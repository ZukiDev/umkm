@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl leading-normal font-semibold">Profil</h3>
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
    <section class="relative pb-16">
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
                            <h6 class="text-slate-400 mb-4">Alamat berikut akan digunakan pada halaman pembayaran secara
                                default.</h6>
                            <form action="{{ route('customer.profile.update') }}" method="POST">
                                @csrf <!-- Token CSRF untuk keamanan -->
                                <div class="md:w-full md:px-3">
                                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
                                        <!-- Nama -->
                                        <div>
                                            <label class="form-label font-semibold">Nama Lengkap: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="name"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Nama Lengkap" value="{{ $user->name }}" required>
                                        </div>

                                        <!-- Phone Number -->
                                        <div>
                                            <label class="form-label font-semibold">Nomor Telepon: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="phone_number"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Nomor Telepon" value="{{ $user->phone_number }}" required>
                                        </div>

                                        <!-- Address -->
                                        <div>
                                            <label class="form-label font-semibold">Alamat: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="address"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Alamat" value="{{ $address->address }}" required>
                                        </div>

                                        <!-- Province -->
                                        <div>
                                            <label class="form-label font-semibold">Provinsi: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="province"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Provinsi" value="{{ $address->province }}" required>
                                        </div>

                                        <!-- City -->
                                        <div>
                                            <label class="form-label font-semibold">Kota: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="city"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Kota" value="{{ $address->city }}" required>
                                        </div>

                                        <!-- District -->
                                        <div>
                                            <label class="form-label font-semibold">Kecamatan: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="district"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Kecamatan" value="{{ $address->district }}" required>
                                        </div>

                                        <!-- Post Code -->
                                        <div>
                                            <label class="form-label font-semibold">Kode Pos: <span
                                                    class="text-red-600">*</span></label>
                                            <input type="text" name="post_code"
                                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Kode Pos" value="{{ $address->post_code }}" required>
                                        </div>

                                        <!-- Delivery Instructions (optional) -->
                                        <div class="lg:col-span-2">
                                            <label class="form-label font-semibold">Instruksi Pengiriman:</label>
                                            <textarea name="delivery_instructions"
                                                class="form-input w-full py-2 px-3 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                                placeholder="Instruksi Pengiriman (opsional)">{{ $address->delivery_instructions }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="mt-6">
                                        <button type="submit"
                                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md">
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
@endsection
