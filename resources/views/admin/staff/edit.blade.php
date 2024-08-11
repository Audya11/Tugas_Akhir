@extends('admin.layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="collor-button shadow-primary border-radius-lg">
            <h4 class="text-dark text-capitalize ps-3">Edit Data Pegawai</h4>
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
                <form action="{{ route('staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data" class="w-100 mt-4 mb-4">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Nama</label>
                            <input type="text" id="name" value="{{ $staff->name }}" name="name" required class="form-control border"  placeholder="Masukkan Nama">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $staff->email }}" required class="form-control border" placeholder="Masukkan Email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat"   required class="form-control border" placeholder="Masukkan Alamat">{{ $staff->alamat }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <input type="text" id="role" value="{{ $staff->role }}" name="role" required class="form-control border"  placeholder="Masukkan role">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_telp" class="form-label">No. Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" value="{{ $staff->no_telp }}" required class="form-control border @error('no_telp') is-invalid @enderror" placeholder="Masukkan nomor telepon">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_laki_laki" name="jenis_kelamin" value="Laki-Laki" 
                                    {{ $staff->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jenis_kelamin_laki_laki">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="Perempuan" 
                                    {{ $staff->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name='photo'
                                value="{{ $staff->photo }}"
                                class="form-control border-top-0  border-1"
                                placeholder="Masukkan Nama PIC">
                        </div>
                    </div>
                
                    <button class="btn collor-button text-white shadow bg-primary" type="submit" name="submit">Save</button>
                </form>
             
            </div>
        </div>
    </div>
</div>
@endsection