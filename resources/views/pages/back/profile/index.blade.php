@extends('layouts.back.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <h5 class="card-header">Edit Akun</h5>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('profile.update-password') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nama_akun" class="form-label">Nama Akun</label>
                                <input class="form-control" type="text" id="nama_akun" name="nama_akun"
                                    value="{{ Auth::user()->nama }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email_akun" class="form-label">Email Akun</label>
                                <input class="form-control" type="text" id="email_akun" name="email_akun"
                                    value="{{ Auth::user()->email }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    id="password" name="password" value="" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input class="form-control" type="password" id="password_confirmation"
                                    name="password_confirmation" value="" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            @if (!Auth::user()->hasRole(['Administrator', 'Operator', 'Pembimbing', 'Pimpinan']))
                <div class="card mb-3">
                    <h5 class="card-header">Edit Data Diri</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('profile.update-data-diri') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama"
                                        class="form-control @error('nama_pemohon') is-invalid @enderror"
                                        placeholder="johndoe" name="nama_pemohon" required
                                        value="{{ Auth::user()->pemohon->nama_pemohon }}">
                                    @error('nama_pemohon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email"
                                        class="form-control @error('email_pemohon') is-invalid @enderror"
                                        placeholder="john.doe@email.com" aria-label="john.doe" name="email_pemohon" required
                                        value="{{ Auth::user()->pemohon->email_pemohon }}">
                                    @error('email_pemohon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="no_telp_pemohon">Telepon</label>
                                    <input type="number" id="no_telp_pemohon"
                                        class="form-control @error('no_telp_pemohon') is-invalid
                                        @enderror"
                                        placeholder="08xxxxxxxxx" aria-label="john.doe" name="no_telp_pemohon" required
                                        value="{{ Auth::user()->pemohon->no_telp_pemohon }}">
                                    @error('no_telp_pemohon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="L"
                                            {{ Auth::user()->pemohon->jenis_kelamin === 'L' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="P">
                                            {{ Auth::user()->pemohon->jenis_kelamin === 'P' ? 'selected' : '' }}Perempuan
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
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        name="tempat_lahir" required value="{{ Auth::user()->pemohon->tempat_lahir }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        placeholder="YYYY/MM/DD" name="tanggal_lahir" required
                                        value="{{ Auth::user()->pemohon->tanggal_lahir }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-3 universitas {{ !Auth::user()->pemohon->detailPemohonKuliah ? 'd-none' : '' }}">
                    <h5 class="card-header">Edit Data Pendidikan</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('profile.update-kuliah') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div>
                                    <label class="form-label" for="nim">NIM</label>
                                    <input type="number" id="nim"
                                        class="form-control @error('nim') is-invalid @enderror" required
                                        placeholder="212xxxxxxxxx" name="nim"
                                        value="{{ Auth::user()->pemohon->detailPemohonKuliah?->nim }}" />
                                    @error('nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="universitas">Universitas</label>
                                    <input type="text" id="universitas"
                                        class="form-control @error('universitas') is-invalid @enderror" name="universitas"
                                        required style="text-transform: uppercase"
                                        value="{{ Auth::user()->pemohon->detailPemohonKuliah?->universitas }}" />
                                    @error('universitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="fakultas">Fakultas</label>
                                    <input type="text" id="fakultas"
                                        class="form-control @error('fakultas') is-invalid @enderror" name="fakultas"
                                        required style="text-transform: uppercase"
                                        value="{{ Auth::user()->pemohon->detailPemohonKuliah?->fakultas }}" />
                                    @error('fakultas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="prodi">Program Studi</label>
                                    <input type="text" id="prodi"
                                        class="form-control @error('prodi') is-invalid @enderror" name="prodi" required
                                        style="text-transform: uppercase"
                                        value="{{ Auth::user()->pemohon->detailPemohonKuliah?->prodi }}" />
                                    @error('prodi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="semester">Semester</label>
                                    <input type="number" id="semester"
                                        class="form-control @error('semester') is-invalid @enderror" name="semester"
                                        required value="{{ Auth::user()->pemohon->detailPemohonKuliah?->semester }}" />
                                    @error('semester')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-3 sekolah {{ !Auth::user()->pemohon->detailPemohonSekolah ? 'd-none' : '' }}">
                    <h5 class="card-header">Edit Data Pendidikan</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('profile.update-sekolah') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="sekolah">
                                <div class="row g-3">
                                    <div>
                                        <label class="form-label" for="nis">NIS</label>
                                        <input type="number" id="nis"
                                            class="form-control @error('nis') is-invalid
                                            @enderror"
                                            placeholder="212xxxxxxxxx" required name="nis"
                                            value="{{ Auth::user()->pemohon->detailPemohonSekolah?->nis }}" />

                                        @error('nis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="sekolah">Sekolah</label>
                                        <input type="text" id="sekolah"
                                            class="form-control @error('sekolah') is-invalid @enderror" name="sekolah"
                                            required style="text-transform: uppercase"
                                            value="{{ Auth::user()->pemohon->detailPemohonSekolah?->sekolah }}" />
                                        @error('sekolah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="sekolah">Jurusan</label>
                                        <select name="jurusan" id=""
                                            class="form-select @error('jurusan') is-invalid @enderror">
                                            <option value="IPA"
                                                {{ Auth::user()->pemohon->detailPemohonSekolah?->jurusan === 'IPA' ? 'selected' : '' }}>
                                                IPA</option>
                                            <option value="IPS"
                                                {{ Auth::user()->pemohon->detailPemohonSekolah?->jurusan === 'IPS' ? 'selected' : '' }}>
                                                IPS</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="kelas">Kelas</label>
                                        <input type="number" id="kelas"
                                            class="form-control @error('kelas') is-invalid @enderror" name="kelas"
                                            required value="{{ Auth::user()->pemohon->detailPemohonSekolah?->kelas }}" />

                                        @error('kelas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-3">
                    <h5 class="card-header">Edit Kegiatan</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form action="{{ route('profile.update-kegiatan') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div>
                                    <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="text" id="nama_kegiatan"
                                        class="form-control @error('nama_kegiatan') is-invalid @enderror " required
                                        name="nama_kegiatan" placeholder="Masukkan nama kegiatan"
                                        style="text-transform: uppercase"
                                        value="{{ Auth::user()->userKegiatan->kegiatan->nama_kegiatan }}" />
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

    </div>
    </div>
@endsection

@push('scripts')
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terdapat kesalahan dalam pengisian form, silahkan periksa kembali form anda',
            });
        </script>
    @elseif(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
@endpush
