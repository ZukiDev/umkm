<!-- Start Header Area -->
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}"
                        alt="" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="category.html">Shop Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="single-product.html">Product Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="checkout.html">Product Checkout</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="cart.html">Shopping Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="confirmation.html">Confirmation</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="blog.html">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="single-blog.html">Blog Details</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        @auth
                            @include('layouts.partials.header-right-auth')
                        @endauth
                        @guest
                            @include('layouts.partials.header-right-guest')
                        @endguest
                    </ul>
                </div>
        </nav>
    </div>
</header>
<!-- End Header Area -->
