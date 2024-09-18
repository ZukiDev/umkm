<!-- Start -->
<section class="relative py-16">
    <div class="container relative">
        <div id="grid" class="md:flex w-full justify-center mx-auto mt-4">
            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('asset/images/shop/hoodie.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="">
                    <div class="absolute bottom-4 start-4">
                        <a href="" class="text-xl font-semibold hover:text-indigo-600 duration-500">Hoodies</a>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('asset/images/shop/beanie.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="">
                    <div class="absolute bottom-4 start-4">
                        <a href="" class="text-xl font-semibold hover:text-indigo-600 duration-500">Beanies
                            for Man & Women</a>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('asset/images/shop/glasses.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="">
                    <div class="absolute bottom-4 start-4">
                        <a href="" class="text-xl font-semibold hover:text-indigo-600 duration-500">Glasses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container relative mt-16">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center">
            <div class="lg:col-span-8 md:col-span-6 md:text-start text-center">
                <h3 class="text-2xl leading-normal font-semibold">Most Viewed Products</h3>
            </div>

            <div class="lg:col-span-4 md:col-span-6 md:text-end hidden md:block">
                <a href="shop-grid-two.html"
                    class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:duration-500 text-slate-400 hover:text-indigo-600 after:bg-indigo-600 duration-500 ease-in-out">View
                    More Items <i class="uil uil-arrow-right align-middle"></i></a>
            </div>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s1.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-orange-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">New</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Branded
                        T-Shirt</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s2.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-green-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Featured</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Shopping
                        Bag</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s3.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Elegent
                        Watch</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s4.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Casual
                        Shoes</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s5.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-orange-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">New</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Earphones</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s6.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Elegent
                        Mug</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s7.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Sony
                        Headphones</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s8.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Sale</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Wooden
                        Stools</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->
        </div><!--end grid-->

        <div class="grid md:grid-cols-12 grid-cols-1 md:hidden mt-8">
            <div class="md:col-span-12 text-center">
                <a href="shop-grid-two.html"
                    class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:duration-500 text-slate-400 hover:text-indigo-600 after:bg-indigo-600 duration-500 ease-in-out">View
                    More Items <i class="uil uil-arrow-right align-middle"></i></a>
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="container relative mt-16">
        <div class="grid grid-cols-1 items-center">
            <h3 class="text-2xl leading-normal font-semibold">Top Categories</h3>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 mt-8 gap-[30px]">
            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('asset/images/shop/categories/electronics.jpg') }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">Electronics</a>
            </div><!--end content-->

            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('asset/images/shop/categories/fashion.jpg') }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">Fashion</a>
            </div><!--end content-->

            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('asset/images/shop/categories/furniture.jpg') }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">Furniture</a>
            </div><!--end content-->

            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('asset/images/shop/categories/mobile.jpg') }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">Mobile</a>
            </div><!--end content-->

            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('asset/images/shop/categories/music.jpg') }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">Music</a>
            </div><!--end content-->

            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('asset/images/shop/categories/sports.jpg') }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">Sports</a>
            </div><!--end content-->
        </div><!--end grid-->
    </div><!--end container-->

    <div class="container relative mt-16">
        <div class="grid grid-cols-1 items-center">
            <h3 class="text-2xl leading-normal font-semibold">Popular Products</h3>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s9.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-cyan-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Popular</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Branded
                        T-Shirt</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s10.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-cyan-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Popular</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Shopping
                        Bag</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s11.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-cyan-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Popular</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">Sports
                        Shoes</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->

            <div class="group">
                <div
                    class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                    <img src="{{ asset('asset/images/shop/items/s12.jpg') }}" alt="">

                    <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                        <a href="shop-cart.html"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Add
                            to Cart</a>
                    </div>

                    <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                        <li><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-heart"></i></a></li>
                        <li class="mt-1"><a href="shop-item-detail.html"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-eye-outline"></i></a></li>
                        <li class="mt-1"><a href="javascript:void(0)"
                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                    class="mdi mdi-bookmark-outline"></i></a></li>
                    </ul>

                    <ul class="list-none absolute top-[10px] start-4">
                        <li><a href="javascript:void(0)"
                                class="bg-cyan-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Popular</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <a href="shop-item-detail.html" class="hover:text-indigo-600 text-lg font-semibold">T-shirt</a>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-green-600">$16.00 <del class="text-red-600">$21.00</del></p>
                        <ul class="font-medium text-amber-400 list-none">
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                            <li class="inline"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--end content-->
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
