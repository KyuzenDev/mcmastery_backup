<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="MCMastery">
    <meta name="author" content="MCMastery">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>MCMastery</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('/assets/vendors/core/core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/vendors/flatpickr/flatpickr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather-font/css/iconfont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo2/style.css')); ?>">

    <link rel="shortcut icon" href="<?php echo e(asset('/assets/images/favicon.png')); ?>" />
    <style>
        .video-preview {
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .video-preview:hover {
            opacity: 0.8;
        }

        .video {
            pointer-events: none;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            overflow: hidden;
            display: block;
        }

        .profile-image-small {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">

        <?php echo $__env->make('user.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page-wrapper">

            <?php echo $__env->make('user.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('user'); ?>
            <?php echo $__env->make('user.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>

    <script src="<?php echo e(asset('assets/vendors/core/core.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/flatpickr/flatpickr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/template.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashboard-dark.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\mcmastery\resources\views/user/dashboard.blade.php ENDPATH**/ ?>