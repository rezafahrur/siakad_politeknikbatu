<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            POLIBA<span>TU</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#general" role="button" aria-expanded="false"
                    aria-controls="general">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">General</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="general">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('biodata') }}" class="nav-link">Biodata Mahasiswa</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#akademik" role="button" aria-expanded="false"
                    aria-controls="akademik">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Akademik</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="akademik">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('krs') }}" class="nav-link">Kartu Rencana Studi (KRS)</a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwal-perkuliahan.html" class="nav-link">Jadwal Perkuliahan</a>
                        </li>
                        <li class="nav-item">
                            <a href="nilai-mahasiswa.html" class="nav-link">Nilai Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a href="presensi.html" class="nav-link">Presensi</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ukt" role="button" aria-expanded="false"
                    aria-controls="ukt">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">UKT</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="ukt">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pembayaran-ukt.html" class="nav-link">Pembayaran UKT</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
