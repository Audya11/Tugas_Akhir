<div id="app">
    <div id="sidebar">
        <div class="sidebar-wrapper active d-flex align-items-start">

            <div class="sidebar-menu">
                <ul class="menu">
                    <p>Welcome {{ Auth::user()->name }}</p>


                    <li class="">
                        <a href="/school/dashboard" class='nav-link ' class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item  " id="sekolah-item">
                        <a href="/school/dashboard/academic-year" class='sidebar-link'>
                            <i class="bi bi-calendar"></i>
                            <span>Tahun Akademik</span>
                        </a>
                    </li>

                    @if (Auth::user()->school()->first()->paket === 'Akreditasi B' ||
                            Auth::user()->school()->first()->paket === 'Akreditasi A')
                        <li class="sidebar-item  " id="sekolah-item">
                            <a href="/school/dashboard/major" class='sidebar-link'>
                                <i class="bi bi-award"></i>
                                <span>Jurusan</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->school()->first()->paket === 'Akreditasi A')
                        <li class="sidebar-item has-sub" id="sekolah-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>Pengguna</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item  ">
                                    <a href="/school/dashboard/student" class='submenu-link'>
                                        <span>Siswa</span>
                                    </a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="/school/dashboard/teacher" class='submenu-link'>
                                        <span>Guru</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="sidebar-item " id="sekolah-item">
                        <a href="/school/dashboard/class" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Kelas</span>
                        </a>
                    </li>
                    <li class="sidebar-item  " id="sekolah-item">
                        <a href="/school/dashboard/subclass" class='sidebar-link'>
                            <i class="bi bi-subtract"></i>
                            <span>Sub Kelas</span>
                        </a>
                    </li>
                    <li class="sidebar-item  " id="sekolah-item">
                        <a href="/school/dashboard/course" class='sidebar-link'>
                            <i class="bi bi-book"></i>
                            <span>Mata Pelajaran</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/school/profile" class='nav-link ' class="sidebar-link">
                            <i class="bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Seleksi semua item sidebar
                            const sidebarItems = document.querySelectorAll('.sidebar-item');

                            sidebarItems.forEach(function(item) {
                                item.addEventListener('click', function() {
                                    // Hapus kelas 'active' dari semua item
                                    sidebarItems.forEach(function(el) {
                                        el.classList.remove('active');
                                    });

                                    // Tambahkan kelas 'active' pada item yang diklik
                                    this.classList.add('active');
                                });
                            });

                            // Highlight the current page
                            const currentPath = window.location.pathname;
                            sidebarItems.forEach(function(item) {
                                const link = item.querySelector('a');
                                if (link && link.getAttribute('href') === currentPath) {
                                    item.classList.add('active');
                                }
                            });
                        });
                    </script>

                    <form class="mt-4" action="/sesi/logout" method="POST">
                        @csrf
                        <button class='btn btn-danger' type="submit"
                            onclick="return confirm('Apakah anda yakin ingin keluar?')">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    {{-- <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-currency-dollar"></i>
                            <span>Keuangan</span>
                        </a>

                        <ul class="submenu ">

                            <li class="submenu-item  ">
                                <a href="layout-default.html" class="submenu-link"> Rekening Institusi</a>

                            </li>

                            <li class="submenu-item  ">
                                <a href="layout-vertical-1-column.html" class="submenu-link">Permintaan Penarikan</a>

                            </li>

                        </ul>
                    </li> --}}
            </div>
        </div>
