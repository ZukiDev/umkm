<!-- Start -->
<section class="relative py-16">
    {{-- <div class="container relative">
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
    </div> --}}

    @include('customer.partials.category-product')

    @include('customer.partials.new-product')

    @include('customer.partials.popular-umkm')

    @include('customer.partials.popular-product')

</section><!--end section-->
<!-- End -->
