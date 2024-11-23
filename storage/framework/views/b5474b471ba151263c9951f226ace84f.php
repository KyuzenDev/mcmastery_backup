

<?php $__env->startSection('admin'); ?>
    <div class="page-content">
        <h4 class="mb-3">Seller Details</h4>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <img src="<?php echo e(asset('storage/' . $seller->profile_image)); ?>" alt="<?php echo e($seller->name); ?>"
                            class="photo_image img-fluid">
                    </div>
                    <div class="col-md-9">
                        <h5><?php echo e($seller->name); ?></h5>
                        <p>Email: <?php echo e($seller->email); ?></p>
                    </div>
                </div>

                <?php if($seller->products->isNotEmpty()): ?>
                    <h5 class="mb-3">Products:</h5>

                    <!-- Menggunakan Bootstrap's card layout untuk produk -->
                    <div class="row">
                        <?php
                            // Mengurutkan produk berdasarkan jumlah pembeli
                            $sortedProducts = $seller->products->sortByDesc(function ($product) {
                                return $product->transactions->count();
                            });
                        ?>

                        <?php $__currentLoopData = $sortedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <!-- Menampilkan thumbnail jika tersedia -->
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>"
                                            class="card-img-top img-fluid">
                                    <?php endif; ?>
                                    <?php if($product->video): ?>
                                        <div class="mt-3">
                                            <video width="100%" controls>
                                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/mp4">
                                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/mov">
                                                <source src="<?php echo e(asset('storage/' . $product->video)); ?>" type="video/webm">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                        <p class="card-text">Price: Rp <?php echo e(number_format($product->price, 2)); ?></p>
                                        <p class="card-text mb-2">Total Buyers: <?php echo e($product->transactions->count()); ?></p>

                                        <!-- Menampilkan deskripsi produk -->
                                        <p class="card-text"><?php echo e(Str::limit($product->description, 100)); ?></p>
                                        <!-- Memotong deskripsi agar tidak terlalu panjang -->

                                        <!-- Menampilkan video jika tersedia -->

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="mt-3">No products found for this seller.</p>
                <?php endif; ?>

                <!-- Tambahkan list laporan dari user tentang seller ini -->
                <?php if($seller->reports->isNotEmpty()): ?>
                    <h5 class="mt-3 mb-3">User Reports:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reported By</th>
                                <th>Reason</th>
                                <th>Date Reported</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $seller->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($report->user->name); ?></td>
                                    <td><?php echo e($report->reason); ?></td>
                                    <td><?php echo e($report->created_at->format('d M Y')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="mt-3">No reports found for this seller.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\admin\sellerDetails.blade.php ENDPATH**/ ?>