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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo2/style.css')); ?>">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" />
    <?php echo $__env->yieldPushContent('stylesheets'); ?>
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
                                        <a href="<?php echo e(route('user.login')); ?>"
                                            class="noble-ui-logo logo-light d-block mb-2">MC<span>Mastery</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                        <form class="forms-sample" method="post" action="<?php echo e(route('user.login')); ?>">
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
                                                <input type="text" class="form-control" name="login_id"
                                                    value="<?php echo e(old('login_id')); ?>" id="email"
                                                    placeholder="Username / Email">
                                                <?php $__errorArgs = ['login_id'];
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
                                                <input type="password" class="form-control" name="password"
                                                    id="password" autocomplete="current-password"
                                                    placeholder="Password">
                                                <button type="button"
                                                    class="btn btn-outline-primary position-absolute end-0 top-0"
                                                    style="height: 100%;" onclick="togglePasswordVisibility()">
                                                    <i id="toggleIcon" class="bi bi-eye"></i> <!-- Bootstrap Icons -->
                                                </button>
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
                                            <div class="form-check mb-3">
                                                <input type="checkbox" name="remember" class="form-check-input"
                                                    id="remember">
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                                <a style="float: right;" href="<?php echo e(route('user.forgot')); ?>"
                                                    class="text-muted text-white"><u>Forgot Password</u></a>
                                            </div>

                                            <button type="submit"
                                                class="btn btn-primary text-white  me-2 mb-2 mb-md-0">Login</button>
                                            <a href="<?php echo e(route('user.register')); ?>"
                                                class="d-block mt-3 text-muted">Don't have an account?
                                                <u>Register</u></a>
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
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('toggleIcon');

            // Ubah tipe input antara 'password' dan 'text'
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\mcmastery\resources\views/auth/login.blade.php ENDPATH**/ ?>