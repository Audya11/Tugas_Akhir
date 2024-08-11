@extends('admin.layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="collor-button shadow-primary border-radius-lg">
            <h4 class="text-dark text-capitalize ps-3">Tambah Data Pegawai</h4>
        </div>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="card my-4 w-75">
            <div class='container'>
                <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data" class="w-100 mt-4 mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Nama</label>
                            <input type="text" id="name" value="{{ old('name') }}" name="name" required class="form-control border"  placeholder="Masukkan Nama">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required class="form-control border" placeholder="Masukkan Email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required class="form-control border" placeholder="Masukkan Password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" required class="form-control border" placeholder="Masukkan Alamat"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <input type="text" id="role" value="{{ old('role') }}" name="role" required class="form-control border"  placeholder="Masukkan role">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_telp" class="form-label">No. Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" required class="form-control border @error('no_telp') is-invalid @enderror" placeholder="Masukkan nomor telepon">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_laki_laki" name="jenis_kelamin" value="Laki-Laki" required>
                                <label class="form-check-label" for="jenis_kelamin_laki_laki">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="Perempuan" required>
                                <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name='photo'
                                class="form-control border-top-0  border-1"required
                                placeholder="Masukkan Nama PIC">
                        </div>
                    </div>
                
                    <button class="btn collor-button text-white shadow bg-primary" type="submit" name="submit">Save</button>
                </form>
             
            </div>
        </div>
    </div>
</div>

{{-- <script>
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
</script> --}}
   
@endsection