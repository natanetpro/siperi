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

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="sertifikat">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mahasiswa</td>
                        <td>
                            @if (count($certificate->where('jenis_sertifikat', 'Mahasiswa')) == 0)
                                <a href="{{ route('admin.master-data.sertifikat.create-mahasiswa') }}"
                                    class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
                            @else
                                <a href="{{ route('admin.master-data.sertifikat.edit-mahasiswa') }}"
                                    class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Siswa</td>
                        <td>
                            @if (count($certificate->where('jenis_sertifikat', 'Siswa')) == 0)
                                <a href="{{ route('admin.master-data.sertifikat.create-siswa') }}"
                                    class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
                            @else
                                <a href="{{ route('admin.master-data.sertifikat.edit-siswa') }}"
                                    class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
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
