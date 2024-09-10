<x-guest-layout>
    <!-- Start Banner Area -->
    <section class="banner-area organic_breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Verifikasi Email</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Verifikasi alamat email Anda</h4>
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
                    {{ __('Sebelum melanjutkan, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda belum menerima email tersebut, kami dengan senang hati akan mengirimkannya kembali.') }}
                </p>

                <!-- Display Status Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success text-center">
                        <i class="fas fa-envelope-open-text"></i>
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan di pengaturan profil.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <!-- Resend Verification Email Form -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="primary-btn">
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </button>
                    </form>

                    <div class="flex items-center space-x-4">
                        <!-- Edit Profile Link -->
                        <a href="{{ route('profile.show') }}"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Edit Profil') }}
                        </a>

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                                {{ __('Keluar') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Email Verification Box Area =================-->
</x-guest-layout>
