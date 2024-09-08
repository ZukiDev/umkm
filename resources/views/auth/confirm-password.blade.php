<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Confirm Your Password</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Please confirm your password before continuing</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Password Confirmation Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <!-- Description Text -->
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <!-- Display Validation Errors -->
                <x-validation-errors class="mb-4" />

                <!-- Password Confirmation Form -->
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password Field -->
                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" autofocus />
                    </div>

                    <!-- Confirm Button -->
                    <div class="flex justify-end mt-4">
                        <x-button class="ms-4">
                            {{ __('Confirm') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Password Confirmation Box Area =================-->
</x-guest-layout>
