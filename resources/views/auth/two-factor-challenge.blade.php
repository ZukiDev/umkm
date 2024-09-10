<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Autentikasi Dua Faktor</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Masukkan kode autentikasi Anda untuk mengakses akun Anda</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Two-Factor Authentication Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <div x-data="{ recovery: false }">
                    <!-- Message for Authentication Code -->
                    <div class="mb-4 text-sm text-gray-600" x-show="!recovery">
                        <i class="fas fa-key"></i> Masukkan kode autentikasi yang diberikan oleh aplikasi autentikator
                        Anda untuk mengonfirmasi akses ke akun Anda.
                    </div>

                    <!-- Message for Recovery Code -->
                    <div class="mb-4 text-sm text-gray-600" x-cloak x-show="recovery">
                        <i class="fas fa-shield-alt"></i> Masukkan salah satu kode pemulihan darurat Anda untuk
                        mengonfirmasi akses ke akun Anda.
                    </div>

                    <!-- Display Validation Errors -->
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <!-- Authentication Code Field -->
                        <div class="mt-4" x-show="!recovery">
                            <x-label for="code" value="Kode Autentikasi" />
                            <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric"
                                name="code" autofocus x-ref="code" placeholder="Masukkan kode autentikasi"
                                autocomplete="one-time-code" />
                        </div>

                        <!-- Recovery Code Field -->
                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-label for="recovery_code" value="Kode Pemulihan" />
                            <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code"
                                x-ref="recovery_code" placeholder="Masukkan kode pemulihan"
                                autocomplete="one-time-code" />
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="button"
                                class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                x-show="!recovery"
                                x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                                Gunakan kode pemulihan
                            </button>

                            <button type="button"
                                class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer" x-cloak
                                x-show="recovery"
                                x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                                Gunakan kode autentikasi
                            </button>

                            <x-button class="ms-4">
                                Masuk
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Two-Factor Authentication Box Area =================-->
</x-guest-layout>
