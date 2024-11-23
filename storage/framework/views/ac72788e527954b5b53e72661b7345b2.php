<!-- resources/views/seller/products/edit.blade.php -->


<?php $__env->startSection('seller'); ?>
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Edit Product</h4>
            </div>
        </div>

        <!-- Tambahkan enctype="multipart/form-data" untuk menangani file upload -->
        <form method="POST" action="<?php echo e(route('seller.products.update', $product->id)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>

            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo e($product->name); ?>" required>
            </div>

            <!-- Harga Produk -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo e($product->price); ?>" required>
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="productDescription" maxlength="500"><?php echo e($product->description); ?></textarea>
                <small id="descriptionCount" class="form-text text-muted">0/500 characters</small>
                <?php $__errorArgs = ['description'];
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

            <!-- Thumbnail Image Produk -->
            <div class="mb-3">
                <label for="productThumbnail" class="form-label">Thumbnail Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">

                <!-- Tampilkan thumbnail saat ini jika ada -->
                <?php if($product->image): ?>
                    <div class="mt-3">
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="Current Thumbnail" width="500">
                    </div>
                <?php endif; ?>

                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        document.getElementById('productDescription').addEventListener('input', function() {
            const maxLength = 500;
            const currentLength = this.value.length;

            const charCount = document.getElementById('descriptionCount');
            charCount.textContent = `${currentLength}/${maxLength} characters`;

            if (currentLength > maxLength) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\seller\products\edit.blade.php ENDPATH**/ ?>