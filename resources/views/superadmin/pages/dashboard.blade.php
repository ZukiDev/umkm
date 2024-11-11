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

            <div class="grid xl:grid-cols-4 md:grid-cols-4 grid-cols-1 mt-6 gap-6">
                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="users" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total Customer</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10</span>
                            </span>
                        </span>
                    </div>
                </div><!--end-->

                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="shopping-bag" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total UMKM</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10</span>
                            </span>
                    </div>
                </div><!--end-->

                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="grid" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total Kategori</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10</span>
                            </span>
                    </div>
                </div><!--end-->

                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="p-5 flex items-center">
                        <span
                            class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                            <i data-feather="tag" class="h-5 w-5"></i>
                        </span>

                        <span class="ms-3">
                            <span class="text-slate-400 font-semibold block">Total Produk</span>
                            <span class="flex items-center justify-between mt-1">
                                <span class="text-xl font-semibold">10
                                </span>
                            </span>
                    </div>
                </div><!--end-->
            </div>

            <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-6">
                <div class="xl:col-span-6 lg:col-span-6">
                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-800">
                            <h6 class="text-lg font-semibold">Top 10 Customer Highest Order</h6>
                        </div>

                        <div class="relative overflow-x-auto block w-full max-h-[400px]" data-simplebar>
                            <table class="w-full text-start">
                                <thead class="text-base">
                                    <tr>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[100px]">No.
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Nama
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Total Pesanan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th
                                            class="text-start border-t border-gray-100 dark:border-gray-800 p-4 font-semibold">
                                            1.</th>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Ahnaf S.Tr. Kom</span>
                                        </td>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">10</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-6 lg:col-span-6">
                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-800">
                            <h6 class="text-lg font-semibold">Top 10 Customer Highest Priced Order</h6>
                        </div>

                        <div class="relative overflow-x-auto block w-full max-h-[400px]" data-simplebar>
                            <table class="w-full text-start">
                                <thead class="text-base">
                                    <tr>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[100px]">No.
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Nama
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Total Pembelian
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th
                                            class="text-start border-t border-gray-100 dark:border-gray-800 p-4 font-semibold">
                                            1.</th>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Ahnaf S.Tr. Kom</span>
                                        </td>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Rp. 10.000.000</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-6">
                <div class="xl:col-span-6 lg:col-span-6">
                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-800">
                            <h6 class="text-lg font-semibold">Top 10 UMKM Highest Order</h6>
                        </div>

                        <div class="relative overflow-x-auto block w-full max-h-[400px]" data-simplebar>
                            <table class="w-full text-start">
                                <thead class="text-base">
                                    <tr>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[100px]">No.
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Nama
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Total Pesanan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th
                                            class="text-start border-t border-gray-100 dark:border-gray-800 p-4 font-semibold">
                                            1.</th>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Naffe ID</span>
                                        </td>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">1000</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-6 lg:col-span-6">
                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-800">
                            <h6 class="text-lg font-semibold">Top 10 UMKM Highest Income</h6>
                        </div>

                        <div class="relative overflow-x-auto block w-full max-h-[400px]" data-simplebar>
                            <table class="w-full text-start">
                                <thead class="text-base">
                                    <tr>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[100px]">No.
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Nama
                                        </th>
                                        <th class="text-start font-semibold text-[15px] p-4 min-w-[256px]">Total Pendapatan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th
                                            class="text-start border-t border-gray-100 dark:border-gray-800 p-4 font-semibold">
                                            1.</th>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Naffe ID</span>
                                        </td>
                                        <td class="text-start border-t border-gray-100 dark:border-gray-800 p-4">
                                            <span class="text-slate-400">Rp. 10.000.000</span>
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
