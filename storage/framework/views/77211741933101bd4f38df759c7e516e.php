

<?php $__env->startSection('user'); ?>
    <div class="page-content">
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
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">All Tutorials</h4>
            </div>
        </div>
        <form method="GET" action="<?php echo e(route('user.products.index')); ?>" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search here...">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <!-- Display product video preview or placeholder if no video -->
                        <?php if($product->video): ?>
                            <video id="videoPreview<?php echo e($product->id); ?>" class="card-img-top video-preview" muted
                                preload="auto">
                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/mp4">
                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/mov">
                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="No Video">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                            <p>Rp. <?php echo e(number_format($product->price, 2)); ?></p>
                            <p class="mb-2"><strong>Seller:</strong> <?php echo e($product->seller->name); ?></p>

                            <!-- Buttons for Details and Report -->
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#reportModal<?php echo e($product->seller->id); ?>">
                                    Report
                                </button>
                                <!-- Button to trigger details modal -->
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#productModal<?php echo e($product->id); ?>">
                                    Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for product details -->
                <div class="modal fade" id="productModal<?php echo e($product->id); ?>" tabindex="-1"
                    aria-labelledby="productModalLabel<?php echo e($product->id); ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel<?php echo e($product->id); ?>">Product Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                <!-- Display product image -->
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>"
                                        class="img-fluid mb-3">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/300" alt="No Image" class="img-fluid mb-3">
                                <?php endif; ?>

                                <!-- Display product details -->
                                <h5><?php echo e($product->name); ?></h5>
                                <p class="mb-3">Rp. <?php echo e(number_format($product->price, 2)); ?></p>
                                <textarea name="description" class="form-control" id="productDescription" placeholder="<?php echo e($product->description); ?>"
                                    maxlength="500" readonly style="width: 100%; height: 150px;"></textarea>
                                <p class="mt-2"><strong>Seller:</strong> <?php echo e($product->seller->name); ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary"
                                    onclick="confirmCheckout(<?php echo e($product->id); ?>, '<?php echo e($product->name); ?>', '<?php echo e(number_format($product->price, 2)); ?>')">Buy</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for reporting seller -->
                <div class="modal fade" id="reportModal<?php echo e($product->seller->id); ?>" tabindex="-1"
                    aria-labelledby="reportModalLabel<?php echo e($product->seller->id); ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reportModalLabel<?php echo e($product->seller->id); ?>">Report Seller</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(route('user.reports.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="seller_id" value="<?php echo e($product->seller->id); ?>">
                                    <div class="mb-3">
                                        <label for="reportReason" class="form-label">Reason for Reporting</label>
                                        <textarea class="form-control" id="reportReason" name="reason" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Submit Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Checkout -->
                <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkoutModalLabel">Confirm Checkout</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p id="checkoutProductName"></p>
                                <p id="checkoutProductPrice"></p>

                            </div>
                            <div class="modal-footer">
                                <form id="checkoutForm" method="GET">
                                    <?php echo csrf_field(); ?>
                                    <!-- Add other necessary form fields if required -->
                                    <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('.video-preview');
            const previewDuration = 10; // Set preview duration in seconds

            videos.forEach(function(video) {
                // Set video quality to high by specifying a high-resolution source
                video.addEventListener('loadedmetadata', function() {
                    video.playbackRate = 1; // Ensure normal playback speed
                    video.defaultPlaybackRate = 1;
                });

                // Disable seeking
                video.addEventListener('timeupdate', function() {
                    if (video.currentTime > previewDuration) {
                        video.pause();
                        video.currentTime = 0; // Reset video to the beginning
                    }
                });

                // Play video when mouse hovers over it
                video.addEventListener('mouseenter', function() {
                    video.play();
                });

                // Pause video and reset when mouse leaves the video
                video.addEventListener('mouseleave', function() {
                    video.pause();
                    video.currentTime = 0; // Reset to the start of the video
                });

                // Prevent user from changing video progress manually
                video.addEventListener('seeking', function() {
                    if (video.currentTime > previewDuration) {
                        video.currentTime =
                            0; // Reset to the start if user tries to seek beyond preview
                    }
                });

                // Pause and reset video when preview duration is reached
                video.addEventListener('timeupdate', function() {
                    if (video.currentTime >= previewDuration) {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            });
        });

        // Function to set the product details in the checkout modal
        function confirmCheckout(productId, productName, productPrice) {
            // Set product name and price in the modal
            document.getElementById('checkoutProductName').innerText = productName;
            document.getElementById('checkoutProductPrice').innerText = 'Amount: Rp. ' + productPrice;

            // Set the action for the checkout form
            const form = document.getElementById('checkoutForm');
            form.action = `/user/products/checkout/${productId}`; // Set the action URL to purchase

            // Hide the current product detail modal if it's open
            var currentModal = bootstrap.Modal.getInstance(document.querySelector('.modal.show')); // Find the open modal
            if (currentModal) {
                currentModal.hide(); // Close the currently open modal
            }

            // Show the checkout modal
            var checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            checkoutModal.show();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\user\products\index.blade.php ENDPATH**/ ?>