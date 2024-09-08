<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Password Reset</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Enter your email address to reset your password</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Forgot Password Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <p>Forgot your password? No problem. Just enter your email address below, and we'll send you a link to
                    reset your password.</p>

                <!-- Display Status Message -->
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        <strong>Whoops! Something went wrong.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="row tracking_form" method="POST" action="{{ route('password.email') }}"
                    novalidate="novalidate">
                    @csrf

                    <!-- Email Field -->
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ old('email') }}" required autofocus autocomplete="username"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 form-group">
                        <button type="submit" class="primary-btn">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Forgot Password Box Area =================-->
</x-guest-layout>
