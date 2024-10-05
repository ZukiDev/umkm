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
                                                        <img src="{{ Storage::url($umkm->logo) }}" alt="Logo"
                                                            class="w-10 h-10 rounded-full">
                                                    </td>
                                                    <td class="p-4">{{ $umkm->store_name }}</td>
                                                    <td class="p-4">{{ $umkm->owner_name }}</td>
                                                    <td class="p-4">{{ $umkm->user->phone_number }}</td>
                                                    <td class="p-4">{{ $umkm->address->address }}</td>
                                                    <td class="p-4">{{ $umkm->business_type }}</td>
                                                    <td class="p-4">
                                                        <span
                                                            class="text-white text-[12px] font-semibold px-2.5 py-0.5 rounded h-5 {{ $umkm->status == 1 ? 'bg-emerald-600' : 'bg-red-600' }}">
                                                            {{ $umkm->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                                        </span>
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

                                                <!-- Start Edit Modal -->
                                                <dialog id="editModal{{ $umkm->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[960px] w-full">
                                                        <!-- Adjusted width for larger modal -->
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
                                                                action="{{ route('superadmin.data-master.umkm.update', $umkm->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                                    <!-- Grid for 3 columns -->
                                                                    <!-- User Data Section -->
                                                                    <div>
                                                                        <h4 class="font-semibold mb-3">Data Akun</h4>
                                                                        <input type="text" name="name"
                                                                            value="{{ $umkm->user->name }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Nama Akun" required>
                                                                        <input type="text" name="username"
                                                                            value="{{ $umkm->user->username }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Username" required>
                                                                        <input type="email" name="email"
                                                                            value="{{ $umkm->user->email }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Email" required>
                                                                        <input type="number" name="phone_number"
                                                                            value="{{ $umkm->user->phone_number }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="No. Telp" required>
                                                                        <input type="password" name="password"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Password (Opsional)">
                                                                        <input type="password"
                                                                            name="password_confirmation"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Konfirmasi Password (Opsional)">
                                                                    </div>

                                                                    <!-- Address Data Section -->
                                                                    <div>
                                                                        <h4 class="font-semibold mb-3">Data Alamat</h4>
                                                                        <input type="text" name="address"
                                                                            value="{{ $umkm->address->address }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Alamat" required>
                                                                        <input type="text" name="province"
                                                                            value="{{ $umkm->address->province }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Provinsi" required>
                                                                        <input type="text" name="city"
                                                                            value="{{ $umkm->address->city }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Kota" required>
                                                                        <input type="text" name="district"
                                                                            value="{{ $umkm->address->district }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Kecamatan" required>
                                                                        <input type="text" name="post_code"
                                                                            value="{{ $umkm->address->post_code }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Kode Pos" required>
                                                                        <textarea name="delivery_instructions" class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Petunjuk Pengiriman">{{ $umkm->address->delivery_instructions }}</textarea>
                                                                    </div>

                                                                    <!-- Store Data Section -->
                                                                    <div>
                                                                        <h4 class="font-semibold mb-3">Data Toko</h4>
                                                                        <input type="text" name="store_name"
                                                                            value="{{ $umkm->store_name }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Nama UMKM" required>
                                                                        <input type="text" name="owner_name"
                                                                            value="{{ $umkm->owner_name }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Nama Pemilik" required>
                                                                        <input type="text" name="business_type"
                                                                            value="{{ $umkm->business_type }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Kategori Usaha" required>
                                                                        <input type="text" name="description"
                                                                            value="{{ $umkm->description }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Deskripsi UMKM" required>
                                                                        <input type="email" name="store_email"
                                                                            value="{{ $umkm->email }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="Email" required>
                                                                        <input type="number" name="store_phone_number"
                                                                            value="{{ $umkm->phone_number }}"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            placeholder="No. Telp" required>
                                                                        <select name="status"
                                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                                            required>
                                                                            <option value="1"
                                                                                {{ $umkm->status == 1 ? 'selected' : '' }}>
                                                                                Aktif</option>
                                                                            <option value="0"
                                                                                {{ $umkm->status == 0 ? 'selected' : '' }}>
                                                                                Tidak Aktif</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Logo Upload Section -->
                                                                <h4 class="font-semibold mb-3 mt-6">Logo Toko</h4>
                                                                <input type="file" name="logo"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    accept="image/*">

                                                                <!-- Submit Button -->
                                                                <button type="submit"
                                                                    class="bg-indigo-600 text-white px-4 py-2 rounded mt-4">
                                                                    Simpan Perubahan Data
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->

                                                <!-- Start Show Detail Modal -->
                                                <dialog id="viewModal{{ $umkm->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[960px] w-full">
                                                        <!-- Adjusted width for larger modal -->
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Detail Data UMKM</h3>
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
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                                <!-- Grid for 3 columns -->

                                                                <!-- User Data Section -->
                                                                <div>
                                                                    <h4 class="font-semibold mb-3">Data Akun</h4>
                                                                    <p class="mb-4"><strong>Nama Akun:</strong>
                                                                        {{ $umkm->user->name }}</p>
                                                                    <p class="mb-4"><strong>Username:</strong>
                                                                        {{ $umkm->user->username }}</p>
                                                                    <p class="mb-4"><strong>Email:</strong>
                                                                        {{ $umkm->user->email }}</p>
                                                                    <p class="mb-4"><strong>No. Telp:</strong>
                                                                        {{ $umkm->user->phone_number }}</p>
                                                                </div>

                                                                <!-- Address Data Section -->
                                                                <div>
                                                                    <h4 class="font-semibold mb-3">Data Alamat</h4>
                                                                    <p class="mb-4"><strong>Alamat:</strong>
                                                                        {{ $umkm->address->address }}</p>
                                                                    <p class="mb-4"><strong>Provinsi:</strong>
                                                                        {{ $umkm->address->province }}</p>
                                                                    <p class="mb-4"><strong>Kota:</strong>
                                                                        {{ $umkm->address->city }}</p>
                                                                    <p class="mb-4"><strong>Kecamatan:</strong>
                                                                        {{ $umkm->address->district }}</p>
                                                                    <p class="mb-4"><strong>Kode Pos:</strong>
                                                                        {{ $umkm->address->post_code }}</p>
                                                                    <p class="mb-4"><strong>Petunjuk Pengiriman:</strong>
                                                                        {{ $umkm->address->delivery_instructions }}</p>
                                                                </div>

                                                                <!-- Store Data Section -->
                                                                <div>
                                                                    <h4 class="font-semibold mb-3">Data Toko</h4>
                                                                    <p class="mb-4"><strong>Nama UMKM:</strong>
                                                                        {{ $umkm->store_name }}</p>
                                                                    <p class="mb-4"><strong>Nama Pemilik:</strong>
                                                                        {{ $umkm->owner_name }}</p>
                                                                    <p class="mb-4"><strong>Kategori Usaha:</strong>
                                                                        {{ $umkm->business_type }}</p>
                                                                    <p class="mb-4"><strong>Deskripsi UMKM:</strong>
                                                                        {{ $umkm->description }}</p>
                                                                    <p class="mb-4"><strong>Status:</strong>
                                                                        {{ $umkm->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- Logo Section -->
                                                            <h4 class="font-semibold mb-3 mt-6">Logo Toko</h4>
                                                            @if ($umkm->logo)
                                                                <img src="{{ Storage::url($umkm->logo) }}"
                                                                    alt="Logo UMKM" class="mb-4 rounded-md"
                                                                    style="max-width: 200px;">
                                                            @else
                                                                <p class="mb-4">Logo tidak tersedia</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Show Detail Modal -->

                                                <!-- Start Delete Modal -->
                                                <dialog id="deleteModal{{ $umkm->id }}"
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
                                                            <p>Apakah anda yakin menghapus data {{ $umkm->name }}?</p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.umkm.destroy', $umkm->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="bg-red-600 mt-6 text-white px-4 py-2 rounded">Ya,
                                                                    Hapus</button>
                                                                <button type="button"
                                                                    class="bg-gray-300 mt-6 text-black px-4 py-2 rounded"
                                                                    onclick="deleteModal{{ $umkm->id }}.close()">Tidak,
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
                                <!-- Start Add Modal -->
                                <dialog id="addModal"
                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                    <div class="relative h-auto md:w-[960px] w-full">
                                        <!-- Adjusted width for larger modal -->
                                        <div
                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                            <h3 class="font-bold text-lg">Tambah Store Baru</h3>
                                            <form method="dialog">
                                                <button
                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="p-6">
                                            <form action="{{ route('superadmin.data-master.umkm.store') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @method("POST")
                                                @csrf
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                    <!-- Grid for 3 columns -->
                                                    <!-- User Data Section -->
                                                    <div>
                                                        <h4 class="font-semibold mb-3">Data Akun</h4>
                                                        <input type="text" name="name"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Nama Akun" required>
                                                        <input type="text" name="username"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Username" required>
                                                        <input type="email" name="email"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Email" required>
                                                        <input type="number" name="phone_number"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="No. Telp" required>
                                                        <input type="password" name="password"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Password" required>
                                                        <input type="password" name="password_confirmation"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Konfirmasi Password" required>
                                                    </div>

                                                    <!-- Address Data Section -->
                                                    <div>
                                                        <h4 class="font-semibold mb-3">Data Alamat</h4>
                                                        <input type="text" name="address"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Alamat" required>
                                                        <input type="text" name="province"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Provinsi" required>
                                                        <input type="text" name="city"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Kota" required>
                                                        <input type="text" name="district"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Kecamatan" required>
                                                        <input type="text" name="post_code"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Kode Pos" required>
                                                        <textarea name="delivery_instructions" class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Petunjuk Pengiriman"></textarea>
                                                    </div>

                                                    <!-- Store Data Section -->
                                                    <div>
                                                        <h4 class="font-semibold mb-3">Data Toko</h4>
                                                        <input type="text" name="store_name"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Nama UMKM" required>
                                                        <input type="text" name="owner_name"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Nama Pemilik" required>
                                                        <input type="text" name="business_type"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Kategori Usaha" required>
                                                        <input type="text" name="description"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Deskripsi UMKM" required>
                                                        <input type="email" name="store_email"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="Email" required>
                                                        <input type="number" name="store_phone_number"
                                                            class="border px-3 py-2 rounded w-full mb-4"
                                                            placeholder="No. Telp" required>
                                                        <select name="status"
                                                            class="border px-3 py-2 rounded w-full mb-4" required>
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Logo Upload Section -->
                                                <h4 class="font-semibold mb-3">Logo Toko</h4>
                                                <input type="file" name="logo"
                                                    class="border px-3 py-2 rounded w-full mb-4" accept="image/*">

                                                <button type="submit"
                                                    class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah UMKM</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                                <!-- End Add Modal -->
                            </div>
                        </div><!--end content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
