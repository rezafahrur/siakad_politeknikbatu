<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="#"><img style="height: 50px" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"/></a>
            </div>
            <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                <!-- SVG Icons -->
            </div>
            <div class="sidebar-toggler x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item">
                <a href="{{ url('/') }}" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-person-fill"></i>
                    <span>General</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ url('/biodata') }}" class="submenu-link">Biodata Mahasiswa</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-collection-fill"></i>
                    <span>Akademik</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ url('/krs') }}" class="submenu-link">Kartu Rencana Studi (KRS)</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ url('/jadwal-perkuliahan') }}" class="submenu-link">Jadwal Perkuliahan</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ url('/nilai-mahasiswa') }}" class="submenu-link">Nilai Mahasiswa</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ url('/presensi') }}" class="submenu-link">Presensi</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi-currency-dollar"></i>
                    <span>UKT</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ url('/pembayaran-ukt') }}" class="submenu-link">Pembayaran UKT</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
