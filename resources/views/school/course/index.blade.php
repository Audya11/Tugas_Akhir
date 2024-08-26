@extends('school.layout.default')
@section('content')
    <div>
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Mata Pelajaran</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseCreateModal">Tambah
                data
                +</button>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" id="search" name="search-input" class="form-control border"
                    placeholder="Cari Pelajaran...">
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
                                Mata Pelajaran</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Kode Pelajaran</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Tipe Mapel</th>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>


                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if ($courses->count() === 0)
                            <p>Tidak ada data Mata Pelajaran</p>
                        @endif
                        @foreach ($courses as $course)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $course->courses_title }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $course->course_code }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $course->type }}</p>
                                </td>
                                <td class="align-middle justify-content-center align-items-center d-flex gap-2">

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#courseEditModal{{ $course->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="/school/dashboard/course/{{ $course->id }}" method="POST">
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

        <div class="modal fade" id="courseCreateModal" tabindex="-1" aria-labelledby="courseCreateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mata Pelajaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/school/dashboard/course" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6" id="select-type">
                                    <label for="message-text" class="col-form-label">Tipe Pelajaran</label>
                                    <select name="type" id="" class="form-select" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="Kurikulum">Kurikulum</option>
                                        <option value="Lainnya">lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6 " id="select-curriculum">
                                    <label for="recipient-name" class="col-form-label">Kurikulum</label>
                                    <select name="curriculum" id="" class="form-select" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="Merdeka">Merdeka</option>
                                        <option value="K13">K13</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6 " id="select-course">
                                    <label for="recipient-name" class="col-form-label">Nama Pelajaran</label>
                                    <input type="text" name="courses_title" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6 " id="select-code">
                                    <label for="recipient-name" class="col-form-label">Kode Pelajaran</label>
                                    <input type="text" name="course_code" class="form-control" required>

                                </div>
                                <div class="mb-3 col-md-12 " id="select-description">
                                    <label for="recipient-name" class="col-form-label">Deskripsi Pelajaran</label>
                                    <textarea name="courses_description" class="form-control" rows="3" required></textarea>
                                </div>
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

        @foreach ($courses as $course)
            <div class="modal fade" id="courseEditModal{{ $course->id }}" tabindex="-1"
                aria-labelledby="courseEditModalLabel{{ $course->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Mata Pelajaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/school/dashboard/course/{{ $course->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="mb-3 col-md-6" id="select-type">
                                        <label for="message-text" class="col-form-label">Tipe Pelajaran</label>
                                        <select name="type" id="" class="form-select" disabled>
                                            <option value="{{ $course->type }}" selected>{{ $course->type }}
                                            </option>

                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6 " id="select-curriculum">
                                        <label for="recipient-name" class="col-form-label">Kurikulum</label>
                                        <select name="curriculum" id="" class="form-select" disabled>
                                            <option value="{{ $course->curriculum }}">{{ $course->curriculum }}</option>

                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6 " id="select-curriculum">
                                        <label for="recipient-name" class="col-form-label">Nama Pelajaran</label>
                                        <input type="text" name="courses_title" class="form-control"
                                            value="{{ $course->courses_title }}">
                                    </div>
                                    <div class="mb-3 col-md-6 " id="select-curriculum">
                                        <label for="recipient-name" class="col-form-label">Kode Pelajaran</label>
                                        <input type="text" name="course_code" class="form-control"
                                            value="{{ $course->course_code }}">

                                    </div>
                                    <div class="mb-3 col-md-12 " id="select-curriculum">
                                        <label for="recipient-name" class="col-form-label">Deskripsi Pelajaran</label>
                                        <textarea name="courses_description" class="form-control" rows="3">{{ $course->courses_description }}</textarea>
                                    </div>
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
            const selectType = document.getElementById('select-type');
            const selectCurriculum = document.getElementById('select-curriculum');

            selectType.addEventListener('change', (event) => {
                if (event.target.value === 'Kurikulum') {
                    selectCurriculum.style.display = 'block';
                    selectCurriculum.querySelector('select').required =
                        true; // Mengatur elemen select di dalamnya menjadi required
                } else {
                    selectCurriculum.style.display = 'none';
                    selectCurriculum.querySelector('select').required =
                        false; // Mengatur elemen select di dalamnya menjadi tidak required
                }
            });

            // Jalankan event listener ketika halaman pertama kali dimuat
            selectType.dispatchEvent(new Event('change'));
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search');
                const tableBody = document.getElementById('table-body');

                searchInput.addEventListener('input', function() {
                    const query = searchInput.value.trim();

                    fetch(`{{ route('course.search') }}?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            tableBody.innerHTML = '';

                            if (data.length > 0) {
                                data.forEach((course, index) => {
                                    const row = document.createElement('tr');

                                    row.innerHTML = `
                                    <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${index + 1}</p></td>
                                    <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${course.courses_title}</p></td>
                                    <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${course.course_code}</p></td>
                                    <td class="align-middle text-center"><p class="text-xs text-secondary mb-0">${course.type}</p></td>
                                    <td class="align-middle justify-content-center align-items-center d-flex gap-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#courseEditModal${course.id}"><i class="bi bi-pencil-square"></i></button>
                                        
                                        <form action="/school/dashboard/course/${course.id}" method="POST">
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
