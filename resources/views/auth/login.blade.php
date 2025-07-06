@extends('layouts.landing')

@section('content')
    <section class="min-h-screen py-36 flex items-center bg-white bg-no-repeat bg-center bg-cover overflow-auto">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white"></div>
        <div class="container relative">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                    <a href="index.html"><img src="https://i1.sndcdn.com/artworks-000032330403-41dvx8-t1080x1080.jpg" class="mx-auto" alt="" style="height: 108px"></a>
                    <h5 class="my-6 text-xl text-center font-semibold">Selamat Datang!</h5>
                    <x-validation-errors class="mb-4" />
                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ $value }}
                        </div>
                    @endsession
                    <form method="POST" action="{{ route('login') }}" class="text-start">
                        @csrf
                        <div class="grid grid-cols-1">
                            <div class="mb-4">
                                <label class="font-semibold" for="LoginEmail">Email:</label>
                                <input id="email" type="email" name="email" :value="old('email')" required
                                    autofocus autocomplete="username"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    placeholder="Masukkan alamat email anda">
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="LoginPassword">Kata Sandi:</label>
                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    placeholder="Masukkan kata sandi anda">
                            </div>

                            <div class="flex justify-between mb-4">
                                <div class="flex items-center mb-0">
                                    <input
                                        class="form-checkbox rounded border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                        type="checkbox" id="remember_me" name="remember">
                                    <label class="form-checkbox-label text-slate-400" for="RememberMe">Ingat saya</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <p class="text-slate-400 mb-0"><a href="{{ route('password.request') }}"
                                            class="text-slate-400">Lupa
                                            Kata Sandi ?</a></p>
                                @endif

                            </div>

                            <div class="mb-4">
                                <input type="submit"
                                    class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                    value="Masuk">
                            </div>

                            <div class="text-center">
                                <span class="text-slate-400 me-2">Tidak Mempunyai Akun ?</span> <a
                                    href="{{ route('register') }}"
                                    class="text-black dark:text-white font-bold inline-block">Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!--end section -->
@endsection
