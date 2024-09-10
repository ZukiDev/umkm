<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Reset Kata Sandi</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Masukkan kata sandi baru Anda di bawah ini</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Reset Password Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <p>Masukkan kata sandi baru Anda di bawah ini untuk meresetnya. Gunakan kombinasi huruf, angka, dan
                    simbol untuk menjaga keamanan akun Anda.</p>

                <!-- Display Validation Errors -->
                <x-validation-errors class="mb-4" />

                <form class="row tracking_form" method="POST" action="{{ route('password.update') }}"
                    novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Field -->
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan Email Anda" value="{{ old('email', $request->email) }}" required
                            autofocus autocomplete="username">
                    </div>

                    <!-- Password Field -->
                    <div class="col-md-12 form-group">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Buat Kata Sandi Baru" required autocomplete="new-password">
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-12 form-group">
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Konfirmasi Kata Sandi Baru" required
                            autocomplete="new-password">
                    </div>

                    <!-- Password Tips -->
                    <div class="col-md-12 form-group text-center">
                        <small class="text-muted">Tips: Gunakan minimal 8 karakter dengan campuran huruf besar, kecil,
                            angka, dan simbol.</small>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 form-group">
                        <button type="submit" class="primary-btn w-100">Reset Kata Sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Reset Password Box Area =================-->
</x-guest-layout>
