@extends('admin.layouts.default')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="collor-button shadow-primary border-radius-lg">
                <h4 class="text-dark text-capitalize ps-3">Edit Data Sekolah</h4>
            </div>

            <div class="card my-4 w-75">
                <div class='container'>
                    <form action="{{ route('sekolah.update', $sekolah->id) }}" method="POST" enctype="multipart/form-data"
                        class="w-100 mt-4 mb-4">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="paket">Paket</label>
                                <select id="paket" name="paket" class="form-select w-100">
                                    <option value="{{ $sekolah->paket }}">{{ $sekolah->paket }}</option>
                                    <option value="Akreditasi A">Akreditasi A</option>
                                    <option value="Akreditasi B">Akreditasi B</option>
                                    <option value="Akreditasi C">Akreditasi C</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status">Status</label><br>
                                <input type="radio" id="active" name="status" value="active"
                                    {{ $sekolah->status == 'active' ? 'checked' : '' }}>
                                <label for="active">Aktif</label>
                                <input type="radio" id="inactive" name="status" value="inactive"
                                    {{ $sekolah->status == 'inactive' ? 'checked' : '' }}>
                                <label for="inactive">Nonaktif</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" id="nama_sekolah" name="nama_sekolah"
                                    value="{{ $sekolah->nama_sekolah }}" class="form-control border">
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                                    value="{{ $sekolah->tanggal_kadaluarsa }}" class="form-control border">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="provinsi">Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-select w-100">
                                    <option value="{{ $sekolah->provinsi }}" disabled>{{ $sekolah->provinsi }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kota">Kota</label>
                                <select id="kota" name="kota" class="form-select w-100">
                                    <option value="{{ $sekolah->kota }}">{{ $sekolah->kota }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-select w-100">
                                    <option value="{{ $sekolah->kecamatan }}">{{ $sekolah->kecamatan }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kelurahan">Kelurahan</label>
                                <select id="kelurahan" name="kelurahan" class="form-select w-100">
                                    <option value="{{ $sekolah->kelurahan }}">{{ $sekolah->kelurahan }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control border">{{ $sekolah->alamat }}</textarea>
                        </div>

                        <button class="btn collor-button text-white shadow bg-primary" type="submit"
                            name="submit">Save</button>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        const province = document.getElementById('provinsi');
        const city = document.getElementById('kota');
        const district = document.getElementById('kecamatan');
        const subdistrict = document.getElementById('kelurahan');

        const provinceId = "{{ $sekolah->provinsi }}";
        const cityId = "{{ $sekolah->kota }}";
        const districtId = "{{ $sekolah->kecamatan }}";
        const subdistrictId = "{{ $sekolah->kelurahan }}";

        const urlProvince = "https://dev.farizdotid.com/api/daerahindonesia/provinsi";

        fetch(urlProvince)
            .then(response => response.json())
            .then(data => {
                data.provinsi.forEach(prov => {
                    const option = document.createElement('option');
                    option.value = prov.id;
                    option.textContent = prov.nama;
                    if (prov.id === provinceId) {
                        option.selected = true;
                    }
                    province.appendChild(option);
                });

                // Load cities after provinces
                loadCities(provinceId, cityId);
            })
            .catch(error => console.error('Error:', error));

        function loadCities(provinceId, selectedCityId = null) {
            const cityUrl = `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${provinceId}`;
            fetch(cityUrl)
                .then(response => response.json())
                .then(data => {
                    city.innerHTML = ''; // Menghapus opsi sebelumnya
                    data.kota_kabupaten.forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota.id;
                        option.textContent = kota.nama;
                        if (kota.id === selectedCityId) {
                            option.selected = true;
                        }
                        city.appendChild(option);
                    });

                    // Load districts after cities
                    if (selectedCityId) {
                        loadDistricts(selectedCityId, districtId);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadDistricts(cityId, selectedDistrictId = null) {
            const districtUrl = `https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${cityId}`;
            fetch(districtUrl)
                .then(response => response.json())
                .then(data => {
                    district.innerHTML = ''; // Menghapus opsi sebelumnya
                    data.kecamatan.forEach(kec => {
                        const option = document.createElement('option');
                        option.value = kec.id;
                        option.textContent = kec.nama;
                        if (kec.id === selectedDistrictId) {
                            option.selected = true;
                        }
                        district.appendChild(option);
                    });

                    // Load subdistricts after districts
                    if (selectedDistrictId) {
                        loadSubdistricts(selectedDistrictId, subdistrictId);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadSubdistricts(districtId, selectedSubdistrictId = null) {
            const subdistrictUrl = `https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${districtId}`;
            fetch(subdistrictUrl)
                .then(response => response.json())
                .then(data => {
                    subdistrict.innerHTML = ''; // Menghapus opsi sebelumnya
                    data.kelurahan.forEach(kel => {
                        const option = document.createElement('option');
                        option.value = kel.id;
                        option.textContent = kel.nama;
                        if (kel.id === selectedSubdistrictId) {
                            option.selected = true;
                        }
                        subdistrict.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        province.addEventListener('change', () => {
            loadCities(province.value);
        });

        city.addEventListener('change', () => {
            loadDistricts(city.value);
        });

        district.addEventListener('change', () => {
            loadSubdistricts(district.value);
        });
    </script>
@endsection
