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

    <title>MCMastery - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/core/core.css')); ?>">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather-font/css/iconfont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
    <!-- endinject -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo2/style.css')); ?>">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" />
    <style>
        .role-box {
            display: inline-block;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
            text-align: center;
            width: 120px;
        }

        .role-box input[type="radio"] {
            display: none;
        }

        .role-box.active {
            background-color: #6571ff;
            color: white;
            border-color: #6571ff;
        }

        .role-box:hover {
            border-color: #6571ff;
        }

        .role-box label {
            cursor: pointer;
            font-weight: bold;
        }
    </style>
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
                                        <a href="<?php echo e(route('user.register')); ?>"
                                            class="noble-ui-logo logo-light d-block mb-2">MC<span>Mastery</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                                        <form class="forms-sample" method="post" action="<?php echo e(route('user.register')); ?>">
                                            <?php if (isset($component)) { $__componentOriginal05c67cae45fbecf1eafe99c6dadf9b47 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05c67cae45fbecf1eafe99c6dadf9b47 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-alerts','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-alerts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05c67cae45fbecf1eafe99c6dadf9b47)): ?>
<?php $attributes = $__attributesOriginal05c67cae45fbecf1eafe99c6dadf9b47; ?>
<?php unset($__attributesOriginal05c67cae45fbecf1eafe99c6dadf9b47); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05c67cae45fbecf1eafe99c6dadf9b47)): ?>
<?php $component = $__componentOriginal05c67cae45fbecf1eafe99c6dadf9b47; ?>
<?php unset($__componentOriginal05c67cae45fbecf1eafe99c6dadf9b47); ?>
<?php endif; ?>
                                            <?php echo csrf_field(); ?>

                                            <div class="mb-3">
                                                <!-- Option for Customer -->
                                                <div class="role-box <?php echo e(old('role') == 'user' ? 'active' : ''); ?>"
                                                    onclick="selectRole('roleUser')">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="roleUser" value="user"
                                                        <?php echo e(old('role') == 'user' ? 'checked' : ''); ?> required>
                                                    <label for="roleUser">Customer</label>
                                                </div>

                                                <!-- Option for Seller -->
                                                <div class="role-box <?php echo e(old('role') == 'seller' ? 'active' : ''); ?>"
                                                    onclick="selectRole('roleSeller')">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="roleSeller" value="seller"
                                                        <?php echo e(old('role') == 'seller' ? 'checked' : ''); ?> required>
                                                    <label for="roleSeller">Seller</label>
                                                </div>

                                                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger ml-1"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="mb-3">
                                                <input type="text" name="name" class="form-control"
                                                    value="<?php echo e(old('name')); ?>" id="exampleInputUsername1"
                                                    autocomplete="false" placeholder="Username" required>
                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger ml-1"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="mb-3">
                                                <input type="email" class="form-control" id="userEmail"
                                                    value="<?php echo e(old('email')); ?>" placeholder="Email" name="email"
                                                    required>
                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger ml-1"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <!-- Input Password -->
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password"
                                                        id="userPassword" autocomplete="new-password"
                                                        placeholder="Password" required>
                                                    <button class="btn btn-outline-primary" type="button"
                                                        onclick="togglePasswordVisibility('userPassword', 'toggleIcon1')">
                                                        <i id="toggleIcon1" class="bi bi-eye"></i>
                                                        <!-- Bootstrap Icon eye -->
                                                    </button>
                                                </div>
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger ml-1"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>   
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <!-- Input Confirm Password -->
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" id="passwordConfirmation"
                                                        placeholder="Confirm Password" required>
                                                    <button class="btn btn-outline-primary" type="button"
                                                        onclick="togglePasswordVisibility('passwordConfirmation', 'toggleIcon2')">
                                                        <i id="toggleIcon2" class="bi bi-eye"></i>
                                                        <!-- Bootstrap Icon eye -->
                                                    </button>
                                                </div>
                                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>



                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary text-white me-2 mb-2 mb-md-0">Sign
                                                    up</button>
                                            </div>

                                            <a href="<?php echo e(route('user.login')); ?>"
                                                class="d-block mt-3 text-muted">Already a user? <u>Login</u></a>
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

    <script>
        function selectRole(id) {
            // Remove 'active' class from all role-boxes
            document.querySelectorAll('.role-box').forEach(function(el) {
                el.classList.remove('active');
            });

            // Add 'active' class to the clicked role-box
            document.getElementById(id).parentElement.classList.add('active');

            // Select the radio input
            document.getElementById(id).checked = true;
        }

        // Initial load check if any role is selected
        window.onload = function() {
            const checkedRadio = document.querySelector('input[name="role"]:checked');
            if (checkedRadio) {
                checkedRadio.parentElement.classList.add('active');
            }
        };

        function togglePasswordVisibility(inputId, iconId) {
            var passwordInput = document.getElementById(inputId);
            var toggleIcon = document.getElementById(iconId);

            // Toggle between 'password' and 'text' input types
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye'); // Remove the "eye" icon
                toggleIcon.classList.add('bi-eye-slash'); // Add the "eye-slash" icon
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash'); // Remove the "eye-slash" icon
                toggleIcon.classList.add('bi-eye'); // Add the "eye" icon
            }
        }
    </script>

    <!-- core:js -->
    <script src="<?php echo e(asset('vendors/core/core.js')); ?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="<?php echo e(asset('vendors/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/template.js')); ?>"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>

</html>
<?php /**PATH C:\laragon\www\mcmastery\resources\views\auth\register.blade.php ENDPATH**/ ?>