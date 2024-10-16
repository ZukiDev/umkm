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

                        <form>
                            <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Nama: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Nama" name="name" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Username: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Username" name="username" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Email: <span
                                            class="text-red-600">*</span></label>
                                    <input type="email"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Email" name="email" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Nomer Telepon: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Nomer Telepon" name="phone_number" required>
                                </div>

                                <div class="lg:col-span-6">
                                    <label class="form-label font-semibold">Alamat Lengkap: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Alamat Lengkap" name="address" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Provinsi: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Provinsi" name="province" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Kota: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Kota" name="city" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Kecamatan: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Kecamatan" name="district" required>
                                </div>

                                <div class="lg:col-span-4">
                                    <label class="form-label font-semibold">Kode Pos: <span
                                            class="text-red-600">*</span></label>
                                    <input type="text"
                                        class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Kode Pos" name="post_code" required>
                                </div>

                                <div class="lg:col-span-12">
                                    <label class="form-label font-semibold">Instruksi Pengiriman:</label>
                                    <textarea
                                        class="form-input w-full py-2 px-3 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                        placeholder="Instruksi Pengiriman" name="delivery_instructions"></textarea>
                                </div>
                            </div>
                        </form>


                        <h3 class="text-xl leading-normal font-semibold mt-6">Metode Pembayaran</h3>

                        <form action="">
                            <form>
                                <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                                    <div class="lg:col-span-12">
                                        <div class="block">
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="radio"
                                                        class="form-radio border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                                        name="radio-colors" value="1" checked>
                                                    <span class="text-slate-400">Bayar di Tempat</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="block mt-2">
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="radio"
                                                        class="form-radio border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                                        name="radio-colors" value="1">
                                                    <span class="text-slate-400">Transfer Rekening</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="block mt-2">
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="radio"
                                                        class="form-radio border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                                        name="radio-colors" value="1">
                                                    <span class="text-slate-400">Scan QR Code</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </form>
                        <div class="mt-4">
                            <input type="submit"
                                class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                value="Lanjutkan Pembayaran">
                        </div>
                    </div>

                </div><!--end col-->

                <div class="lg:col-span-4">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                        <div class="flex justify-between items-center">
                            <h5 class="text-lg font-semibold">Detail Pemesanan</h5>

                            <a href="javascript:void(0)"
                                class="bg-indigo-600 flex justify-center items-center text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full h-5">3</a>
                        </div>

                        <div class="mt-4 rounded-md shadow dark:shadow-gray-800">
                            <div class="p-3 flex justify-between items-center">
                                <div>
                                    <h5 class="font-semibold">Nama Produk</h5>
                                    <p class="text-sm text-slate-400">Deskripsi</p>
                                </div>

                                <p class="text-slate-400 font-semibold">Rp. 1.200.000</p>
                            </div>
                            <div class="p-3 flex justify-between items-center border border-gray-100 dark:border-gray-800">
                                <div>
                                    <h5 class="font-semibold">Nama Produk</h5>
                                    <p class="text-sm text-slate-400">Deskripsi</p>
                                </div>

                                <p class="text-slate-400 font-semibold">Rp. 1.800.000</p>
                            </div>
                            <div class="p-3 flex justify-between items-center border border-gray-100 dark:border-gray-800">
                                <div>
                                    <h5 class="font-semibold">Nama Produk</h5>
                                    <p class="text-sm text-slate-400">Deskripsi</p>
                                </div>

                                <p class="text-slate-400 font-semibold">Rp. 2.000.000</p>
                            </div>
                            <div class="p-3 flex justify-between items-center border border-gray-100 dark:border-gray-800">
                                <div>
                                    <h5 class="font-semibold">Total (Rp)</h5>
                                </div>

                                <p class="font-semibold">Rp. 3.000.000</p>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
