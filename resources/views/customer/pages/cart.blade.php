@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl font-semibold leading-normal">Keranjang</h3>
            </div>
            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="{{ route('home') }}">{{ config('app.name', 'UMKM Blitar') }}</p>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Keranjang
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative py-12">
        <div class="container">
            <div class="mt-4 mb-4">
                @if (session('success'))
                    <div
                        class="relative block px-4 py-2 font-medium border rounded-md bg-emerald-600/10 border-emerald-600/10 text-emerald-600">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div
                        class="relative block px-4 py-2 font-medium text-orange-600 border rounded-md bg-orange-600/10 border-orange-600/10">
                        {{ session('warning') }}
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="relative block px-4 py-2 font-medium text-red-600 border rounded-md bg-red-600/10 border-red-600/10">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- Produk yang bisa di-checkout --}}
            <div class="grid mb-8 lg:grid-cols-1">
                <div class="relative overflow-x-auto rounded-md shadow dark:shadow-gray-800">
                    <table class="w-full text-start">
                        <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                            <tr>
                                <th scope="col" class="w-4 p-4"></th>
                                <th scope="col" class="text-start p-4 min-w-[140px]">Nama Produk</th>
                                <th scope="col" class="p-4 w-24 min-w-[160px]">Harga</th>
                                <th scope="col" class="p-4 w-56 min-w-[220px]">Jumlah</th>
                                <th scope="col" class="p-4 w-24 min-w-[160px]">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checkoutableCarts as $cart)
                                <tr class="bg-white dark:bg-slate-900">
                                    <form action="{{ route('customer.cart.destroy', $cart->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <td class="p-4 text-start"><button type="submit">
                                                <i class="text-red-600 uil uil-trash"></i>
                                            </button></td>
                                    </form>
                                    <td class="p-4">
                                        <span class="flex items-center">
                                            <img src="{{ asset('storage/products/' . $cart->product->images) }}"
                                                class="w-12 rounded shadow dark:shadow-gray-800"
                                                alt="{{ $cart->product->name }}">
                                            <span class="ms-3">
                                                <span class="block font-semibold">{{ $cart->product->name }}</span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">Rp. {{ number_format($cart->price ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-4 text-center">
                                        <div class="qty-icons">
                                            <button onclick="updateQuantity(this, -1)"
                                                class="inline-flex items-center justify-center text-base tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md size-9 bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white minus">-</button>
                                            <input min="0" name="quantity" value="{{ $cart->quantity ?? 0 }}"
                                                type="number"
                                                class="inline-flex items-center justify-center w-16 text-base tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md pointer-events-none h-9 bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white ps-4 quantity"
                                                data-cart-id="{{ $cart->id }}" onchange="updateQuantity(this)">
                                            <button onclick="updateQuantity(this, 1)"
                                                class="inline-flex items-center justify-center text-base tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md size-9 bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white plus">+</button>
                                        </div>
                                    </td>
                                    <td class="p-4 text-end item-total">Rp.
                                        {{ number_format($cart->total ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center">Tidak ada produk yang bisa di-checkout.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Produk hanya untuk Blitar --}}
            @if ($blitarOnlyCarts->count())
                <div class="grid mb-8 lg:grid-cols-1">
                    <div class="relative overflow-x-auto border border-orange-400 rounded-md shadow dark:shadow-gray-800">
                        <h4 class="p-4 text-lg font-semibold text-orange-600">Produk hanya bisa dikirim ke Blitar</h4>
                        <div class="p-4 text-orange-600">
                            Produk berikut hanya bisa dikirim ke Blitar. Silakan ubah alamat Anda ke Blitar untuk
                            melanjutkan checkout produk ini.
                        </div>
                        <table class="w-full text-start">
                            <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                                <tr>
                                    <th scope="col" class="w-4 p-4"></th>
                                    <th scope="col" class="text-start p-4 min-w-[140px]">Nama Produk</th>
                                    <th scope="col" class="p-4 w-24 min-w-[160px]">Harga</th>
                                    <th scope="col" class="p-4 w-56 min-w-[220px]">Jumlah</th>
                                    <th scope="col" class="p-4 w-24 min-w-[160px]">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blitarOnlyCarts as $cart)
                                    <tr class="bg-white dark:bg-slate-900">
                                        <form action="{{ route('customer.cart.destroy', $cart->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <td class="p-4 text-start"><button type="submit">
                                                    <i class="text-red-600 uil uil-trash"></i>
                                                </button></td>
                                        </form>
                                        <td class="p-4">
                                            <span class="flex items-center">
                                                <img src="{{ asset('storage/products/' . $cart->product->images) }}"
                                                    class="w-12 rounded shadow dark:shadow-gray-800"
                                                    alt="{{ $cart->product->name }}">
                                                <span class="ms-3">
                                                    <span class="block font-semibold">{{ $cart->product->name }}</span>
                                                </span>
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">Rp. {{ number_format($cart->price ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 text-center">
                                            <div class="qty-icons">
                                                <input min="0" name="quantity" value="{{ $cart->quantity ?? 0 }}"
                                                    type="number"
                                                    class="inline-flex items-center justify-center w-16 text-base tracking-wide text-center text-orange-600 align-middle duration-500 bg-orange-100 border border-orange-400 rounded-md pointer-events-none h-9 ps-4 quantity"
                                                    data-cart-id="{{ $cart->id }}" readonly>
                                            </div>
                                        </td>
                                        <td class="p-4 text-end item-total">Rp.
                                            {{ number_format($cart->total ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-12 md:grid-cols-2">
                <div class="order-3 lg:col-span-7 md:order-1">
                    @if ($checkoutableCarts->count())
                        <a href="{{ route('customer.checkout') }}"
                            class="inline-block w-full px-5 py-2 mt-2 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 hover:border-indigo-700 me-2">Buat
                            Pemesanan</a>
                    @else
                        <button disabled
                            class="inline-block w-full px-5 py-2 mt-2 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 bg-gray-400 border border-gray-400 rounded-md cursor-not-allowed me-2">Buat
                            Pemesanan</button>
                    @endif
                </div>
                <div class="order-1 lg:col-span-5 md:order-2">
                    <ul class="list-none rounded-md shadow dark:shadow-gray-800">
                        <li class="flex justify-between p-4">
                            <span class="text-lg font-semibold">Subtotal :</span>
                            <span id="subtotal" class="text-slate-400">Rp.
                                {{ number_format($subTotalPayment ?? 0, 0, ',', '.') }}</span>
                        </li>
                        <li class="flex justify-between p-4 border-t border-gray-100 dark:border-gray-800">
                            <span class="text-lg font-semibold">PPN :</span>
                            <span id="ppn" class="text-slate-400">Rp.
                                {{ number_format($ppn ?? 0, 0, ',', '.') }}</span>
                        </li>
                        <li class="flex justify-between p-4 font-semibold border-t border-gray-200 dark:border-gray-600">
                            <span class="text-lg font-semibold">Total :</span>
                            <span id="total" class="font-semibold">Rp.
                                {{ number_format($totalPayment ?? 0, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

    <script>
        function updateQuantity(element, increment = 0) {
            const quantityInput = element.closest('.qty-icons').querySelector('.quantity');
            const cartId = quantityInput.getAttribute('data-cart-id');

            // Calculate and set new quantity
            let newQuantity = parseInt(quantityInput.value) + increment;
            newQuantity = Math.max(1, newQuantity);
            quantityInput.value = newQuantity;

            // AJAX request to update quantity
            fetch(`/cart/${cartId}`, {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            // If there's an error message, display it and reload the page
                            alert(data.error);
                            location.reload(); // Reload the page
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Response Data:", data); // Debugging: Check response data in console
                    if (data.success) {
                        // Update subtotal, PPN, and total in UI
                        document.getElementById("subtotal").innerText = `Rp. ${data.subTotalPayment}`;
                        document.getElementById("ppn").innerText = `Rp. ${data.ppn}`;
                        document.getElementById("total").innerText = `Rp. ${data.totalPayment}`;

                        // Update item-specific total
                        quantityInput.closest('tr').querySelector('.item-total').innerText = `Rp. ${data.itemTotal}`;
                    } else {
                        console.error("Update Failed:", data.error);
                        alert(data.error || "Failed to update cart.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
@endsection
