@extends('admin.layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="collor-button shadow-primary border-radius-lg">
            <h4 class="text-dark text-capitalize ps-3">Tambah data Sekolah</h4>
        </div>
                
        <div class="card my-4 w-75">
            <div class='container'>
                <form action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data" class="w-100 mt-4 mb-4">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label for="nama_sekolah">Nama Sekolah</label>
                        <input type="text" id="nama_sekolah" name="nama_sekolah" required class="form-control border" placeholder="Masukkan Nama">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type">Type</label>
                            <select id="type" name="type" required class="form-select">
                                <option value="">Pilih Jenjang</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                            </select>   
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="paket">Paket</label>
                            <select id="paket" name="paket" required class="form-select">
                                <option value="">Pilih Paket</option>
                                <option value="Bronze">Bronze</option>
                                <option value="Gold">Gold</option>
                                <option value="Patinum">Platinum</option>
                            </select>   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status">Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="active" name="status" value="active" required>
                                <label class="form-check-label" for="active">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inactive" name="status" value="inactive">
                                <label class="form-check-label" for="inactive">Nonaktif</label>
                            </div>
                        </div>

                       
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                            <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required class="form-control border">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="provinsi">Provinsi</label>
                            <select id="provinsi" name="provinsi" required class="form-select">
                                <option value="" disabled>Pilih Provinsi</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kota">Kota</label>
                            <select id="kota" name="kota" required class="form-select">
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="kecamatan">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan" required class="form-select">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kelurahan">Kelurahan</label>
                            <select id="kelurahan" name="kelurahan" required class="form-select">
                                <option value="">Pilih Kelurahan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" required class="form-control border" placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>

                    <button class="btn collor-button text-white shadow bg-primary" type="submit" name="submit">Save</button>
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
    const postalCode = document.getElementById('kodepos');

    const url = "https://dev.farizdotid.com/api/daerahindonesia/provinsi";
    

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const provinceOptions = data.provinsi.map(provinsi => {
                return `<option value="${provinsi.id}">${provinsi.nama}</option>`;
            }).join('');
            province.innerHTML = provinceOptions;
        });

    province.addEventListener('change', (event) => {
        const selectedProvince = event.target.value;
        const url = `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${selectedProvince}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const cityOptions = data.kota_kabupaten.map(kota => {
                    return `<option value="${kota.id}">${kota.nama}</option>`;
                }).join('');
                city.innerHTML = cityOptions;
            });
    });

    city.addEventListener('change', (event) => {
        const selectedCity = event.target.value;
        const url = `https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${selectedCity}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const districtOptions = data.kecamatan.map(kecamatan => {
                    return `<option value="${kecamatan.id}">${kecamatan.nama}</option>`;
                }).join('');
                district.innerHTML = districtOptions;
            });
    });

    district.addEventListener('change', (event) => {
        const selectedDistrict = event.target.value;
        const url = `https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${selectedDistrict}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const subdistrictOptions = data.kelurahan.map(kelurahan => {
                    return `<option value="${kelurahan.id}">${kelurahan.nama}</option>`;
                }).join('');    
                subdistrict.innerHTML = subdistrictOptions;
            });
    });
</script>
   
@endsection