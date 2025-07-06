@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl font-semibold leading-normal">Pembayaran</h3>
            </div>
            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <a href="{{ route('home') }}">{{ config('app.name', 'UMKM Blitar') }}</a>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180">
                        <i class="uil uil-angle-right-b"></i>
                    </li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Pembayaran
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative py-12">
        <div class="container">
            <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-8">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                        <h3 class="mb-6 text-xl font-semibold leading-normal">Alamat Pengiriman</h3>
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-12">
                            <div class="lg:col-span-6">
                                <p class="font-semibold">Nama:</p>
                                <p>{{ $order->address->user->name ?? '-' }}</p>
                            </div>
                            <div class="lg:col-span-6">
                                <p class="font-semibold">Nomer Telepon:</p>
                                <p>{{ $order->address->user->phone_number ?? '-' }}</p>
                            </div>
                            <div class="lg:col-span-12">
                                <p class="font-semibold">Alamat Lengkap:</p>
                                <p>
                                    {{ $order->address->address ?? '-' }}<br>
                                    {{ $order->address->district ?? '-' }}, {{ $order->address->city ?? '-' }},
                                    {{ $order->address->province ?? '-' }} - {{ $order->address->post_code ?? '-' }}<br>
                                    <span
                                        class="text-slate-400">({{ $order->address->delivery_instructions ?? '-' }})</span>
                                </p>
                            </div>
                        </div>

                        <h3 class="mt-8 text-xl font-semibold leading-normal">Metode Pembayaran</h3>
                        <div class="mt-4">
                            <p class="font-semibold">Metode:</p>
                            <p>
                                @if ($order->payment->payment_method == 'cod')
                                    Bayar di Tempat
                                @elseif($order->payment->payment_method == 'bank_transfer')
                                    Transfer Rekening
                                @else
                                    {{ $order->payment->payment_method }}
                                @endif
                            </p>
                        </div>

                        <h3 class="mt-8 text-xl font-semibold leading-normal">Status Pesanan</h3>
                        <div class="mt-4">
                            <p class="font-semibold">Nomor Pesanan:</p>
                            <p>{{ $order->code_order ?? '-' }}</p>
                            <p class="mt-2 font-semibold">Tanggal Pesanan:</p>
                            <p>{{ $order->created_at->format('d M Y H:i') }}</p>
                            <p class="mt-2 font-semibold">Status:</p>
                            @php
                                // Status Payment: 0 = pending, 1 = paid, 2 = cancelled
                                // Status Order: 0 = belum bayar, 1 = processed, 2 = pengiriman, 3 = selesai, 4 = cancelled

                                $paymentStatus = $order->payment->status ?? 0;
                                $orderStatus = $order->status ?? 0;

                                if ($paymentStatus == 2 || $orderStatus == 4) {
                                    $statusText = 'Dibatalkan';
                                    $statusClass = 'text-red-600';
                                } elseif ($paymentStatus == 0) {
                                    $statusText = 'Menunggu Pembayaran';
                                    $statusClass = 'text-yellow-600';
                                } elseif ($paymentStatus == 1) {
                                    switch ($orderStatus) {
                                        case 1:
                                            $statusText = 'Diproses';
                                            $statusClass = 'text-blue-600';
                                            break;
                                        case 2:
                                            $statusText = 'Pengiriman';
                                            $statusClass = 'text-indigo-600';
                                            break;
                                        case 3:
                                            $statusText = 'Selesai';
                                            $statusClass = 'text-green-600';
                                            break;
                                        default:
                                            $statusText = 'Belum Bayar';
                                            $statusClass = 'text-yellow-600';
                                    }
                                } else {
                                    $statusText = 'Belum Bayar';
                                    $statusClass = 'text-yellow-600';
                                }
                            @endphp
                            <p class="font-bold {{ $statusClass }}">{{ $statusText }}</p>
                        </div>

                        <h3 class="mt-8 text-xl font-semibold leading-normal">Daftar Produk</h3>
                        <ul class="mt-2 ml-5 list-disc">
                            @foreach ($orderDetails as $item)
                                <li>
                                    {{ $item->product->name ?? '-' }} x{{ $item->quantity }}
                                    <span class="text-slate-400">RP {{ number_format($item->price, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>

                        @if ($payment->payment_method == 'bank_transfer')
                            <div class="mt-8">
                                <input type="button" id="pay-button"
                                    class="w-full px-5 py-2 text-white bg-indigo-600 rounded-md"
                                    value="Lanjutkan Pembayaran">

                                {{-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> --}}

                                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
                                </script>
                                <script type="text/javascript">
                                    document.getElementById('pay-button').onclick = function() {
                                        // SnapToken acquired from previous step
                                        snap.pay('<?= $snapToken ?>', {
                                            // Optional
                                            onSuccess: function(result) {
                                                /* You may add your own js here, this is just example */
                                                var resultJsonElem = document.getElementById('result-json');
                                                if (resultJsonElem) {
                                                    resultJsonElem.innerHTML += JSON.stringify(result, null, 2);
                                                }

                                                fetch('/midtrans/webhook', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'Accept': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify(result)
                                                    })
                                                    .then(async response => {
                                                        const contentType = response.headers.get("content-type");
                                                        if (contentType && contentType.indexOf("application/json") !== -1) {
                                                            const json = await response.json();
                                                            console.log("Berhasil:", json);
                                                        } else {
                                                            const text = await response.text();
                                                            console.error("Unexpected response (HTML?):", text);
                                                        }
                                                        // Redirect after fetch is done
                                                        window.location.href = "{{ route('customer.order.index') }}";
                                                    })
                                                    .catch(error => {
                                                        console.error("Fetch error:", error);
                                                        // Redirect even if fetch fails
                                                        window.location.href = "{{ route('customer.order.index') }}";
                                                    });
                                            },
                                            // Optional
                                            onError: function(result) {
                                                /* You may add your own js here, this is just example */
                                                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                                window.location.href = "{{ route('customer.order.index') }}";
                                            }
                                        });
                                    };
                                </script>
                                {{-- <script>
                                    document.getElementById('pay-button').onclick = function() {
                                        snap.pay('{{ $snapToken }}', {
                                            // Optional
                                            onSuccess: function(result) {
                                                // Update payment status and order status via callback
                                                fetch('{{ route('customer.midtrans.callback') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify(result)
                                                }).then(response => {
                                                    // Optionally reload or show a success message
                                                    if (response.ok) {
                                                        location.reload();
                                                    }
                                                });
                                            },
                                            // Optional
                                            onPending: function(result) {
                                                // Update payment status and order status via callback
                                                fetch('{{ route('customer.midtrans.callback') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify(result)
                                                }).then(response => {
                                                    // Optionally reload or show a success message
                                                    if (response.ok) {
                                                        location.reload();
                                                    }
                                                });
                                            },
                                            // Optional
                                            onError: function(result) {
                                                // Update payment status and order status via callback
                                                fetch('{{ route('customer.midtrans.callback') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify(result)
                                                }).then(response => {
                                                    // Optionally reload or show a success message
                                                    if (response.ok) {
                                                        location.reload();
                                                    }
                                                });
                                            }
                                        })
                                    };
                                </script> --}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                        <h3 class="text-xl font-semibold leading-normal">Ringkasan Pembayaran</h3>
                        <div class="flex items-center justify-between mt-6">
                            <p class="text-slate-400">Sub Total:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($order->sub_total, 0, ',', '.') }}</h6>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-slate-400">PPN:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($order->ppn, 0, ',', '.') }}</h6>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-slate-400">Total Pembayaran:</p>
                            <h6 class="text-lg font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
@endsection
