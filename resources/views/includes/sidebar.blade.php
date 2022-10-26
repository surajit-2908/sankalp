@php
    $controller_arr = explode(
        '\\',
        request()
            ->route()
            ->getAction()['controller'],
    );
    $controllerArr = explode('@', end($controller_arr));
    $controller_name = $controllerArr[0];
@endphp

<!-- ===================== Main Sidebar Section Start ===================== -->

<div class="bodyLeftPanel">
    <nav>
        <ul class="nav nav-list">
            <li><a class="{{ $controller_name == 'DashboardController' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i
                        class="fa fa-tachometer"></i> Dashboard</a></li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu1">
                    <span class="nav-header-primary"><i class="fa fa-calendar"></i> Product</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu1">
                    <li><a href="#">Filter Housing</a></li>
                    <li><a href="#">Filter Consumable</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu2">
                    <span class="nav-header-primary"><i class="fa fa-list-alt"></i> Services</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu2">
                    <li><a href="#">Filter</a></li>
                    <li><a href="#">Cleaning</a></li>
                    <li><a href="#">Testing</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu3">
                    <span class="nav-header-primary"><i class="fa fa-cog"></i> Technical Resources</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu3">
                    <li><a href="#">Start Here</a></li>
                    <li><a href="#">Industry</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu4">
                    <span class="nav-header-primary"><i class="fa fa-handshake-o"></i> Support</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu4">
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>

<!-- ===================== Main Sidebar Section End ===================== -->
