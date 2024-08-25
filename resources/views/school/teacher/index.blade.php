@extends('school.layout.default')
@section('content')
    <div>
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Guru</h3>
            <a href="/school/dashboard/teacher/create" class="btn collor-button btn-primary rounded "
                style="color: white;">tambah
                data <i class="fas fa-plus-square"></i></a>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" id="search" name="search-input" class="form-control border"
                    placeholder="Cari Guru...">
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
                                nama</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Sekolah</th>

                            <th
                                class=" align-middle text-center text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                NIP</th>
                            <th
                                class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                                Kelas
                            </th>
                            <th
                                class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                                No. Telp
                            </th>
                            <th
                                class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                                Alamat
                            </th>
                            <th
                                class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $loop->iteration }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $teacher->nama }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">

                                        {{ $teacher->school->nama_sekolah }}

                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $teacher->nip }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $teacher->kelas }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $teacher->no_telp }}</p>
                                </td>

                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $teacher->alamat }}</p>
                                </td>
                                <td class="align-middle justify-content-center align-items-center d-flex gap-2">
                                    <a href="/school/dashboard/teacher/{{ $teacher->id }}/edit" class="btn btn-warning"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="/school/dashboard/teacher/{{ $teacher->id }}" method="POST">
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search');
                const tableBody = document.getElementById('table-body');

                searchInput.addEventListener('input', function() {
                    const query = searchInput.value.trim();

                    fetch(`{{ route('teacher.search') }}?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            tableBody.innerHTML = '';

                            if (data.length > 0) {
                                data.forEach((teacher, index) => {
                                    const row = document.createElement('tr');

                                    row.innerHTML = `
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${index + 1}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${teacher.nama}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${teacher.school.nama_sekolah}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${teacher.nip}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${teacher.kelas}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${teacher.no_telp}</p></td>
                                        <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${teacher.alamat}</p></td>
                                       
                                        <td class="align-middle justify-content-center align-items-center d-flex gap-2">
                                            <a href="/school/dashboard/teacher/${teacher.id}/edit" class="btn btn-warning" data-toggle="tooltip" data-original-title="Edit user"><i class="bi bi-pencil-square"></i></a>
                                            <form action="/school/dashboard/teacher/${teacher.id}" method="POST">
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
