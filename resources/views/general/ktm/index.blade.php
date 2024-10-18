@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/cropperjs/cropper.min.css') }}">
@endpush

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
