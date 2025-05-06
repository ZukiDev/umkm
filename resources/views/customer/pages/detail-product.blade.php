@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl font-semibold leading-normal">Detail {{ $product->name }}</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <p href="{{ route('home') }}">{{ config('app.name', 'UMKM Blitar') }}</p>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Detail
                        {{ $product->name }}
                    </li>
                </ul>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative py-12">
        <div class="container">
            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="relative block px-4 py-2 mb-4 font-medium border rounded-md bg-emerald-600/10 border-emerald-600/10 text-emerald-600">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Warning Message -->
            @if (session('warning'))
                <div
                    class="relative block px-4 py-2 mb-4 font-medium text-orange-600 border rounded-md bg-orange-600/10 border-orange-600/10">
                    {{ session('warning') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div
                    class="relative block px-4 py-2 mb-4 font-medium text-red-600 border rounded-md bg-red-600/10 border-red-600/10">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] items-center">
                <div class="lg:col-span-5 md:col-span-6">
                    <div>
                        <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}"
                            class="rounded-md shadow dark:shadow-gray-800">
                    </div>
                </div>

                <div class="lg:col-span-7 md:col-span-6">
                    <div class="lg:ms-6">
                        <h5 class="text-3xl font-bold">{{ $product->name }}</h5>
                        <div class="mt-2">
                            <span class="text-2xl font-semibold text-slate-400 me-1">Rp.
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-red-600 text-nowrap text-end">({{ $product->sold }} Terjual)</span>
                        </div>

                        <div class="mt-4">
                            <h5 class="text-lg font-semibold">Deskripsi :</h5>
                            <p class="mt-2 text-slate-400">{{ $product->description }}</p>
                        </div>

                        <div class="mt-4">
                            <h5 class="text-lg font-semibold">Detail Produk :</h5>
                            <ul class="mt-2 text-slate-400">
                                <li><strong>Kategori:</strong> {{ $product->category->title ?? 'Tidak ada kategori' }}</li>
                                <li><strong>SKU:</strong> {{ $product->sku }}</li>
                                <li><strong>Berat:</strong> {{ $product->weight ?? 'N/A' }} kg</li>
                                <li><strong>Dimensi:</strong> {{ $product->dimensions ?? 'N/A' }}</li>
                                <li><strong>Merek:</strong> {{ $product->brand ?? 'Tidak ada merek' }}</li>
                            </ul>
                        </div>

                        <form action="{{ route('customer.cart.store', $product->id) }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] mt-4">
                                <div class="flex items-center">
                                    <h5 class="text-lg font-semibold me-2">Jumlah:</h5>
                                    <div class="flex items-center qty-icons ms-3">
                                        <button type="button"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                            class="inline-flex items-center justify-center text-base tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md size-9 bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white minus">-</button>
                                        <input min="1" name="quantity" value="1" type="number"
                                            class="inline-flex items-center justify-center w-16 text-base tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md pointer-events-none h-9 bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white ps-4 quantity">
                                        <button type="button"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                            class="inline-flex items-center justify-center text-base tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md size-9 bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white plus">+</button>
                                    </div>
                                </div>
                                <span class="mt-2 text-indigo-600 text-md text-start">Stok tersedia:
                                    {{ $product->stock }}</span>
                            </div>

                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                            <input type="hidden" name="checkout" value="0">
                            <div class="mt-4">
                                <button type="submit" onclick="this.form.checkout.value=1"
                                    class="inline-block px-5 py-2 mt-2 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 hover:border-indigo-700 me-2">Pesan
                                    Sekarang</button>
                                <button type="submit"
                                    class="inline-block px-5 py-2 mt-2 text-base font-semibold tracking-wide text-center text-indigo-600 align-middle duration-500 border rounded-md bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 hover:text-white">Tambahkan
                                    Ke Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->
@endsection
