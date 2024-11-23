<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="profile-image-small"
                            src="<?php echo e(Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default-profile.png')); ?>"
                            alt="<?php echo e(Auth::user()->name ?? 'Default User'); ?>">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <img class="profile-image"
                            src="<?php echo e(Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default-profile.png')); ?>"
                            alt="<?php echo e(Auth::user()->name ?? 'Default User'); ?>">

                        <div class="text-center">
                            <p class="tx-16 fw-bolder"><?php echo e(Auth::user()->name); ?></p>
                            <p class="tx-12 text-muted"><?php echo e(Auth::user()->email); ?></p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="<?php echo e(route('user.profile')); ?>" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="<?php echo e(route('user.logout')); ?>" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH C:\laragon\www\mcmastery\resources\views/user/body/header.blade.php ENDPATH**/ ?>