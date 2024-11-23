<nav class="sidebar">
    <div class="sidebar-header">
        <a href="<?php echo e(route('seller.dashboard')); ?>" class="sidebar-brand">
            MC<span>Mastery</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="<?php echo e(route('seller.dashboard')); ?>" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse"
                    href="#products" role="button" aria-expanded="false" aria-controls="products">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">My Products</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="products">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('seller.products.manage')); ?>">
                                Manages Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('seller.products.create')); ?>">
                                Add New Product
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('seller.commission')); ?>" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Commission</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH C:\laragon\www\mcmastery\resources\views\seller\body\sidebar.blade.php ENDPATH**/ ?>