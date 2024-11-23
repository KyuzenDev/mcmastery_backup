

<?php $__env->startSection('admin'); ?>
    <div class="page-content">
        <h4 class="mb-3">Seller Reports</h4>

        <!-- Total Admin Commission di bagian atas -->
        <div class="alert alert-info">
            <h5>Total Admin Commission (Rp): <?php echo e(number_format($totalAdminCommission, 2)); ?></h5>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <?php if($sellerReports->isNotEmpty()): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Seller Name</th>
                                <th>Total Seller Commission (Rp)</th> <!-- Ubah menjadi komisi seller -->
                                <th>Number of Reports</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sellerReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($report['seller']->name); ?></td>
                                    <td><?php echo e(number_format($report['totalSellerCommission'], 2)); ?></td> <!-- Menampilkan komisi seller -->
                                    <td><?php echo e($report['reportsCount']); ?></td> <!-- Menampilkan jumlah laporan -->
                                    <td>
                                        <a href="<?php echo e(route('admin.sellerDetails', $report['seller']->id)); ?>" class="btn btn-primary">Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No sellers found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views/admin/sellerReports.blade.php ENDPATH**/ ?>