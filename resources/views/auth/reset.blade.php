<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>MCMastery - Reset Password</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    @stack('stylesheets')
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-16 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="{{ route('user.login') }}"
                                            class="noble-ui-logo logo-light d-block mb-2">MC<span>Mastery</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Reset Password.</h5>
                                        <form action="{{ route('user.reset_password_handler', ['token' => $token]) }}"
                                            method="POST">
                                            <x-form-alerts></x-form-alerts>
                                            @csrf
                                            <div class="input-group custom mb-1">
                                                <input type="password" class="form-control form-control-lg"
                                                    placeholder="New Password" name="new_password">
                                            </div>
                                            @error('new_password')
                                                <span class="text-danger ml-1">{{ $message }}</span>
                                            @enderror
                                            <div class="input-group custom mb-1 mt-3">
                                                <input type="password" class="form-control form-control-lg"
                                                    placeholder="Confirm New Password" name="new_password_confirm">
                                            </div>
                                            @error('new_password_confirm')
                                                <span class="text-danger ml-1">{{ $message }}</span>
                                            @enderror
                                            <div class=" align-items-center mt-3">
                                                <div class="input-group">
                                                    <input class="btn btn-primary btn-lg btn-block" type="submit"
                                                        value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    @stack('scripts')
</body>

</html>
