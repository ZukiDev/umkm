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
    <section class="relative pb-16">
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
                                            <li>{{ $orderDetail->product->name }} - {{ $orderDetail->quantity }} pcs</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-4 text-end">Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
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
