<!-- Start -->
<section class="py-28 w-full table relative bg-center bg-no-repeat bg-cover jarallax"
    style="background-image: url('{{ asset('asset/images/shop/blitar.jpg') }}');" data-jarallax data-speed="0.5">
    <div class="absolute inset-0 bg-slate-900/30"></div>
    <div class="container relative">
        <div class="grid grid-cols-1 text-center">
            <h3 class="mb-4 md:text-4xl text-3xl text-white font-bold">Satu Klik Lagi<br> untuk Dampak Besar!</h3>

            <p class="text-white/80 max-w-xl mx-auto">
                Checkout ini lebih dari sekadar belanja—ini adalah langkah untuk menghidupkan UMKM Blitar. Terima kasih
                telah mendukung ekonomi lokal, mari kita bawa Blitar ke masa depan yang lebih cerah!
            </p>

            <div class="mt-6">
                <a href="{{ route('customer.cart.index') }}"
                    class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md me-2 mt-2">
                    <i class="mdi mdi-cart-outline"></i> Keranjang Saya
                </a>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
