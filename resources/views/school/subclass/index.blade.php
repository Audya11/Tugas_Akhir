@extends('school.layout.default')
@section('content')
    <div>
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Sub Kelas</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subclassCreateModal">Tambah
                data
                +</button>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" id="search" name="search-input" class="form-control border"
                    placeholder="Cari Sub Kelas...">
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
                                Kelas</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Sub Kelas</th>

                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>


                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if ($subclasses->count() === 0)
                            <p>Tidak ada data Sub Kelas</p>
                        @endif
                        @foreach ($subclasses as $subclass)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $subclass->class->name }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $subclass->name }}</p>
                                </td>

                                <td class="align-middle justify-content-center align-items-center d-flex gap-2">

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#subclassEditModal{{ $subclass->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="/school/dashboard/subclass/{{ $subclass->id }}" method="POST">
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

        <div class="modal fade" id="subclassCreateModal" tabindex="-1" aria-labelledby="subclassCreateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Sub Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/school/dashboard/subclass" method="POST">
                            @csrf
                            <div class="mb-3">
                                <select name="class_id" id="" class="form-select" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Sub Kelas</label>
                                <input type="text" name="name" class="form-control" id="subclass" required>
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

        @foreach ($subclasses as $subclass)
            <div class="modal fade" id="subclassEditModal{{ $subclass->id }}" tabindex="-1"
                aria-labelledby="subclassEditModalLabel{{ $subclass->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Sub Kelas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/school/dashboard/subclass/{{ $subclass->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="class_id" id="" class="form-select" required>
                                    <option value="{{ $subclass->class->id }}">{{ $subclass->class->name }}</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nama Sub Kelas</label>
                                    <input type="text" name="name" class="form-control" id="subclass"
                                        value="{{ $subclass->name }}">
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

                    console.log(query);
                    fetch(`{{ route('subkelas.search') }}?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            tableBody.innerHTML = '';

                            if (data.length > 0) {
                                data.forEach((subkelas, index) => {
                                    const row = document.createElement('tr');

                                    row.innerHTML = `
                                            <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${index + 1}</p></td>
                                            <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${subkelas.class.name}</p></td>
                                            <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${subkelas.name}</p></td>
                                            <td class="align-middle justify-content-center align-items-center d-flex gap-2">
                                                <a href="/school/dashboard/subclass/${subkelas.id}/edit" class="btn btn-warning" data-toggle="tooltip" data-original-title="Edit user"><i class="bi bi-pencil-square"></i></a>
                                                <form action="/school/dashboard/subclass/${subkelas.id}" method="POST">
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
