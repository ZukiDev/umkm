@extends('layouts.landing')

@section('content')
    <section class="md:h-screen py-36 flex items-center bg-white bg-no-repeat bg-center bg-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white"></div>
        <div class="container relative">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                    <a href="index.html"><img src="assets/images/logo-icon-64.png" class="mx-auto" alt=""></a>
                    <h5 class="my-6 text-xl text-center font-semibold">Setel Ulang Kata Sandi</h5>
                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ $value }}
                        </div>
                    @endsession
                    <x-validation-errors class="mb-4" />
                    <div class="grid grid-cols-1">
                        <p class="text-slate-400 mb-6">Harap masukkan alamat email Anda. Anda akan menerima tautan untuk
                            membuat kata sandi baru melalui email.</p>
                        <form method="POST" action="{{ route('password.email') }}" class="text-start">
                            @csrf
                            <div class="grid grid-cols-1">
                                <div class="mb-4">
                                    <label class="font-semibold" for="LoginEmail">Email:</label>
                                    <input id="email" type="email" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username"
                                        class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                        placeholder="Masukkan alamat email anda">
                                </div>

                                <div class="mb-4">
                                    <input type="submit"
                                        class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                        value="Kirim Tautan">
                                </div>

                                <div class="text-center">
                                    <span class="text-slate-400 me-2">Ingat Password ? </span><a href="{{ route('login') }}"
                                        class="text-black dark:text-white font-bold inline-block">Masuk</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--end section -->
@endsection
