@extends('layouts.dashboard')

@section('content')
    <div class="relative px-3 container-fluid">
        <div class="layout-specing">
            <!-- Start Content -->
            <div class="items-center justify-between md:flex">
                <div>
                    <h5 class="text-lg font-semibold">Semua Produk</h5>

                    <ul class="tracking-[0.5px] inline-block mt-2">
                        <li
                            class="inline-block capitalize text-[14px] font-bold duration-500 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white">
                            <a href="#">Produk</a>
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
                        onclick="addshopitem.showModal()" title="Add New"><i data-feather="plus" class="w-4 h-4"></i></a>
                </div>
            </div>

            <div class="mt-6">
                <!-- Success Message -->
                @if (session('success'))
                    <div
                        class="relative block px-4 py-2 font-medium border rounded-md bg-emerald-600/10 border-emerald-600/10 text-emerald-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div
                        class="relative block px-4 py-2 font-medium text-red-600 border rounded-md bg-red-600/10 border-red-600/10">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                @foreach ($products as $product)
                    <div class="flex flex-col w-full group min-h-3 max-h-3">
                        <!-- Image Container (80%) -->
                        <div
                            class="relative w-full h-full overflow-hidden duration-500 rounded-md shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800">
                            <img src="{{ asset('storage/products/' . $product->images) }}" alt="{{ $product->name }}"
                                class="object-cover w-full h-full" style="min-height: 300px; max-height: 300px;">

                            <div class="absolute duration-500 -bottom-20 group-hover:bottom-3 start-3 end-3">
                                <a href="javascript:void(0)" onclick="viewshopitem{{ $product->id }}.showModal()"
                                    class="inline-block w-full px-5 py-2 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 border rounded-md bg-slate-900 border-slate-900">Lihat
                                    Detail</a>
                            </div>

                            <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                                <li>
                                    <a href="javascript:void(0)" onclick="deleteshopitem{{ $product->id }}.showModal()"
                                        class="inline-flex items-center justify-center w-8 h-8 text-base tracking-wide text-center text-white align-middle duration-500 bg-red-600 border-red-600 rounded-full hover:bg-red-700 hover:border-red-700"><i
                                            class="mdi mdi-delete"></i></a>
                                </li>
                                <li class="mt-1">
                                    <a href="javascript:void(0)" onclick="editshopitem{{ $product->id }}.showModal()"
                                        class="inline-flex items-center justify-center w-8 h-8 text-base tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border-indigo-600 rounded-full hover:bg-indigo-700 hover:border-indigo-700"><i
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
                                            class="bg-red-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">Tidak
                                            Aktif</a>
                                    @endif
                                </li>
                            </ul>
                        </div>

                        <!-- Product Details (20%) -->
                        <div class="mt-4 h-[20%] flex flex-col justify-between">
                            <a href="javascript:void(0)" onclick="viewshopitem{{ $product->id }}.showModal()"
                                class="text-lg font-semibold hover:text-indigo-600">{{ $product->name ?? 'Nama Produk' }}</a>
                            <div class="flex items-center justify-between mt-1 font-semibold">
                                <p class="text-green-600">Rp. {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                <p class="text-red-600">Qty : {{ $product->stock ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Start Delete Modal -->
                    <dialog id="deleteshopitem{{ $product->id }}"
                        class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                        <div class="relative h-auto md:w-[480px] w-300px">
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-red-600">Konfirmasi Hapus
                                    Data
                                </h3>
                                <form method="dialog">
                                    <button
                                        class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                        <i data-feather="x" class="text-white size-4"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="p-6 text-center">
                                <p>Apakah anda yakin menghapus data {{ $product->name }}?</p>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 mt-6 text-white bg-red-600 rounded">Ya,
                                        Hapus</button>
                                    <button type="button" class="px-4 py-2 mt-6 text-black bg-gray-300 rounded"
                                        onclick="deleteshopitem{{ $product->id }}.close()">Tidak,
                                        Batalkan</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <!-- End Delete Modal -->

                    <!-- Start Edit Product Modal -->
                    <dialog id="editshopitem{{ $product->id }}"
                        class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                        <div class="relative h-auto md:w-[680px] w-[300px]">
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-lg font-bold">Edit Produk</h3>
                                <form method="dialog">
                                    <button
                                        class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                        <i data-feather="x" class="text-white size-4"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="p-6">
                                <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Grid for 3 sections -->
                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                                        <!-- Image Upload Section -->
                                        <div class="flex flex-col">
                                            <h4 class="mb-4 font-semibold">Foto Produk <span class="text-red-600">*</span>
                                            </h4>
                                            <div id="preview-box-edit-{{ $product->id }}"
                                                class="flex justify-center p-2 mb-4 overflow-hidden text-center rounded-md shadow preview-box-edit dark:shadow-gray-800 bg-gray-50 dark:bg-slate-800 text-slate-400 small max-h-60">
                                                <img src="{{ asset('storage/products/' . $product->images) }}"
                                                    alt="{{ $product->name }}" class="object-contain max-h-60">
                                            </div>
                                            <input type="file" id="edit-images-{{ $product->id }}" name="images"
                                                accept="image/*" onchange="handleChange('edit', {{ $product->id }})"
                                                hidden>
                                            <label
                                                class="inline-block px-5 py-2 mt-6 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border border-indigo-600 rounded-md cursor-pointer btn-upload hover:bg-indigo-700 hover:border-indigo-700"
                                                for="edit-images-{{ $product->id }}">Ganti Foto</label>
                                            {{--  Memilih hanya pengiriman kota blitar --}}
                                            <div class="flex flex-col mt-4">
                                                <h4 class="mb-4 font-semibold">Wilayah Pengiriman</h4>
                                                <select name="is_blitar_only" class="w-full px-3 py-2 mb-4 border rounded"
                                                    required>
                                                    <option value="1"
                                                        {{ $product->is_blitar_only ? 'selected' : '' }}>Kota Blitar
                                                    </option>
                                                    <option value="0"
                                                        {{ !$product->is_blitar_only ? 'selected' : '' }}>Semua kota
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Product Details Section -->
                                        <div class="flex flex-col">
                                            <h4 class="mb-4 font-semibold">Detail Produk</h4>
                                            <input name="name" type="text"
                                                class="w-full px-3 py-2 mb-4 border rounded" placeholder="Nama Produk"
                                                value="{{ old('name', $product->name) }}" required>
                                            <input name="description" type="text"
                                                class="w-full px-3 py-2 mb-4 border rounded"
                                                placeholder="Deskripsi Produk"
                                                value="{{ old('description', $product->description) }}" required>
                                            <input name="sku" type="text"
                                                class="w-full px-3 py-2 mb-4 border rounded"
                                                placeholder="Kode Produk (SKU)" value="{{ old('sku', $product->sku) }}"
                                                required>
                                            <input name="price" type="number"
                                                class="w-full px-3 py-2 mb-4 border rounded" placeholder="Harga Produk"
                                                value="{{ old('price', $product->price) }}" required>
                                            <input name="stock" type="number"
                                                class="w-full px-3 py-2 mb-4 border rounded" placeholder="Stok Produk"
                                                value="{{ old('stock', $product->stock) }}" required>
                                        </div>

                                        <!-- Additional Information Section -->
                                        <div class="flex flex-col">
                                            <h4 class="mb-4 font-semibold">Detail Tambahan</h4>
                                            <input name="weight" type="number"
                                                class="w-full px-3 py-2 mb-4 border rounded" placeholder="Berat (Gram)"
                                                value="{{ old('weight', $product->weight) }}">
                                            <input name="dimensions" type="text"
                                                class="w-full px-3 py-2 mb-4 border rounded"
                                                placeholder="Dimensi Produk (Cm)"
                                                value="{{ old('dimensions', $product->dimensions) }}">
                                            <input name="brand" type="text"
                                                class="w-full px-3 py-2 mb-4 border rounded" placeholder="Merek Produk"
                                                value="{{ old('brand', $product->brand) }}">
                                            <select name="status" required class="w-full px-3 py-2 mb-4 border rounded">
                                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tidak
                                                    Aktif</option>
                                            </select>
                                            <select name="category_id" required
                                                class="w-full px-3 py-2 mb-4 border rounded">
                                                <option value="{{ $product->category_id }}" selected>
                                                    {{ $product->category->title }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="w-full px-4 py-2 mt-4 text-white bg-indigo-600 rounded">Perbarui
                                        Produk</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <!-- End Edit Product Modal -->

                    <!-- Start View Product Modal -->
                    <dialog id="viewshopitem{{ $product->id }}"
                        class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                        <div class="relative h-auto md:w-[680px] w-[300px]">
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-lg font-bold">Detail Produk</h3>
                                <form method="dialog">
                                    <button
                                        class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                        <i data-feather="x" class="text-white size-4"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="p-6">
                                <!-- Grid for 3 sections -->
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                                    <!-- Image Section -->
                                    <div class="flex flex-col">
                                        <h4 class="mb-4 font-semibold">Foto Produk</h4>
                                        <div
                                            class="flex justify-center p-2 mb-4 overflow-hidden text-center rounded-md shadow dark:shadow-gray-800 bg-gray-50 dark:bg-slate-800 text-slate-400 small max-h-60">
                                            <img src="{{ asset('storage/products/' . $product->images) }}"
                                                alt="{{ $product->name }}" class="object-contain max-h-60">
                                        </div>
                                    </div>

                                    <!-- Product Details Section -->
                                    <div class="flex flex-col">
                                        <h4 class="mb-4 font-semibold">Detail Produk</h4>
                                        <p class="mb-2"><strong>Nama:</strong> {{ $product->name }}</p>
                                        <p class="mb-2"><strong>Deskripsi:</strong> {{ $product->description }}</p>
                                        <p class="mb-2"><strong>SKU:</strong> {{ $product->sku }}</p>
                                        <p class="mb-2"><strong>Harga:</strong> Rp.
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="mb-2"><strong>Stok:</strong> {{ $product->stock }}</p>
                                        {{-- Detail Pengiriman --}}
                                        <h4 class="mt-4 mb-4 font-semibold">Detail Pengiriman</h4>
                                        <p class="mb-2"><strong>Area pengiriman:</strong>
                                            {{ $product->is_blitar_only ? 'Kota Blitar' : 'Semua kota' }}</p>
                                    </div>

                                    <!-- Additional Information Section -->
                                    <div class="flex flex-col">
                                        <h4 class="mb-4 font-semibold">Detail Tambahan</h4>
                                        <p class="mb-2"><strong>Berat(Gram):</strong> {{ $product->weight }} Gram</p>
                                        <p class="mb-2"><strong>Dimensi(Cm):</strong> {{ $product->dimensions }}</p>
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
        class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
        <div class="relative h-auto md:w-[680px] w-[300px]">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold">Tambah Produk Baru</h3>
                <form method="dialog">
                    <button
                        class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                        <i data-feather="x" class="text-white size-4"></i>
                    </button>
                </form>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Grid for 3 sections -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                        <!-- Image Upload Section -->
                        <div class="flex flex-col">
                            <h4 class="mb-4 font-semibold">Foto Produk <span class="text-red-600">*</span></h4>
                            <div
                                class="flex justify-center p-2 mb-4 overflow-hidden text-center rounded-md shadow preview-box-add dark:shadow-gray-800 bg-gray-50 dark:bg-slate-800 text-slate-400 small max-h-60">
                                Maksimal Ukuran: 2 MB.
                            </div>
                            <input type="file" id="add-images" name="images" accept="image/*"
                                onchange="handleChange('add')" hidden required>
                            <label
                                class="inline-block px-5 py-2 mt-6 text-base font-semibold tracking-wide text-center text-white align-middle duration-500 bg-indigo-600 border border-indigo-600 rounded-md cursor-pointer btn-upload hover:bg-indigo-700 hover:border-indigo-700"
                                for="add-images">Unggah Foto</label>
                            <!-- Memilih hanya pengiriman kota blitar -->
                            <div class="flex flex-col mt-4">
                                <h4 class="mb-4 font-semibold">Wilayah Pengiriman</h4>
                                <select name="is_blitar_only" class="w-full px-3 py-2 mb-4 border rounded" required>
                                    <option value="1">Kota Blitar</option>
                                    <option value="0">Semua kota</option>
                                </select>
                            </div>
                        </div>

                        <!-- Product Details Section -->
                        <div class="flex flex-col">
                            <h4 class="mb-4 font-semibold">Detail Produk</h4>
                            <input name="name" type="text" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Nama Produk" required>
                            <input name="description" type="text" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Deskripsi Produk" required>
                            <input name="sku" type="text" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Kode Produk (SKU)" required>
                            <input name="price" type="number" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Harga Produk" required>
                            <input name="stock" type="number" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Stok Produk" required>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="flex flex-col">
                            <h4 class="mb-4 font-semibold">Detail Tambahan</h4>
                            <input name="weight" type="number" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Berat (Gram)">
                            <input name="dimensions" type="text" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Dimensi Produk (Cm)">
                            <input name="brand" type="text" class="w-full px-3 py-2 mb-4 border rounded"
                                placeholder="Merek Produk">
                            <select name="status" required class="w-full px-3 py-2 mb-4 border rounded">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <!-- Memilih Kategori produk -->
                            <select name="category_id" class="w-full px-3 py-2 mb-4 border rounded select2" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="text-black">{{ $category->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-indigo-600 rounded">Tambah
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
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    alert('Ukuran foto melebihi 2 MB. Harap pilih ukuran yang lebih kecil.');
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
