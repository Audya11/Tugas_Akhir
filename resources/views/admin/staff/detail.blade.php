@extends('admin.layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="collor-button shadow-primary border-radius-lg">
            <h4 class="text-dark text-capitalize ps-3">Detail Data Pegawai</h4>
        </div>

        <div class="card my-4 w-75">
            <div class='container'>
                <form class="w-100 mt-4 mb-4">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Nama</label>
                            <input type="text" id="name" value="{{ $staff->name }}" name="name" disabled required class="form-control border"  >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $staff->email }}" disabled required class="form-control border" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat"   required class="form-control border" disabled>{{ $staff->alamat }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <input type="text" id="role" value="{{ $staff->role }}" name="role" required class="form-control border" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_telp" class="form-label">No. Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" value="{{ $staff->no_telp }}" required class="form-control border" disabled >
                           
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_laki_laki" name="jenis_kelamin" value="Laki-Laki" 
                                    {{ $staff->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="jenis_kelamin_laki_laki">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="Perempuan" 
                                    {{ $staff->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name='photo'
                                value="{{ $staff->photo }}" disabled
                                class="form-control border-top-0  border-1"
                                placeholder="Masukkan Nama PIC">
                        </div> --}}
                    </div>
                
                    <a href="/dashboard/staff" class="btn collor-button text-white shadow bg-primary" type="button" >Kembali</a>
                </form>
             
            </div>
        </div>
    </div>
</div>
@endsection