@extends('layouts.dashboard')

@section('content')
    <div class="layout-specing mx-6 sm:mx-6 md:mx-8 lg:mx-12">
        <div class="grid md:grid-cols-12 mt-2 gap-6 relative">
            <!-- Start Content -->
            <div class="md:col-span-12">
                <div class="md:flex justify-between items-center">
                    <h5 class="text-lg font-semibold">Data Customer</h5>
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
                            aria-current="page">Data Customer</li>
                    </ul>
                </div>
                <div class="mt-6" id="tables">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="shadow dark:shadow-slate-800 rounded bg-white dark:bg-slate-900">
                            <div class="p-5">
                                <div class="md:flex justify-between items-center">
                                    <h5 class="text-lg font-bold mb-4 md:mb-0">Data Customer</h5>
                                    <div class="flex md:items-center space-x-2">
                                        <!-- Search Box -->
                                        <input type="text" placeholder="Cari Customer..."
                                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                        <!-- Add Customer Button -->
                                        <button
                                            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition"
                                            onclick="addModal.showModal()">
                                            <i class="uil uil-plus mr-1"></i> Tambah Customer Baru
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 border-t border-gray-100 dark:border-slate-800">
                                <div
                                    class="relative overflow-x-auto block w-full bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                                    <table class="w-full text-start">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-5 text-start">No.</th>
                                                <th class="px-4 py-5 text-start">Nama Customer</th>
                                                <th class="px-4 py-5 text-start">Email</th>
                                                <th class="px-4 py-5 text-start">No.Telp</th>
                                                <th class="px-4 py-5 text-start">Alamat</th>
                                                <th class="px-4 py-5 text-end">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($customers as $index => $customer)
                                                <tr class="border-t border-gray-100 dark:border-gray-700">
                                                    <td class="p-4">{{ $index + 1 }}</td>
                                                    <td class="p-4">{{ $customer->name }}</td>
                                                    <td class="p-4">{{ $customer->email }}</td>
                                                    <td class="p-4">{{ $customer->phone_number }}</td>
                                                    <td class="p-4">{{ $customer->address->address }}</td>
                                                    <td class="p-4 text-end">
                                                        <!-- View Button -->
                                                        <button class="text-blue-600 hover:text-blue-800 mr-2"
                                                            onclick="viewModal{{ $customer->id }}.showModal()">
                                                            <i class="uil uil-eye"></i>
                                                        </button>

                                                        <!-- Edit Button -->
                                                        <button class="text-yellow-600 hover:text-yellow-800 mr-2"
                                                            onclick="editModal{{ $customer->id }}.showModal()">
                                                            <i class="uil uil-edit"></i>
                                                        </button>

                                                        <!-- Remove Button -->
                                                        <button class="text-red-600 hover:text-red-800"
                                                            onclick="deleteModal{{ $customer->id }}.showModal()">
                                                            <i class="uil uil-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Start View Modal -->
                                                <dialog id="viewModal{{ $customer->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Data {{ $customer->name }}</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="p-6 text-justify">
                                                            <p>Nama: {{ $customer->name }}</p>
                                                            <p>Email: {{ $customer->email }}</p>
                                                            <p>No.Telp: {{ $customer->phone_number }}</p>
                                                            <p>Alamat: {{ $customer->address->address }}</p>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End View Modal -->

                                                <!-- Start Edit Modal -->
                                                <dialog id="editModal{{ $customer->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg">Ubah Data Customer</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="p-6">
                                                            <form
                                                                action="{{ route('superadmin.data-master.customer.update', $customer->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="text" name="name"
                                                                    value="{{ $customer->name }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Nama Customer" required>
                                                                <input type="email" name="email"
                                                                    value="{{ $customer->email }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Email" required>
                                                                <input type="text" name="phone"
                                                                    value="{{ $customer->phone_number }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="No.Telp" required>
                                                                <input type="text" name="address"
                                                                    value="{{ $customer->address->address }}"
                                                                    class="border px-3 py-2 rounded w-full mb-4"
                                                                    placeholder="Alamat" required>
                                                                <button type="submit"
                                                                    class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan
                                                                    Perubahan Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->

                                                <!-- Start Delete Modal -->
                                                <dialog id="deleteModal{{ $customer->id }}"
                                                    class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="font-bold text-lg text-red-600">Konfirmasi Hapus Data
                                                            </h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost bg-red-600">
                                                                    <i data-feather="x" class="size-4 text-white"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="p-6 text-center">
                                                            <p>Apakah anda yakin menghapus data {{ $customer->name }}?</p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.customer.destroy', $customer->id) }}"
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
    </div>
@endsection
