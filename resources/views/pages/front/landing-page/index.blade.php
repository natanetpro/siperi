@extends('layouts.front.app')
@push('styles')
    <style>
        img#logo {
            width: 10%;
        }

        #app-title {
            color: #3fd234 !important;
        }

        .cta-btn {
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            margin-right: 10px;
        }

        .cta-btn:hover {
            background: #f8d7da;
            color: #fff;
        }

        .cta-btn.bg-success {
            background: #28a745;
            color: #fff;
        }
    </style>
@endpush
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('bg-siperi.jpg') }}" alt="" data-aos="fade-in" class="">
        <div class="container d-flex flex-column align-items-center text-center mt-auto">
            <div data-aos="fade-up" data-aos-delay="300" class="mb-5">
                <img id="logo" src="{{ asset('logo-banten.png') }}" alt="" class="mx-auto mb-3"
                    style="width: 20%; position: relative;">
                <strong>Pengadilan Tinggi Banten</strong>
            </div>
            <h2 data-aos="fade-up" data-aos-delay="100" class="">SISTEM INFORMASI PENGELOLAAN<br><span
                    class="text-success">PENELITIAN
                    DAN RISET</span></h2>
            <div class="mt-5 d-flex gap-3" data-aos="fade-up" data-aos-delay="200">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exLargeModal">Daftar</button>
                {{-- @dd(Auth::user()->getRoleNames()) --}}
                @if (Auth::check() && Auth::user()->hasRole('Administrator'))
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger">Dashboard</a>
                @elseif (Auth::check() && Auth::user()->hasRole('Pemohon'))
                    <a href="{{ route('peserta.dashboard.index') }}" class="btn btn-danger">Dashboard</a>
                @elseif (Auth::check() && Auth::user()->hasRole('Pembimbing'))
                    <a href="{{ route('pembimbing.dashboard.index') }}" class="btn btn-danger">Dashboard</a>
                @elseif(Auth::check() && Auth::user()->hasRole('Pimpinan'))
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger">Dashboard</a>
                @elseif (Auth::check() && Auth::user()->hasRole('Operator'))
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-danger">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-danger" onclick="redirectDashboard()">Masuk</a>
                @endif
            </div>
        </div>
        {{-- <div class="container d-flex flex-column align-items-center text-center mt-auto">
            <h2 data-aos="fade-up" data-aos-delay="100" class="">THE ANNUAL<br><span
                    class="text-success">MARKETING</span>
                CONFERENCE</h2>
            <p data-aos="fade-up" data-aos-delay="200">10-12 December, Downtown Conference Center, New York</p>
            <div data-aos="fade-up" data-aos-delay="300" class="">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                    class="bg-success glightbox pulsating-play-btn mt-3"></a>
            </div>
        </div> --}}

        <div class="about-info mt-auto position-relative">

            {{-- <div class="container position-relative" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>About The Event</h2>
                        <p>Sed nam ut dolor qui repellendus iusto odit. Possimus inventore eveniet accusamus error
                            amet eius aut
                            accusantium et. Non odit consequatur repudiandae sequi ea odio molestiae. Enim possimus
                            sunt inventore in
                            est ut optio sequi unde.</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>Where</h3>
                        <p>Downtown Conference Center, New York</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>When</h3>
                        <p>Monday to Wednesday<br>10-12 December</p>
                    </div>
                </div>
            </div> --}}
        </div>

    </section><!-- /Hero Section -->

    <section id="hotels" class="hotels section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kegiatan</h2>
            <p>Berikut kegiatan-kegiatan yang tersedia</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100">
                        <div class="card-img">
                            <img src="{{ asset('foto-1.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Riset/Penelitian</a></h3>
                        <p>Kegiatan untuk Mahasiswa</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100">
                        <div class="card-img">
                            <img src="{{ asset('foto-2.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Kuliah Kerja Praktik</a></h3>
                        <p>Kegiatan untuk Mahasiswa</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100">
                        <div class="card-img">
                            <img src="{{ asset('foto-3.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Prakerin</a></h3>
                        <p>Kegiatan untuk Siswa</p>
                    </div>
                </div><!-- End Card Item -->
            </div>
        </div>
    </section>

    {{-- Modal Pengajuan --}}
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Daftar Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 mb-4">
                        <div class="bs-stepper wizard-numbered mt-2">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#account-details">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Riset/Penelitian</span>
                                            <span class="bs-stepper-subtitle">Form daftar penelitian</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#personal-info">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Kuliah Kerja Praktik</span>
                                            <span class="bs-stepper-subtitle">Form daftar KKP</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#social-links">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Prakerin</span>
                                            <span class="bs-stepper-subtitle">Form datar prakerin</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content d-flex flex-column gap-5">
                                <!-- Account Details -->
                                <div id="account-details" class="content data-diri">
                                    <form action="#" method="POST" enctype="multipart/form-data" id="riset">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Data Diri</h6>
                                            <small>Silahkan masukkan data diri pemohon</small>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="nama">Nama Lengkap</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nama_pemohon_riset') is-invalid @enderror"
                                                    placeholder="johndoe" required name="nama_pemohon_riset" required
                                                    value="{{ old('nama_pemohon_riset') }}">
                                                @error('nama_pemohon_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email"
                                                    class="form-control @error('email_pemohon_riset') is-invalid @enderror"
                                                    placeholder="john.doe@email.com" aria-label="john.doe"
                                                    name="email_pemohon_riset" required
                                                    value="{{ old('email_pemohon_riset') }}">
                                                @error('email_pemohon_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="no_telp_pemohon">Telepon</label>
                                                <input type="number" id="no_telp_pemohon"
                                                    class="form-control @error('no_telp_pemohon_riset') is-invalid
                                                        @enderror"
                                                    placeholder="08xxxxxxxxx" aria-label="john.doe"
                                                    name="no_telp_pemohon_riset" required
                                                    value="{{ old('no_telp_pemohon_riset') }}">
                                                @error('no_telp_pemohon_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin_riset" id="jenis_kelamin_riset"
                                                    class="form-select @error('jenis_kelamin_riset') is-invalid @enderror"
                                                    required>
                                                    <option value="L"
                                                        {{ old('jenis_kelamin_riset') ? 'selected' : '' }}>Laki-Laki
                                                    </option>
                                                    <option value="P"
                                                        {{ old('jenis_kelamin_riset') ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="tempat_lahir"
                                                    class="form-control @error('tempat_lahir_riset') is-invalid @enderror"
                                                    name="tempat_lahir_riset" required
                                                    value="{{ old('tempat_lahir_riset') }}">
                                                @error('tempat_lahir_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="tanggal_lahir"
                                                    class="form-control @error('tanggal_lahir_riset') is-invalid @enderror"
                                                    placeholder="YYYY/MM/DD" name="tanggal_lahir_riset" required
                                                    value="{{ old('tanggal_lahir_riset') }}">
                                                @error('tanggal_lahir_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="content-header mb-3 mt-3">
                                            <h6 class="mb-0">Detail Universitas</h6>
                                            <small>Masukkan data pendidikan</small>
                                        </div>
                                        <div class="kuliah">
                                            <div class="row g-3">
                                                <div>
                                                    <label class="form-label" for="nim">NIM</label>
                                                    <input type="number" id="nim"
                                                        class="form-control @error('nim_riset') is-invalid @enderror"
                                                        placeholder="212xxxxxxxxx" required name="nim_riset"
                                                        value="{{ old('nim_riset') }}" />
                                                    @error('nim_riset')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="universitas">Universitas</label>
                                                    <input type="text" id="universitas"
                                                        class="form-control @error('universitas_riset') is-invalid @enderror"
                                                        name="universitas_riset" required
                                                        style="text-transform: uppercase"
                                                        value="{{ old('universitas_riset') }}" />
                                                    @error('universitas_riset')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="fakultas">Fakultas</label>
                                                    <input type="text" id="fakultas"
                                                        class="form-control @error('fakultas_riset') is-invalid @enderror"
                                                        name="fakultas_riset" required style="text-transform: uppercase"
                                                        value="{{ old('fakultas_riset') }}" />
                                                    @error('fakultas_riset')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="prodi">Program Studi</label>
                                                    <input type="text" id="prodi"
                                                        class="form-control @error('prodi_riset') is-invalid @enderror"
                                                        name="prodi_riset" required style="text-transform: uppercase"
                                                        value="{{ old('prodi_riset') }}" />
                                                    @error('prodi_riset')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="semester">Semester</label>
                                                    <input type="number" id="semester"
                                                        class="form-control @error('semester_riset') is-invalid @enderror"
                                                        name="semester_riset" required
                                                        value="{{ old('semester_riset') }}" />
                                                    @error('semester_riset')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-header mb-3 mt-3">
                                            <h6 class="mb-0">File Permohonan</h6>
                                            <small>Masukkan data permohonan</small>
                                        </div>
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                                <input type="text" id="nama_kegiatan"
                                                    class="form-control @error('nama_kegiatan_riset') is-invalid @enderror"
                                                    required name="nama_kegiatan_riset"
                                                    placeholder="Masukkan nama kegiatan" required
                                                    style="text-transform: uppercase"
                                                    value="{{ old('nama_kegiatan_riset') }}" />
                                                @error('nama_kegiatan_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                <input type="date" id="tanggal_mulai"
                                                    class="form-control @error('tanggal_mulai_riset') is-invalid @enderror"
                                                    placeholder="YYYY-MM-DD" name="tanggal_mulai_riset" required
                                                    value="{{ old('tanggal_mulai_riset') }}" />
                                                @error('tanggal_mulai_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_selesai">Tanggal
                                                    Selesai</label>
                                                <input type="date" id="tanggal_selesai"
                                                    class="form-control @error('tanggal_selesai_riset') is-invalid @enderror"
                                                    placeholder="YYYY-MM-DD" name="tanggal_selesai_riset" required
                                                    value="{{ old('tanggal_selesai_riset') }}" />
                                                @error('tanggal_selesai_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="form-label" for="surat_permohonan">Upload Surat
                                                    Permohonan:
                                                    (.pdf, Max. 2MB)</label>
                                                <input type="file" id="surat_permohonan"
                                                    class="form-control @error('surat_permohonan_riset') is-invalid
                                                        @enderror"
                                                    required name="surat_permohonan_riset" />
                                                @error('surat_permohonan_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- <div>
                                                <label class="form-label" for="">Captcha : </label>
                                                <div class="captcha_riset d-flex gap-2 mb-2">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" onclick="refreshCaptchaRiset()"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="ti ti-rotate"></i></button>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('captcha_riset') is-invalid
                                                        @enderror"
                                                    required name="captcha_riset" />
                                                @error('captcha_riset')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div> --}}
                                            <div class="col-12 d-flex gap-3">
                                                <button type="button" onclick="submitRiset()" class="btn btn-success"
                                                    aria-hidden="true">Submit</button>
                                                <svg class="my-auto d-none" id="form-riset-loading"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                                                    preserveAspectRatio="xMidYMid" width="20" height="20"
                                                    style="shape-rendering: auto; display: block; background: rgb(255, 255, 255);"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g>
                                                        <circle stroke-dasharray="164.93361431346415 56.97787143782138"
                                                            r="35" stroke-width="10" stroke="#e15b64" fill="none"
                                                            cy="50" cx="50">
                                                            <animateTransform keyTimes="0;1" values="0 50 50;360 50 50"
                                                                dur="1s" repeatCount="indefinite" type="rotate"
                                                                attributeName="transform"></animateTransform>
                                                        </circle>
                                                        <g></g>
                                                    </g><!-- [ldio] generated by https://loading.io -->
                                                </svg>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Personal Info -->
                                <div id="personal-info" class="content data-pendidikan">
                                    <form action="#" method="POST" enctype="multipart/form-data" id="kkp">
                                        @csrf
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Data Diri</h6>
                                            <small>Silahkan masukkan data diri pemohon</small>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="nama">Nama Lengkap</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nama_pemohon_kkp') is-invalid @enderror"
                                                    placeholder="johndoe" required name="nama_pemohon_kkp" required
                                                    value="{{ old('nama_pemohon_kkp') }}">
                                                @error('nama_pemohon_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email"
                                                    class="form-control @error('email_pemohon_kkp') is-invalid @enderror"
                                                    placeholder="john.doe@email.com" aria-label="john.doe"
                                                    name="email_pemohon_kkp" required
                                                    value="{{ old('email_pemohon_kkp') }}">
                                                @error('email_pemohon_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="no_telp_pemohon">Telepon</label>
                                                <input type="number" id="no_telp_pemohon"
                                                    class="form-control @error('no_telp_pemohon_kkp') is-invalid
                                                        @enderror"
                                                    placeholder="08xxxxxxxxx" aria-label="john.doe"
                                                    name="no_telp_pemohon_kkp" required
                                                    value="{{ old('no_telp_pemohon') }}">
                                                @error('no_telp_pemohon_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin_kkp" id="jenis_kelamin_kkp"
                                                    class="form-select @error('jenis_kelamin_kkp') is-invalid @enderror"
                                                    required>
                                                    <option value="L"
                                                        {{ old('jenis_kelamin_kkp') === 'L' ? 'selected' : '' }}>Laki-Laki
                                                    </option>
                                                    <option value="P"
                                                        {{ old('jenis_kelamin_kkp') === 'P' ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                                @error('jenis_kelamin_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="tempat_lahir"
                                                    class="form-control @error('tempat_lahir_kkp') is-invalid @enderror"
                                                    name="tempat_lahir_kkp" required
                                                    value="{{ old('tempat_lahir_kkp') }}">
                                                @error('tempat_lahir_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="tanggal_lahir"
                                                    class="form-control @error('tanggal_lahir_kkp') is-invalid @enderror"
                                                    placeholder="YYYY/MM/DD" name="tanggal_lahir_kkp" required
                                                    value="{{ old('tanggal_lahir_kkp') }}">
                                                @error('tanggal_lahir_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="content-header mb-3 mt-3">
                                            <h6 class="mb-0">Detail Universitas</h6>
                                            <small>Masukkan data pendidikan</small>
                                        </div>
                                        <div class="kuliah">
                                            <div class="row g-3">
                                                <div>
                                                    <label class="form-label" for="nim">NIM</label>
                                                    <input type="number" id="nim"
                                                        class="form-control @error('nim_kkp') is-invalid @enderror"
                                                        required placeholder="212xxxxxxxxx" name="nim_kkp"
                                                        value="{{ old('nim_kkp') }}" />
                                                    @error('nim_kkp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="universitas">Universitas</label>
                                                    <input type="text" id="universitas"
                                                        class="form-control @error('universitas_kkp') is-invalid @enderror"
                                                        name="universitas_kkp" required style="text-transform: uppercase"
                                                        value="{{ old('universitas_kkp') }}" />
                                                    @error('universitas_kkp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="fakultas">Fakultas</label>
                                                    <input type="text" id="fakultas"
                                                        class="form-control @error('fakultas_kkp') is-invalid @enderror"
                                                        name="fakultas_kkp" required style="text-transform: uppercase"
                                                        value="{{ old('fakultas_kkp') }}" />
                                                    @error('fakultas_kkp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="prodi">Program Studi</label>
                                                    <input type="text" id="prodi"
                                                        class="form-control @error('prodi_kkp') is-invalid @enderror"
                                                        name="prodi_kkp" required style="text-transform: uppercase"
                                                        value="{{ old('prodi_kkp') }}" />
                                                    @error('prodi_kkp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="semester">Semester</label>
                                                    <input type="number" id="semester"
                                                        class="form-control @error('semester_kkp') is-invalid @enderror"
                                                        name="semester_kkp" required value="{{ old('semester_kkp') }}" />
                                                    @error('semester_kkp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-header mb-3 mt-3">
                                            <h6 class="mb-0">File Permohonan</h6>
                                            <small>Masukkan data permohonan</small>
                                        </div>
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                                <input type="text" id="nama_kegiatan"
                                                    class="form-control @error('nama_kegiatan_kkp') is-invalid @enderror"
                                                    required name="nama_kegiatan_kkp" placeholder="Masukkan nama kegiatan"
                                                    style="text-transform: uppercase"
                                                    value="{{ old('nama_kegiatan_kkp') }}" />
                                                @error('nama_kegiatan_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                <input type="date" id="tanggal_mulai"
                                                    class="form-control @error('tanggal_mulai_kkp') is-invalid @enderror"
                                                    placeholder="YYYY-MM-DD" name="tanggal_mulai_kkp" required
                                                    value="{{ old('tanggal_mulai_kkp') }}" />
                                                @error('tanggal_mulai_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_selesai">Tanggal
                                                    Selesai</label>
                                                <input type="date" id="tanggal_selesai"
                                                    class="form-control @error('tanggal_selesai_kkp') is-invalid @enderror"
                                                    placeholder="YYYY-MM-DD" name="tanggal_selesai_kkp" required
                                                    value="{{ old('tanggal_selesai_kkp') }}" />
                                                @error('tanggal_selesai_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="form-label" for="surat_permohonan">Upload Surat
                                                    Permohonan:
                                                    (.pdf, Max. 2MB)</label>
                                                <input type="file" id="surat_permohonan"
                                                    class="form-control @error('surat_permohonan_kkp') is-invalid
                                                        @enderror"
                                                    required name="surat_permohonan_kkp" />
                                                @error('surat_permohonan_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- <div>
                                                <label class="form-label" for="">Captcha : </label>
                                                <div class="captcha_kkp d-flex gap-2 mb-2">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" onclick="refreshCaptchaKKP()"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="ti ti-rotate"></i></button>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('captcha_kkp') is-invalid
                                                        @enderror"
                                                    required name="captcha_kkp" />
                                                @error('captcha_kkp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div> --}}
                                            <div class="col-12 d-flex gap-3">
                                                <button type="button" onclick="submitKKP()" class="btn btn-success"
                                                    aria-hidden="true">Submit</button>
                                                <svg class="my-auto d-none" id="form-kkp-loading"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                                                    preserveAspectRatio="xMidYMid" width="20" height="20"
                                                    style="shape-rendering: auto; display: block; background: rgb(255, 255, 255);"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g>
                                                        <circle stroke-dasharray="164.93361431346415 56.97787143782138"
                                                            r="35" stroke-width="10" stroke="#e15b64" fill="none"
                                                            cy="50" cx="50">
                                                            <animateTransform keyTimes="0;1" values="0 50 50;360 50 50"
                                                                dur="1s" repeatCount="indefinite" type="rotate"
                                                                attributeName="transform"></animateTransform>
                                                        </circle>
                                                        <g></g>
                                                    </g><!-- [ldio] generated by https://loading.io -->
                                                </svg>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Social Links -->
                                <div id="social-links" class="content data-permohonan">
                                    <form action="#" method="POST" enctype="multipart/form-data" id="prakerin">
                                        @csrf
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Data Diri</h6>
                                            <small>Silahkan masukkan data diri pemohon</small>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="nama">Nama Lengkap</label>
                                                <input type="text" id="nama"
                                                    class="form-control @error('nama_pemohon_prakerin') is-invalid @enderror"
                                                    placeholder="johndoe" required name="nama_pemohon_prakerin" required
                                                    value="{{ old('nama_pemohon_prakerin') }}">
                                                @error('nama_pemohon_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email"
                                                    class="form-control @error('email_pemohon_prakerin') is-invalid @enderror"
                                                    placeholder="john.doe@email.com" aria-label="john.doe"
                                                    name="email_pemohon_prakerin" required
                                                    value="{{ old('email_pemohon_prakerin') }}">
                                                @error('email_pemohon_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="no_telp_pemohon">Telepon</label>
                                                <input type="number" id="no_telp_pemohon_prakerin"
                                                    class="form-control @error('no_telp_pemohon_prakerin') is-invalid
                                                        @enderror"
                                                    placeholder="08xxxxxxxxx" aria-label="john.doe"
                                                    name="no_telp_pemohon_prakerin" required
                                                    value="{{ old('no_telp_pemohon_prakerin') }}">
                                                @error('no_telp_pemohon_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin_prakerin" id="jenis_kelamin_prakerin"
                                                    class="form-select @error('jenis_kelamin_prakerin') is-invalid @enderror"
                                                    required>
                                                    <option value="L"
                                                        {{ old('jenis_kelamin_prakerin') === 'L' ? 'selected' : '' }}>
                                                        Laki-Laki</option>
                                                    <option value="P">
                                                        {{ old('jenis_kelamin_prakerin') === 'P' ? 'selected' : '' }}Perempuan
                                                    </option>
                                                </select>
                                                @error('jenis_kelamin_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" id="tempat_lahir"
                                                    class="form-control @error('tempat_lahir_prakerin') is-invalid @enderror"
                                                    name="tempat_lahir_prakerin" required
                                                    value="{{ old('tempat_lahir_prakerin') }}">
                                                @error('tempat_lahir_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="tanggal_lahir"
                                                    class="form-control @error('tanggal_lahir_prakerin') is-invalid @enderror"
                                                    placeholder="YYYY/MM/DD" name="tanggal_lahir_prakerin" required
                                                    value="{{ old('tanggal_lahir_prakerin') }}">
                                                @error('tanggal_lahir_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="content-header mb-3 mt-3">
                                            <h6 class="mb-0">Detail Sekolah</h6>
                                            <small>Masukkan data pendidikan</small>
                                        </div>
                                        <div class="sekolah">
                                            <div class="row g-3">
                                                <div>
                                                    <label class="form-label" for="nis">NIS</label>
                                                    <input type="number" id="nis"
                                                        class="form-control @error('nis_prakerin') is-invalid
                                                            @enderror"
                                                        placeholder="212xxxxxxxxx" required name="nis_prakerin"
                                                        value="{{ old('nis_prakerin') }}" />

                                                    @error('nis_prakerin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="sekolah">Sekolah</label>
                                                    <input type="text" id="sekolah"
                                                        class="form-control @error('sekolah_prakerin') is-invalid @enderror"
                                                        name="sekolah_prakerin" required style="text-transform: uppercase"
                                                        value="{{ old('sekolah_prakerin') }}" />
                                                    @error('sekolah_prakerin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="sekolah">Jurusan</label>
                                                    <input type="text" name="jurusan_prakerin" class="form-control"
                                                        style="text-transform: uppercase">
                                                    @error('jurusan_prakerin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="kelas">Kelas</label>
                                                    <input type="number" id="kelas"
                                                        class="form-control @error('kelas_prakerin') is-invalid @enderror"
                                                        name="kelas_prakerin" required
                                                        value="{{ old('kelas_prakerin') }}" />

                                                    @error('kelas_prakerin')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-header mb-3 mt-3">
                                            <h6 class="mb-0">File Permohonan</h6>
                                            <small>Masukkan data permohonan</small>
                                        </div>
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                                <input type="text" id="nama_kegiatan"
                                                    class="form-control @error('nama_kegiatan_prakerin') is-invalid @enderror "
                                                    required name="nama_kegiatan_prakerin"
                                                    placeholder="Masukkan nama kegiatan" style="text-transform: uppercase"
                                                    value="{{ old('nama_kegiatan_prakerin') }}" />
                                                @error('nama_kegiatan_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                <input type="date" id="tanggal_mulai"
                                                    class="form-control @error('tanggal_mulai_prakerin') is-invalid @enderror"
                                                    placeholder="YYYY-MM-DD" name="tanggal_mulai_prakerin" required
                                                    value="{{ old('tanggal_mulai_prakerin') }}" />
                                                @error('tanggal_mulai_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_selesai">Tanggal
                                                    Selesai</label>
                                                <input type="date" id="tanggal_selesai"
                                                    class="form-control @error('tanggal_selesai_prakerin') is-invalid @enderror"
                                                    placeholder="YYYY-MM-DD" name="tanggal_selesai_prakerin" required
                                                    value="{{ old('tanggal_selesai_prakerin') }}" />
                                                @error('tanggal_selesai_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="form-label" for="surat_permohonan">Upload Surat
                                                    Permohonan:
                                                    (.pdf, Max. 2MB)</label>
                                                <input type="file" id="surat_permohonan"
                                                    class="form-control @error('surat_permohonan_prakerin') is-invalid
                                                        @enderror"
                                                    required name="surat_permohonan_prakerin" />
                                                @error('surat_permohonan_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- <div>
                                                <label class="form-label" for="">Captcha : </label>
                                                <div class="captcha_prakerin d-flex gap-2 mb-2">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" onclick="refreshCaptchaPrakerin()"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="ti ti-rotate"></i></button>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('captcha_prakerin') is-invalid
                                                        @enderror"
                                                    required name="captcha_prakerin" />
                                                @error('captcha_prakerin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div> --}}
                                            <div class="col-12 d-flex gap-3">
                                                <button type="button" onclick="submitPrakerin()" class="btn btn-success"
                                                    aria-hidden="true">Submit</button>
                                                <svg class="my-auto d-none" id="form-prakerin-loading"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                                                    preserveAspectRatio="xMidYMid" width="20" height="20"
                                                    style="shape-rendering: auto; display: block; background: rgb(255, 255, 255);"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g>
                                                        <circle stroke-dasharray="164.93361431346415 56.97787143782138"
                                                            r="35" stroke-width="10" stroke="#e15b64" fill="none"
                                                            cy="50" cx="50">
                                                            <animateTransform keyTimes="0;1" values="0 50 50;360 50 50"
                                                                dur="1s" repeatCount="indefinite" type="rotate"
                                                                attributeName="transform"></animateTransform>
                                                        </circle>
                                                        <g></g>
                                                    </g><!-- [ldio] generated by https://loading.io -->
                                                </svg>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Periksa kembali data yang anda masukkan',
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
    <script>
        function closeModal() {
            $('button.btn-close').click();
            $('#exLargeModal').modal('hide');
        }

        function submitRiset() {
            // Ambil form elemen
            var form = $('form#riset');
            // console.log(form);

            // Ambil data yang diinput
            var formData = new FormData(form[0]);

            // Kirim permintaan AJAX
            $.ajax({
                url: "{{ route('landing-page.daftar.riset') }}", // Ganti dengan route yang benar
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                beforeSend: function() {
                    $('#form-riset-loading').removeClass('d-none');
                },
                success: function(response) {
                    closeModal();
                    $('#form-riset-loading').addClass('d-none');
                    if (response.success) {
                        // hilangkan pesan error yang sudah ada
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        });
                        form.trigger('reset');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.error,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    closeModal();
                    $('#form-riset-loading').addClass('d-none');
                    if (xhr.status == 422) {
                        if (xhr.responseJSON.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.error,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat pengisian form, coba lagi.',
                            });
                        }

                        var errors = xhr.responseJSON.errors;

                        // Loop untuk semua error dan tambahkan class is-invalid serta pesan error
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var inputElement = $('[name="' + key + '"]');

                                // Hapus pesan error yang sudah ada sebelumnya
                                inputElement.removeClass('is-invalid');
                                inputElement.next('.invalid-feedback').remove();

                                // Tambahkan class is-invalid
                                inputElement.addClass('is-invalid');

                                // Tambahkan pesan error setelah elemen input
                                inputElement.after('<div class="invalid-feedback">' + errors[key][0] +
                                    '</div>');
                            }
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan, coba lagi.',
                        });
                    }
                }
            });
        }

        function submitKKP() {
            // Ambil form elemen
            var form = $('form#kkp');
            // console.log(form);

            // Ambil data yang diinput
            var formData = new FormData(form[0]);

            // Kirim permintaan AJAX
            $.ajax({
                url: "{{ route('landing-page.daftar.kkp') }}", // Ganti dengan route yang benar
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                beforeSend: function() {
                    $('#form-kkp-loading').removeClass('d-none');
                },
                success: function(response) {
                    closeModal();
                    $('#form-kkp-loading').addClass('d-none');
                    if (response.success) {
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        // close modal
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        });

                        // Bersihkan form
                        form.trigger('reset');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.error,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('#form-kkp-loading').addClass('d-none');
                    closeModal();
                    if (xhr.status === 422) {
                        if (xhr.responseJSON.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.error,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat pengisian form, coba lagi.',
                            });
                        }
                        var errors = xhr.responseJSON.errors;

                        // Loop untuk semua error dan tambahkan class is-invalid serta pesan error
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var inputElement = $('[name="' + key + '"]');

                                // Hapus pesan error yang sudah ada sebelumnya
                                inputElement.removeClass('is-invalid');
                                inputElement.next('.invalid-feedback').remove();

                                // Tambahkan class is-invalid
                                inputElement.addClass('is-invalid');

                                // Tambahkan pesan error setelah elemen input
                                inputElement.after('<div class="invalid-feedback">' + errors[key][0] +
                                    '</div>');
                            }
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan, coba lagi.',
                        });
                    }
                }
            });
        }

        function submitPrakerin() {
            // Ambil form elemen
            var form = $('form#prakerin');
            // console.log(form);

            // Ambil data yang diinput
            var formData = new FormData(form[0]);

            // Kirim permintaan AJAX
            $.ajax({
                url: "{{ route('landing-page.daftar.prakerin') }}", // Ganti dengan route yang benar
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                },
                beforeSend: function() {
                    $('#form-prakerin-loading').removeClass('d-none');
                },
                success: function(response) {
                    closeModal();
                    $('#form-prakerin-loading').addClass('d-none');
                    if (response.success) {
                        // hilangkan pesan error yang sudah ada
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        // close modal
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.error,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('#form-prakerin-loading').addClass('d-none');
                    closeModal();
                    if (xhr.status === 422) {
                        if (xhr.responseJSON.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.error,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terdapat kesalahan saat pengisian form, coba lagi.',
                            });
                        }
                        var errors = xhr.responseJSON.errors;

                        // Loop untuk semua error dan tambahkan class is-invalid serta pesan error
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var inputElement = $('[name="' + key + '"]');

                                // Hapus pesan error yang sudah ada sebelumnya
                                inputElement.removeClass('is-invalid');
                                inputElement.next('.invalid-feedback').remove();

                                // Tambahkan class is-invalid
                                inputElement.addClass('is-invalid');

                                // Tambahkan pesan error setelah elemen input
                                inputElement.after('<div class="invalid-feedback">' + errors[key][0] +
                                    '</div>');
                            }
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan, coba lagi.',
                        });
                    }
                }
            });
        }
    </script>
@endpush
