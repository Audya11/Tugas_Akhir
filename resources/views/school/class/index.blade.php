@extends('school.layout.default')
@section('content')
    <div>
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Kelas</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#classCreateModal">Tambah
                data
                +</button>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" id="search" name="search-input" class="form-control border"
                    placeholder="Cari Kelas...">
            </div>
        </div>

        <div class="card-body px-0 pb-2 fs-6 text-left">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive p-0">
                <table class="table table-striped table-bordered mb-0 " id="school_table">
                    <thead class="table-dark">
                        <tr>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                #</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama Kelas</th>

                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>


                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if ($classes->count() === 0)
                            <p>Tidak ada data Kelas</p>
                        @endif
                        @foreach ($classes as $class)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $class->name }}</p>
                                </td>

                                <td class="align-middle justify-content-center align-items-center d-flex gap-2">

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#classEditModal{{ $class->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="/school/dashboard/class/{{ $class->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash3"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="classCreateModal" tabindex="-1" aria-labelledby="academicCreateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/school/dashboard/class" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama Kelas</label>
                            <input type="text" name="name" class="form-control" id="class" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($classes as $class)
        <div class="modal fade" id="classEditModal{{ $class->id }}" tabindex="-1"
            aria-labelledby="classEditModalLabel{{ $class->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/school/dashboard/class/{{ $class->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tahun Ajaran</label>
                                <input type="text" name="name" class="form-control" id="class"
                                    value="{{ $class->name }}">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const tableBody = document.getElementById('table-body');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value.trim();

                fetch(`{{ route('kelas.search') }}?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach((kelas, index) => {
                                const row = document.createElement('tr');

                                row.innerHTML = `
                                <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${index + 1}</p></td>
                                <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${kelas.name}</p></td>
                                <td class="align-middle justify-content-center align-items-center d-flex gap-2">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#classEditModal${kelas.id}"><i class="bi bi-pencil-square"></i></button>
                                    
                                    <form action="/school/dashboard/class/${kelas.id}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            `;

                                tableBody.appendChild(row);
                            });
                        } else {
                            tableBody.innerHTML =
                                '<tr><td colspan="9" class="text-center">No results found</td></tr>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
