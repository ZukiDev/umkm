<x-guest-layout>
    <!-- Mulai Area Banner -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Konfirmasi Kata Sandi Anda</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Silakan konfirmasi kata sandi Anda sebelum melanjutkan</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Area Banner -->

    <!--================Area Kotak Konfirmasi Kata Sandi =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <!-- Teks Deskripsi -->
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Ini adalah area aman dari aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.') }}
                </div>

                <!-- Tampilkan Validasi Kesalahan -->
                <x-validation-errors class="mb-4" />

                <!-- Form Konfirmasi Kata Sandi -->
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Field Kata Sandi -->
                    <div>
                        <x-label for="password" value="{{ __('Kata Sandi') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" autofocus />
                    </div>

                    <!-- Tombol Konfirmasi -->
                    <div class="flex justify-end mt-4">
                        <x-button class="ms-4">
                            {{ __('Konfirmasi') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================Akhir Area Kotak Konfirmasi Kata Sandi =================-->
</x-guest-layout>
