@extends('layouts.landing')

@section('content')
    {{-- <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl leading-normal font-semibold">Profil Saya</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <a href="index-shop.html">Techwind</a>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">My Account
                    </li>
                </ul>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Hero --> --}}

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-3 md:col-span-5">
                    <div class="flex items-center">
                        <img src="{{ Auth::user()->profile_photo_url }}"
                            class="size-16 rounded-full shadow dark:shadow-gray-800" alt="">
                        <div class="ms-2">
                            <p class="font-semibold text-slate-400">Hello,</p>
                            <h5 class="text-lg font-semibold">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="lg:col-span-9 md:col-span-7">
                    <p class="text-slate-400 max-w-xl">Anda dapat mengelola informasi pribadi, mengubah kata sandi, dan
                        menyesuaikan preferensi akun Anda. Pastikan semua detail terbaru agar kami dapat memberikan
                        pengalaman yang lebih baik sesuai dengan kebutuhan Anda.</p>
                </div><!--end col-->

                <div class="lg:col-span-3 md:col-span-5">
                    <div class="sticky top-20">
                        <ul class="flex-column p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md"
                            id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li role="presentation">
                                <button
                                    class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                    id="accountdetail-tab" data-tabs-target="#accountdetail" type="button" role="tab"
                                    aria-controls="accountdetail" aria-selected="false"><i
                                        class="uil uil-user text-[20px] me-2 align-middle"></i> Informasi Profil</button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                    id="security-tab" data-tabs-target="#security" type="button" role="tab"
                                    aria-controls="security" aria-selected="false"><i
                                        class="uil uil-lock text-[20px] me-2 align-middle"></i> Keamanan</button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                    id="address-tab" data-tabs-target="#address" type="button" role="tab"
                                    aria-controls="address" aria-selected="false"><i
                                        class="uil uil-map-marker text-[20px] me-2 align-middle"></i> Alamat</button>
                            </li>
                            <li role="presentation">
                                <!-- Authentication Logout Form -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" href="{{ route('logout') }}"
                                        class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-indigo-600 dark:hover:text-white"
                                        @click.prevent="$root.submit();">
                                        <i class="uil uil-sign-out-alt text-[20px] me-2 align-middle"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div><!--end col-->

                <div class="lg:col-span-9 md:col-span-7">
                    <div id="myTabContent" class="p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md">
                        <div class="" id="accountdetail" role="tabpanel" aria-labelledby="accountdetail-tab">
                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                @livewire('profile.update-profile-information-form')

                                <x-section-border />
                            @endif
                        </div>

                        <div class="hidden" id="security" role="tabpanel" aria-labelledby="security-tab">
                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.update-password-form')
                                </div>

                                <x-section-border />
                            @endif

                            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.two-factor-authentication-form')
                                </div>

                                <x-section-border />
                            @endif

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.logout-other-browser-sessions-form')
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                <x-section-border />

                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.delete-user-form')
                                </div>
                            @endif
                        </div>

                        <div class="hidden" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <h6 class="text-slate-400 mb-0">The following addresses will be used on the checkout page by
                                default.</h6>
                            <div class="md:flex mt-6">
                                <div class="md:w-1/2 md:px-3">
                                    <div class="flex items-center mb-4 justify-between">
                                        <h5 class="text-xl font-semibold">Billing Address:</h5>
                                        <a href="#" class="text-indigo-600 text-lg"><i
                                                class="uil uil-edit align-middle"></i></a>
                                    </div>
                                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                        <p class="text-lg font-semibold mb-2">Cally Joseph</p>

                                        <ul class="list-none">
                                            <li class="flex">
                                                <i class="uil uil-map-marker text-lg me-2"></i>
                                                <p class="text-slate-400">C/54 Northwest Freeway, Suite 558, <br> Houston,
                                                    USA 485</p>
                                            </li>

                                            <li class="flex mt-1">
                                                <i class="uil uil-phone text-lg me-2"></i>
                                                <p class="text-slate-400">+123 897 5468</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="md:w-1/2 md:px-3 mt-[30] md:mt-0">
                                    <div class="flex items-center mb-4 justify-between">
                                        <h5 class="text-xl font-semibold">Shipping Address:</h5>
                                        <a href="#" class="text-indigo-600 text-lg"><i
                                                class="uil uil-edit align-middle"></i></a>
                                    </div>
                                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                        <p class="text-lg font-semibold mb-2">Cally Joseph</p>

                                        <ul class="list-none">
                                            <li class="flex">
                                                <i class="uil uil-map-marker text-lg me-2"></i>
                                                <p class="text-slate-400">C/54 Northwest Freeway, Suite 558, <br> Houston,
                                                    USA 485</p>
                                            </li>

                                            <li class="flex mt-1">
                                                <i class="uil uil-phone text-lg me-2"></i>
                                                <p class="text-slate-400">+123 897 5468</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
