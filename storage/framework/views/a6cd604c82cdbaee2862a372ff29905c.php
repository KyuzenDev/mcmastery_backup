<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="MCMastery">
    <meta name="author" content="MCMastery">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Admin Panel - MCMastery</title>

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

        .photo_image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid transparent;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">

        <?php echo $__env->make('admin.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page-wrapper">

            <?php echo $__env->make('admin.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('admin'); ?>
            <?php echo $__env->make('admin.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>

    <script src="<?php echo e(asset('assets/vendors/core/core.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/flatpickr/flatpickr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/template.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashboard-dark.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/sweet-alert.js')); ?>"></script>

    <?php echo $__env->yieldContent('script'); ?>
    <script type="text/javascript">
        function showModal(userId, type) {
            document.getElementById('modalUserId').value = userId;
            document.getElementById('modalType').value = type;

            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }

        function submitForm() {
            var userId = document.getElementById('modalUserId').value;
            var type = document.getElementById('modalType').value;

            if (type === 'role') {
                document.getElementById('updateRoleForm' + userId).submit();
            } else if (type === 'status') {
                document.getElementById('updateStatusForm' + userId).submit();
            }
        }
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\mcmastery\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>