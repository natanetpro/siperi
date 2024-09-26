@extends('layouts.back.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
        {{-- <div class="d-flex gap-3">
            <a href="{{ route('admin.master-data.sertifikat.create') }}"><button class="btn btn-primary">Tambah
                    Sertif Mahasiswa</button></a>
            <a href="{{ route('admin.master-data.sertifikat.create') }}"><button class="btn btn-primary"
                    style="width: 300px">Tambah
                    Sertif Siswa</button></a>
        </div> --}}
    </div>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.master-data.sertifikat.createOrUpdate') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Pemimpin</label>
                            <input type="text" class="form-control @error('nama_pemimpin') is-invalid @enderror"
                                id="basic-default-fullname" name="nama_pemimpin" />
                            @error('nama_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Jabatan Pemimpin</label>
                            <input type="text" class="form-control @error('jabatan_pemimpin') is-invalid @enderror"
                                id="basic-default-fullname" name="jabatan_pemimpin" />
                            @error('jabatan_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">NIP Pemimpin</label>
                            <input type="number" class="form-control" id="basic-default-company" name="nip_pemimpin" />
                            @error('nip_pemimpin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <p>Nama Pemimpin: <strong id="nama_pemimpin">{{ $certificate->nama_pemimpin ?? '-' }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <p>NIP Pemimpin: <strong id="nip_pemimpin">{{ $certificate->nip_pemimpin ?? '-' }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <p>Jabatan Pemimpin: <strong
                                id="jabatan_pemimpin">{{ $certificate->jabatan_pemimpin ?? '-' }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @elseif($errors->any())
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
    <script>
        $('#sertifikat').DataTable();

        function deleteSertifikat(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/master-data/sertifikat/' + id,
                        type: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(data) {
                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
