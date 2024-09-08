<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Welcome to Registration</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Create your account</h4>
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
                            <h4>Already have an account?</h4>
                            <p>Existing members can log in to access their accounts and manage their settings.</p>
                            <a class="primary-btn" href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Create an Account</h3>

                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops! Something went wrong.</strong>
                                <ul class="mt-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Display Status Message -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="row login_form" method="POST" action="{{ route('register') }}"
                            novalidate="novalidate">
                            @csrf

                            <!-- Name Field -->
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" value="{{ old('name') }}" required autofocus
                                    autocomplete="name" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Name'">
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" value="{{ old('email') }}" required autocomplete="username"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>

                            <!-- Password Field -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required autocomplete="new-password"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" required
                                    autocomplete="new-password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Confirm Password'">
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <!-- Terms and Privacy Policy -->
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <input type="checkbox" id="terms" name="terms" required>
                                        <label for="terms">
                                            I agree to the
                                            <a target="_blank" href="{{ route('terms.show') }}"
                                                class="underline text-sm text-gray-600 hover:text-gray-900">Terms of
                                                Service</a>
                                            and
                                            <a target="_blank" href="{{ route('policy.show') }}"
                                                class="underline text-sm text-gray-600 hover:text-gray-900">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <!-- Submit Button and Login Link -->
                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Register</button>
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('login') }}">
                                    Already registered?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
</x-guest-layout>
