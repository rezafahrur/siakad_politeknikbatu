@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/cropperjs/cropper.min.css') }}">
@endpush

<style>
    .photo-card img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ktm</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Foto KTM Mahasiswa</h5>
            <hr>
            <div class="p-3" style="background-color: lightsteelblue; border-radius: 8px;">
                <h4><strong>Ketentuan Pakaian untuk Pas Foto</strong></h4>
                <div class="row">
                    <div class="col-md-6">
                        <h6>1. Pria</h6>
                        <ul>
                            <li>Menggunakan Jas (polos) berwarna biru tua/hitam</li>
                            <li>Kemeja (berkerah) berwarna putih polos</li>
                            <li>Berdasi hitam</li>
                            <li>Rambut tertata rapi, tidak menutupi telinga, tidak memakai tutup kepala, topi, atau songkok
                            </li>
                            <li>Tidak memakai aksesoris seperti anting atau aksesoris lainnya</li>
                            <li>Tidak berkacamata dan tidak menggunakan softlens</li>
                            <li>Menggunakan foto terbaru, tidak boleh diedit dengan badan orang lain</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>2. Wanita</h6>
                        <ul>
                            <li>Menggunakan Jas (polos) berwarna biru tua/hitam</li>
                            <li>Kemeja (berkerah) berwarna putih polos, kerah tidak boleh dikeluarkan</li>
                            <li>Tidak berdasi</li>
                            <li>Jika berkerudung, kerudung warna putih dan di dalam jas, tanpa variasi</li>
                            <li>Tidak berkacamata dan tidak menggunakan softlens</li>
                            <li>Menggunakan foto terbaru, tidak boleh diedit dengan badan orang lain</li>
                        </ul>
                    </div>
                </div>

                <h4 class="mt-3"><strong>Ketentuan Foto KTM</strong></h4>
                <ul>
                    <li>Ukuran foto 3x4 cm</li>
                    <li>Ukuran file maksimal 2 MB (2048 KB)</li>
                    <li>Ukuran pixel minimal 354px x 472px</li>
                    <li>Jenis file foto: *.jpg atau *.jpeg</li>
                    <li>Nama file berupa NIM (contoh: 123131001.jpg)</li>
                    <li>Kode warna background: #46b4f0</li>
                    <li>Bisa menggunakan <a href="https://www.remove.bg" target="_blank">https://www.remove.bg</a> untuk
                        mengganti background</li>
                </ul>
            </div>

            <br>

            <div class="container mt-5">
                <h2 class="text-center mb-4">CONTOH FOTO KTM YANG BENAR</h2>
                <div class="row text-center">
                    <div class="col-md-3 mb-4 photo-card">
                        <img src="assets\images\KTM\Putra.png" alt="Putra">
                        <p class="mt-2 fw-bold">PUTRA</p>
                    </div>
                    <div class="col-md-3 mb-4 photo-card">
                        <img src="assets\images\KTM\Putri Rambut Pendek.png" alt="Putri Rambut Sebahu">
                        <p class="mt-2 fw-bold">PUTRI<br><small>RAMBUT SEBAHU</small></p>
                    </div>
                    <div class="col-md-3 mb-4 photo-card">
                        <img src="assets\images\KTM\Putri Rambut Panjang.png" alt="Putri Rambut Panjang">
                        <p class="mt-2 fw-bold">PUTRI<br><small>RAMBUT PANJANG</small></p>
                    </div>
                    <div class="col-md-3 mb-4 photo-card">
                        <img src="assets\images\KTM\Putri Jilbab.png" alt="Putri Berkerudung">
                        <p class="mt-2 fw-bold">PUTRI<br><small>BERKERUDUNG</small></p>
                    </div>
                </div>
            </div>

            <br>

            @if ($mahasiswaKtm)
                @if ($mahasiswaKtm->status == 1)
                    <div class="alert alert-warning" role="alert">
                        <h5 class="alert-heading mb-2">Pemberitahuan Validasi Foto KTM</h5>
                        <p>Foto KTM Anda masih dalam status <a href="#" class="alert-link">pending</a> validasi. Harap
                            menunggu proses validasi selesai.</p>
                    </div>
                    <img src="{{ asset($mahasiswaKtm->path_photo) }}" alt="KTM Photo" style="height: 200px;" />
                @elseif ($mahasiswaKtm->status == 2)
                    <div class="alert alert-success" role="alert">
                        <h5 class="alert-heading mb-2">Pemberitahuan Validasi Foto KTM</h5>
                        <p>Foto KTM anda sudah berhasil divalidasi dan sudah sesuai ketentuan yang ada.</p>
                    </div>
                    <img src="{{ asset($mahasiswaKtm->path_photo) }}" alt="KTM Photo" style="height: 200px;" />
                @elseif ($mahasiswaKtm->status == 0)
                    <div class="alert alert-danger">
                        <h6>Foto KTM Anda ditolak. Silakan unggah ulang dengan foto yang sesuai.</h6>
                    </div>
                    <!-- Form Upload ulang KTM -->
                    <h4 class="mb-3">Upload Ulang KTM</h4>
                    <form action="{{ route('mahasiswa.ktm.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="cropperImageUpload" />
                                </div>
                                <div>
                                    <img src="../../../assets/images/others/placeholder.jpg" class="w-100"
                                        id="croppingImage" alt="cropper" />
                                </div>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                    <div class="d-flex align-items-center me-2">
                                        <button class="btn btn-primary crop">Crop</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <h6 class="text-muted mb-3">Cropped Image:</h6>
                                <img class="w-100 cropped-img mt-2" src="#" alt="" />
                                <input type="hidden" name="cropped_image" id="cropped_image" />
                                <button type="submit" class="btn btn-success mt-3">Upload KTM</button>
                            </div>
                        </div>
                    </form>
                @endif
            @else
                <!-- Jika belum ada data KTM -->
                <form action="{{ route('mahasiswa.ktm.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <input class="form-control" type="file" id="cropperImageUpload" />
                            </div>
                            <div>
                                <img src="../../../assets/images/others/placeholder.jpg" class="w-100" id="croppingImage"
                                    alt="cropper" />
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                <div class="d-flex align-items-center me-2">
                                    <button class="btn btn-primary crop">Crop</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ms-auto">
                            <h6 class="text-muted mb-3">Cropped Image:</h6>
                            <img class="w-100 cropped-img mt-2" src="#" alt="" />
                            <input type="hidden" name="cropped_image" id="cropped_image" />
                            <button type="submit" class="btn btn-success mt-3">Upload KTM</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendors/cropperjs/cropper.min.js') }}"></script>
    <script>
        $(function() {
            'use strict';

            var croppingImage = document.querySelector('#croppingImage'),
                cropBtn = document.querySelector('.crop'),
                croppedImg = document.querySelector('.cropped-img'),
                upload = document.querySelector('#cropperImageUpload'),
                croppedInput = document.querySelector('#cropped_image'),
                cropper = '',
                imageUploaded = false; // Tambahkan variabel untuk mengecek apakah foto sudah diunggah

            // Initialize cropper
            cropper = new Cropper(croppingImage, {
                aspectRatio: 2 / 3,
                zoomable: false,
            });

            // On file change, load the image into cropper
            upload.addEventListener('change', function(e) {
                if (e.target.files.length) {
                    var file = e.target.files[0];
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        croppingImage.src = event.target.result;
                        cropper.replace(event.target.result);
                        imageUploaded = true; // Set true ketika gambar diunggah
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Crop and display the result
            cropBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Cek apakah gambar sudah diunggah
                if (imageUploaded) {
                    let imgSrc = cropper.getCroppedCanvas().toDataURL();
                    croppedImg.src = imgSrc;
                    croppedInput.value = imgSrc;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Silakan unggah foto terlebih dahulu sebelum melakukan crop.',
                    }); // Pesan peringatan jika foto belum diunggah
                }
            });
        });
    </script>
@endpush
