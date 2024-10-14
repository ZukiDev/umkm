@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid relative px-3">
        <div class="layout-specing">
            <!-- Start Content -->
            <div class="md:flex justify-between items-center">
                <div>
                    <h5 class="text-lg font-semibold">Semua Produk</h5>

                    <ul class="tracking-[0.5px] inline-block mt-2">
                        <li
                            class="inline-block capitalize text-[14px] font-bold duration-500 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white">
                            <a href="index.html">Produk</a>
                        </li>
                        <li
                            class="inline-block text-base text-slate-950 dark:text-white/70 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                            <i class="uil uil-angle-right-b"></i>
                        </li>
                        <li class="inline-block capitalize text-[14px] font-bold text-indigo-600 dark:text-white"
                            aria-current="page">Semua Produk</li>
                    </ul>
                </div>

                <div>
                    <a href="javascript:void(0)"
                        class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[20px] text-center bg-gray-800/5 hover:bg-gray-800/10 dark:bg-gray-800 border border-gray-800/5 dark:border-gray-800 text-slate-900 dark:text-white rounded-full"
                        onclick="addshopitem.showModal()" title="Add New"><i data-feather="plus" class="h-4 w-4"></i></a>
                </div>
            </div>
            <div class="mt-6">
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
            </div>

            <div class="grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-6 gap-6">
                @foreach($products as $product)
                <div class="group">
                    <div
                        class="relative overflow-hidden shadow dark:shadow-gray-700 group-hover:shadow-lg group-hover:dark:shadow-gray-700 rounded-md duration-500">
                        <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}">

                        <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Edit</a>
                        </div>

                        <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                            <li><a href="javascript:void(0)"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                        class="mdi mdi-heart"></i></a></li>
                            <li class="mt-1"><a href="{{ route('admin.product.show', $product->id) }}"
                                    class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                        class="mdi mdi-eye-outline"></i></a></li>
                            <li class="mt-1">
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white"><i
                                            class="mdi mdi-delete"></i></button>
                                </form>
                            </li>
                        </ul>

                        <ul class="list-none absolute top-[10px] start-4">
                            <li><a href="javascript:void(0)"
                                    class="bg-orange-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">{{ $product->label }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.product.show', $product->id) }}" class="hover:text-indigo-600 text-lg font-semibold">{{ $product->name }}</a>
                        <div class="flex justify-between items-center mt-1">
                            <p class="text-green-600">${{ $product->price }} <del class="text-red-600">${{ $product->original_price }}</del></p>
                            <ul class="font-medium text-amber-400 list-none">
                                @for ($i = 0; $i < 5; $i++)
                                    <li class="inline"><i class="mdi mdi-star{{ $i < $product->rating ? '' : '-outline' }}"></i></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div><!--end content-->
                @endforeach
            </div>
            <!--end grid-->
        </div>
    </div>
    <!-- Start Modal -->
    <dialog id="addshopitem"
        class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
        <div class="relative h-auto md:w-[480px] w-300px">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="font-bold text-lg">Add shop item</h3>
                <form method="dialog">
                    <button
                        class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost"><i
                            data-feather="x" class="size-4"></i></button>
                </form>
            </div>
            <div class="p-4">

                <form class="mt-4" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div>
                        <p class="font-semibold mb-4">Upload your shop image here, Please click "Upload Image" Button.
                        </p>
                        <div
                            class="preview-box flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small w-auto max-h-60">
                            Supports JPG, PNG and MP4 videos. Max file size : 2MB.</div>
                        <input type="file" id="images" name="images" accept="image/*" hidden required>
                        <label
                            class="btn-upload py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md mt-6 cursor-pointer"
                            for="images">Upload Image</label>
                    </div>

                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-12">
                            <label class="font-semibold">Item Name <span class="text-red-600">*</span></label>
                            <input name="name" id="name" type="text"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="Name" required>
                        </div><!--end col-->

                        <div class="col-span-12">
                            <label class="font-semibold">Description</label>
                            <textarea name="description" id="description"
                                class="form-input w-full py-2 px-3 h-20 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="Description"></textarea>
                        </div><!--end col-->

                        <div class="col-span-12">
                            <label class="font-semibold">SKU <span class="text-red-600">*</span></label>
                            <input name="sku" id="sku" type="text"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="SKU" required>
                        </div><!--end col-->

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label font-semibold">Price <span class="text-red-600">*</span></label>
                            <div class="relative mt-2">
                                <span
                                    class="absolute top-0.5 start-0.5 size-9 text-xl bg-gray-100 dark:bg-slate-800 inline-flex justify-center items-center text-dark dark:text-white rounded"
                                    id="basic-addon1"><i class="uil uil-dollar-sign"></i></span>
                                <input name="price" id="price" type="text"
                                    class="form-input ps-12 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                    placeholder="Price" required>
                            </div>
                        </div><!--end col-->

                        <div class="md:col-span-6 col-span-12">
                            <label class="font-semibold">Stock <span class="text-red-600">*</span></label>
                            <input name="stock" id="stock" type="number"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="Stock" required>
                        </div><!--end col-->

                        <div class="md:col-span-6 col-span-12">
                            <label class="font-semibold">Weight</label>
                            <input name="weight" id="weight" type="text"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="Weight">
                        </div><!--end col-->

                        <div class="md:col-span-6 col-span-12">
                            <label class="font-semibold">Dimensions</label>
                            <input name="dimensions" id="dimensions" type="text"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="Dimensions">
                        </div><!--end col-->

                        <div class="md:col-span-6 col-span-12">
                            <label class="font-semibold">Brand</label>
                            <input name="brand" id="brand" type="text"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                placeholder="Brand">
                        </div><!--end col-->

                        <div class="md:col-span-6 col-span-12">
                            <label class="font-semibold">Status <span class="text-red-600">*</span></label>
                            <select name="status" id="status"
                                class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div><!--end col-->

                        <div class="col-span-12">
                            <button type="submit"
                                class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md">Add
                                Item</button>
                        </div><!--end col-->
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    <!-- End Modal -->
@endsection
