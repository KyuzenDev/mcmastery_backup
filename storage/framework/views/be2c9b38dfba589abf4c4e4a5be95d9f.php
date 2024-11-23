<div>
    <div class="mb-3">
        <?php if( Session::get('info') ): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo Session::get('info'); ?>

                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if( Session::get('fail') ): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo Session::get('fail'); ?>

                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if( Session::get('success') ): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo Session::get('success'); ?>

                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\mcmastery\resources\views\components\form-alerts.blade.php ENDPATH**/ ?>