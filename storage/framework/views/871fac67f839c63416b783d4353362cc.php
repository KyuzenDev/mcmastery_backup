

<?php $__env->startSection('user'); ?>
    <div class="page-content">
        <h4 class="mb-3">Checkout</h4>

        <div class="card mb-4">
            <div class="card-body">
                <!-- Display product information -->
                <h5 class="card-title"><?php echo e($product->name); ?></h5>
                <p class="card-text">Price: Rp. <?php echo e(number_format($product->price, 2)); ?></p>

                <!-- Purchase form -->
                <form action="<?php echo e(route('user.products.purchase', $pendingTransaction->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Payment method selection -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Select Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="" disabled selected>Select payment method</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="gopay">GoPay</option>
                            <option value="ovo">OVO</option>
                        </select>
                    </div>

                    <!-- Submit buttons -->
                    <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                    <a href="<?php echo e(route('user.transactions.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\user\products\checkout.blade.php ENDPATH**/ ?>