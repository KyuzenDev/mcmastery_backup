<nav class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('user.dashboard') }}" class="sidebar-brand">
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
                        <a href="{{ route('user.dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.products.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Paid Tutorials</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.transactions.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Transactions</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>