@extends('admin.layouts.default')
@section('content')
    <div id="main">
        <div class="page-heading text-left ">
            <h3 class="mb-3 fs-5">Daftar Sekolah</h3>
            <a href="/jadwal/create" class="btn collor-button btn-primary rounded " style="color: white;">tambah data <i class="fas fa-plus-square"></i></a>
        </div>

        <div class="card-body px-0 pb-2 fs-6 text-left">
            <div class="table-responsive p-0">
                <table class="table table-striped table-bordered  mb-0 ">
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
                                Tanggal_kadaluarsa
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
                                        {{ $sekolah->id }}</p>
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
                                    <a href=""
                                        class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="border-0 bg-transparent"
                                            onclick="return confirm('Are you sure?')"> <i
                                                class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                        by <a href="https://saugi.me">Saugi</a></p>
                </div>
            </div>
        </footer>
    @endsection
