@extends('school.layout.default')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-start">
            <div class="mb-4 text-center">
                <h2>Laporan Sekolah</h2>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card p-2">
                    <div class="card-header p-3 pt-2 rounded-circle">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="bi bi-bank2 opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tahun Akademik</p>
                            <h4 class="mb-0">{{ $academicYear->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card p-2">
                    <div class="card-header p-3 pt-2 rounded-circle">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="bi bi-bank2 opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jumlah Jurusan</p>
                            <h4 class="mb-0">{{ $major->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card p-2">
                    <div class="card-header p-3 pt-2 rounded-circle">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="bi bi-bank2 opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jumlah Siswa</p>
                            <h4 class="mb-0">{{ $students->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card p-2">
                    <div class="card-header p-3 pt-2 rounded-circle">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="bi bi-person opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jumlah Guru</p>
                            <h4 class="mb-0">{{ $teachers->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card p-2">
                    <div class="card-header p-3 pt-2 rounded-circle">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="bi bi-person opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jumlah Kelas</p>
                            <h4 class="mb-0">{{ $subclass->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card p-2">
                    <div class="card-header p-3 pt-2 rounded-circle">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="bi bi-person opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Jumlah Pelajaran</p>
                            <h4 class="mb-0">{{ $courses->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
