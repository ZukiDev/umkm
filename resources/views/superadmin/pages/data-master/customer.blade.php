@extends('layouts.dashboard')

@section('content')
    <div class="mx-6 layout-specing sm:mx-6 md:mx-8 lg:mx-12">
        <div class="relative grid gap-6 mt-2 md:grid-cols-12">
            <!-- Start Content -->
            <div class="md:col-span-12">
                <div class="items-center justify-between md:flex">
                    <h5 class="text-lg font-semibold">Data Customer</h5>
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
                            aria-current="page">Data Customer</li>
                    </ul>
                </div>
                <div class="mt-6" id="tables">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="bg-white rounded shadow dark:shadow-slate-800 dark:bg-slate-900">
                            <div class="p-5">
                                <div class="items-center justify-between md:flex">
                                    <!-- Search Box -->
                                    <div class="flex-grow">
                                        <!--<input type="text" placeholder="Cari Customer..."-->
                                        <!--    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">-->
                                    </div>
                                    <!-- Add Customer Button -->
                                    <button
                                        class="px-4 py-2 ml-4 text-white transition bg-indigo-600 rounded hover:bg-indigo-700"
                                        onclick="addModal.showModal()">
                                        <i class="mr-1 uil uil-plus"></i> Tambah Customer Baru
                                    </button>
                                </div>
                            </div>
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
                            <div class="p-5 border-t border-gray-100 dark:border-slate-800">
                                <div
                                    class="relative block w-full overflow-x-auto bg-white rounded-md shadow dark:bg-slate-900 dark:shadow-gray-700">
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
                                                    <td class="p-4">{{ $customer->address->address ?? '' }}</td>
                                                    <td class="p-4 text-end">
                                                        <!-- View Button -->
                                                        <button class="mr-2 text-blue-600 hover:text-blue-800"
                                                            onclick="viewModal{{ $customer->id }}.showModal()">
                                                            <i class="uil uil-eye"></i>
                                                        </button>

                                                        <!-- Edit Button -->
                                                        <button class="mr-2 text-yellow-600 hover:text-yellow-800"
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
                                                    class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="text-lg font-bold">Data {{ $customer->name }}</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                                                    <i data-feather="x" class="text-white size-4"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6">
                                                            <!-- Grid for 2 columns -->
                                                            <div
                                                                class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 ">

                                                                <!-- User Data Section -->
                                                                <div>
                                                                    <h4 class="mb-3 font-semibold">Data Akun</h4>
                                                                    <p class="mb-4"><strong>Nama Akun:</strong>
                                                                        {{ $customer->name }}</p>
                                                                    <p class="mb-4"><strong>Username:</strong>
                                                                        {{ $customer->username }}</p>
                                                                    <p class="mb-4"><strong>Email:</strong>
                                                                        {{ $customer->email }}</p>
                                                                    <p class="mb-4"><strong>No. Telp:</strong>
                                                                        {{ $customer->phone_number }}</p>
                                                                </div>

                                                                <!-- Address Data Section -->
                                                                <div>
                                                                    <h4 class="mb-3 font-semibold">Data Alamat</h4>
                                                                    <p class="mb-4"><strong>Alamat:</strong>
                                                                        {{ $customer->address->address ?? '' }}</p>
                                                                    <p class="mb-4"><strong>Provinsi:</strong>
                                                                        {{ $customer->address->province ?? '' }}</p>
                                                                    <p class="mb-4"><strong>Kota:</strong>
                                                                        {{ $customer->address->city ?? '' }}</p>
                                                                    <p class="mb-4"><strong>Kecamatan:</strong>
                                                                        {{ $customer->address->district ?? '' }}</p>
                                                                    <p class="mb-4"><strong>Kode Pos:</strong>
                                                                        {{ $customer->address->post_code ?? '' }}</p>
                                                                    <p class="mb-4"><strong>Petunjuk Pengiriman:</strong>
                                                                        {{ $customer->address->delivery_instructions ?? '' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End View Modal -->

                                                <!-- Start Edit Modal -->
                                                <dialog id="editModal{{ $customer->id }}"
                                                    class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[480px] w-300px">
                                                        <div
                                                            class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="text-lg font-bold">Ubah Data Customer</h3>
                                                            <form method="dialog">
                                                                <button
                                                                    class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                                                    <i data-feather="x" class="text-white size-4"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="p-6">
                                                            <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                                                                <span class="text-red-600">*</span> Wajib diisi (kecuali password dan konfirmasi password)
                                                            </p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.customer.update', $customer->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Grid for 2 columns -->
                                                                <div
                                                                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 ">
                                                                    <!-- User Data Section -->
                                                                    <div>
                                                                        <h4 class="mb-3 font-semibold">Data Akun</h4>
                                                                        <label class="block mb-1 font-medium" for="edit_name_{{ $customer->id }}">
                                                                            Nama Akun <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <input type="text" name="name" id="edit_name_{{ $customer->id }}"
                                                                            value="{{ $customer->name }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Nama Akun" required>

                                                                        <label class="block mb-1 font-medium" for="edit_username_{{ $customer->id }}">
                                                                            Username <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <input type="text" name="username" id="edit_username_{{ $customer->id }}"
                                                                            value="{{ $customer->username }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Username" required>

                                                                        <label class="block mb-1 font-medium" for="edit_email_{{ $customer->id }}">
                                                                            Email <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <input type="email" name="email" id="edit_email_{{ $customer->id }}"
                                                                            value="{{ $customer->email }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Email" required>

                                                                        <label class="block mb-1 font-medium" for="edit_phone_number_{{ $customer->id }}">
                                                                            No. Telp <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <input type="number" name="phone_number" id="edit_phone_number_{{ $customer->id }}"
                                                                            value="{{ $customer->phone_number }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="No. Telp" required>

                                                                        <label class="block mb-1 font-medium" for="edit_password_{{ $customer->id }}">
                                                                            Password <span class="text-gray-400">(Opsional)</span>
                                                                        </label>
                                                                        <input type="password" name="password" id="edit_password_{{ $customer->id }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Password (Opsional)">

                                                                        <label class="block mb-1 font-medium" for="edit_password_confirmation_{{ $customer->id }}">
                                                                            Konfirmasi Password <span class="text-gray-400">(Opsional)</span>
                                                                        </label>
                                                                        <input type="password"
                                                                            name="password_confirmation" id="edit_password_confirmation_{{ $customer->id }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Konfirmasi Password (Opsional)">
                                                                    </div>

                                                                    <!-- Address Data Section -->
                                                                    <div>
                                                                        <h4 class="mb-3 font-semibold">Data Alamat</h4>

                                                                        <label class="block mb-1 font-medium" for="edit_address_{{ $customer->id }}">
                                                                            Alamat <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <input type="text" name="address" id="edit_address_{{ $customer->id }}"
                                                                            value="{{ $customer->address->address ?? '' }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Alamat" required>

                                                                        <!-- Province -->
                                                                        <div>
                                                                            <label class="font-semibold form-label">Provinsi: <span class="text-red-600">*</span></label>
                                                                            <select id="province-select-{{ $customer->id }}" name="province"
                                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                                required>
                                                                                <option value="">Pilih Provinsi</option>
                                                                                <!-- Options will be populated by JS -->
                                                                            </select>
                                                                        </div>

                                                                        <!-- City -->
                                                                        <div>
                                                                            <label class="font-semibold form-label">Kota: <span class="text-red-600">*</span></label>
                                                                            <select id="city-select-{{ $customer->id }}" name="city"
                                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                                required disabled>
                                                                                <option value="">Pilih Kota/Kabupaten</option>
                                                                                <!-- Options will be populated by JS -->
                                                                            </select>
                                                                        </div>

                                                                        <!-- District -->
                                                                        <div>
                                                                            <label class="font-semibold form-label">Kecamatan: <span class="text-red-600">*</span></label>
                                                                            <select id="district-select-{{ $customer->id }}" name="district"
                                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                                required disabled>
                                                                                <option value="">Pilih Kecamatan</option>
                                                                                <!-- Options will be populated by JS -->
                                                                            </select>
                                                                        </div>

                                                                        <script>
                                                                            // Cek apakah data sudah ada di database lokal (misal window.localProvinces, window.localRegencies, window.localDistricts)
                                                                            // Jika tidak ada, fallback ke API eksternal
                                                                            // Cek kemiripan nama (case-insensitive, ignore spasi) agar data lama tetap tersambung

                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                const provinceSelect = document.getElementById('province-select-{{ $customer->id }}');
                                                                                const citySelect = document.getElementById('city-select-{{ $customer->id }}');
                                                                                const districtSelect = document.getElementById('district-select-{{ $customer->id }}');
                                                                                const selectedProvince = @json($customer->address->province ?? '');
                                                                                const selectedCity = @json($customer->address->city ?? '');
                                                                                const selectedDistrict = @json($customer->address->district ?? '');

                                                                                // Fungsi normalisasi string untuk kemiripan
                                                                                function normalize(str) {
                                                                                    return (str || '').toLowerCase().replace(/\s+/g, '');
                                                                                }

                                                                                // Cari id berdasarkan kemiripan nama
                                                                                function findByName(arr, name) {
                                                                                    const normName = normalize(name);
                                                                                    return arr.find(item => normalize(item.name) === normName) || null;
                                                                                }

                                                                                function fetchData(source, url, cb) {
                                                                                    if (window[source] && Array.isArray(window[source])) {
                                                                                        cb(window[source]);
                                                                                    } else {
                                                                                        fetch(url)
                                                                                            .then(r => r.json())
                                                                                            .then(data => cb(data));
                                                                                    }
                                                                                }

                                                                                // Load provinces
                                                                                fetchData(
                                                                                    'localProvinces',
                                                                                    'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                                                                                    function(provinces) {
                                                                                        provinces.forEach(province => {
                                                                                            const option = document.createElement('option');
                                                                                            option.value = province.name;
                                                                                            option.textContent = province.name;
                                                                                            option.dataset.id = province.id;
                                                                                            if (normalize(province.name) === normalize(selectedProvince)) option.selected = true;
                                                                                            provinceSelect.appendChild(option);
                                                                                        });
                                                                                        if (selectedProvince) provinceSelect.dispatchEvent(new Event('change'));
                                                                                    }
                                                                                );

                                                                                provinceSelect.addEventListener('change', function() {
                                                                                    const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                                                                                    const provinceId = selectedOption.dataset.id;

                                                                                    citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                                                                                    citySelect.disabled = true;
                                                                                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                                                                                    districtSelect.disabled = true;

                                                                                    if (provinceId) {
                                                                                        citySelect.disabled = false;
                                                                                        fetchData(
                                                                                            'localRegencies_' + provinceId,
                                                                                            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`,
                                                                                            function(regencies) {
                                                                                                regencies.forEach(regency => {
                                                                                                    const option = document.createElement('option');
                                                                                                    option.value = regency.name;
                                                                                                    option.textContent = regency.name;
                                                                                                    option.dataset.id = regency.id;
                                                                                                    if (normalize(regency.name) === normalize(selectedCity)) option.selected = true;
                                                                                                    citySelect.appendChild(option);
                                                                                                });
                                                                                                if (selectedCity) citySelect.dispatchEvent(new Event('change'));
                                                                                            }
                                                                                        );
                                                                                    }
                                                                                });

                                                                                citySelect.addEventListener('change', function() {
                                                                                    const selectedOption = citySelect.options[citySelect.selectedIndex];
                                                                                    const cityId = selectedOption.dataset.id;

                                                                                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                                                                                    districtSelect.disabled = true;

                                                                                    if (cityId) {
                                                                                        districtSelect.disabled = false;
                                                                                        fetchData(
                                                                                            'localDistricts_' + cityId,
                                                                                            `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`,
                                                                                            function(districts) {
                                                                                                districts.forEach(district => {
                                                                                                    const option = document.createElement('option');
                                                                                                    option.value = district.name;
                                                                                                    option.textContent = district.name;
                                                                                                    if (normalize(district.name) === normalize(selectedDistrict)) option.selected = true;
                                                                                                    districtSelect.appendChild(option);
                                                                                                });
                                                                                            }
                                                                                        );
                                                                                    }
                                                                                });

                                                                                // Auto-load city & district if already selected
                                                                                if (selectedProvince) {
                                                                                    fetchData(
                                                                                        'localProvinces',
                                                                                        'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                                                                                        function(provinces) {
                                                                                            const province = findByName(provinces, selectedProvince);
                                                                                            if (province) {
                                                                                                citySelect.disabled = false;
                                                                                                fetchData(
                                                                                                    'localRegencies_' + province.id,
                                                                                                    `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${province.id}.json`,
                                                                                                    function(regencies) {
                                                                                                        regencies.forEach(regency => {
                                                                                                            const option = document.createElement('option');
                                                                                                            option.value = regency.name;
                                                                                                            option.textContent = regency.name;
                                                                                                            option.dataset.id = regency.id;
                                                                                                            if (normalize(regency.name) === normalize(selectedCity)) option.selected = true;
                                                                                                            citySelect.appendChild(option);
                                                                                                        });
                                                                                                        if (selectedCity) {
                                                                                                            const regency = findByName(regencies, selectedCity);
                                                                                                            if (regency) {
                                                                                                                districtSelect.disabled = false;
                                                                                                                fetchData(
                                                                                                                    'localDistricts_' + regency.id,
                                                                                                                    `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regency.id}.json`,
                                                                                                                    function(districts) {
                                                                                                                        districts.forEach(district => {
                                                                                                                            const option = document.createElement('option');
                                                                                                                            option.value = district.name;
                                                                                                                            option.textContent = district.name;
                                                                                                                            if (normalize(district.name) === normalize(selectedDistrict)) option.selected = true;
                                                                                                                            districtSelect.appendChild(option);
                                                                                                                        });
                                                                                                                    }
                                                                                                                );
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                );
                                                                                            }
                                                                                        }
                                                                                    );
                                                                                }
                                                                            });
                                                                        </script>

                                                                        <label class="block mb-1 font-medium" for="edit_post_code_{{ $customer->id }}">
                                                                            Kode Pos <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <input type="text" name="post_code" id="edit_post_code_{{ $customer->id }}"
                                                                            value="{{ $customer->address->post_code ?? '' }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Kode Pos" required>

                                                                        <label class="block mb-1 font-medium" for="edit_delivery_instructions_{{ $customer->id }}">
                                                                            Petunjuk Pengiriman <span class="text-red-600">*</span>
                                                                        </label>
                                                                        <textarea name="delivery_instructions" id="edit_delivery_instructions_{{ $customer->id }}"
                                                                            class="w-full px-3 py-2 mb-4 border rounded"
                                                                            placeholder="Petunjuk Pengiriman" required>{{ $customer->address->delivery_instructions ?? '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <button type="submit"
                                                                    class="px-4 py-2 text-white bg-indigo-600 rounded">Simpan
                                                                    Perubahan Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->

                                                <!-- Start Delete Modal -->
                                                <dialog id="deleteModal{{ $customer->id }}"
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
                                                            <p>Apakah anda yakin menghapus data {{ $customer->name }}?</p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.customer.destroy', $customer->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="px-4 py-2 mt-6 text-white bg-red-600 rounded">Ya,
                                                                    Hapus</button>
                                                                <button type="button"
                                                                    class="px-4 py-2 mt-6 text-black bg-gray-300 rounded"
                                                                    onclick="deleteModal{{ $customer->id }}.close()">Tidak,
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

        <!-- Start Add Modal -->
        <dialog id="addModal"
            class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
            <div class="relative h-auto md:w-[480px] w-300px">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-bold">Tambah Customer Baru</h3>
                    <form method="dialog">
                        <button
                            class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                            <i data-feather="x" class="text-white size-4"></i>
                        </button>
                    </form>
                </div>

                <div class="p-6">
                    <form action="{{ route('superadmin.data-master.customer.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                            <span class="text-red-600">*</span> Wajib diisi
                        </p>
                        <!-- Grid for 2 columns -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 ">
                            <!-- User Data Section -->
                            <div>
                                <h4 class="mb-4 font-semibold">Data Akun</h4>
                                <label class="block mb-1 font-medium" for="name">
                                    Nama Akun <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="name" id="name" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Nama Akun" required>

                                <label class="block mb-1 font-medium" for="username">
                                    Username <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="username" id="username" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Username" required>

                                <label class="block mb-1 font-medium" for="email">
                                    Email <span class="text-red-600">*</span>
                                </label>
                                <input type="email" name="email" id="email" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Email" required>

                                <label class="block mb-1 font-medium" for="phone_number">
                                    No. Telp <span class="text-red-600">*</span>
                                </label>
                                <input type="number" name="phone_number" id="phone_number" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="No. Telp" required>

                                <label class="block mb-1 font-medium" for="password">
                                    Password <span class="text-red-600">*</span>
                                </label>
                                <input type="password" name="password" id="password" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Password" required>

                                <label class="block mb-1 font-medium" for="password_confirmation">
                                    Konfirmasi Password <span class="text-red-600">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-3 py-2 mb-4 border rounded" placeholder="Konfirmasi Password" required>
                            </div>

                            <!-- Address Data Section -->
                            <div>
                                <h4 class="mb-4 font-semibold">Data Alamat</h4>
                                <label class="block mb-1 font-medium" for="address">
                                    Alamat <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="address" id="address" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Alamat" required>

                                <!-- Province -->
                                <div>
                                    <label class="font-semibold form-label">Provinsi: <span class="text-red-600">*</span></label>
                                    <select id="province-select" name="province"
                                        class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                        required>
                                        <option value="">Pilih Provinsi</option>
                                        <!-- Options will be populated by JS -->
                                    </select>
                                </div>

                                <!-- City -->
                                <div>
                                    <label class="font-semibold form-label">Kota: <span class="text-red-600">*</span></label>
                                    <select id="city-select" name="city"
                                        class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                        required disabled>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        <!-- Options will be populated by JS -->
                                    </select>
                                </div>

                                <!-- District -->
                                <div>
                                    <label class="font-semibold form-label">Kecamatan: <span class="text-red-600">*</span></label>
                                    <select id="district-select" name="district"
                                        class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                        required disabled>
                                        <option value="">Pilih Kecamatan</option>
                                        <!-- Options will be populated by JS -->
                                    </select>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const provinceSelect = document.getElementById('province-select');
                                        const citySelect = document.getElementById('city-select');
                                        const districtSelect = document.getElementById('district-select');

                                        // No preselected values for add form
                                        const selectedProvince = '';
                                        const selectedCity = '';
                                        const selectedDistrict = '';

                                        // Fetch provinces
                                        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                                            .then(response => response.json())
                                            .then(provinces => {
                                                provinces.forEach(province => {
                                                    const option = document.createElement('option');
                                                    option.value = province.name;
                                                    option.textContent = province.name;
                                                    option.dataset.id = province.id;
                                                    provinceSelect.appendChild(option);
                                                });
                                            });

                                        provinceSelect.addEventListener('change', function() {
                                            const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                                            const provinceId = selectedOption.dataset.id;

                                            // Reset city select
                                            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                                            citySelect.disabled = true;
                                            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                                            districtSelect.disabled = true;

                                            if (provinceId) {
                                                citySelect.disabled = false;
                                                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                                                    .then(response => response.json())
                                                    .then(regencies => {
                                                        regencies.forEach(regency => {
                                                            const option = document.createElement('option');
                                                            option.value = regency.name;
                                                            option.textContent = regency.name;
                                                            option.dataset.id = regency.id;
                                                            citySelect.appendChild(option);
                                                        });
                                                    });
                                            }
                                        });

                                        citySelect.addEventListener('change', function() {
                                            const selectedOption = citySelect.options[citySelect.selectedIndex];
                                            const cityId = selectedOption.dataset.id;

                                            // Reset district select
                                            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                                            districtSelect.disabled = true;

                                            if (cityId) {
                                                districtSelect.disabled = false;
                                                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`)
                                                    .then(response => response.json())
                                                    .then(districts => {
                                                        districts.forEach(district => {
                                                            const option = document.createElement('option');
                                                            option.value = district.name;
                                                            option.textContent = district.name;
                                                            districtSelect.appendChild(option);
                                                        });
                                                    });
                                            }
                                        });
                                    });
                                </script>

                                <label class="block mb-1 font-medium" for="post_code">
                                    Kode Pos <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="post_code" id="post_code" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Kode Pos" required>

                                <label class="block mb-1 font-medium" for="delivery_instructions">
                                    Petunjuk Pengiriman <span class="text-red-600">*</span>
                                </label>
                                <textarea name="delivery_instructions" id="delivery_instructions" class="w-full px-3 py-2 mb-4 border rounded"
                                    placeholder="Petunjuk Pengiriman" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded">Tambah Customer</button>
                    </form>
                </div>
            </div>
        </dialog>
        <!-- End Add Modal -->
    </div>
@endsection
