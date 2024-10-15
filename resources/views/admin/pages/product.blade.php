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
                @foreach ($products as $product)
                    <div class="group">
                        <div
                            class="relative overflow-hidden shadow dark:shadow-gray-700 group-hover:shadow-lg group-hover:dark:shadow-gray-700 rounded-md duration-500">
                            <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}">
                            <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                                <a href="javascript:void(0)" onclick="viewshopitem{{ $product->id }}.showModal()"
                                    class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-slate-900 border-slate-900 text-white w-full rounded-md">Lihat
                                    Detail</a>
                            </div>

                            <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                                <li>
                                    <a href="javascript:void(0)" onclick="deleteshopitem{{ $product->id }}.showModal()"
                                        class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-red-600 hover:bg-red-700 border-red-600 hover:border-red-700 text-white"><i
                                            class="mdi mdi-delete"></i></a>
                                </li>
                                <li class="mt-1">
                                    <a href="javascript:void(0)" onclick="editshopitem{{ $product->id }}.showModal()"
                                        class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i
                                            class="mdi mdi-pencil"></i></a>
                                </li>
                            </ul>

                            <ul class="list-none absolute top-[10px] start-4">
                                <li>
                                    @if ($product->status == 1)
                                        <a href="javascript:void(0)"
                                            class="bg-green-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Aktif</a>
                                    @else
                                        <a href="javascript:void(0)"
                                            class="bg-red-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Nonaktif</a>
                                    @endif
                                </li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <a href="javascript:void(0)" onclick="viewshopitem{{ $product->id }}.showModal()"
                                class="hover:text-indigo-600 text-lg font-semibold">{{ $product->name ?? 'Nama Produk' }}</a>
                            <div class="flex justify-between items-center mt-1 font-semibold">
                                <p class="text-green-600">Rp. {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                <p class="text-red-600">Qty : {{ $product->stock ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Start Delete Modal -->
                    <dialog id="deleteshopitem{{ $product->id }}"
                        class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <div class="relative h-auto md:w-[480px] w-300px">
                            <div
                                class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="font-bold text-lg text-red-600">Konfirmasi Hapus
                                    Data
                                </h3>
                                <form method="dialog">
                                    <button
                                        class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                        <i data-feather="x" class="size-4 text-white"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="p-6 text-center">
                                <p>Apakah anda yakin menghapus data {{ $product->name }}?</p>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 mt-6 text-white px-4 py-2 rounded">Ya,
                                        Hapus</button>
                                    <button type="button" class="bg-gray-300 mt-6 text-black px-4 py-2 rounded"
                                        onclick="deleteitemshop{{ $product->id }}.close()">Tidak,
                                        Batalkan</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <!-- End Delete Modal -->

                    <!-- Start Edit Product Modal -->
                    <dialog id="editshopitem{{ $product->id }}"
                        class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <div class="relative h-auto md:w-[680px] w-[300px]">
                            <div
                                class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="font-bold text-lg">Edit Produk</h3>
                                <form method="dialog">
                                    <button
                                        class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                        <i data-feather="x" class="size-4 text-white"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="p-6">
                                <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Grid for 3 sections -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                        <!-- Image Upload Section -->
                                        <div class="flex flex-col">
                                            <h4 class="font-semibold mb-4">Foto Produk <span class="text-red-600">*</span>
                                            </h4>
                                            <div id="preview-box-edit-{{ $product->id }}"
                                                class="preview-box-edit flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small max-h-60 mb-4">
                                                <img src="{{ asset('storage/products/' . $product->images) }}"
                                                    alt="{{ $product->name }}" class="max-h-60 object-contain">
                                            </div>
                                            <input type="file" id="edit-images-{{ $product->id }}" name="images"
                                                accept="image/*" onchange="handleChange('edit', {{ $product->id }})"
                                                hidden>
                                            <label
                                                class="btn-upload py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md mt-6 cursor-pointer"
                                                for="edit-images-{{ $product->id }}">Ganti Foto</label>
                                        </div>

                                        <!-- Product Details Section -->
                                        <div class="flex flex-col">
                                            <h4 class="font-semibold mb-4">Detail Produk</h4>
                                            <input name="name" type="text"
                                                class="border px-3 py-2 rounded w-full mb-4" placeholder="Nama Produk"
                                                value="{{ old('name', $product->name) }}" required>
                                            <input name="description" type="text"
                                                class="border px-3 py-2 rounded w-full mb-4"
                                                placeholder="Deskripsi Produk"
                                                value="{{ old('description', $product->description) }}" required>
                                            <input name="sku" type="text"
                                                class="border px-3 py-2 rounded w-full mb-4"
                                                placeholder="Kode Produk (SKU)" value="{{ old('sku', $product->sku) }}"
                                                required>
                                            <input name="price" type="number"
                                                class="border px-3 py-2 rounded w-full mb-4" placeholder="Harga Produk"
                                                value="{{ old('price', $product->price) }}" required>
                                            <input name="stock" type="number"
                                                class="border px-3 py-2 rounded w-full mb-4" placeholder="Stok Produk"
                                                value="{{ old('stock', $product->stock) }}" required>
                                        </div>

                                        <!-- Additional Information Section -->
                                        <div class="flex flex-col">
                                            <h4 class="font-semibold mb-4">Detail Tambahan</h4>
                                            <input name="weight" type="number"
                                                class="border px-3 py-2 rounded w-full mb-4" placeholder="Berat (Kg)"
                                                value="{{ old('weight', $product->weight) }}">
                                            <input name="dimensions" type="text"
                                                class="border px-3 py-2 rounded w-full mb-4" placeholder="Dimensi Produk"
                                                value="{{ old('dimensions', $product->dimensions) }}">
                                            <input name="brand" type="text"
                                                class="border px-3 py-2 rounded w-full mb-4" placeholder="Merek Produk"
                                                value="{{ old('brand', $product->brand) }}">
                                            <select name="status" required class="border px-3 py-2 rounded w-full mb-4">
                                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tidak
                                                    Aktif</option>
                                            </select>
                                            <select name="category_id" required class="border px-3 py-2 rounded w-full mb-4">
                                                <option value="{{ $product->category_id }}" selected>{{ $product->category->title }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-2 w-full rounded mt-4">Perbarui
                                        Produk</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <!-- End Edit Product Modal -->

                    <!-- Start View Product Modal -->
                    <dialog id="viewshopitem{{ $product->id }}"
                        class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <div class="relative h-auto md:w-[680px] w-[300px]">
                            <div
                                class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="font-bold text-lg">Detail Produk</h3>
                                <form method="dialog">
                                    <button
                                        class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                        <i data-feather="x" class="size-4 text-white"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="p-6">
                                <!-- Grid for 3 sections -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                    <!-- Image Section -->
                                    <div class="flex flex-col">
                                        <h4 class="font-semibold mb-4">Foto Produk</h4>
                                        <div
                                            class="flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small max-h-60 mb-4">
                                            <img src="{{ asset('storage/products/' . $product->images) }}"
                                                alt="{{ $product->name }}" class="max-h-60 object-contain">
                                        </div>
                                    </div>

                                    <!-- Product Details Section -->
                                    <div class="flex flex-col">
                                        <h4 class="font-semibold mb-4">Detail Produk</h4>
                                        <p class="mb-2"><strong>Nama:</strong> {{ $product->name }}</p>
                                        <p class="mb-2"><strong>Deskripsi:</strong> {{ $product->description }}</p>
                                        <p class="mb-2"><strong>SKU:</strong> {{ $product->sku }}</p>
                                        <p class="mb-2"><strong>Harga:</strong> Rp.
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="mb-2"><strong>Stok:</strong> {{ $product->stock }}</p>
                                    </div>

                                    <!-- Additional Information Section -->
                                    <div class="flex flex-col">
                                        <h4 class="font-semibold mb-4">Detail Tambahan</h4>
                                        <p class="mb-2"><strong>Berat:</strong> {{ $product->weight }} Kg</p>
                                        <p class="mb-2"><strong>Dimensi:</strong> {{ $product->dimensions }}</p>
                                        <p class="mb-2"><strong>Merek:</strong> {{ $product->brand }}</p>
                                        <p class="mb-2"><strong>Status:</strong>
                                            {{ $product->status ? 'Aktif' : 'Tidak Aktif' }}</p>
                                        <p class="mb-2"><strong>Kategori:</strong> {{ $product->category->title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dialog>
                    <!-- End View Product Modal -->
                @endforeach
            </div><!--end grid-->
        </div>
    </div>

    <!-- Start Add Product Modal -->
    <dialog id="addshopitem"
        class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
        <div class="relative h-auto md:w-[680px] w-[300px]">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="font-bold text-lg">Tambah Produk Baru</h3>
                <form method="dialog">
                    <button
                        class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                        <i data-feather="x" class="size-4 text-white"></i>
                    </button>
                </form>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Grid for 3 sections -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Image Upload Section -->
                        <div class="flex flex-col">
                            <h4 class="font-semibold mb-4">Foto Produk <span class="text-red-600">*</span></h4>
                            <div
                                class="preview-box-add flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small max-h-60 mb-4">
                                Maksimal Ukuran: 10MB.
                            </div>
                            <input type="file" id="add-images" name="images" accept="image/*"
                                onchange="handleChange('add')" hidden>
                            <label
                                class="btn-upload py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md mt-6 cursor-pointer"
                                for="add-images">Unggah Foto</label>
                        </div>

                        <!-- Product Details Section -->
                        <div class="flex flex-col">
                            <h4 class="font-semibold mb-4">Detail Produk</h4>
                            <input name="name" type="text" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Nama Produk" required>
                            <input name="description" type="text" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Deskripsi Produk" required>
                            <input name="sku" type="text" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Kode Produk (SKU)" required>
                            <input name="price" type="number" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Harga Produk" required>
                            <input name="stock" type="number" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Stok Produk" required>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="flex flex-col">
                            <h4 class="font-semibold mb-4">Detail Tambahan</h4>
                            <input name="weight" type="number" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Berat (Kg)">
                            <input name="dimensions" type="text" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Dimensi Produk">
                            <input name="brand" type="text" class="border px-3 py-2 rounded w-full mb-4"
                                placeholder="Merek Produk">
                            <select name="status" required class="border px-3 py-2 rounded w-full mb-4">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <!-- Memilih Kategori produk -->
                            <select name="category_id" class="border px-3 py-2 rounded w-full mb-4 select2" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="text-black">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 w-full rounded mt-4">Tambah
                        Produk</button>
                </form>
            </div>
        </div>
    </dialog>
    <!-- End Add Product Modal -->

    <script>
        function handleChange(modalType, productId = null) {
            let input;
            let previewBox;

            // Determine which input and preview box to use based on the modal type
            if (modalType === 'add') {
                input = document.getElementById('add-images');
                previewBox = document.querySelector('.preview-box-add');
            } else if (modalType === 'edit') {
                input = document.getElementById(`edit-images-${productId}`);
                previewBox = document.querySelector(`#preview-box-edit-${productId}`);
            }

            // Clear previous previews
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Check file size (optional)
                const maxSize = 10 * 1024 * 1024; // 10MB
                if (file.size > maxSize) {
                    alert('Ukuran foto melebihi 10 MB. Harap pilih ukuran yang lebih kecil.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create an image element and set its source to the file's data URL
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview Image';
                    img.className = 'max-h-60 object-contain'; // Apply any additional styling here

                    // Append the image to the preview box
                    previewBox.innerHTML = ''; // Clear previous image before adding the new one
                    previewBox.appendChild(img);
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
