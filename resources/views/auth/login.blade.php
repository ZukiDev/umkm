<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Welcome Back !</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Enter yout details</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Login Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{ asset('assets/img/login.jpg') }}" alt="">
                        <div class="hover">
                            <h4>Welcome to Our Website!</h4>
                            <p>We are delighted to have you here. If you are new and looking to join our community, you
                                can easily create an account to get started. Enjoy exploring our features and services
                                designed to enhance your experience.</p>
                            <a class="primary-btn" href="{{ route('register') }}">Create an Account</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>

                        <!-- Display Validation Errors -->
                        <x-validation-errors class="mb-4" />

                        <!-- Display Status Message -->
                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="row login_form" method="POST" action="{{ route('login') }}"
                            novalidate="novalidate">
                            @csrf

                            <!-- Email Field -->
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" value="{{ old('email') }}" required autofocus
                                    autocomplete="username" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Email'">
                            </div>

                            <!-- Password Field -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required autocomplete="current-password"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>

                            <!-- Remember Me Checkbox -->
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <label for="remember_me">Keep me logged in</label>
                                </div>
                            </div>

                            <!-- Submit Button and Forgot Password Link -->
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Log In</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
</x-guest-layout>
