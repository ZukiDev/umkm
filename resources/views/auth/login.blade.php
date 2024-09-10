<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Selamat Datang Kembali!</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Masukkan detail Anda untuk melanjutkan</h4>
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
                <!-- Welcome Image & Info Section -->
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{ asset('assets/img/login.jpg') }}" alt="Welcome Image">
                        <div class="hover">
                            <h4>Selamat Datang di Website Kami!</h4>
                            <p>Kami senang Anda di sini. Jika baru, buat akun baru dengan mudah dan mulai nikmati
                                fitur-fitur kami.</p>
                            <a class="primary-btn" href="{{ route('register') }}">Buat Akun Baru</a>
                        </div>
                    </div>
                </div>

                <!-- Login Form Section -->
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Masuk untuk Melanjutkan</h3>

                        <!-- Display Validation Errors -->
                        <x-validation-errors class="mb-4" />

                        <!-- Display Status Message -->
                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form class="row login_form" method="POST" action="{{ route('login') }}"
                            novalidate="novalidate">
                            @csrf

                            <!-- Email Field -->
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email Anda" value="{{ old('email') }}" required autofocus
                                    autocomplete="username">
                            </div>

                            <!-- Password Field -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan Kata Sandi Anda" required autocomplete="current-password">
                            </div>

                            <!-- Remember Me Checkbox -->
                            <div class="col-md-12 form-group d-flex align-items-center">
                                <input type="checkbox" id="remember_me" name="remember" class="me-2">
                                <label for="remember_me" class="mb-0">Tetap Masuk</label>
                            </div>

                            <!-- Submit Button and Forgot Password Link -->
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn w-100">Masuk</button>
                                @if (Route::has('password.request'))
                                    <a class="text-center d-block mt-3" href="{{ route('password.request') }}">Lupa Kata
                                        Sandi?</a>
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
