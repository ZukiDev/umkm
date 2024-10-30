@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl leading-normal font-semibold">Pemesanan</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="index-shop.html">{{ config('app.name', 'UMKM Blitar') }}</p>
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
    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-8">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                        <h3 class="text-xl leading-normal font-semibold">Alamat Pengiriman</h3>

                        <form action="{{ route('customer.checkout.store') }}" method="POST">
                            @csrf
                            <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Nama: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Nama" name="name" value="{{ $user->name }}" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Username: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Username" name="username" value="{{ $user->username }}" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Email: <span
                                            class="text-red-600">*</span></label>
                                    <input type="email"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Email" name="email" value="{{ $user->email }}" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Nomer Telepon: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Nomer Telepon" name="phone_number" value="{{ $user->phone_number }}"
                                        required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Alamat Lengkap: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Alamat Lengkap" name="address" value="{{ $address->address }}"
                                        required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Provinsi: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Provinsi" name="province" value="{{ $address->province }}" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Kota: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Kota" name="city" value="{{ $address->city }}" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Kecamatan: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Kecamatan" name="district" value="{{ $address->district }}" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Kode Pos: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Kode Pos" name="post_code" value="{{ $address->post_code }}" required>
                                </div>

                                <div class="lg:col-span-12">
                                    <label class="form-label font-semibold">Instruksi Pengiriman:</label>
                                    <textarea
                                        class="form-input w-full py-2 px-3 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Instruksi Pengiriman" name="delivery_instructions">{{ $address->delivery_instructions }}</textarea>
                                </div>
                            </div>


                            <h3 class="text-xl leading-normal font-semibold mt-6">Metode Pembayaran</h3>

                            <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                                <div class="lg:col-span-12">
                                    <div class="block">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio text-indigo-600"
                                                name="payment_method" value="cod" checked>
                                            <span class="text-slate-400"> Bayar di Tempat</span>
                                        </label>
                                    </div>
                                    <div class="block mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio text-indigo-600"
                                                name="payment_method" value="bank_transfer">
                                            <span class="text-slate-400"> Transfer Rekening</span>
                                        </label>
                                    </div>
                                    <div class="block mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio text-indigo-600"
                                                name="payment_method" value="qr_code">
                                            <span class="text-slate-400"> Scan QR Code</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="mt-4">
                                <input type="submit" class="py-2 px-5 bg-indigo-600 text-white rounded-md w-full"
                                    value="Lanjutkan Pembayaran">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                        <h3 class="text-xl leading-normal font-semibold">Detail Pemesanan</h3>
                        <div class="flex justify-between items-center mt-6">
                            <p class="text-slate-400">Total Barang:</p>
                            <h6 class="text-lg font-semibold">{{ $carts->count() }}</h6>
                        </div>
                        <div class="flex justify-between items-center mt-6">
                            <p class="text-slate-400">Sub Total:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($subTotalPayment, 0, ',', '.') }}</h6>
                        </div>
                        <div class="flex justify-between items-center mt-6">
                            <p class="text-slate-400">PPN:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($ppn, 0, ',', '.') }}</h6>
                        </div>
                        <div class="flex justify-between items-center mt-6">
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
