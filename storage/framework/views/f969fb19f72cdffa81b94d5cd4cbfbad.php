
<?php $__env->startSection('admin'); ?>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('admin/users')); ?>">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
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
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Users</h6>
                        <form method="get">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <input type="text" name="username" class="form-control"
                                        value="<?php echo e(Request()->username); ?>" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <select name="role" class="form-control">
                                        <option value="-">Select Role</option>
                                        <option value="admin"<?php echo e(Request()->role == 'admin' ? 'selected' : ''); ?>>Admin
                                        </option>
                                        <option value="seller"<?php echo e(Request()->role == 'seller' ? 'selected' : ''); ?>>Seller
                                        </option>
                                        <option value="user"<?php echo e(Request()->role == 'user' ? 'selected' : ''); ?>>User
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                            <a href="<?php echo e(url('admin/users')); ?>" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Users</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $getRecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e($data->username); ?></td>
                                            <td><?php echo e($data->email); ?></td>
                                            <td>
                                                <form id="updateRoleForm<?php echo e($data->id); ?>" method="POST"
                                                    action="<?php echo e(route('admin.updateRole', $data->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <select class="form-select" name="role"
                                                        onchange="showModal(<?php echo e($data->id); ?>, 'role')">
                                                        <option value="admin"
                                                            <?php echo e($data->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                                        <option value="seller"
                                                            <?php echo e($data->role == 'seller' ? 'selected' : ''); ?>>Seller</option>
                                                        <option value="user"
                                                            <?php echo e($data->role == 'user' ? 'selected' : ''); ?>>User</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <td>
                                                <form id="updateStatusForm<?php echo e($data->id); ?>" method="POST"
                                                    action="<?php echo e(route('admin.updateStatus', $data->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <select class="form-select" name="status"
                                                        onchange="showModal(<?php echo e($data->id); ?>, 'status')">
                                                        <option value="active"
                                                            <?php echo e($data->status == 'active' ? 'selected' : ''); ?>>Active
                                                        </option>
                                                        <option value="pending"
                                                            <?php echo e($data->status == 'pending' ? 'selected' : ''); ?>>Pending
                                                        </option>
                                                        <option value="rejected"
                                                            <?php echo e($data->status == 'rejected' ? 'selected' : ''); ?>>Rejected
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>



                                            <td><?php echo e($data->created_at); ?></td>
                                            <!-- Tombol untuk Memunculkan Modal -->
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal<?php echo e($data->id); ?>">
                                                    <i data-feather="trash-2" width="16" height="12"></i>
                                                </button>
                                            </td>

                                            <!-- Modal Bootstrap 5 -->
                                            <div class="modal fade" id="deleteModal<?php echo e($data->id); ?>" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak
                                                            dapat diurungkan.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- Form Penghapusan -->
                                                            <form action="<?php echo e(route('admin.delete', $data->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="100%">No Record Found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding: 10px; float: right;">
                            <?php echo $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to make this change?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden Inputs untuk Menyimpan Data -->
        <input type="hidden" id="modalUserId">
        <input type="hidden" id="modalType">

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views/admin/list/users.blade.php ENDPATH**/ ?>