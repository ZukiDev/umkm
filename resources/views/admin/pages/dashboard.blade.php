@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid relative px-3">
        <div class="layout-specing">
            <!-- Start Content -->
            <div class="flex justify-between items-center">
                <div>
                    <h5 class="text-xl font-bold">Halo, {{ Auth::user()->name }}</h5>
                    <h6 class="text-slate-400 font-semibold">Selamat Datang!</h6>
                </div>
            </div>

            <div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 mt-6 gap-6">
                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="users" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Konfirmasi Pesanan</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10</span>
                            </span>
                    </div>

                    <div class="px-5 py-4 bg-gray-50 dark:bg-slate-800">
                        <a href="{{ route('admin.order.index') }}"
                            class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-indigo-600 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white after:bg-indigo-600 dark:after:bg-white duration-500">Lihat
                            Rincian <i class="uil uil-arrow-right"></i></a>
                    </div>
                </div><!--end-->

                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="shopping-cart" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total Pesanan</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10</span>
                            </span>
                    </div>

                    <div class="px-5 py-4 bg-gray-50 dark:bg-slate-800">
                        <a href="{{ route('admin.history.index') }}"
                            class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-indigo-600 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white after:bg-indigo-600 dark:after:bg-white duration-500">Lihat
                            Rincian <i class="uil uil-arrow-right"></i></a>
                    </div>
                </div><!--end-->

                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="shopping-bag" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total Produk</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10</span>
                            </span>
                    </div>

                    <div class="px-5 py-4 bg-gray-50 dark:bg-slate-800">
                        <a href="{{ route('admin.product.index') }}"
                            class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-indigo-600 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white after:bg-indigo-600 dark:after:bg-white duration-500">Lihat
                            Rincian <i class="uil uil-arrow-right"></i></a>
                    </div>
                </div><!--end-->

                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="dollar-sign" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total Pendapatan</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">Rp. 100.000.000</span>
                            </span>
                    </div>

                    <div class="px-5 py-4 bg-gray-50 dark:bg-slate-800">
                        <a href="{{ route('admin.history.index') }}"
                            class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-indigo-600 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white after:bg-indigo-600 dark:after:bg-white duration-500">Lihat
                            Rincian <i class="uil uil-arrow-right"></i></a>
                    </div>
                </div><!--end-->
            </div>

            <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-6">
                <div class="xl:col-span-7 lg:col-span-7">
                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-800">
                            <h6 class="text-lg font-semibold">Konfirmasi Pesanan</h6>

                            <a href="{{ route('admin.order.index') }}"
                                class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-slate-400 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white after:bg-indigo-600 dark:after:bg-white duration-500">Lihat
                                Selengkapnya <i class="uil uil-arrow-right"></i></a>
                        </div>

                        <div class="relative overflow-x-auto block w-full max-h-[400px]" data-simplebar>
                            <table class="w-full text-start">
                                <thead class="text-base">
                                    <tr>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[50px]">No.
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[153px]">Nama
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[153px]">Tanggal Pembelian
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[128px]">
                                            Harga</th>
                                        <th class="text-end font-semibold text-[15px] p-4 min-w-[128px]">Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th
                                            class="text-start border-t border-gray-100 dark:border-gray-800 p-4 font-semibold">
                                            1.</th>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">Ahnaf</td>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">10th Aug 2023</span>
                                        </td>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Rp. 100.000</span>
                                        </td>
                                        <td class="text-end border-t border-gray-100 dark:border-gray-800 p-4">
                                            {{-- <span
                                                class="
                                                @if ($order->status == 0) bg-red-600 text-white
                                                @elseif($order->status == 1) bg-orange-600 text-white
                                                @elseif($order->status == 2) bg-indigo-600 text-white
                                                @elseif($order->status == 3) bg-green-600 text-white
                                                @elseif($order->status == 4) bg-gray-500 text-white @endif
                                                text-[12px] font-bold px-2.5 py-0.5 rounded h-5 ms-1">
                                                @if ($order->status == 0)
                                                    Belum Bayar
                                                @elseif($order->status == 1)
                                                    Proses
                                                @elseif($order->status == 2)
                                                    Pengiriman
                                                @elseif($order->status == 3)
                                                    Selesai
                                                @elseif($order->status == 4)
                                                    Batal
                                                @endif
                                            </span> --}}
                                            <!-- Dummy badges with hardcoded statuses -->
                                            <span
                                                class="bg-green-600 text-white text-[12px] font-bold px-2.5 py-0.5 rounded h-5 ms-1">Selesai
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-5 lg:col-span-5">
                    <div class="rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-800">
                            <h6 class="text-lg font-semibold">Produk Terlaris</h6>

                            <a href="{{ route('admin.product.index') }}"
                                class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-slate-400 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white after:bg-indigo-600 dark:after:bg-white duration-500">Perbarui
                                Stok <i class="uil uil-arrow-right"></i></a>
                        </div>

                        <div class="relative overflow-x-auto block w-full max-h-[400px]" data-simplebar>
                            <table class="w-full text-start">
                                <thead class="text-base">
                                    <tr>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[150px]">Produk</th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[100px]">Terjual</th>
                                        <th class="text-end font-semibold text-[15px] p-4 min-w-[80px]">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th
                                            class="text-start border-t border-gray-100 dark:border-gray-800 p-4 font-semibold">
                                            Bakpia Ahnaf</th>
                                        <td
                                            class="text-start text-emerald-600 border-t border-gray-100 dark:border-gray-800 p-4">
                                            100</td>
                                        <td class="text-end border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-sm ms-1 font-semibold">5</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div><!--end container-->
@endsection
