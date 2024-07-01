@extends('admin.layouts.default')
@section('content')
    <div id="main">
        <div class="page-heading text-center ">
            <h3 class="mb-3 fs-5">Daftar Pelajaran</h3>
        </div>
        <div class="card-body px-0 pb-2 fs-6">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class=" align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama Pelajaran</th>
                            <th class="align-middle text-center  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Jenjang</th>
                            <th
                                class=" align-middle text-center text-center  text-secondary text-xxs font-weight-bolder opacity-7">
                                Kurikulum</th>

                            <th
                                class="align-middle text-center text-secondary opacity-7  text-secondary text-xxs font-weight-bolder opacity-7">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelajarans as $pelajaran)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $pelajaran->nama_pelajaran }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $pelajaran->jenjang }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $pelajaran->Kurikulum }}</p>
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
