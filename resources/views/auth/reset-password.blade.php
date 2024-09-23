@extends('layouts.landing')

@section('content')
    <section class="md:h-screen py-36 flex items-center bg-white bg-no-repeat bg-center bg-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-indigo-400"></div>
        <div class="container relative">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                    <a href="index.html"><img src="assets/images/logo-icon-64.png" class="mx-auto" alt=""></a>
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('password.update') }}" class="text-start">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="grid grid-cols-1">
                            <div class="mb-4">
                                <label class="font-semibold" for="email">Email:</label>
                                <x-input id="email"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="email" name="email" :value="old('email', $request->email)" required autofocus
                                    autocomplete="username" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="LoginPassword">Kata Sandi Baru:</label>
                                <x-input id="password"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    type="password" name="password" required autocomplete="new-password"
                                    placeholder="Masukkan kata sandi baru" />
                            </div>

                            <div class="mb-4">
                                <label class="font-semibold" for="LoginPassword">Konfirmasi Kata Sandi Baru:</label>
                                <x-input id="password_confirmation" type="password" name="password_confirmation" required
                                    autocomplete="new-password"
                                    class="form-input mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    placeholder="Masukkan ulang kata sandi baru" />
                            </div>

                            <div class="mb-4">
                                <input type="submit"
                                    class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                    value="Setel Ulang Kata Sandi">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!--end section -->
@endsection
