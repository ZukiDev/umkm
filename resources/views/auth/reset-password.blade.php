<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Reset Password</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Enter your new password below</h4>
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
                <p>Please enter your new password below to reset it. Make sure to use a strong password to keep your
                    account secure.</p>

                <!-- Display Validation Errors -->
                <x-validation-errors class="mb-4" />

                <form class="row tracking_form" method="POST" action="{{ route('password.update') }}"
                    novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Field -->
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                    </div>

                    <!-- Password Field -->
                    <div class="col-md-12 form-group">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="New Password" required autocomplete="new-password"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'">
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-12 form-group">
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm New Password" required
                            autocomplete="new-password" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Confirm New Password'">
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 form-group">
                        <button type="submit" class="primary-btn">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Reset Password Box Area =================-->
</x-guest-layout>
