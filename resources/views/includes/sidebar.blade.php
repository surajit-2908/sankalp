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
            <li><a class="{{ $controller_name == 'DashboardController' ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
            <li><a class="{{ $controller_name == 'CompanyController' ? 'active' : '' }}"
                    href="{{ route('admin.company') }}"><i class="fa fa-building-o"></i> Companies</a></li>
            <li><a class="{{ $controller_name == 'OrderController' ? 'active' : '' }}"
                    href="{{ route('admin.order') }}"><i class="fa fa-shopping-cart"></i> Orders</a></li>
            <li><a class="{{ $controller_name == 'EnquiryController' ? 'active' : '' }}"
                    href="{{ route('admin.enquiry') }}"><i class="fa fa-question-circle"></i> Enqueries</a></li>
            <li><a class="{{ $controller_name == 'TrackingController' ? 'active' : '' }}"
                    href="{{ route('admin.tracking') }}"><i class="fa fa-map-marker"></i> Trackings</a></li>
        </ul>
    </nav>
</div>

<!-- ===================== Main Sidebar Section End ===================== -->
