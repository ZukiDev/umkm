@extends('layouts.dashboard')

@section('content')
    <div class="layout-specing mx-6 sm:mx-6 md:mx-8 lg:mx-12">
        <div class="grid md:grid-cols-12 mt-2 gap-6 relative">
            <!-- Start Content -->
            <div class="md:col-span-12">
                <div class="md:flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Data Kategori</h5>
                    <ul class="tracking-[0.5px] inline-block sm:mt-0 mt-3">
                        <li
                            class="inline-block capitalize text-[14px] font-bold duration-500 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white">
                            <a href="#">Data Master</a>
                        </li>
                        <li
                            class="inline-block text-base text-slate-950 dark:text-white/70 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                            <i class="uil uil-angle-right-b"></i>
                        </li>
                        <li class="inline-block capitalize text-[14px] font-bold text-indigo-600 dark:text-white"
                            aria-current="page">Data Kategori</li>
                    </ul>
                </div>
                <div class="mt-6" id="tables">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="shadow dark:shadow-slate-800 rounded bg-white dark:bg-slate-900">
                            <div class="p-5">
                                <div class="md:flex justify-between items-center">
                                    <!-- Search Box -->
                                    <div class="flex-grow">
                                        <!--<input type="text" placeholder="Cari Kategori..."-->
                                        <!--    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">-->
                                    </div>
                                    <!-- Add Kategori Button -->
                                    <button
                                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition ml-4"
                                        onclick="addModal.showModal()">
                                        <i class="uil uil-plus mr-1"></i> Tambah Kategori Baru
                                    </button>
                                </div>
                            </div>
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
                            <div class="p-5 border-t border-gray-100 dark:border-slate-800">
                                <div
                                    class="relative overflow-x-auto block w-full bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                                    <table class="w-full text-start">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-5 text-start">No.</th>
                                                <th class="px-4 py-5 text-start">Ikon</th>
                                                <th class="px-4 py-5 text-start">Nama Kategori</th>
                                                <th class="px-4 py-5 text-start">Slug</th>
                                                <th class="px-4 py-5 text-end">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($categories as $index => $category)
                                                <tr class="border-t border-gray-100 dark:border-gray-700">
                                                    <td class="p-4">{{ $index + 1 }}</td>
                                                    <td class="p-4">
                                                        <img src="{{ asset('storage/' . $category->icon) }}"
                                                            alt="Icon {{ $category->title }}" class="h-8 w-8">
                                                    </td>
                                                    <td class="p-4">{{ $category->title }}</td>
                                                    <td class="p-4">{{ $category->slug }}</td>
                                                    <td class="p-4 text-end">
                                                        <!-- View Button -->
                                                        <button class="text-blue-600 hover:text-blue-800 mr-2"
                                                            onclick="viewModal{{ $category->id }}.showModal()">
                                                            <i class="uil uil-eye"></i>
                                                        </button>

                                                        <!-- Edit Button -->
                                                        <button class="text-yellow-600 hover:text-yellow-800 mr-2"
                                                            onclick="editModal{{ $category->id }}.showModal()">
                                                            <i class="uil uil-edit"></i>
                                                        </button>

                                                        <!-- Remove Button -->
                                                        <button class="text-red-600 hover:text-red-800"
                                                            onclick="deleteModal{{ $category->id }}.showModal()">
                                                            <i class="uil uil-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Start View Modal -->
                                                <dialog id="viewModal{{ $category->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Data {{ $category->title }}</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6">
                                                            <!-- Grid for 2 columns -->
                                                            <div class="grid grid-cols-1 gap-6">
                                                                <!-- Category Data Section -->
                                                                <div>
                                                                    <h4 class="font-semibold mb-3">Data Kategori</h4>
                                                                    <p class="mb-4"><strong>Nama Kategori:</strong>
                                                                        {{ $category->title }}</p>
                                                                    <p class="mb-4"><strong>Slug Kategori:</strong>
                                                                        {{ $category->slug }}</p>
                                                                    <p class="mb-4"><strong>Ikon Kategori:</strong></p>
                                                                    <img src="{{ asset('storage/' . $category->icon) }}"
                                                                        alt="Icon {{ $category->title }}"
                                                                        class="h-16 w-16">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End View Modal -->

                                                <!-- Start Edit Modal -->
                                                <dialog id="editModal{{ $category->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Ubah Data Kategori</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="p-6">
                                                            <form
                                                                action="{{ route('superadmin.data-master.category.update', $category->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Grid for 2 columns -->
                                                                <div class="grid grid-cols-1 gap-6">
                                                                    <!-- Category Data Section -->
                                                                    <div>
                                                                        <h4 class="font-semibold mb-3">Data Kategori</h4>

                                                                        <!-- Nama Kategori -->
                                                                        <input type="text" name="title"
                                                                            value="{{ $category->title }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Nama Kategori" required>

                                                                        <!-- Slug Kategori -->
                                                                        <input type="text" name="slug"
                                                                            value="{{ $category->slug }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Slug Kategori" required>

                                                                        <!-- Ikon Kategori (Upload Gambar) -->
                                                                        <label class="block mb-2">Ikon Kategori</label>
                                                                        <img src="{{ asset('storage/' . $category->icon) }}"
                                                                            alt="Icon {{ $category->title }}"
                                                                            class="h-16 w-16 mb-4">
                                                                        <input type="file" name="icon"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            accept="image/*">

                                                                    </div>
                                                                </div>
                                                                <button type="submit"
                                                                    class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan
                                                                    Perubahan Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->


                                                <!-- Start Delete Modal -->
                                                <dialog id="deleteModal{{ $category->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg text-red-600">Konfirmasi Hapus
                                                                Data</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="p-6 text-center">
                                                            <p>Apakah anda yakin ingin menghapus kategori
                                                                <strong>{{ $category->title }}</strong>?
                                                            </p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.category.destroy', $category->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="bg-red-600 mt-6 text-white px-4 py-2 rounded">Ya,
                                                                    Hapus</button>
                                                                <button type="button"
                                                                    class="bg-gray-300 mt-6 text-black px-4 py-2 rounded"
                                                                    onclick="deleteModal{{ $category->id }}.close()">Tidak,
                                                                    Batalkan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Delete Modal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Add Category Modal -->
        <dialog id="addModal"
            class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
            <div class="relative h-auto md:w-[480px] w-300px">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-lg">Tambah Kategori Baru</h3>
                    <form method="dialog">
                        <button
                            class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                            <i data-feather="x" class="size-4 text-white"></i>
                        </button>
                    </form>
                </div>

                <div class="p-6">
                    <form action="{{ route('superadmin.data-master.category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <!-- Grid for 1 column layout -->
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Category Data Section -->
                            <div>
                                <!-- Upload Icon -->
                                <label for="icon" class="block text-sm font-medium mb-2">Ikon Kategori</label>
                                <input type="file" name="icon" id="icon" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer mb-4"
                                    required>
                                <input type="text" name="slug" class="border px-3 py-2 rounded w-full mb-4"
                                    placeholder="Slug" required>
                                <input type="text" name="title" class="border px-3 py-2 rounded w-full mb-4"
                                    placeholder="Nama Kategori" required>
                            </div>
                        </div>

                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah Kategori</button>
                    </form>
                </div>
            </div>
        </dialog>
        <!-- End Add Category Modal -->

    </div>
@endsection
