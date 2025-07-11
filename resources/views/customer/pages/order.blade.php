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
            <div class="grid lg:grid-cols-1">
                <div class="relative overflow-x-auto shadow dark:shadow-gray-800 rounded-md">
                    <table class="w-full text-start">
                        <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                            <tr>
                                <th scope="col" class="p-4 w-4">No</th>
                                <th scope="col" class="text-start p-4 min-w-[140px]">Tanggal Pemesanan</th>
                                <th scope="col" class="text-start p-4 min-w-[140px]">Kode Pemesanan</th>
                                <th scope="col" class="text-start p-4 min-w-[140px]">Nama UMKM</th>
                                <th scope="col" class="text-start p-4 min-w-[240px]">Nama Produk</th>
                                <th scope="col" class="p-4 w-24 min-w-[160px]">Total</th>
                                <th scope="col" class="p-4 min-w-[120px]">Status</th>
                                {{-- Liha detail --}}
                                {{-- <th scope="col" class="p-4 min-w-[120px]">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="bg-white dark:bg-slate-900">
                                    <td class="p-4">{{ $loop->iteration }}</td>
                                    <td class="p-4">{{ $order->created_at }}</td>
                                    <td class="p-4">{{ $order->code_order }}</td>
                                    <td class="p-4">{{ $order->umkm->store_name ?? 'N/A' }}</td>
                                    <td class="p-4">
                                        <ul class="list-disc list-inside">
                                            @foreach ($order->orderDetails as $orderDetail)
                                                <li>
                                                    {{ $orderDetail->product ? $orderDetail->product->name : 'Produk telah dihapus' }} - {{ $orderDetail->quantity }} pcs
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="p-4 text-end">Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        <span
                                            class="text-white text-[12px] font-semibold px-2.5 py-0.5 rounded h-5
                                            @if ($order->status == 0) bg-red-600
                                            @elseif($order->status == 1) bg-orange-600
                                            @elseif($order->status == 2) bg-indigo-600
                                            @elseif($order->status == 3) bg-green-600
                                            @elseif($order->status == 4) bg-gray-500 @endif">
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
                                    {{-- <td class="p-4">
                                        <a href="{{ route('customer.payment.show', $order->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--end table-->
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
