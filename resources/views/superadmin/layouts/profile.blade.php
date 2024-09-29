@extends('layouts.dashboard')
@section('content')
    <div class="layout-specing mx-6 sm:mx-6 md:mx-8 lg:mx-12">
        <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-6 md:mt-8 lg:mt-10 max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-6 md:mt-8 lg:mt-10 max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <div class="mt-10 sm:mt-6 md:mt-8 lg:mt-10 max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="mt-10 sm:mt-6 md:mt-8 lg:mt-10 max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
@endsection
