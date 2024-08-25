@extends('school.layout.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Profil Sekolah</h1>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card my-4 w-75 p-3">
                <div class='container'>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-control border"
                                value="{{ $sekolah->nama_sekolah }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control border"
                                value="{{ Auth::user()->email }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type">Type</label>
                            <input type="text" id="type" name="type" class="form-control border"
                                value="{{ $sekolah->type }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="paket">Paket</label>
                            <input type="text" id="paket" name="paket" class="form-control border"
                                value="{{ $sekolah->paket }}" disabled>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                        <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control border"
                            value="{{ $sekolah->tanggal_kadaluarsa }}" disabled>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi" id="provinsi" class="form-select" disabled>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kota">Kota</label>
                        <select id="kota" name="kota" class="form-select" disabled>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kecamatan">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="form-select" disabled>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kelurahan">Kelurahan</label>
                        <select id="kelurahan" name="kelurahan" class="form-select" disabled>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control border" disabled>{{ $sekolah->alamat }}</textarea>
                    </div>
                </div>


            </div>

            <h1>Ganti Password</h1>
            <div class="card my-4 w-75 p-3">

                <div class="row">
                    <form action="/school/change-password" method="POST">
                        @csrf
                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control border">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="new_password">Password Baru</label>
                            <input type="password" id="new_password" name="new_password" class="form-control border">
                        </div>
                        <button class="btn btn-primary" type="submit">Ubah</button>
                    </form>

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
        </script>
    @endsection
