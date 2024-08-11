@extends('admin.layouts.default')
@section('content')
<div>
    <div class="page-heading text-left ">
        <h3 class="mb-3 fs-5">Daftar Pegawai</h3>
        <a href="/dashboard/staff/create" class="btn collor-button btn-primary rounded " style="color: white;">tambah data <i class="fas fa-plus-square"></i></a>
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
                            Nama</th>
                        <th class="align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Email</th>
                        <th
                            class=" align-middle text-center text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                            Role</th>
                        <th
                            class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                            Alamat
                        </th>
                        <th
                            class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                            No. Telp
                        </th>
                        <th
                            class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($staffs as $staff)
                        <tr>
                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $loop->iteration }}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $staff->name }}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $staff->email }}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $staff->role}}
                                </p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $staff->alamat }}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $staff->no_telp }}</p>
                            </td>
                            <td class="align-middle justify-content-center align-items-center d-flex">
                                <a href="/dashboard/staff/{{ $staff->id }}/edit"
                                    class="text-secondary font-weight-bold text-xs"
                                    data-toggle="tooltip" data-original-title="Edit user">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="/dashboard/staff/{{ $staff->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="border-0 bg-transparent"
                                        onclick="return confirm('Are you sure?')"> <i
                                            class="bi bi-trash3"></i></button>
                                </form>
                                <a href="/dashboard/staff/{{ $staff->id }}/detail"
                                    class="text-secondary font-weight-bold text-xs"
                                    data-toggle="tooltip" data-original-title="Edit user">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $staffs->appends(request()->except('page'))->links() }}
        </div>
    </div>

@endsection