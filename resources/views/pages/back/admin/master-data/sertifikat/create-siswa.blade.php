@extends('layouts.back.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.master-data.sertifikat.store-siswa') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Pemimpin</label>
                            <input type="text" class="form-control @error('nama_pemimpin') is-invalid @enderror"
                                name="nama_pemimpin" required value="{{ old('nama_pemimpin') }}" />
                            @error('nama_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan Pemimpin</label>
                            <input type="text" class="form-control @error('jabatan_pemimpin') is-invalid @enderror"
                                name="jabatan_pemimpin" required value="{{ old('jabatan_pemimpin') }}" />
                            @error('jabatan_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIP Pemimpin</label>
                            <input type="number" class="form-control @error('nip_pemimpin') is-invalid @enderror"
                                name="nip_pemimpin" required value="{{ old('nip_pemimpin') }}" />
                            @error('nip_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">TTD Pemimpin (.png, .jpg, .jpeg)</label>
                            <input type="file" name="ttd_pemimpin"
                                class="form-control @error('ttd_pemimpin') is-invalid @enderror" required accept="image/*">
                            @error('ttd_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Template (.pdf)</label>
                            <input type="file" class="form-control @error('template') is-invalid @enderror"
                                name="template" required />
                            @error('template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($errors->any())
        <script>
            Swal.fire(
                'Error!',
                'Terdapat kesalahan. Harap periksa kembali form.',
                'error'
            )
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('error') }}',
                'error'
            )
        </script>
    @endif
@endpush
