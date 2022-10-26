<div class="top-row">
    <div class="container">
        <div class="dFlex">
            <div>
                <a href="{{ route('index') }}"><img class="topLogo" alt="Hero Fit" title="Hero Fit"
                        src="{{ asset('assets/images/logo.png') }}" /></a>
            </div>
            <div>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="menu-button" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                        <span class="icon-spar"></span>
                        <span class="icon-spar"></span>
                        <span class="icon-spar"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="{{ Route::is('index') ? 'active' : '' }}"
                                    href="{{ route('index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ Route::is('about') ? 'active' : '' }}"
                                    href="{{ route('about') }}">About Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ Route::is('online.training') ? 'active' : '' }}"
                                    href="{{ route('online.training') }}">Online Training</a>
                            </li>
                            <li class="nav-item"><a class="{{ Route::is('shop') ? 'active' : '' }}"
                                    href="{{ route('shop') }}">Shop</a></li>
                            <li class="nav-item">
                                <a class="{{ Route::is('contact') ? 'active' : '' }}"
                                    href="{{ route('contact') }}">Contact Me</a>
                            </li>
                            <li class="nav-item">
                                @auth
                                    <div class="count"@if (!count(Auth::user()->getCart)) style="display:none;" @endif>
                                        {{ count(Auth::user()->getCart) }}</div>
                                    <a href="{{ route('user.cart') }}"><img alt="icon"
                                            src="{{ asset('assets/images/bag-icon.png') }}" /></a>
                                @else
                                    <a href="{{ route('user.login') }}"><img alt="icon"
                                            src="{{ asset('assets/images/bag-icon.png') }}" /></a>
                                @endauth
                            </li>
                            @auth
                                <div class="dropdown">
                                    <li id="menu1" data-toggle="dropdown" class="nav-item">
                                        <div class="userSec userSecDark dropdown-toggle">
                                            <div class="suserImg">
                                                @if (Auth::user()->image)
                                                    <img class="profile_pic_left"
                                                        src="{{ asset('storage/user_image/') . '/' . Auth::user()->image }}"
                                                        alt="">
                                                @else
                                                    <img class="profile_pic_left"
                                                        src="{{ asset('assets/images/no-user-image.png') }}"
                                                        alt="">
                                                @endif
                                            </div>
                                            <p>{{ Auth::user()->getFullNameAttribute() }} </p>
                                        </div>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"
                                                    onclick="window.location='{{ route('user.profile.info') }}'">Profile</a>
                                            </li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"
                                                    onclick="window.location='{{ route('user.my.orders') }}'">Orders</a>
                                            </li>
                                            {{-- <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"
                                                    onclick="window.location='{{ route('user.my.rating.review') }}'">Reviews</a>
                                            </li> --}}
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="javascript:void(0)"
                                                    onclick="window.location='{{ route('user.logout') }}'">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                </div>
                            @else
                                <li class="nav-item">
                                    <a class="signup-btn" href="{{ route('user.login') }}">Sign In</a>
                                </li>
                            @endauth
                        </ul>
                        <a href="javascript:void(0)" title="" class="close-menu"><i class="fa fa-close"></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
