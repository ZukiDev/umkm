<div class="container relative mt-16">
    <div class="grid grid-cols-1 items-center">
        <h3 class="text-2xl leading-normal font-semibold">Kategori</h3>
    </div><!--end grid-->

    <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 mt-8 gap-[30px]">
        @foreach ($allCategory as $category)
            <div
                class="group relative overflow-hidden hover:shadow-lg hover:dark:shadow-gray-800 rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('storage/' . $category->icon) }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2"
                    alt="{{ $category->title }}">

                <a href="" class="font-semibold hover:text-indigo-600 text-lg">{{ $category->title }}</a>
            </div><!--end content-->
        @endforeach
    </div><!--end grid-->
</div><!--end container-->
