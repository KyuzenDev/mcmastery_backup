

<?php $__env->startSection('seller'); ?>
    <div class="page-content">
        <h4 class="mb-3">Your Earnings</h4>

        <div class="card mb-4">
            <div class="card-body">
                <p>Total Earnings: Rp. <?php echo e(number_format($totalCommission, 2)); ?></p>

                <?php if($commissions->isNotEmpty()): ?>
                    <h5>Transaction Details:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction ID</th>
                                <th>Product Name</th>
                                <th>Buyer Name</th>
                                <th>Price (Rp)</th>
                                <th>Earnings (Rp)</th> <!-- Pendapatan seller setelah potong komisi -->
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($commission->id); ?></td>
                                    <td><?php echo e($commission->product->name); ?></td>
                                    <td><?php echo e($commission->user->name); ?></td>
                                    <td><?php echo e(number_format($commission->amount, 2)); ?></td>
                                    <td><?php echo e(number_format($commission->amount * (1 - 0.10), 2)); ?></td> <!-- 90% dari harga -->
                                    <td>
                                        <?php if($commission->status === 'completed'): ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php elseif($commission->status === 'pending'): ?>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php elseif($commission->status === 'failed'): ?>
                                            <span class="badge bg-danger">Failed</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Unknown</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No transactions found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\seller\commission.blade.php ENDPATH**/ ?>