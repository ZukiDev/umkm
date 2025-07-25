<div class="container relative pt-16">
    <div class="grid grid-cols-1 items-center">
        <h3 class="text-2xl leading-normal font-semibold">UMKM Terpopuler</h3>
    </div><!--end grid-->

    <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 mt-8 gap-[30px]">
        @foreach ($bestUMKM as $umkm)
            <div class="group relative overflow-hidden rounded-md duration-500 p-6 text-center">
                <img src="{{ asset('storage/logos/' . $umkm->logo) }}" alt="{{ $umkm->store_name }}"
                    class="rounded-full shadow-md dark:shadow-gray-800 size-20 block mx-auto mb-2" alt="">

                <p class="font-semibold text-lg">{{ $umkm->store_name }}</p>
            </div><!--end content-->
        @endforeach
    </div><!--end grid-->
</div><!--end container-->
