@extends('school.layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="collor-button shadow-primary border-radius-lg">
                <h4 class="text-dark text-capitalize ps-3">Detail Guru</h4>
            </div>

            <div class="card my-4 w-75">
                <div class='container'>
                    <form class="w-100 mt-4 mb-4">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" value="{{ $teacher->nama }}" disabled
                                    class="form-control border">
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nis">NIS</label>
                                    <input type="text" id="nis" name="nis" value="{{ $teacher->nip }}"
                                        class="form-control border" disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="kelas">Kelas</label>
                                    <select id="kelas" name="kelas" class="form-select" disabled>
                                        <option value="{{ $teacher->kelas }}">{{ $teacher->kelas }}</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Jenis Kelamin</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="jenis_kelamin_laki_laki"
                                            name="jenis_kelamin" value="Laki-Laki"
                                            {{ $teacher->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="jenis_kelamin_laki_laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="jenis_kelamin_perempuan"
                                            name="jenis_kelamin" value="Perempuan"
                                            {{ $teacher->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="agama">Agama</label>
                                    <select id="agama" name="agama" class="form-select" disabled>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ $teacher->agama == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{ $teacher->agama == 'Kristen' ? 'selected' : '' }}>Kristen
                                        </option>
                                        <option value="Budha" {{ $teacher->agama == 'Budha' ? 'selected' : '' }}>Budha
                                        </option>
                                        <option value="Hindu" {{ $teacher->agama == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Khonghucu" {{ $teacher->agama == 'Khonghucu' ? 'selected' : '' }}>
                                            Khonghucu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $teacher->email) }}" class="form-control border" disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="no_telp" class="form-label">No. Telepon</label>
                                    <input type="text" id="no_telp" name="no_telp"
                                        value="{{ old('no_telp', $teacher->no_telp) }}"
                                        class="form-control border @error('no_telp') is-invalid @enderror"
                                        placeholder="Masukkan nomor telepon" disabled>
                                    @error('no_telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control border" disabled>{{ $teacher->alamat }}</textarea>
                            </div>

                            <a href="/school/dashboard/student" class="btn collor-button text-white shadow bg-primary"
                                type="button">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
