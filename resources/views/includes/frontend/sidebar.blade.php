<div class="bodyLeftPanel">
    <nav>
        <ul class="nav nav-list">
            <li><a href="{{ route('index') }}" class="{{ Route::is('index') ? 'active' : '' }}"><i
                        class="fa fa-tachometer"></i> Dashboard</a></li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu10">
                    <span class="nav-header-primary"><i class="fa fa-calendar"></i> Product</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu10">
                    <li><a href="javascript:void(0)">Accessories</a></li>

                    @foreach ($productCat as $key => $cat)
                        @if (count($cat->getSubcat))
                            <li>
                                <a class="accordion-heading2" data-toggle="collapse"
                                    data-target="#submenu{{ $key }}">
                                    <span class="nav-header-primary">{{ $cat->name }}</span>
                                </a>
                                <ul class="nav nav-list collapse" id="submenu{{ $key }}">
                                    @foreach ($cat->getSubcat as $subcat)
                                        <li><a href="{{ route('product', $subcat->slug) }}">{{ $subcat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('product', $cat->slug) }}">{{ $cat->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu5">
                    <span class="nav-header-primary"><i class="fa fa-paperclip"></i> Accessories</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu5">
                    <li><a href="javascript:void(0)">“O” rings</a></li>
                    <li><a href="javascript:void(0)">Filter Pads</a></li>
                    <li><a href="javascript:void(0)">Gasket</a></li>
                    <li><a href="javascript:void(0)">Non Woven Pads</a></li>
                </ul>
            </li>
            <li>
                <a class="accordion-heading" data-toggle="collapse" data-target="#submenu2">
                    <span class="nav-header-primary"><i class="fa fa-list-alt"></i> Services</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu2">
                    <li><a href="javascript:void(0)">Accessories</a></li>
                    <li><a href="javascript:void(0)">Integrity Testing</a></li>
                    <li><a href="javascript:void(0)">Retrofit Filters</a></li>
                    <li><a href="javascript:void(0)">Filter Servicing</a></li>
                    <li><a href="javascript:void(0)">Nutsche Filter Disc Servicing</a></li>
                    <li><a href="javascript:void(0)">Screen Disc Servicing</a></li>
                    <li><a href="javascript:void(0)">Filter Repair</a></li>
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
                <a class="accordion-heading {{ Route::is(['enquiry', 'about.us']) ? 'active' : '' }} "
                    data-toggle="collapse" data-target="#submenu4">
                    <span class="nav-header-primary"><i class="fa fa-handshake-o"></i> Support</span>
                </a>
                <ul class="nav nav-list collapse" id="submenu4">
                    <li><a href="{{ route('about.us') }}">About Us</a></li>
                    <li><a href="{{ route('enquiry') }}">Contact Us</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <p class="copyright">&copy; 2022 sankalpcorporation.com. </p>
</div>
