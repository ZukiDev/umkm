@extends('layouts.landing')

@section('content')
    <!-- Start Hero -->
    <section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 mt-14">
                <h3 class="text-3xl leading-normal font-semibold">Semua Produk</h3>
            </div><!--end grid-->

            <div class="relative mt-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                        <a href="{{ route('home') }}">{{ config('app.name', 'UMKM Blitar') }}</a>
                    </li>
                    <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                            class="uil uil-angle-right-b"></i></li>
                    <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Semua
                        Produk
                    </li>
                </ul>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End Hero -->

    <!-- Start -->
    <section class="relative pb-32">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-4 md:col-span-6">
                    <div class="shadow dark:shadow-gray-800 p-6 rounded-md bg-white dark:bg-slate-900 sticky top-20">
                        <form action="{{ route('customer.product.index') }}" method="GET">
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <label for="searchname" class="hidden font-semibold"></label>
                                    <div class="relative">
                                        <i data-feather="search" class="size-4 absolute top-3 start-3"></i>

                                        <input name="search" id="searchname" type="text"
                                            class="form-input w-full py-2 px-3 h-10 ps-9 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            placeholder="Cari..." value="{{ request('search') }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="font-semibold">Kategori</label>
                                    @foreach ($categories as $category)
                                        <div class="block mt-2">
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="radio"
                                                        class="form-radio border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                                        name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }}>
                                                    <span class="text-slate-400">{{ $category->title }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-2">
                                    <input type="submit"
                                        class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                        value="Cari">
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--end col-->

                <div class="lg:col-span-8 md:col-span-6">
                    <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                        <div class="lg:col-span-9 md:col-span-8">
                            <h3 class="text-xl leading-normal font-semibold">Menampilkan {{ $products->count() }} Produk
                            </h3>
                        </div>

                        <div class="lg:col-span-3 md:col-span-4 md:text-end">
                            <label class="font-semibold hidden"></label>
                            <form action="{{ route('customer.product.index') }}" method="GET">
                                <select name="sort"
                                    class="form-select form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    onchange="this.form.submit()">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Urutkan</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                    <option value="high_price" {{ request('sort') == 'high_price' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="low_price" {{ request('sort') == 'low_price' ? 'selected' : '' }}>Harga Terendah</option>
                                </select>
                            </form>
                        </div>
                    </div><!--end grid-->

                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
                        @foreach ($products as $product)
                            <div class="group">
                                <div
                                    class="relative overflow-hidden shadow dark:shadow-gray-700 group-hover:shadow-lg group-hover:dark:shadow-gray-700 rounded-md duration-500 w-full h-full">
                                    <img src="{{ asset('storage/products/' . $product->images) }}"
                                        alt="{{ $product->name }}" class="w-full h-full object-cover">

                                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                                        <form action="{{ route('customer.cart.store', $product->id) }}" method="POST">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                                            <input type="hidden" name="checkout" value="0">
                                            <input type="hidden" name="quantity" value="1">

                                            <button type="submit"
                                                class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">
                                                Tambahkan ke Keranjang
                                            </button>
                                        </form>
                                    </div>

                                    <ul
                                        class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                                        <li class="mt-1"><a href="{{ route('customer.product.show', $product->id) }}"
                                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                                    class="mdi mdi-eye-outline"></i></a></li>
                                    </ul>

                                    <ul class="list-none absolute top-[10px] start-4">
                                        <li><a href="javascript:void(0)"
                                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">{{ $product->store->store_name }}</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('customer.product.show', $product->id) }}"
                                        class="hover:text-indigo-600 text-lg font-semibold">{{ $product->name ?? 'Nama Produk' }}</a>
                                    <div class="flex justify-between items-center mt-1 font-semibold">
                                        <p class="text-green-600">Rp.
                                            {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                        <p class="text-red-600">{{ $product->stock ?? 0 }} Terjual</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--end grid-->
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
