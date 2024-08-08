@extends('admin.layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="collor-button shadow-primary border-radius-lg">
            <h4 class="text-dark text-capitalize ps-3">Details</h4>
        </div>
        <div class="card my-4 w-75">
            <div class='container'>
                <form  method="POST" enctype="multipart/form-data" class="w-100 mt-4 mb-4">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="paket">Paket</label>
                            <input type="text" id="paket" name="paket"  class="form-control w-100 " value="{{ $sekolah->paket }}" disabled>   
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="type">Type</label>
                            <select id="type" name="type" disabled required class="form-select">
                                <option value="">{{ $sekolah->type }}</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                            </select>   
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label><br>
                            <input type="radio" id="active" name="status" disabled value="active" {{ $sekolah->status == 'active' ? 'checked' : '' }} required>
                            <label for="active">Aktif</label>
                            <input type="radio" id="inactive" name="status" disabled value="inactive" {{ $sekolah->status == 'inactive' ? 'checked' : '' }}>
                            <label for="inactive">Nonaktif</label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" id="nama_sekolah" name="nama_sekolah" disabled value="{{ $sekolah->nama_sekolah }}"  class="form-control border">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                            <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" disabled value="{{ $sekolah->tanggal_kadaluarsa }}" required class="form-control border">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="provinsi">Provinsi</label>
                            <select id="provinsi" name="provinsi" required  class="form-control w-100" disabled> 
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="kota">Kota</label>
                            <select id="kota" name="kota" required class="form-select w-100" disabled>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kecamatan">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan" required class="form-control w-100" disabled>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="kelurahan">Kelurahan</label>
                            <select id="kelurahan" name="kelurahan" required class="form-control w-100" disabled>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" disabled class="form-control border">{{ $sekolah->alamat }}</textarea>
                    </div>

                    <a href="/daftar_sekolah" class="btn collor-button text-white shadow bg-primary" type="submit" name="submit">Kembali</a>
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
            const selectedProvince = data.provinsi.find(prov => prov.id === parseInt(provinceId));
            const option = document.createElement('option');
            option.value = selectedProvince.id;
            option.textContent = selectedProvince.nama;
            option.selected = true;
            province.appendChild(option);

            // Load cities after provinces
            loadCities(provinceId, cityId);
        })
        .catch(error => console.error('Error:', error));

    function loadCities(provinceId, selectedCityId = null) {
        const cityUrl = `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${provinceId}`;
        fetch(cityUrl)
            .then(response => response.json())
            .then(data => {
                const selectedCity = data.kota_kabupaten.find(kota => kota.id === parseInt(selectedCityId));
                const option = document.createElement('option');
                option.value = selectedCity.id;
                option.textContent = selectedCity.nama;
                option.selected = true;
                city.appendChild(option);

                // Load districts after cities
                loadDistricts(selectedCityId, districtId);
            })
            .catch(error => console.error('Error:', error));
    }

    function loadDistricts(cityId, selectedDistrictId = null) {
        const districtUrl = `https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${cityId}`;
        fetch(districtUrl)
            .then(response => response.json())
            .then(data => {
                const selectedDistrict = data.kecamatan.find(kec => kec.id === parseInt(selectedDistrictId));
                const option = document.createElement('option');
                option.value = selectedDistrict.id;
                option.textContent = selectedDistrict.nama;
                option.selected = true;
                district.appendChild(option);

                // Load subdistricts after districts
                loadSubdistricts(selectedDistrictId, subdistrictId);
            })
            .catch(error => console.error('Error:', error));
    }

    function loadSubdistricts(districtId, selectedSubdistrictId = null) {
        const subdistrictUrl = `https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${districtId}`;
        fetch(subdistrictUrl)
            .then(response => response.json())
            .then(data => {
                const selectedSubdistrict = data.kelurahan.find(kel => kel.id === parseInt(selectedSubdistrictId));
                const option = document.createElement('option');
                option.value = selectedSubdistrict.id;
                option.textContent = selectedSubdistrict.nama;
                option.selected = true;
                subdistrict.appendChild(option);
            })
            .catch(error => console.error('Error:', error));
    }
</script>
                            
                            
   
@endsection