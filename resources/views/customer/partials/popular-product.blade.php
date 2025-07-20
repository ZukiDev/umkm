<div class="container relative py-16">
    <div class="grid items-center grid-cols-1">
        <h3 class="text-2xl font-semibold leading-normal">Produk Terpopuler</h3>
    </div><!--end grid-->

    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
        @foreach ($popularProducts as $product)
            <div class="flex flex-col w-full group min-h-3 max-h-3">
                <!-- Image Container (80%) -->
                <div
                    class="relative w-full h-full overflow-hidden duration-500 rounded-md shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800">
                    <a href="{{ route('customer.product.show', $product->id) }}">
                        <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}"
                            class="object-cover w-full h-full" style="min-height: 300px; max-height: 300px;">
                    </a>
                    <div class="absolute duration-500 -bottom-20 group-hover:bottom-3 start-3 end-3">
                        <form action="{{ route('customer.cart.store', $product->id) }}" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                            <input type="hidden" name="checkout" value="0">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                class="inline-block w-full px-5 py-2 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 border rounded-md bg-slate-900 border-slate-900">
                                Tambahkan ke Keranjang
                            </button>
                        </form>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li class="mt-1">
                            <a href="{{ route('customer.product.show', $product->id) }}"
                                class="inline-flex items-center justify-center text-base tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border-indigo-600 rounded-full size-8 hover:bg-indigo-700 hover:border-indigo-700">
                                <i class="mdi mdi-eye-outline"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li>
                            <a href="javascript:void(0)"
                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">{{ $product->store->store_name }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"
                                class="bg-cyan-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Populer</a>
                        </li>
                    </ul>
                </div>

                <!-- Product Details (20%) -->
                <div class="mt-4 h-[20%] flex flex-col justify-between">
                    <a href="{{ route('customer.product.show', $product->id) }}"
                        class="text-lg font-semibold hover:text-indigo-600">{{ $product->name ?? 'Nama Produk' }}</a>
                    <div class="flex items-center justify-between mt-1 font-semibold">
                        <p class="text-green-600">Rp. {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                        <p class="text-red-600">{{ $product->sold ?? 0 }} Terjual</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--end grid-->
</div><!--end container-->
