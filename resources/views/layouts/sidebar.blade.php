<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="#"><img style="height: 50px" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
                        srcset="" /></a>
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

            <li class="sidebar-item active ">
                <a href="{{ url('/message') }}" class="sidebar-link">
                    <i class="bi bi-collection-fill"></i>
                    <span>Message</span>
                </a>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-collection-fill"></i>
                    <span>Akademik</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="form-element-krs.html" class="submenu-link">Kartu Rencana Studi(KRS)</a>
                    </li>
                    <li class="submenu-item">
                        <a href="form-element-input-jadwal.html" class="submenu-link">Jadwal Perkuliahan</a>
                    </li>
                    <li class="submenu-item">
                        <a href="form-element-nilai.html" class="submenu-link">Nilai Mahasiswa</a>
                    </li>
                    <li class="submenu-item">
                        <a href="form-element-presensi.html" class="submenu-link">Presensi</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-collection-fill"></i>
                    <span>UKT</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="form-element-pembayaranUkt.html" class="submenu-link">Pembayaran UKT</a>
                    </li>
                    <li class="submenu-item">
                        <a href="form-element-input-keringananUkt.html" class="submenu-link">Keringanan UKT</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-collection-fill"></i>
                    <span>Surat & Kuisioner</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="form-element-permintaanSurat.html" class="submenu-link">Permintaan Surat</a>
                    </li>
                    <li class="submenu-item">
                        <a href="form-element-input-riwayatPermintaanSurat.html" class="submenu-link">Riwayat Permintaan Surat</a>
                    </li>
                    <li class="submenu-item">
                        <a href="form-element-kuisioner.html" class="submenu-link">Kuisioner</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
