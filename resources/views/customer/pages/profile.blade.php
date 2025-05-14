@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl font-semibold leading-normal">Profil</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="{{ route('home') }}">{{ config('app.name', 'UMKM Blitar') }}</p>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Profil
                    </li>
                </ul>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative py-12">
        <div class="container">
            <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-3 md:col-span-5">
                    <div class="flex items-center">
                        <img src="{{ Auth::user()->profile_photo_url }}"
                            class="rounded-full shadow size-16 dark:shadow-gray-800" alt="">
                        <div class="ms-2">
                            <p class="font-semibold text-slate-400">Hello,</p>
                            <h5 class="text-lg font-semibold">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="lg:col-span-9 md:col-span-7">
                    <div class="mt-4 mb-4">
                        <!-- Success Message -->
                        @if (session('success'))
                            <div
                                class="relative px-4 py-2 rounded-md font-medium bg-emerald-600/10 border border-emerald-600/10 text-emerald-600 block">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Warning Message -->
                        @if (session('warning'))
                            <div
                                class="relative px-4 py-2 rounded-md font-medium bg-orange-600/10 border border-orange-600/10 text-orange-600 block">
                                {{ session('warning') }}
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if (session('error'))
                            <div
                                class="relative px-4 py-2 rounded-md font-medium bg-red-600/10 border border-red-600/10 text-red-600 block">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <p class="max-w-xl text-slate-400">Anda dapat mengelola informasi pribadi, mengubah kata sandi, dan
                        menyesuaikan preferensi akun Anda. Pastikan semua detail terbaru agar kami dapat memberikan
                        pengalaman yang lebih baik sesuai dengan kebutuhan Anda.</p>
                </div><!--end col-->

                <div class="lg:col-span-3 md:col-span-5">
                    <div class="sticky top-20">
                        <ul class="p-6 bg-white rounded-md shadow flex-column dark:bg-slate-900 dark:shadow-gray-800"
                            id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li role="presentation">
                                <button
                                    class="w-full px-4 py-2 mt-3 text-base font-semibold duration-500 rounded-md text-start"
                                    id="accountdetail-tab" data-tabs-target="#accountdetail" type="button" role="tab"
                                    aria-controls="accountdetail" aria-selected="false"><i
                                        class="uil uil-user text-[20px] me-2 align-middle"></i> Informasi Profil</button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="w-full px-4 py-2 mt-3 text-base font-semibold duration-500 rounded-md text-start"
                                    id="security-tab" data-tabs-target="#security" type="button" role="tab"
                                    aria-controls="security" aria-selected="false"><i
                                        class="uil uil-lock text-[20px] me-2 align-middle"></i> Keamanan</button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="w-full px-4 py-2 mt-3 text-base font-semibold duration-500 rounded-md text-start"
                                    id="address-tab" data-tabs-target="#address" type="button" role="tab"
                                    aria-controls="address" aria-selected="false"><i
                                        class="uil uil-map-marker text-[20px] me-2 align-middle"></i> Alamat</button>
                            </li>
                            <li role="presentation">
                                <!-- Authentication Logout Form -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" href="{{ route('logout') }}"
                                        class="w-full px-4 py-2 mt-3 text-base font-semibold duration-500 rounded-md text-start hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-indigo-600 dark:hover:text-white"
                                        @click.prevent="$root.submit();">
                                        <i class="uil uil-sign-out-alt text-[20px] me-2 align-middle"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div><!--end col-->

                <div class="lg:col-span-9 md:col-span-7">
                    <div id="myTabContent" class="p-6 bg-white rounded-md shadow dark:bg-slate-900 dark:shadow-gray-800">
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
                            <h6 class="mb-4 text-slate-400">Alamat berikut akan digunakan pada halaman pembayaran secara
                                default.</h6>
                            <form action="{{ route('customer.profile.update') }}" method="POST">
                                @csrf <!-- Token CSRF untuk keamanan -->
                                <div class="md:w-full md:px-3">
                                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                        <!-- Nama -->
                                        <div>
                                            <label class="font-semibold form-label">Nama Lengkap: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="name"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Nama Lengkap" value="{{ $user->name }}" required>
                                        </div>

                                        <!-- Phone Number -->
                                        <div>
                                            <label class="font-semibold form-label">Nomor Telepon: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="phone_number"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Nomor Telepon" value="{{ $user->phone_number }}" required>
                                        </div>

                                        <!-- Address -->
                                        <div>
                                            <label class="font-semibold form-label">Alamat: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="address"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Alamat" value="{{ $address->address ?? '' }}" required>
                                        </div>

                                        <!-- Province -->
                                        <div>
                                            <label class="font-semibold form-label">Provinsi: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="province"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Provinsi" value="{{ $address->province ?? '' }}" required>
                                        </div>

                                        <!-- City -->
                                        <div>
                                            <label class="font-semibold form-label">Kota: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="city"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Kota" value="{{ $address->city ?? '' }}" required>
                                        </div>

                                        <!-- District -->
                                        <div>
                                            <label class="font-semibold form-label">Kecamatan: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="district"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Kecamatan" value="{{ $address->district ?? '' }}" required>
                                        </div>

                                        <!-- Post Code -->
                                        <div>
                                            <label class="font-semibold form-label">Kode Pos: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="post_code"
                                                class="w-full h-10 px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Kode Pos" value="{{ $address->post_code ?? '' }}" required>
                                        </div>

                                        <!-- Delivery Instructions (optional) -->
                                        <div class="lg:col-span-2">
                                            <label class="font-semibold form-label">Instruksi Pengiriman:</label>
                                            <textarea name="delivery_instructions"
                                                class="w-full px-3 py-2 mt-2 bg-transparent border border-gray-200 rounded outline-none form-input dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                                placeholder="Instruksi Pengiriman (opsional)">{{ $address->delivery_instructions ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="mt-6">
                                        <button type="submit"
                                            class="inline-block px-5 py-2 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 hover:border-indigo-700">
                                            Simpan Perubahan Alamat
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab) {
                const tabButton = document.querySelector(`[data-tabs-target="#${tab}"]`);
                const tabContent = document.querySelector(`#${tab}`);

                if (tabButton && tabContent) {
                    // Nonaktifkan semua tab
                    document.querySelectorAll('[role="tabpanel"]').forEach(el => el.classList.add('hidden'));
                    document.querySelectorAll('[role="tab"]').forEach(el => el.setAttribute('aria-selected',
                        'false'));

                    // Aktifkan tab yang sesuai
                    tabContent.classList.remove('hidden');
                    tabButton.setAttribute('aria-selected', 'true');
                }
            }
        });
    </script>
@endsection
