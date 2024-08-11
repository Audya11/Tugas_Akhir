@extends('admin.layouts.default')
@section('content')
    <div>
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Sekolah</h3>
            <a href="/dashboard/daftar_sekolah/create" class="btn collor-button btn-primary rounded " style="color: white;">tambah data <i class="fas fa-plus-square"></i></a>
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
                                Sekolah</th>
                            <th class="align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Paket</th>
                            <th
                                class=" align-middle text-center text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Status</th>
                            <th
                                class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                                Tanggal Kadaluarsa
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
                    <tbody class="">
                        @foreach ($sekolahs as $sekolah)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $loop->iteration }}   
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $sekolah->nama_sekolah }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $sekolah->paket }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $sekolah->status }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $sekolah->tanggal_kadaluarsa }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $sekolah->alamat }}</p>
                                </td>
                                <td class="align-middle justify-content-center align-items-center d-flex">
                                    <a href="/dashboard/daftar_sekolah/{{ $sekolah->id }}/edit"
                                        class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="/dashboard/daftar_sekolah/{{ $sekolah->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 bg-transparent"
                                            onclick="return confirm('Are you sure?')"> <i
                                                class="bi bi-trash3"></i></button>
                                    </form>
                                    
                                    <a href="/dashboard/daftar_sekolah/{{ $sekolah->id }}/detail"
                                        class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sekolahs->appends(request()->except('page'))->links() }}
            </div>
        </div>


        {{-- <script>
            var table = $('#school_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('sekolah.data') !!}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_sekolah',
                        name: 'nama_sekolah'
                    },
                    {
                        data: 'paket',
                        name: 'paket'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                    
                }]
            })
        </script> --}}
    @endsection
