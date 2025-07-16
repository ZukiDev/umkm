@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl font-semibold leading-normal">Pemesanan</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="{{ route('home') }}">{{ config('app.name', 'UMKM Blitar') }}</p>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Pemesanan
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
                <div class="lg:col-span-8">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">

                        <form action="{{ route('customer.order.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12">
                                <div class="mb-4 lg:col-span-12">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xl font-semibold leading-normal">Alamat Pengiriman</h3>
                                        <a href="{{ route('customer.profile') }}"
                                            class="text-sm text-indigo-600 hover:underline">Edit Alamat</a>
                                    </div>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="font-semibold form-label">Nama:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $user->name }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="font-semibold form-label">Username:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $user->username }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="font-semibold form-label">Email:</label>
                                    <input type="email"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $user->email }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="font-semibold form-label">Nomer Telepon:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $user->phone_number }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="font-semibold form-label">Alamat Lengkap:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $address->address }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="font-semibold form-label">Provinsi:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $address->province }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="font-semibold form-label">Kota:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $address->city }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="font-semibold form-label">Kecamatan:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $address->district }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="font-semibold form-label">Kode Pos:</label>
                                    <input type="text"
                                        class="w-full h-10 px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        value="{{ $address->post_code }}" readonly disabled>
                                </div>

                                <div class="lg:col-span-12">
                                    <label class="font-semibold form-label">Instruksi Pengiriman:</label>
                                    <textarea
                                        class="w-full px-3 py-2 mt-2 bg-gray-100 border border-gray-200 rounded outline-none form-input dark:bg-slate-700 dark:text-slate-200"
                                        readonly disabled>{{ $address->delivery_instructions }}</textarea>
                                </div>
                            </div>


                            <h3 class="mt-6 text-xl font-semibold leading-normal">Metode Pembayaran</h3>

                            <div class="grid grid-cols-1 gap-5 mt-6 lg:grid-cols-12">
                                <div class="lg:col-span-12">
                                    <div class="block">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="text-indigo-600 form-radio" name="payment_method"
                                                value="cod" checked>
                                            <span class="p-2 text-slate-400"> Bayar di Tempat</span>
                                        </label>
                                    </div>
                                    <div class="block mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="text-indigo-600 form-radio" name="payment_method"
                                                value="bank_transfer">
                                            <span class="p-2 text-slate-400"> Transfer Rekening</span>
                                        </label>
                                    </div>
                                    {{-- <div class="block mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="text-indigo-600 form-radio"
                                                name="payment_method" value="qr_code">
                                            <span class="p-2 text-slate-400"> Scan QR Code</span>
                                        </label>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="mt-4">
                                <input type="submit" class="w-full px-5 py-2 text-white bg-indigo-600 rounded-md"
                                    value="Lanjutkan Pembayaran">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                        <h3 class="text-xl font-semibold leading-normal">Detail Pemesanan</h3>
                        <div class="flex items-center justify-between mt-6">
                            <p class="text-slate-400">Total Barang:</p>
                            <h6 class="text-lg font-semibold">{{ $carts->sum('quantity') }}</h6>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <p class="text-slate-400">Total Jenis Barang:</p>
                            <h6 class="text-lg font-semibold">{{ $carts->count() }}</h6>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <p class="text-slate-400">Sub Total:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($subTotalPayment, 0, ',', '.') }}</h6>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <p class="text-slate-400">PPN:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($ppn, 0, ',', '.') }}</h6>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <p class="text-slate-400">Total Pembayaran:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($totalPayment, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
@endsection
