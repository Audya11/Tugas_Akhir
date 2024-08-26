@extends('school.layout.default')
@section('content')
    <div>
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Tahun Akademik</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#academicCreateModal">Tambah
                data
                +</button>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" id="search" name="search-input" class="form-control border"
                    placeholder="Cari Tahun Akademik...">
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
                                Tahun Ajaran</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Status</th>

                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>


                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if ($academicYears->count() === 0)
                            <p>Tidak ada data Tahun Akademik</p>
                        @endif
                        @foreach ($academicYears as $year)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $year->year }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $year->status }}</p>
                                </td>
                                <td class="align-middle justify-content-center align-items-center d-flex gap-2">

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#academicEditModal{{ $year->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="/school/dashboard/academic-year/{{ $year->id }}" method="POST">
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

        <div class="modal fade" id="academicCreateModal" tabindex="-1" aria-labelledby="academicCreateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tahun Akademik</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/school/dashboard/academic-year" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tahun Ajaran</label>
                                <input type="text" name="year" class="form-control" id="year" required>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Status</label>
                                <select name="status" id="" class="form-select" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
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

        @foreach ($academicYears as $year)
            <div class="modal fade" id="academicEditModal{{ $year->id }}" tabindex="-1"
                aria-labelledby="academicEditModalLabel{{ $year->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Tahun Akademik</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/school/dashboard/academic-year/{{ $year->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Tahun Ajaran</label>
                                    <input type="text" name="year" class="form-control" id="year"
                                        value="{{ $year->year }}">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select name="status" id="" class="form-select">
                                        <option value="${ $year->status }">{{ $year->status }}</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
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
                    fetch(`{{ route('academicYear.search') }}?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            tableBody.innerHTML = '';

                            if (data.length > 0) {
                                data.forEach((year, index) => {
                                    const row = document.createElement('tr');

                                    row.innerHTML = `
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${index + 1}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${year.year}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${year.status}</p></td>
                                        <td class="align-middle justify-content-center align-items-center d-flex gap-2">
                                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#academicEditModal${year.id}"><i class="bi bi-pencil-square"></i></button>

                                            <form action="/school/dashboard/academic-year/${year.id}" method="POST">
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
