<div class="bodyLeftPanel">
    <nav>
        <ul class="nav nav-list">
            <li><a href="{{ route('index') }}" class="{{ Route::is('index') ? 'active' : '' }}"><i
                        class="fa fa-tachometer"></i> Dashboard</a></li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu1">
                    <span class="nav-header-primary"><i class="fa fa-calendar"></i> Product</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu1">
                    <li>
                        <a class="accordion-heading2" data-toggle="collapse" data-target="#submenu5">
                            <span class="nav-header-primary">Filter Housing</span>
                        </a> 
                    <ul class="nav nav-list collapse" id="submenu5">
                        <li><a href="javascript:void(0)">fdfdfd</a></li>
                        <li><a href="javascript:void(0)">dfdfd</a></li>
                     </ul>               
                    </li>
                    <li><a href="javascript:void(0)">Filter Consumable</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu2">
                    <span class="nav-header-primary"><i class="fa fa-list-alt"></i> Services</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu2">
                    <li><a href="javascript:void(0)">Filter</a></li>
                    <li><a href="javascript:void(0)">Cleaning</a></li>
                    <li><a href="javascript:void(0)">Testing</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu3">
                    <span class="nav-header-primary"><i class="fa fa-cog"></i> Technical Resources</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu3">
                    <li><a href="javascript:void(0)">Start Here</a></li>
                    <li><a href="javascript:void(0)">Industry</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading {{ Route::is('enquiry') ? 'active' : '' }} " data-toggle="collapse"
                    data-target="#submenu4">
                    <span class="nav-header-primary"><i class="fa fa-handshake-o"></i> Support</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu4">
                    <li><a href="{{ route('enquiry') }}">Contact Us</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <p class="copyright">&copy; 2022 sankalpcorporation.com. </p>
</div>
