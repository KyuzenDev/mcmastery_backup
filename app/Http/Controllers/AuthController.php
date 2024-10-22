<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Helpers\CMail;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'MCMastery | Login'
        ];
        return view('auth.login', $data);
    }
    public function regisForm(Request $request)
    {
        $data = [
            'pageTitle' => 'MCMastery | Register'
        ];
        return view('auth.register', $data);
    }
    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'MCMastery | Forgot Password'
        ];
        return view('auth.forgot', $data);
    }

    public function regisHandlerUser(Request $request)
    {

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:4|max:20|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:user,seller',
        ]);

        if ($validator->fails()) {
            $input = $request->all();

            // Check if the username validation fails, remove it from input
            if ($validator->errors()->has('name')) {
                unset($input['name']);
            }

            // Check if the email validation fails, remove it from input
            if ($validator->errors()->has('email')) {
                unset($input['email']);
            }

            // Check if the password validation fails, remove it from input
            if ($validator->errors()->has('password')) {
                unset($input['password']);
                unset($input['password_confirmation']);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput($input);  // Pass the remaining valid input back to the form
        }

        $user = User::create([
            'name'            => $request->name,
            'username'        => strtolower($request->name), // Buat username menjadi huruf kecil
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => $request->role, // Menyimpan role
            'status'          => UserStatus::Pending,
            'commission_rate' => 10.00, // Persentase komisi 10%
        ]);

        // Redirect ke halaman dashboard user
        return redirect()->route('user.login')->with('success', 'Registration successful!');
    }

    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validasi berdasarkan tipe login (email atau username)
        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:8',

            ], [
                'login_id.required' => 'Enter your email or username',
                'login_id.email'    => 'Invalid email address',
                'login_id.exists'   => 'No account found for this email',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:8',

            ], [
                'login_id.required' => 'Enter your username or email',
                'login_id.username' => 'Invalid username',
                'login_id.exists'   => 'No account found for this username',
            ]);
        }

        // Credentials untuk login
        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password,
        );

        // Attempt login
        if (Auth::attempt($creds)) {

            // Buat user baru dengan role yang valid
            $user = Auth::user();
            ;


            // Periksa status user

            if ($user->status === UserStatus::Pending) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('user.login')->with('fail', 'Your account is currently pending approval. Please, check your email for further instructions or contact support at (support@mcmastery.test) assistance.');
            }

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'user') {
                return redirect()->route('user.dashboard');
            } elseif ($user->role == 'seller') {
                return redirect()->route('seller.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('user.login')->with('fail', 'Unknown role assigned to your account. Please contact support.');
            }
        } else {
            // Redirect kembali ke halaman login masing-masing jika password salah
            if ($fieldType == 'email') {
                // Cek apakah user login sebagai admin atau user berdasarkan input email
                $user = User::where('email', $request->login_id)->first();
            } else {
                // Cek berdasarkan username
                $user = User::where('username', $request->login_id)->first();
            }

            // Redirect ke halaman login yang sesuai dengan role
            if ($user && $user->role == 'admin') {
                return redirect()->route('admin.login')->withInput()->with('fail', 'Incorrect password.');
            } elseif ($user && $user->role == 'user') {
                return redirect()->route('user.login')->withInput()->with('fail', 'Incorrect password.');
            } elseif ($user && $user->role == 'seller') {
                return redirect()->route('seller.login')->withInput()->with('fail', 'Incorrect password.');
            } else {
                return redirect()->route('user.login')->withInput()->with('fail', 'No account found.');
            }
        }
    }


    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ],
            [
                'email.required' => 'The :attribute is required',
                'email.email'    => 'Invalid email address',
                'email.exists'   => 'We can not find a user with this email address'
            ]
        );

        $user = User::where('email', $request->email)->first();

        $token = base64_encode(Str::random(64));

        $oldToken = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->update([
                    'token'      => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email'      => $user->email,
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);
        }

        $actionLink = route('user.reset_password_form', ['token' => $token]);

        $data = array(
            'actionlink' => $actionLink,
            'user'       => $user
        );

        $mail_body = view('email-templates.forgot-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name'    => $user->name,
            'subject'           => 'Reset Password',
            'body'              => $mail_body
        );

        if (CMail::send($mailConfig)) {
            return redirect()->route('user.forgot')->with('success', 'We have e-mailed your password reset link.');
        } else {
            return redirect()->route('user.forgot')->with('fail', 'Something went wrong. Resetting password link not sent. Try again later.');
        }
    }

    public function resetForm(Request $request, $token = null)
    {
        $isTokenExists = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$isTokenExists) {
            return redirect()->route('user.forgot')->with('fail', 'Invalid token. Request another reset password link.');
        } else {
            $data = [
                'pageTitle' => 'MCMastery | Reset Password',
                'token'     => $token
            ];

            return view('auth.reset', $data);
        }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password'         => 'required|min:8|required_with:new_password_confirm|same:new_password_confirm',
            'new_password_confirm' => 'required'
        ]);

        $dbToken = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        $user = User::where('email', $dbToken->email)->first();

        User::where('email', $user->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $data = array(
            'user'         => $user,
            'new_password' => $request->new_password
        );

        $mail_body = view('email-templates.password-changes-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name'    => $user->name,
            'subject'           => 'Password Changed',
            'body'              => $mail_body
        );

        if (CMail::send($mailConfig)) {
            DB::table('password_reset_tokens')->where([
                'email' => $dbToken->email,
                'token' => $dbToken->token
            ])->delete();

            return redirect()->route('user.login')->with('success', 'Done!, Your password has been changed successfully. Use your new password for login into system.');
        } else {
            return redirect()->route('user.reset_password_form', ['token' => $dbToken->token])->with('fail', 'Something went wrong. Try again later.');
        }
    }
}
