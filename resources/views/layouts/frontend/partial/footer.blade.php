<section class="informations-section padding-20-20">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-md-3 mb-md-0 mb-sm-4 mb-3">
                <div class="single-info">
                    <h4 class="title">payment method</h4>
                    <ul class="payments">
                        <li><img src="{{asset('image/all-payment-area.png')}}" alt=""></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-8 mb-md-0 mb-sm-4 mb-3 mx-auto">
                <div class="single-info">
                    <h4 class="title text-center">client slide set</h4>
                    <ul class="client-carousel owl-carousel">
                        {{ clients() }}
                    </ul>
                </div>
            </div>
            <div class="col-md-3 mb-md-0 mb-4">
                <div class="single-info">
                    <h4 class="title">Social Link</h4>
                    <ul class="social">
                        {{ site_icon() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a class="chat-btn" href="#"><i class="bi bi-chat-square-text"></i> live chat</a>
</section>
<!-- End Informations -->
<footer class="footer-section">
    <div class="footer-top pt-40 pb-40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-6 mb-lg-0 mb-sm-4 mb-3">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}"><img src="@if($website->logo){{ asset($website->logo) }} @else {{ asset('frontend/images/logo/logo.png') }} @endif" alt=""></a>
                    </div>
                    <p class="footer-contact">
                        <span class="d-block">Address : {{ site_address() }}</span>
                        <span class="d-block">Email: {{ site_email() }}</span>
                        <span class="d-block">Contact no: {{ site_phone() }}</span>
                    </p>
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-lg-0 mb-sm-4 mb-3">
                    <h3 class="footer-title">information</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('arrival') }}">new arrival</a></li>
                        <li><a href="{{ route('allproduct') }}">all product</a></li>
                    </ul>
                </div>
                <div class="mobile-border"></div>
                <div class="col-lg-2 col-md-3 col-6 mb-lg-0 mb-sm-4 mb-3">
                    <h3 class="footer-title">our services</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">about us</a></li>
                        {{ site_policy() }}
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-lg-0 mb-sm-4 mb-3">
                    <h3 class="footer-title">download app</h3>
                    <div class="download-wrapper">
                        <div class="qrcode-area">
                            <img src="{{asset('frontend/images/icons/qrcode.png')}}" alt="">
                        </div>
                        <div class="btn-area">
                            <a href="{{ asset('image/royalmart.apk') }}"><img src="{{asset('frontend/images/icons/appstore.png')}}" alt=""></a>
                            <a href="javascript:;"><img src="{{asset('frontend/images/icons/playstore.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="footer-bottom">
        <div class="container-fluid">
            <p class="copyright">copyright @ 2022 All rights reserved and developed by <a href="https://projanmoit.com/" target="__blank">Projanmo IT</a></p>
        </div>
    </div>
    <!-- End Footer Bottom -->
</footer>
<!-- End Footer -->
<div class="mobile-footer-bar">
    <div class="inner-footer-bar">
        <ul>
            <li><a class="home" href="{{ route('home') }}"><i class="bi bi-house-door"></i><span>home</span></a></li>
            <li><a class="mobile-nav-trigger" href="javascript:;"><i class="ri-function-line"></i><span>Categories</span></a></li>
            <li><a class="shop" href="{{ route('allproduct') }}"><span class="img"><img src="{{asset('frontend/images/logo/icon.png')}}" alt=""></span><span>shop</span></a></li>
            <li><a class="mobile-search-trigger" href="javascript:;"><i class="bi bi-search"></i><span>search</span></a></li>
            @auth
                <li><a class="privacy-trigger" href="javascript:;"><i class="ri-user-line"></i><span>account</span></a></li>
            @else
                <li><a href="{{ route('login') }}"><i class="ri-user-line"></i><span>account</span></a></li>
            @endauth
        </ul>
    </div>
</div>
<!-- End Footer Bar -->

