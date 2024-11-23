

<?php $__env->startSection('user'); ?>
    <div class="page-content">
        <h4 class="mb-4">Payment for <?php echo e($product->name); ?></h4>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Price: Rp. <?php echo e(number_format($product->price, 2)); ?></h5>

                <form action="<?php echo e(route('user.products.checkout', $product->id)); ?>" method="GET">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                    <a href="<?php echo e(route('user.products.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\user\products\payment.blade.php ENDPATH**/ ?>