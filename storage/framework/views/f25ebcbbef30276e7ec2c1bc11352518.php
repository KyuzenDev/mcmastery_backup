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
                                        <h5 class="text-muted fw-normal mb-4">Reset Password.</h5>
                                        <form action="<?php echo e(route('user.reset_password_handler', ['token' => $token])); ?>"
                                            method="POST">
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
                                            <div class="input-group custom mb-1">
                                                <input type="password" class="form-control form-control-lg"
                                                    placeholder="New Password" name="new_password">
                                            </div>
                                            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger ml-1"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <div class="input-group custom mb-1 mt-3">
                                                <input type="password" class="form-control form-control-lg"
                                                    placeholder="Confirm New Password" name="new_password_confirm">
                                            </div>
                                            <?php $__errorArgs = ['new_password_confirm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger ml-1"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
</body>

</html>
<?php /**PATH C:\laragon\www\mcmastery\resources\views\auth\reset.blade.php ENDPATH**/ ?>