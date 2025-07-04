@extends('layouts.landing')

@section('content')
    <div class="container">
        <h3 class="text-xl font-semibold">Pembayaran melalui Midtrans</h3>
        <p>Silakan klik tombol di bawah ini untuk melakukan pembayaran.</p>
        <button id="pay-button" class="px-6 py-2 mt-4 text-white bg-indigo-600 rounded">Bayar Sekarang</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil! Terima kasih.');
                    // Jika pembayaran berhasil, update status order ke "berhasil" (misal status = 1)
                    fetch("{{ route('customer.order.update', $order->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            status: 1
                        })
                    }).then(() => {
                        window.location.href = "{{ route('customer.order.index') }}";
                    });
                },
                onPending: function(result) {
                    alert('Pembayaran Anda sedang diproses. Silakan cek status pesanan secara berkala.');
                    // Jika pembayaran pending, update status order ke "pending" (misal status = 2)
                    fetch("{{ route('customer.order.update', $order->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            status: 2
                        })
                    }).then(() => {
                        window.location.href = "{{ route('customer.order.index') }}";
                    });
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Silakan coba lagi atau gunakan metode pembayaran lain.');
                    // Jika pembayaran gagal, update status order ke "gagal" (misal status = 3)
                    fetch("{{ route('customer.order.update', $order->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            status: 3
                        })
                    }).then(() => {
                        window.location.href = "{{ route('customer.order.index') }}";
                    });
                }
            });
        };
    </script>
@endsection
