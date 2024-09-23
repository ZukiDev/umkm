@extends('layouts.landing')

@section('content')
    <section class="min-h-screen py-36 flex items-center bg-white bg-no-repeat bg-center bg-cover overflow-auto">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white"></div>
        <div class="container relative">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                    <a href="index.html"><img src="assets/images/logo-icon-64.png" class="mx-auto" alt=""></a>
                    <h5 class="my-6 text-xl text-center font-semibold">Daftar Sekarang!</h5>
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('register') }}" class="text-start">
                        @csrf
                        <div class="grid grid-cols-1">
                            <div class="mb-4">
                                <label class="font-semibold" for="name">Nama Lengkap:</label>
                                <x-input id="name"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                    placeholder="Masukkan nama anda" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="username">Username:</label>
                                <x-input id="username"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="text" name="username" :value="old('username')" required autofocus
                                    autocomplete="username" placeholder="Masukkan username anda" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="email">Alamat Email:</label>
                                <x-input id="email"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="email" name="email" :value="old('email')" required autofocus autocomplete="email"
                                    placeholder="Masukkan alamat email anda" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="phone_number">Nomer Telpon:</label>
                                <x-input id="phone_number"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="number" name="phone_number" :value="old('phone_number')" required autofocus
                                    autocomplete="phone_number" placeholder="Masukkan nomer telpon aktif anda" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="password">Kata Sandi:</label>
                                <x-input id="password"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="password" name="password" :value="old('password')" required autofocus
                                    autocomplete="new-password" placeholder="Masukkan kata sandi anda" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="password_confirmation">Konfirmasi Kata Sandi:</label>
                                <x-input id="password_confirmation"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="password_confirmation" name="password_confirmation" :value="old('password_confirmation')" required
                                    autofocus autocomplete="new-password" placeholder="Masukkan ulang kata sandi anda" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-2 mb-4">
                                    <label class="form-check-label text-slate-400" for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' =>
                                                        '<a target="_blank" href="' .
                                                        route('terms.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                        __('Terms of Service') .
                                                        '</a>',
                                                    'privacy_policy' =>
                                                        '<a target="_blank" href="' .
                                                        route('policy.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                        __('Privacy Policy') .
                                                        '</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endif

                            <div class="mb-4">
                                <input type="submit"
                                    class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                    value="Daftar">
                            </div>

                            <div class="text-center">
                                <span class="text-slate-400 me-2">Sudah punya akun? </span> <a href="{{ route('login') }}"
                                    class="text-black dark:text-white font-bold inline-block">Masuk</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
