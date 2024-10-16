@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl leading-normal font-semibold">Detail Produk {{ 'Nama Produk' }}</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="index-shop.html">{{ config('app.name', 'UMKM Blitar') }}</p>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Detail
                        Produk {{ 'Nama Produk' }}
                    </li>
                </ul>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] items-center">
                <div class="lg:col-span-5 md:col-span-6">
                    <div>
                        <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}"
                            class="rounded-md shadow dark:shadow-gray-800" alt="">
                    </div><!--end content-->
                </div><!--end col-->

                <div class="lg:col-span-7 md:col-span-6">
                    <div class="lg:ms-6">
                        <h5 class="text-3xl font-bold">{{ $product->name }}</h5>
                        <div class="mt-2">
                            <span class="text-slate-400 text-2xl font-semibold me-1">Rp. {{ $product->price }}</span>
                            <span class="text-red-600 text-nowrap text-end">(90
                                Terjual)
                            </span>
                        </div>

                        <div class="mt-4">
                            <h5 class="text-lg font-semibold">Deskripsi :</h5>
                            <p class="text-slate-400 mt-2">{{ $product->description }}</p>
                        </div>

                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] mt-4">
                            <div class="flex items-center">
                                <h5 class="text-lg font-semibold me-2">Jumlah:</h5>
                                <div class="qty-icons ms-3 flex items-center">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                        class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 border hover:border-indigo-600 text-indigo-600 hover:text-white minus">-</button>
                                    <input min="0" name="quantity" value="0" type="number"
                                        class="h-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white pointer-events-none w-16 ps-4 quantity">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                        class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white plus">+</button>
                                </div>
                                <!-- Teks Stok tersedia -->
                            </div><!--end content-->
                            <span class="mt-2 text-indigo-600 text-md text-start">Stok tersedia : 90</span>
                        </div><!--end grid-->

                        <div class="mt-4">
                            <a href="{{ route('customer.checkout') }}"
                                class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md me-2 mt-2">Pesan
                                Sekarang</a>
                            <a href="{{ route('customer.cart') }}"
                                class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white mt-2">Tambahkan
                                Ke Keranjang</a>
                        </div>
                    </div>
                </div>
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
