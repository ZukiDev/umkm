<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Selamat Datang !</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Buat Akun Anda Sekarang</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Registration Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <!-- Login Prompt Section -->
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{ asset('assets/img/login.jpg') }}" alt="Registration Image">
                        <div class="hover">
                            <h4>Sudah Punya Akun?</h4>
                            <p>Jika Anda sudah memiliki akun, masuk untuk mengelola pengaturan Anda.</p>
                            <a class="primary-btn" href="{{ route('login') }}">Masuk</a>
                        </div>
                    </div>
                </div>

                <!-- Registration Form Section -->
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Buat Akun Baru</h3>

                        <!-- Display Validation Errors -->
                        <x-validation-errors class="mb-4" />

                        <!-- Display Status Message -->
                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Registration Form -->
                        <form class="row login_form" method="POST" action="{{ route('register') }}"
                            novalidate="novalidate">
                            @csrf

                            <!-- Name Field -->
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan Nama Anda" value="{{ old('name') }}" required autofocus
                                    autocomplete="name">
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email Anda" value="{{ old('email') }}" required
                                    autocomplete="username">
                            </div>

                            <!-- Password Field -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Buat Kata Sandi" required autocomplete="new-password">
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required
                                    autocomplete="new-password">
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <!-- Terms and Privacy Policy -->
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <input type="checkbox" id="terms" name="terms" required>
                                        <label for="terms">
                                            Saya setuju dengan
                                            <a target="_blank" href="{{ route('terms.show') }}"
                                                class="underline text-sm text-gray-600 hover:text-gray-900">Syarat
                                                Layanan</a>
                                            dan
                                            <a target="_blank" href="{{ route('policy.show') }}"
                                                class="underline text-sm text-gray-600 hover:text-gray-900">Kebijakan
                                                Privasi</a>.
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <!-- Submit Button and Login Link -->
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn w-100">Daftar</button>
                                <a class="text-center d-block mt-3 underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('login') }}">
                                    Sudah terdaftar? Masuk di sini
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Registration Box Area =================-->
</x-guest-layout>
