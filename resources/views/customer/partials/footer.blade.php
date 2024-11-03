<!-- Footer Start -->
<footer class="footer bg-dark-footer relative text-gray-200 dark:text-gray-200">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[60px] px-0">
                    <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                        <div class="lg:col-span-10 md:col-span-12">
                            <a href="#" class="text-[22px] focus:outline-none">
                                <img src="{{ asset('asset/images/logo-light.png') }}" alt="">
                            </a>
                            <p class="mt-6 text-gray-300">Temukan produk berkualitas dari para pengusaha lokal Blitar.
                                Dengan setiap pembelian, Anda turut berkontribusi pada kemajuan UMKM Blitar, menciptakan
                                peluang, dan memperkuat ekonomi lokal.</p>
                        </div><!--end col-->

                        {{-- @php
                            $categories = DB::table('categories')->get();
                        @endphp

                        <div class="lg:col-span-4 md:col-span-12">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">Kategori</h5>

                            <div class="grid md:grid-cols-12 grid-cols-1">
                                @foreach ($categories->chunk(6) as $chunk)
                                    <div class="md:col-span-4">
                                        <ul class="list-none footer-list mt-6">
                                            @foreach ($chunk as $category)
                                                <li
                                                    class="mt-[10px] text-gray-300 hover:text-gray-400 duration-500 ease-in-out">
                                                    <i class="uil uil-angle-right-b"></i> {{ $category->title }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div><!--end col-->
                                @endforeach
                            </div>
                        </div> --}}

                        <div class="lg:col-span-2 md:col-span-4">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">Kontak Kami</h5>
                            <ul class="list-none mt-6">
                                <li class="inline"><a href="#" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-facebook-f align-middle" title="facebook"></i></a>
                                </li>
                                <li class="inline"><a href="#/" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-instagram align-middle" title="instagram"></i></a>
                                </li>
                                <li class="inline"><a href="#" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                            </ul><!--end icon-->
                            </form>
                        </div><!--end col-->
                    </div><!--end grid-->
                </div><!--end col-->
            </div>
        </div><!--end grid-->

        <div class="grid grid-cols-1">
            <div class="py-[30px] px-0 border-t border-slate-800">
                <div class="grid lg:grid-cols-4 md:grid-cols-2">
                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-truck align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Gratis Ongkir</h6>
                    </div><!--end content-->

                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-archive align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Produk Lokal</h6>
                    </div><!--end content-->

                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-transaction align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Jaminan Uang Kembali</h6>
                    </div><!--end content-->

                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-shield-check align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Pembayaran Mudah</h6>
                    </div><!--end content-->
                </div><!--end grid-->
            </div><!--end-->
        </div><!--end grid-->
    </div><!--end container-->

    <div class="py-[30px] px-0 border-t border-slate-800">
        <div class="container relative text-center">
            <div class="grid md:grid-cols-2 items-center">
                <div class="md:text-start text-center">
                    <p class="mb-0">©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> UMKM Blitar. Developed
                        by <a href="#" target="_blank" class="text-reset">NovaDev</a>.
                    </p>
                </div>

                {{-- <ul class="list-none md:text-end text-center mt-6 md:mt-0">
                    <li class="inline"><a href=""><img
                                src="{{ asset('asset/images/payments/american-ex.png') }}" class="max-h-6 inline"
                                title="American Express" alt=""></a></li>
                    <li class="inline"><a href=""><img src="{{ asset('asset/images/payments/discover.png') }}"
                                class="max-h-6 inline" title="Discover" alt=""></a></li>
                    <li class="inline"><a href=""><img
                                src="{{ asset('asset/images/payments/master-card.png') }}" class="max-h-6 inline"
                                title="Master Card" alt=""></a></li>
                    <li class="inline"><a href=""><img src="{{ asset('asset/images/payments/paypal.png') }}"
                                class="max-h-6 inline" title="Paypal" alt=""></a></li>
                    <li class="inline"><a href=""><img src="{{ asset('asset/images/payments/visa.png') }}"
                                class="max-h-6 inline" title="Visa" alt=""></a></li>
                </ul> --}}
            </div><!--end grid-->
        </div><!--end container-->
    </div>
</footer><!--end footer-->
<!-- Footer End -->
