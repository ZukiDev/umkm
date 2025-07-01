@extends('layouts.dashboard')

@section('content')
    <div class="layout-specing mx-6 sm:mx-6 md:mx-8 lg:mx-12">
        <div class="grid md:grid-cols-12 mt-2 gap-6 relative">
            <!-- Start Content -->
            <div class="md:col-span-12">
                <div class="md:flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Konfirmasi Pesanan</h5>
                    <ul class="tracking-[0.5px] inline-block sm:mt-0 mt-3">
                        <li
                            class="inline-block capitalize text-[14px] font-bold duration-500 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white">
                            <a href="#">Konfirmasi Pesanan</a>
                        </li>
                        <li
                            class="inline-block text-base text-slate-950 dark:text-white/70 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                            <i class="uil uil-angle-right-b"></i>
                        </li>
                        <li class="inline-block capitalize text-[14px] font-bold text-indigo-600 dark:text-white"
                            aria-current="page">Semua Pesanan
                        </li>
                    </ul>
                </div>

                <div class="grid xl:grid-cols-3 md:grid-cols-3 grid-cols-1 mt-6 gap-6">
                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-5 flex items-center">
                            <span
                                class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-red-600">
                                <i data-feather="credit-card" class="h-5 w-5"></i>
                            </span>

                            <span class="ms-3">
                                <span class="text-slate-400 font-semibold block">Belum Bayar</span>
                                <span class="flex items-center justify-between mt-1">
                                    <span class="text-xl font-semibold">{{ $unpaidCount }}</span>
                                </span>
                        </div>
                    </div><!--end-->

                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-5 flex items-center">
                            <span
                                class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-orange-600">
                                <i data-feather="package" class="h-5 w-5"></i>
                            </span>

                            <span class="ms-3">
                                <span class="text-slate-400 font-semibold block">Proses</span>
                                <span class="flex items-center justify-between mt-1">
                                    <span class="text-xl font-semibold">{{ $processCount }}</span>
                                </span>
                        </div>
                    </div><!--end-->

                    <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                        <div class="p-5 flex items-center">
                            <span
                                class="flex justify-center items-center rounded-md size-14 min-w-[56px] bg-indigo-600/5 dark:bg-indigo-600/10 shadow shadow-indigo-600/5 dark:shadow-indigo-600/10 text-indigo-600">
                                <i data-feather="truck" class="h-5 w-5"></i>
                            </span>

                            <span class="ms-3">
                                <span class="text-slate-400 font-semibold block">Pengiriman</span>
                                <span class="flex items-center justify-between mt-1">
                                    <span class="text-xl font-semibold">{{ $onDeliveryCount }}</span>
                                </span>
                        </div>
                    </div><!--end-->
                </div>

                <div class="mt-6" id="tables">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="shadow dark:shadow-slate-800 rounded bg-white dark:bg-slate-900">
                            <!-- Success Message -->
                            @if (session('success'))
                                <div
                                    class="relative px-4 py-2 rounded-md font-medium bg-emerald-600/10 border border-emerald-600/10 text-emerald-600 block">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if (session('error'))
                                <div
                                    class="relative px-4 py-2 rounded-md font-medium bg-red-600/10 border border-red-600/10 text-red-600 block">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="p-5 border-t border-gray-100 dark:border-slate-800">
                                <div
                                    class="relative overflow-x-auto block w-full bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                                    <table class="w-full text-start">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-5 text-start">No.</th>
                                                <th class="px-4 py-5 text-start">Tanggal Pembelian</th>
                                                <th class="px-4 py-5 text-start">Nama Pembeli</th>
                                                <th class="px-4 py-5 text-start">Alamat</th>
                                                <th class="px-4 py-5 text-start">Produk</th>
                                                <th class="px-4 py-5 text-start">Total</th>
                                                <th class="px-4 py-5 text-start">Metode Bayar</th>
                                                <th class="px-4 py-5 text-start">Status</th>
                                                <th class="px-4 py-5 text-start">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($orders as $index => $order)
                                                <tr class="border-t border-gray-100 dark:border-gray-700">
                                                    {{-- <td class="p-4">
                                                        {{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}
                                                    </td> --}}
                                                    <td class="p-4">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="p-4">{{ $order->created_at }}</td>
                                                    <td class="p-4">{{ $order->user->name }}</td>
                                                    <td class="p-4">{{ $order->address->address }}</td>
                                                    <!-- Tampilkan Produk -->
                                                    <td class="p-4">
                                                        <ul class="list-disc list-inside">
                                                            @foreach ($order->orderDetails as $orderDetail)
                                                                <li>{{ $orderDetail->product->name }} -
                                                                    {{ $orderDetail->quantity }} pcs</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="p-4">
                                                        Rp. {{ number_format($order->total, 0, ',', '.') }}
                                                    </td>
                                                    <td class="p-4">
                                                         {{ $order->payment->last()?->payment_method ?? '-' }}
                                                    </td>
                                                    <td class="p-4">
                                                        <span
                                                            class="text-white text-[12px] font-semibold px-2.5 py-0.5 rounded h-5
                                                            @if ($order->status == 0) bg-red-600 text-white
                                                            @elseif($order->status == 1) bg-orange-600 text-white
                                                            @elseif($order->status == 2) bg-indigo-600 text-white
                                                            @elseif($order->status == 3) bg-green-600 text-white
                                                            @elseif($order->status == 4) bg-gray-500 text-white @endif">
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
                                                        </span>
                                                    </td>

                                                    <td class="p-4 text-end">
                                                        <!-- Chat WA Button -->
                                                        <a href="https://wa.me/{{ $order->user->phone_number }}"
                                                            class="text-blue-600 hover:text-blue-800" target="_blank">
                                                            <i class="uil uil-chat"></i> Chat WhatsApp
                                                        </a>
                                                        <br>
                                                        <!-- Edit Button -->
                                                        <button class="text-yellow-600 hover:text-yellow-800"
                                                            onclick="editModal{{ $order->id }}.showModal()">
                                                            <i class="uil uil-edit">Ubah Status</i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Start Edit Modal -->
                                                <dialog id="editModal{{ $order->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[960px] w-full px-6">
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Ubah Status</h3>
                                                            <!-- Close Button (X) -->
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6">
                                                            <form action="{{ route('admin.order.update', $order->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Dropdown Status Pesanan -->
                                                                <div class="mb-4">
                                                                    <label for="status"
                                                                        class="block font-semibold mb-2">Status
                                                                        Pesanan</label>
                                                                    <select id="status" name="status"
                                                                        class="border px-3 py-2 rounded w-full" required>
                                                                        <option value="0"
                                                                            {{ $order->status == 0 ? 'selected' : '' }}>
                                                                            Belum Bayar</option>
                                                                        <option value="1"
                                                                            {{ $order->status == 1 ? 'selected' : '' }}>
                                                                            Proses</option>
                                                                        <option value="2"
                                                                            {{ $order->status == 2 ? 'selected' : '' }}>
                                                                            Pengiriman</option>
                                                                        <option value="3"
                                                                            {{ $order->status == 3 ? 'selected' : '' }}>
                                                                            Selesai</option>
                                                                        <option value="4"
                                                                            {{ $order->status == 4 ? 'selected' : '' }}>
                                                                            Batal</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Submit Button -->
                                                                <button type="submit"
                                                                    class="bg-indigo-600 text-white px-4 py-2 rounded mt-4">
                                                                    Simpan Perubahan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Pagination Links -->
                                </div>
                                {{-- <div class="mt-4">
                                    {{ $orders->links('pagination::simple-tailwind') }}
                                </div> --}}
                            </div>
                        </div><!--end content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
