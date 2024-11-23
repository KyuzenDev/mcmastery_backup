
<?php $__env->startSection('seller'); ?>
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Manage Products</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <form action="<?php echo e(route('seller.products.manage')); ?>" method="GET" class="me-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?php echo e(request('search')); ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <a href="<?php echo e(route('seller.products.create')); ?>" class="btn btn-primary">Add New Product</a>
            </div>
        </div>

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
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $getRecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <?php if($product->video): ?>
                            <video class="card-img-top" controls>
                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/mp4">
                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/mov">
                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                        <?php elseif($product->image): ?>
                            <img class="card-img-top" src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                alt="<?php echo e($product->name); ?>">
                        <?php else: ?>
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="No Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                            <p class="card-text short-description" id="short-description-<?php echo e($product->id); ?>">
                                <?php echo e(Str::limit($product->description, 100)); ?>

                                <?php if(strlen($product->description) > 100): ?>
                                    <a href="javascript:void(0)" onclick="showFullDescription(<?php echo e($product->id); ?>)">See
                                        more</a>
                                <?php endif; ?>
                            </p>
                            <p class="card-text full-description" id="full-description-<?php echo e($product->id); ?>"
                                style="display:none;">
                                <?php echo e($product->description); ?>

                                <a href="javascript:void(0)" onclick="showShortDescription(<?php echo e($product->id); ?>)">Show
                                    less</a>
                            </p>
                            <p class="card-text mb-3">Price: Rp. <?php echo e(number_format($product->price, 2)); ?></p>
                            <a href="<?php echo e(route('seller.products.edit', $product->id)); ?>" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal<?php echo e($product->id); ?>">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal<?php echo e($product->id); ?>" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the product "<?php echo e($product->name); ?>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="<?php echo e(route('seller.products.delete', $product->id)); ?>"
                                                method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <p>No products available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views/seller/products/index.blade.php ENDPATH**/ ?>