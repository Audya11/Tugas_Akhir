<div id="app">
    <div id="sidebar">
        <div class="sidebar-wrapper active d-flex align-items-start">

            <div class="sidebar-menu">
                <ul class="menu">


                    <li class="">
                        <a href="/" class='nav-link ' class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li> 
 
                    
                    <li class="sidebar-item" id="sekolah-item">
                        <a href="/dashboard/daftar_sekolah" class='sidebar-link'>
                            <i class="bi bi-bank2"></i>
                            <span>Sekolah</span>
                        </a>
                    </li>
                    <li class="sidebar-item" id="sekolah-item">
                        <a href="/dashboard/daftar_siswa" class='sidebar-link'>
                            <i class="bi bi-person"></i>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item  " id="sekolah-item">
                        <a href="/dashboard/staff" class='sidebar-link'>
                            <i class="bi bi-person-vcard-fill"></i>
                            <span>Petugas</span>
                        </a>
                    </li>

                    <script>
                      document.addEventListener('DOMContentLoaded', function () {
    // Seleksi semua item sidebar
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    sidebarItems.forEach(function (item) {
        item.addEventListener('click', function () {
            // Hapus kelas 'active' dari semua item
            sidebarItems.forEach(function (el) {
                el.classList.remove('active');
            });

            // Tambahkan kelas 'active' pada item yang diklik
            this.classList.add('active');
        });
    });

    // Highlight the current page
    const currentPath = window.location.pathname;
    sidebarItems.forEach(function (item) {
        const link = item.querySelector('a');
        if (link && link.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
});


                    </script>
                    
                        <form class="mt-4" action="/sesi/logout" method="POST">
                            @csrf
                        <button class='btn btn-danger' type="submit" onclick="return confirm('Apakah anda yakin ingin keluar?')">
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
