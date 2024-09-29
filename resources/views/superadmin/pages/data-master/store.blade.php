@extends('layouts.dashboard')

@section('content')
    <div class="layout-specing mx-6 sm:mx-6 md:mx-8 lg:mx-12">
        <div class="grid md:grid-cols-12 mt-2 gap-6 relative">
            <!-- Start Content -->
            <div class="md:col-span-12">
                <div class="md:flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Data UMKM</h5>
                    <ul class="tracking-[0.5px] inline-block sm:mt-0 mt-3">
                        <li
                            class="inline-block capitalize text-[14px] font-bold duration-500 dark:text-white/70 hover:text-indigo-600 dark:hover:text-white">
                            <a href="index.html">Data Master</a>
                        </li>
                        <li
                            class="inline-block text-base text-slate-950 dark:text-white/70 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                            <i class="uil uil-angle-right-b"></i>
                        </li>
                        <li class="inline-block capitalize text-[14px] font-bold text-indigo-600 dark:text-white"
                            aria-current="page">Data UMKM
                        </li>
                    </ul>
                </div>

                <div class="mt-6" id="tables">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="shadow dark:shadow-slate-800 rounded bg-white dark:bg-slate-900">
                            <div class="p-5">
                                <div class="md:flex justify-between items-center">
                                    <!-- Search Box -->
                                    <div class="flex-grow">
                                        <input type="text" placeholder="Cari UMKM..."
                                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                    </div>
                                    <!-- Add UMKM Button -->
                                    <button
                                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition ml-4"
                                        onclick="addModal.showModal()">
                                        <i class="uil uil-plus mr-1"></i> Tambah UMKM Baru
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
                                                <th class="px-4 py-5 text-start">Logo</th>
                                                <th class="px-4 py-5 text-start">Nama UMKM</th>
                                                <th class="px-4 py-5 text-start">Nama Pemilik</th>
                                                <th class="px-4 py-5 text-start">No.Telp</th>
                                                <th class="px-4 py-5 text-start">Alamat</th>
                                                <th class="px-4 py-5 text-start">Kategori</th>
                                                <th class="px-4 py-5 text-start">Status</th>
                                                <th class="px-4 py-5 text-end">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($stores as $index => $umkm)
                                                <tr class="border-t border-gray-100 dark:border-gray-700">
                                                    <td class="p-4">{{ $index + 1 }}</td>
                                                    <td class="p-4">
                                                        <img src="{{ $umkm->logo }}" alt="Logo"
                                                            class="w-10 h-10 rounded-full">
                                                    </td>
                                                    <td class="p-4">{{ $umkm->store_name }}</td>
                                                    <td class="p-4">{{ $umkm->owner_name }}</td>
                                                    <td class="p-4">{{ $umkm->user->phone_number }}</td>
                                                    <td class="p-4">{{ $umkm->address->address }}</td>
                                                    <td class="p-4">{{ $umkm->business_type }}</td>
                                                    <td class="p-4">
                                                        <span
                                                            class="bg-emerald-600 text-white text-[12px] font-semibold px-2.5 py-0.5 rounded h-5">{{ $umkm->status }}</span>
                                                    </td>
                                                    <td class="p-4 text-end">
                                                        <!-- View Button -->
                                                        <button class="text-blue-600 hover:text-blue-800 mr-2"
                                                            onclick="viewModal{{ $umkm->id }}.showModal()">
                                                            <i class="uil uil-eye"></i>
                                                        </button>

                                                        <!-- Edit Button -->
                                                        <button class="text-yellow-600 hover:text-yellow-800 mr-2"
                                                            onclick="editModal{{ $umkm->id }}.showModal()">
                                                            <i class="uil uil-edit"></i>
                                                        </button>

                                                        <!-- Remove Button -->
                                                        <button class="text-red-600 hover:text-red-800"
                                                            onclick="deleteModal{{ $umkm->id }}.showModal()">
                                                            <i class="uil uil-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Start View Modal -->
                                                <dialog id="viewModal{{ $umkm->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Data {{ $umkm->store_name }}</h3>
                                                            <!-- Close Button (X) -->
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6 text-justify">
                                                            <p>Nama: {{ $umkm->store_name }}</p>
                                                            <p>Pemilik: {{ $umkm->owner_name }}</p>
                                                            <p>No.Telp: {{ $umkm->user->phone_number }}</p>
                                                            <p>Alamat: {{ $umkm->address->address }}</p>
                                                            <p>Kategori: {{ $umkm->business_type }}</p>
                                                            <p>Status: {{ $umkm->status }}</p>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Modal -->


                                                <!-- Start Edit Modal -->
                                                <dialog id="editModal{{ $umkm->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Ubah Data UMKM</h3>
                                                            <!-- Close Button (X) -->
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6">
                                                            <form
                                                                action="{{ route('superadmin.data-master.store.update', $umkm->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="text" name="store_name"
                                                                    value="{{ $umkm->store_name }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Nama UMKM" required>
                                                                <input type="text" name="owner_name"
                                                                    value="{{ $umkm->owner_name }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Nama Pemilik" required>
                                                                <input type="number" name="phone_number"
                                                                    value="{{ $umkm->user->phone_number }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="No.Telp" required>
                                                                <input type="text" name="address"
                                                                    value="{{ $umkm->address->address }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Alamat" required>
                                                                <input type="text" name="business_type"
                                                                    value="{{ $umkm->business_type }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Kategori" required>
                                                                <button type="submit"
                                                                    class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan
                                                                    Perubahan Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->


                                                <!-- Start Delete Modal -->
                                                <dialog id="deleteModal{{ $umkm->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg text-red-600">Konfirmasi Hapus
                                                                Data
                                                            </h3>
                                                            <!-- Close Button (X) -->
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6 text-center">
                                                            <p>Apakah anda yakin menghapus data {{ $umkm->store_name }}?
                                                            </p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.store.destroy', $umkm->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="bg-red-600 mt-6 text-white px-4 py-2 rounded">Ya,
                                                                    Hapus</button>
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
                        </div><!--end content-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Add Modal -->
        <dialog id="addModal"
            class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
            <div class="relative h-auto md:w-[480px] w-300px">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-lg">Tambah Store Baru</h3>
                    <form method="dialog">
                        <button
                            class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                            <i data-feather="x" class="size-4 text-white"></i>
                        </button>
                    </form>
                </div>

                <div class="p-6">
                    <form action="{{ route('superadmin.data-master.store.store') }}" method="POST">
                        @csrf
                        <input type="text" name="store_name" class="border px-3 py-2 rounded w-full mb-4"
                            placeholder="Nama UMKM" required>
                        <input type="text" name="owner_name" class="border px-3 py-2 rounded w-full mb-4"
                            placeholder="Nama Pemilik" required>
                        <input type="number" name="phone_number" class="border px-3 py-2 rounded w-full mb-4"
                            placeholder="No.Telp" required>
                        <input type="text" name="address" class="border px-3 py-2 rounded w-full mb-4"
                            placeholder="Alamat" required>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah UMKM</button>
                    </form>
                </div>
            </div>
        </dialog>
        <!-- End Add Modal -->
    </div>
@endsection