<div class="mobile-privacy-nav">
    <div class="nav-header">
        <div class="user-area">
            <div class="user-img">
                <span class="material-icons">account_circle</span>
            </div>
            <div class="user-login">
                <ul>
                    @auth
                        @if(Auth::check() && auth()->user()->role_id == 1)
                            <li><a href="{{ route('admin.dashboard') }}" target="_blank">Dashboard</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        @if(Auth::check() && auth()->user()->role_id == 2)
                            <li><a href="{{ route('customer.information') }}">My Account</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">sign in</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <button type="button" class="close-nav"><i class="bi bi-x"></i></button>
    </div>
    <div class="nav-body">
        <div class="top-area">
            <div class="top-nav">
                <ul>
                    @auth
                        @if(Auth::check() && auth()->user()->role_id == 1)
                            <li><a href="{{ route('home') }}"><i class="bi bi-house-door"></i>home</a></li>
                            <li><a href="{{ route('admin.dashboard') }}"><i class="bi bi-person-fill"></i>account information</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons">logout</i>
                                    logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        @if(Auth::check() && auth()->user()->role_id == 2)
                            <li><a href="{{ route('home') }}"><i class="bi bi-house-door"></i>home</a></li>
                            <li><a href="{{ route('customer.information') }}"><i class="bi bi-person-fill"></i>account information</a></li>
                            <li><a href="{{ route('customer.order') }}"><i class="material-icons">content_paste</i>my orders</a></li>
                            <li><a href="{{ route('customer.password.change') }}"><i class="material-icons-outlined">lock</i>change password</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons">logout</i>
                                    logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    @else
                    @endauth
                </ul>
            </div>
            <div class="divider"></div>
            <div class="bottom-nav">
                <ul>
                    <li>
                        <a href="tel:{{ site_phone() }}">
                            <i class="bi bi-telephone-plus"></i>
                            <span><strong>helpline</strong> <br> {{ site_phone() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="divider"></div>
            <div class="links">
                <ul>
                    <li><a href="{{ route('about') }}">about us</a></li>
                    <li><a href="{{ route('track.my.order') }}">track order</a></li>
                    {{ site_policy() }}
                </ul>
            </div>
        </div>
        <div class="bottom-area">
            <div class="divider"></div>
            <div class="download-area">
                <button class="download-app-btn">
                    <span>download app</span>
                    <i class="android ri-android-fill"></i>
                    <i class="ios bi bi-apple"></i>
                </button>
            </div>
            <div class="divider"></div>
            <div class="social-area">
                <ul class="social">
                    {{ site_icon() }}
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Privacy Nav -->
<div class="mobile-nav">
    <div class="inner-mobile-nav checknav">
        <div class="nav-head">
            <div class="logo-area">
                <a href="{{ route('home') }}">
                    {{ site_logo() }}
                </a>
                <button type="button" class="close-nav">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>

        <ul>
            @foreach(main_categories() as $category)
                <li>
                    <a href="{{ route('category', $category->slug) }}">
                        <span>{{ language_convert($category->name) }}</span>
                    </a>

                    @if(parent_categories($category->id)->count() > 0)
                        <ul>
                            @foreach(parent_categories($category->id) as $parentcategory)
                                <li>
                                    <a href="{{ route('category', $parentcategory->slug) }}">
                                        {{ language_convert($parentcategory->name) }}
                                    </a>

                                    @if(child_categories($parentcategory->id)->count() > 0)
                                        <ul>
                                            @foreach(child_categories($parentcategory->id) as $childcategory)
                                                <li>
                                                    <a href="{{ route('category', $childcategory->slug) }}">
                                                        {{ language_convert($childcategory->name) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- End Mobile Nav -->

<div class="mobile-cart">
    <div class="inner-mobile-cart">
        <div class="cart-head">
            <h3 class="title">
                @if(session('cart'))
                    {{ count(session('cart')) }}
                @else
                    0
                @endif
                items in cart
            </h3>
            <button type="button" class="close-cart">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="cart-body">
            @if(session('cart'))
                @foreach(session('cart') as $key => $cartdetails)
                    <div class="single-item">
                        <figure>
                            <a href="javascript:;">
                                <img src="{{ asset($cartdetails['image']) }}" alt="">
                            </a>
                        </figure>
                        <div class="contents">
                            <h5 class="product-name">
                                <a href="javascript:;">
                                    {{ $cartdetails['name'] }}
                                </a>
                            </h5>
                            <div class="qty-price">
                                <span> {{ $cartdetails['quantity'] }} </span> * <span>{{$cartdetails['price']}} ৳</span>
                            </div>
                        </div>
                        <a class="remove" href="{{ route('cart.remove', $key) }}" onclick="return confirm('Are you sure, you want to remove this product from cart ? ')" type="button">
                            <i class="bi bi-x"></i>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="cart-footer">
            @auth
                <a href="{{ route('customer.checkout.index') }}" type="button" class="sm-btn">Checkout</a>
            @else
                <a href="{{ route('customer.guest-checkout.index') }}" type="button" class="sm-btn">Checkout</a>
            @endauth
            <a href="{{ route('cart') }}" type="button" class="sm-btn">View cart</a>
        </div>
    </div>
</div>
