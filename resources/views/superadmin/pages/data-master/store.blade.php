@extends('layouts.dashboard')

@section('content')
    <div class="mx-6 layout-specing sm:mx-6 md:mx-8 lg:mx-12">
        <div class="relative grid gap-6 mt-2 md:grid-cols-12">
            <!-- Start Content -->
            <div class="md:col-span-12">
                <div class="items-center justify-between md:flex">
                    <h5 class="text-lg font-semibold">Data UMKM</h5>
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
                            aria-current="page">Data UMKM
                        </li>
                    </ul>
                </div>

                <div class="mt-6" id="tables">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="bg-white rounded shadow dark:shadow-slate-800 dark:bg-slate-900">
                            <div class="p-5">
                                <div class="items-center justify-between md:flex">
                                    <!-- Search Box -->
                                    <div class="flex-grow">
                                        <!--<input type="text" placeholder="Cari UMKM..."-->
                                        <!--    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">-->
                                    </div>
                                    <!-- Add UMKM Button -->
                                    <button
                                        class="px-4 py-2 ml-4 text-white transition bg-indigo-600 rounded hover:bg-indigo-700"
                                        onclick="addModal.showModal()">
                                        <i class="mr-1 uil uil-plus"></i> Tambah UMKM Baru
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
                                                    <td class="p-4">
                                                        {{ $loop->iteration + ($stores->currentPage() - 1) * $stores->perPage() }}
                                                    </td>
                                                    <td class="p-4">
                                                        <img src="{{ asset('storage/logos/' . $umkm->logo) }}"
                                                            alt="{{ $umkm->store_name }}" class="w-10 h-10 rounded-full">
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
                                                        <button class="mr-2 text-blue-600 hover:text-blue-800"
                                                            onclick="viewModal{{ $umkm->id }}.showModal()">
                                                            <i class="uil uil-eye"></i>
                                                        </button>

                                                        <!-- Edit Button -->
                                                        <button class="mr-2 text-yellow-600 hover:text-yellow-800"
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
                                                    class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[1200px] w-full max-w-[98vw]">
                                                        <!-- Adjusted width for larger modal -->
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="text-lg font-bold">Ubah Data UMKM</h3>
                                                            <!-- Close Button (X) -->
                                                            <form method="dialog">
                                                                <button
                                                                    class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                                                    <i data-feather="x" class="text-white size-4"></i>
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

                                                                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                                                    <!-- User Data Section -->
                                                                    <div>
                                                                        <h4 class="mb-3 font-semibold">Data Akun</h4>
                                                                        <label class="block mb-1 font-medium">Nama Akun
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="text" name="name"
                                                                            value="{{ $umkm->user->name }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Nama Akun" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Masukkan
                                                                            nama lengkap akun pengguna.</small>

                                                                        <label class="block mb-1 font-medium">Username <span
                                                                                class="text-red-600">*</span></label>
                                                                        <input type="text" name="username"
                                                                            value="{{ $umkm->user->username }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Username" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Username
                                                                            unik untuk login.</small>

                                                                        <label class="block mb-1 font-medium">Email <span
                                                                                class="text-red-600">*</span></label>
                                                                        <input type="email" name="email"
                                                                            value="{{ $umkm->user->email }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Email" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Alamat
                                                                            email aktif pengguna.</small>

                                                                        <label class="block mb-1 font-medium">No. Telp
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="number" name="phone_number"
                                                                            value="{{ $umkm->user->phone_number }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Contoh: 6287755819001" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Nomor
                                                                            telepon yang dapat dihubungi.</small>

                                                                        <label
                                                                            class="block mb-1 font-medium">Password</label>
                                                                        <input type="password" name="password"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Password">
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Minimal
                                                                            8 karakter. Kosongkan jika tidak ingin mengubah
                                                                            password.</small>

                                                                        <label class="block mb-1 font-medium">Konfirmasi
                                                                            Password</label>
                                                                        <input type="password"
                                                                            name="password_confirmation"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Konfirmasi Password">
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Ulangi
                                                                            password di atas jika ingin mengubah
                                                                            password.</small>
                                                                    </div>

                                                                    <!-- Address Data Section -->
                                                                    <div>
                                                                        <h4 class="mb-3 font-semibold">Data Alamat</h4>
                                                                        <label class="block mb-1 font-medium">Alamat <span
                                                                                class="text-red-600">*</span></label>
                                                                        <input type="text" name="address"
                                                                            value="{{ $umkm->address->address }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Alamat" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Alamat
                                                                            lengkap UMKM.</small>

                                                                        <!-- Province -->
                                                                        <div>
                                                                            <label class="font-semibold form-label">Provinsi: <span
                                                                                    class="text-red-600">*</span></label>
                                                                            <select id="province-select-{{ $umkm->id }}" name="province"
                                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                                required>
                                                                                <option value="">Pilih Provinsi</option>
                                                                                <!-- Options will be populated by JS -->
                                                                            </select>
                                                                        </div>

                                                                        <!-- City -->
                                                                        <div>
                                                                            <label class="font-semibold form-label">Kota: <span
                                                                                    class="text-red-600">*</span></label>
                                                                            <select id="city-select-{{ $umkm->id }}" name="city"
                                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                                required disabled>
                                                                                <option value="">Pilih Kota/Kabupaten</option>
                                                                                <!-- Options will be populated by JS -->
                                                                            </select>
                                                                        </div>

                                                                        <!-- District -->
                                                                        <div>
                                                                            <label class="font-semibold form-label">Kecamatan: <span
                                                                                    class="text-red-600">*</span></label>
                                                                            <select id="district-select-{{ $umkm->id }}" name="district"
                                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                                required disabled>
                                                                                <option value="">Pilih Kecamatan</option>
                                                                                <!-- Options will be populated by JS -->
                                                                            </select>
                                                                        </div>

                                                                        <script>
                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                const provinceSelect = document.getElementById('province-select-{{ $umkm->id }}');
                                                                                const citySelect = document.getElementById('city-select-{{ $umkm->id }}');
                                                                                const districtSelect = document.getElementById('district-select-{{ $umkm->id }}');
                                                                                const selectedProvince = @json($umkm->address->province ?? '');
                                                                                const selectedCity = @json($umkm->address->city ?? '');
                                                                                const selectedDistrict = @json($umkm->address->district ?? '');

                                                                                // Fetch provinces
                                                                                fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                                                                                    .then(response => response.json())
                                                                                    .then(provinces => {
                                                                                        provinces.forEach(province => {
                                                                                            const option = document.createElement('option');
                                                                                            option.value = province.name;
                                                                                            option.textContent = province.name;
                                                                                            option.dataset.id = province.id;
                                                                                            if (province.name === selectedProvince) {
                                                                                                option.selected = true;
                                                                                            }
                                                                                            provinceSelect.appendChild(option);
                                                                                        });

                                                                                        // If province already selected, trigger change to load cities
                                                                                        if (selectedProvince) {
                                                                                            provinceSelect.dispatchEvent(new Event('change'));
                                                                                        }
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
                                                                                                    if (regency.name === selectedCity) {
                                                                                                        option.selected = true;
                                                                                                    }
                                                                                                    citySelect.appendChild(option);
                                                                                                });

                                                                                                // If city already selected, trigger change to load districts
                                                                                                if (selectedCity) {
                                                                                                    citySelect.dispatchEvent(new Event('change'));
                                                                                                }
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
                                                                                                    if (district.name === selectedDistrict) {
                                                                                                        option.selected = true;
                                                                                                    }
                                                                                                    districtSelect.appendChild(option);
                                                                                                });
                                                                                            });
                                                                                    }
                                                                                });

                                                                                // If province and city already selected, load cities and districts on page load
                                                                                if (selectedProvince) {
                                                                                    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                                                                                        .then(response => response.json())
                                                                                        .then(provinces => {
                                                                                            const province = provinces.find(p => p.name === selectedProvince);
                                                                                            if (province) {
                                                                                                citySelect.disabled = false;
                                                                                                fetch(
                                                                                                        `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${province.id}.json`)
                                                                                                    .then(response => response.json())
                                                                                                    .then(regencies => {
                                                                                                        regencies.forEach(regency => {
                                                                                                            const option = document.createElement('option');
                                                                                                            option.value = regency.name;
                                                                                                            option.textContent = regency.name;
                                                                                                            option.dataset.id = regency.id;
                                                                                                            if (regency.name === selectedCity) {
                                                                                                                option.selected = true;
                                                                                                            }
                                                                                                            citySelect.appendChild(option);
                                                                                                        });

                                                                                                        // If city already selected, load districts
                                                                                                        if (selectedCity) {
                                                                                                            const regency = regencies.find(r => r.name === selectedCity);
                                                                                                            if (regency) {
                                                                                                                districtSelect.disabled = false;
                                                                                                                fetch(
                                                                                                                        `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regency.id}.json`)
                                                                                                                    .then(response => response.json())
                                                                                                                    .then(districts => {
                                                                                                                        districts.forEach(district => {
                                                                                                                            const option = document.createElement(
                                                                                                                                'option');
                                                                                                                            option.value = district.name;
                                                                                                                            option.textContent = district.name;
                                                                                                                            if (district.name ===
                                                                                                                                selectedDistrict) {
                                                                                                                                option.selected = true;
                                                                                                                            }
                                                                                                                            districtSelect.appendChild(option);
                                                                                                                        });
                                                                                                                    });
                                                                                                            }
                                                                                                        }
                                                                                                    });
                                                                                            }
                                                                                        });
                                                                                }
                                                                            });
                                                                        </script>

                                                                        <label class="block mb-1 font-medium">Kode Pos
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="text" name="post_code"
                                                                            value="{{ $umkm->address->post_code }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Kode Pos" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Kode
                                                                            pos lokasi UMKM.</small>

                                                                        <label class="block mb-1 font-medium">Petunjuk
                                                                            Pengiriman <span
                                                                                class="text-red-600">*</span></label>
                                                                        <textarea name="delivery_instructions" class="w-full px-3 py-2 mb-2 border rounded" placeholder="Petunjuk Pengiriman"
                                                                            required>{{ $umkm->address->delivery_instructions }}</textarea>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Petunjuk
                                                                            tambahan untuk pengiriman.</small>
                                                                    </div>

                                                                    <!-- Store Data Section -->
                                                                    <div>
                                                                        <h4 class="mb-3 font-semibold">Data Toko</h4>
                                                                        <label class="block mb-1 font-medium">Nama UMKM
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="text" name="store_name"
                                                                            value="{{ $umkm->store_name }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Nama UMKM" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Nama
                                                                            usaha/UMKM.</small>

                                                                        <label class="block mb-1 font-medium">Nama Pemilik
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="text" name="owner_name"
                                                                            value="{{ $umkm->owner_name }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Nama Pemilik" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Nama
                                                                            pemilik UMKM.</small>

                                                                        <label class="block mb-1 font-medium">Kategori
                                                                            Usaha <span
                                                                                class="text-red-600">*</span></label>
                                                                        <input type="text" name="business_type"
                                                                            value="{{ $umkm->business_type }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Kategori Usaha" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Jenis/kategori
                                                                            usaha.</small>

                                                                        <label class="block mb-1 font-medium">Deskripsi
                                                                            UMKM <span
                                                                                class="text-red-600">*</span></label>
                                                                        <input type="text" name="description"
                                                                            value="{{ $umkm->description }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Deskripsi UMKM" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Deskripsi
                                                                            singkat tentang UMKM.</small>

                                                                        <label class="block mb-1 font-medium">Email Toko
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="email" name="store_email"
                                                                            value="{{ $umkm->email }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Email" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Email
                                                                            resmi toko/UMKM.</small>

                                                                        <label class="block mb-1 font-medium">No. Telp Toko
                                                                            <span class="text-red-600">*</span></label>
                                                                        <input type="number" name="store_phone_number"
                                                                            value="{{ $umkm->phone_number }}"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            placeholder="Contoh: 6287755819001" required>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Nomor
                                                                            telepon toko/UMKM.</small>

                                                                        <label class="block mb-1 font-medium">Status <span
                                                                                class="text-red-600">*</span></label>
                                                                        <select name="status"
                                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                                            required>
                                                                            <option value="1"
                                                                                {{ $umkm->status == 1 ? 'selected' : '' }}>
                                                                                Aktif</option>
                                                                            <option value="0"
                                                                                {{ $umkm->status == 0 ? 'selected' : '' }}>
                                                                                Tidak Aktif</option>
                                                                        </select>
                                                                        <small
                                                                            class="block mb-4 text-xs text-gray-500">Status
                                                                            aktif/tidak aktif UMKM.</small>
                                                                    </div>
                                                                </div>

                                                                <!-- Logo Upload Section -->
                                                                <h4 class="mt-6 mb-3 font-semibold">Logo Toko</h4>
                                                                <label class="block mb-1 font-medium">Upload Logo</label>
                                                                <input type="file" name="logo"
                                                                    class="w-full px-3 py-2 mb-2 border rounded"
                                                                    accept="image/*">
                                                                <small class="block mb-4 text-xs text-gray-500">
                                                                    Format gambar (jpg, png, jpeg). Kosongkan jika tidak ingin mengganti logo.
                                                                </small>

                                                                <!-- Submit Button -->
                                                                <button type="submit"
                                                                    class="px-4 py-2 mt-4 text-white bg-indigo-600 rounded">
                                                                    Simpan Perubahan Data
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <!-- End Edit Modal -->

                                                <!-- Start Show Detail Modal -->
                                                <dialog id="viewModal{{ $umkm->id }}"
                                                    class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                                                    <div class="relative h-auto md:w-[960px] w-full">
                                                        <!-- Adjusted width for larger modal -->
                                                        <!-- Modal Header with Close Button -->
                                                        <div
                                                            class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                                            <h3 class="text-lg font-bold">Detail Data UMKM</h3>
                                                            <!-- Close Button (X) -->
                                                            <form method="dialog">
                                                                <button
                                                                    class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                                                    <i data-feather="x" class="text-white size-4"></i>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal Content -->
                                                        <div class="p-6">
                                                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                                                <!-- Grid for 3 columns -->

                                                                <!-- User Data Section -->
                                                                <div>
                                                                    <h4 class="mb-3 font-semibold">Data Akun</h4>
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
                                                                    <h4 class="mb-3 font-semibold">Data Alamat</h4>
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
                                                                    <h4 class="mb-3 font-semibold">Data Toko</h4>
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
                                                            <h4 class="mt-6 mb-3 font-semibold">Logo Toko</h4>
                                                            @if ($umkm->logo)
                                                                <img src="{{ asset('storage/logos/' . $umkm->logo) }}"
                                                                    alt="{{ $umkm->logo }}" class="mb-4 rounded-md"
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
                                                            <p>Apakah anda yakin menghapus data {{ $umkm->name }}?</p>
                                                            <form
                                                                action="{{ route('superadmin.data-master.umkm.destroy', $umkm->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="px-4 py-2 mt-6 text-white bg-red-600 rounded">Ya,
                                                                    Hapus</button>
                                                                <button type="button"
                                                                    class="px-4 py-2 mt-6 text-black bg-gray-300 rounded"
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
                                    <!-- Pagination Links -->
                                </div>
                                <div class="mt-4">
                                    {{ $stores->links('pagination::simple-tailwind') }}
                                </div>
                                <!-- Start Add Modal -->
                                <dialog id="addModal"
                                    class="bg-white rounded-md shadow dark:shadow-gray-800 dark:bg-slate-900 text-slate-900 dark:text-white">
                                    <div class="relative h-auto md:w-[960px] w-full">
                                        <!-- Adjusted width for larger modal -->
                                        <div
                                            class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                                            <h3 class="text-lg font-bold">Tambah Store Baru</h3>
                                            <form method="dialog">
                                                <button
                                                    class="flex items-center justify-center bg-red-600 rounded-md shadow size-6 dark:shadow-gray-800 btn-ghost">
                                                    <i data-feather="x" class="text-white size-4"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="p-6">
                                            <form action="{{ route('superadmin.data-master.umkm.store') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @method('POST')
                                                @csrf
                                                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                                    <!-- User Data Section -->
                                                    <div>
                                                        <h4 class="mb-3 font-semibold">Data Akun</h4>
                                                        <label class="block mb-1 font-medium">Nama Akun <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="name"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Nama Akun" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Masukkan nama
                                                            lengkap akun pengguna.</small>

                                                        <label class="block mb-1 font-medium">Username <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="username"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Username" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Username unik untuk
                                                            login.</small>

                                                        <label class="block mb-1 font-medium">Email <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="email" name="email"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Email" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Alamat email aktif
                                                            pengguna.</small>

                                                        <label class="block mb-1 font-medium">No. Telp <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="number" name="phone_number"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Contoh: 6287755819001" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Nomor telepon yang
                                                            dapat dihubungi.</small>

                                                        <label class="block mb-1 font-medium">Password <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="password" name="password"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Password" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Minimal 8
                                                            karakter.</small>

                                                        <label class="block mb-1 font-medium">Konfirmasi Password <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="password" name="password_confirmation"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Konfirmasi Password" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Ulangi password di
                                                            atas.</small>
                                                    </div>

                                                    <!-- Address Data Section -->
                                                    <div>
                                                        <h4 class="mb-3 font-semibold">Data Alamat</h4>
                                                        <label class="block mb-1 font-medium">Alamat <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="address"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Alamat" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Alamat lengkap
                                                            UMKM.</small>

                                                        <!-- Province -->
                                                        <div>
                                                            <label class="font-semibold form-label">Provinsi: <span
                                                                    class="text-red-600">*</span></label>
                                                            <select id="province-select" name="province"
                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                required>
                                                                <option value="">Pilih Provinsi</option>
                                                                <!-- Options will be populated by JS -->
                                                            </select>
                                                        </div>

                                                        <!-- City -->
                                                        <div>
                                                            <label class="font-semibold form-label">Kota: <span
                                                                    class="text-red-600">*</span></label>
                                                            <select id="city-select" name="city"
                                                                class="w-full h-10 px-3 py-2 mt-2 border border-gray-200 rounded form-select dark:bg-slate-900 dark:text-slate-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600"
                                                                required disabled>
                                                                <option value="">Pilih Kota/Kabupaten</option>
                                                                <!-- Options will be populated by JS -->
                                                            </select>
                                                        </div>

                                                        <!-- District -->
                                                        <div>
                                                            <label class="font-semibold form-label">Kecamatan: <span
                                                                    class="text-red-600">*</span></label>
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
                                                                // For add modal, no preselected values
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

                                                        <label class="block mb-1 font-medium">Kode Pos <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="post_code"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Kode Pos" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Kode pos lokasi
                                                            UMKM.</small>

                                                        <label class="block mb-1 font-medium">Petunjuk Pengiriman <span
                                                                class="text-red-600">*</span></label>
                                                        <textarea name="delivery_instructions" class="w-full px-3 py-2 mb-2 border rounded" placeholder="Petunjuk Pengiriman"
                                                            required></textarea>
                                                        <small class="block mb-4 text-xs text-gray-500">Petunjuk tambahan
                                                            untuk pengiriman.</small>
                                                    </div>

                                                    <!-- Store Data Section -->
                                                    <div>
                                                        <h4 class="mb-3 font-semibold">Data Toko</h4>
                                                        <label class="block mb-1 font-medium">Nama UMKM <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="store_name"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Nama UMKM" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Nama
                                                            usaha/UMKM.</small>

                                                        <label class="block mb-1 font-medium">Nama Pemilik <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="owner_name"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Nama Pemilik" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Nama pemilik
                                                            UMKM.</small>

                                                        <label class="block mb-1 font-medium">Kategori Usaha <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="business_type"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Kategori Usaha" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Jenis/kategori
                                                            usaha.</small>

                                                        <label class="block mb-1 font-medium">Deskripsi UMKM <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="text" name="description"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Deskripsi UMKM" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Deskripsi singkat
                                                            tentang UMKM.</small>

                                                        <label class="block mb-1 font-medium">Email Toko <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="email" name="store_email"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Email" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Email resmi
                                                            toko/UMKM.</small>

                                                        <label class="block mb-1 font-medium">No. Telp Toko <span
                                                                class="text-red-600">*</span></label>
                                                        <input type="number" name="store_phone_number"
                                                            class="w-full px-3 py-2 mb-2 border rounded"
                                                            placeholder="Contoh: 6287755819001" required>
                                                        <small class="block mb-4 text-xs text-gray-500">Nomor telepon
                                                            toko/UMKM.</small>

                                                        <label class="block mb-1 font-medium">Status <span
                                                                class="text-red-600">*</span></label>
                                                        <select name="status"
                                                            class="w-full px-3 py-2 mb-2 border rounded" required>
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Tidak Aktif</option>
                                                        </select>
                                                        <small class="block mb-4 text-xs text-gray-500">Status aktif/tidak
                                                            aktif UMKM.</small>
                                                    </div>
                                                </div>

                                                <!-- Logo Upload Section -->
                                                <div class="mt-8">
                                                    <h4 class="mb-3 font-semibold">Logo Toko</h4>
                                                    <label class="block mb-1 font-medium">Upload Logo <span
                                                            class="text-red-600">*</span></label>
                                                    <input type="file" name="logo"
                                                        class="w-full px-3 py-2 mb-2 border rounded" accept="image/*"
                                                        required>
                                                    <small class="block mb-4 text-xs text-gray-500">Format gambar (jpg,
                                                        png, jpeg). Wajib diisi.</small>
                                                </div>

                                                <button type="submit"
                                                    class="px-6 py-2 mt-4 text-white bg-indigo-600 rounded">Tambah
                                                    UMKM</button>
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
