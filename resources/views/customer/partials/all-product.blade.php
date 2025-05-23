<!-- Start -->
<section class="relative pb-32 pt-16">
    <div class="container relative">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center">
            <div class="lg:col-span-8 md:col-span-6 md:text-start text-center">
                <h3 class="text-2xl leading-normal font-semibold">Semua Produk</h3>
            </div>

            <div class="lg:col-span-4 md:col-span-6 md:text-end hidden md:block">
                <a href="{{ route('customer.product.index') }}"
                    class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:duration-500 text-slate-400 hover:text-indigo-600 after:bg-indigo-600 duration-500 ease-in-out">Lihat
                    Semua <i class="uil uil-arrow-right align-middle"></i></a>
            </div>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
            @foreach ($allProduct as $product)
                <div class="group w-full flex flex-col min-h-3 max-h-3">
                    <!-- Image Container (80%) -->
                    <div
                        class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500 w-full h-full">
                        <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}"
                            class="object-cover w-full h-full" style="min-height: 300px; max-height: 300px;">

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

                        <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                            <li class="mt-1">
                                <a href="{{ route('customer.product.show', $product->id) }}"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white">
                                    <i class="mdi mdi-eye-outline"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="list-none absolute top-[10px] start-4">
                            <li>
                                <a href="javascript:void(0)"
                                    class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">{{ $product->store->store_name }}</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Product Details (20%) -->
                    <div class="mt-4 h-[20%] flex flex-col justify-between">
                        <a href="{{ route('customer.product.show', $product->id) }}"
                            class="hover:text-indigo-600 text-lg font-semibold">{{ $product->name ?? 'Nama Produk' }}</a>
                        <div class="flex justify-between items-center mt-1 font-semibold">
                            <p class="text-green-600">Rp. {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                            <p class="text-red-600">{{ $product->sold ?? 0 }} Terjual</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
