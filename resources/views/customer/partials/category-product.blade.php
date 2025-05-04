<div class="container relative">
    <div class="grid items-center grid-cols-1">
        <h3 class="text-2xl font-semibold leading-normal">Kategori</h3>
    </div><!--end grid-->

    <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 mt-8 gap-[30px]">
        @foreach ($allCategory as $category)
            <div
                class="relative p-6 overflow-hidden text-center duration-500 rounded-md group hover:shadow-lg hover:dark:shadow-gray-800">
                <img src="{{ asset('storage/' . $category->icon) }}"
                    class="block mx-auto mb-2 rounded-full shadow-md dark:shadow-gray-800 size-20"
                    alt="{{ $category->title }}">

                <a href="{{ route('customer.product.index', ['category' => $category->id]) }}"
                    class="text-lg font-semibold hover:text-indigo-600">{{ $category->title }}</a>
            </div><!--end content-->
        @endforeach
    </div><!--end grid-->
</div><!--end container-->
