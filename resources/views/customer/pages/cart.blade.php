@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl leading-normal font-semibold">Keranjang</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="index-shop.html">{{ config('app.name', 'UMKM Blitar') }}</p>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Keranjang
                    </li>
                </ul>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid lg:grid-cols-1">
                <div class="relative overflow-x-auto shadow dark:shadow-gray-800 rounded-md">
                    <table class="w-full text-start">
                        <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                            <tr>
                                <th scope="col" class="p-4 w-4"></th>
                                <th scope="col" class="text-start p-4 min-w-[140px]">Nama Produk</th>
                                <th scope="col" class="p-4 w-24 min-w-[160px]">Harga</th>
                                <th scope="col" class="p-4 w-56 min-w-[220px]">Jumlah</th>
                                <th scope="col" class="p-4 w-24 min-w-[160px]">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-slate-900">
                                <td class="p-4"><a href=""><i class="uil uil-trash text-red-600"></i></a>
                                </td>
                                <td class="p-4">
                                    <span class="flex items-center">
                                        <img src="../../assets/images/shop/items/s1.jpg"
                                            class="rounded shadow dark:shadow-gray-800 w-12" alt="">
                                        <span class="ms-3">
                                            <span class="block font-semibold">Baju (M)</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="p-4 text-center">Rp 2.000.000</td>
                                <td class="p-4 text-center">
                                    <div class="qty-icons">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white minus">-</button>
                                        <input min="0" name="quantity" value="3" type="number"
                                            class="h-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white pointer-events-none w-16 ps-4 quantity">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                            class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white plus">+</button>
                                    </div>
                                </td>
                                <td class="p-4  text-end">Rp. 5.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 mt-6 gap-6">
                    <div class="lg:col-span-7 md:order-1 order-3">
                        <a href="{{ route('customer.checkout') }}"
                            class="py-2 px-5 w-full inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md me-2 mt-2">Buat
                            Pemesanan</a>
                    </div>

                    <div class="lg:col-span-5 md:order-2 order-1">
                        <ul class="list-none shadow dark:shadow-gray-800 rounded-md">
                            <li class="flex justify-between p-4">
                                <span class="font-semibold text-lg">Subtotal :</span>
                                <span class="text-slate-400">Rp 1500</span>
                            </li>
                            <li class="flex justify-between p-4 border-t border-gray-100 dark:border-gray-800">
                                <span class="font-semibold text-lg">Ppn :</span>
                                <span class="text-slate-400">Rp 150</span>
                            </li>
                            <li
                                class="flex justify-between font-semibold p-4 border-t border-gray-200 dark:border-gray-600">
                                <span class="font-semibold text-lg">Total :</span>
                                <span class="font-semibold">Rp 1650</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
