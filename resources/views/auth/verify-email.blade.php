<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic_breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Email Verification</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Verify your email address</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Email Verification Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <p class="mb-4 text-sm text-gray-600">
                    {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                <!-- Display Status Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success text-center">
                        {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div>
                            <button type="submit" class="primary-btn">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </div>
                    </form>

                    <div>
                        <a href="{{ route('profile.show') }}"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Edit Profile') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Email Verification Box Area =================-->
</x-guest-layout>
