<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="../assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo1/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
    <div class="main-wrapper">

        @include('layouts.sidebar')
        <div class="page-wrapper">

            @include('layouts.navbar')

            <div class="page-content">

                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">Selamat Datang, RIZALDY</h4>
                        <p class="mb-1">NIM: </p>
                        <p class="mb-1">Program Studi: </p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Ringkasan Akademik -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Ringkasan Akademik</h6>
                                <p class="mb-2">Semester Aktif: </p>
                                <p class="mb-2">Jumlah SKS:</p>
                                <p class="mb-2">IPK: </p>
                                <a href="krs.html" class="btn btn-primary mt-2">Lihat KRS</a>
                            </div>
                        </div>
                    </div>
                
                    <!-- Riwayat KRS -->
                    <!-- Status Pembayaran UKT -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Status Pembayaran UKT</h6>
                                {{-- @if($statusPembayaran == 'Lunas')
                                    <p class="text-success mb-2">UKT telah dibayar.</p>
                                @else
                                    <p class="text-danger mb-2">Belum melakukan pembayaran UKT.</p>
                                    <a href="pembayaran.html" class="btn btn-danger mt-2">Bayar Sekarang</a>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Pengumuman -->
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Berita</h6>
                                {{-- <ul>
                                    @foreach($pengumuman as $item)
                                        <li>{{ $item->judul }} - {{ $item->tanggal }}</li>
                                    @endforeach --}}
                                </ul>
                                <a href="pengumuman.html" class="btn btn-info mt-2">Lihat Semua Berita</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            @include('layouts.footer')

        </div>
    </div>

    <!-- core:js -->
    <script src="../assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../assets/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="../assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../assets/vendors/feather-icons/feather.min.js"></script>
    <script src="../assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard-light.js"></script>
    <script src="../assets/js/datepicker.js"></script>
    <!-- End custom js for this page -->

</body>

</html>
