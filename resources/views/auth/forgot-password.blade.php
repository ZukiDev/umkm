<x-guest-layout>
    <!-- Mulai Area Banner -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Reset Kata Sandi</h1>
                    <nav class="d-flex align-items-center">
                        <h4 class="text-light">Masukkan alamat email Anda untuk mereset kata sandi</h4>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Area Banner -->

    <!--================Area Kotak Lupa Kata Sandi =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="login_box_inner">
                <p>Lupa kata sandi Anda? Tidak masalah. Cukup masukkan alamat email Anda di bawah ini, dan kami akan
                    mengirimkan tautan untuk mereset kata sandi Anda.</p>

                <!-- Tampilkan Pesan Status -->
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Tampilkan Validasi Kesalahan -->
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        <strong>Ups! Ada yang salah.</strong>
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

                    <!-- Field Email -->
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ old('email') }}" required autofocus autocomplete="username"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="col-md-12 form-group">
                        <button type="submit" class="primary-btn">Kirim Tautan Reset Kata Sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================Akhir Area Kotak Lupa Kata Sandi =================-->
</x-guest-layout>
