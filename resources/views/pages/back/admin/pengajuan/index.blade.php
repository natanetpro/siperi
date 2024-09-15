@extends('layouts.back.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
        {{-- <a href="{{ route('admin.master-data.pembimbing.create') }}"><button class="btn btn-primary">Tambah Data</button></a> --}}
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="my-3 d-flex gap-3 justify-content-between">
            <div class="d-flex flex-row gap-3">
                <div class="d-flex flex-column gap-1">
                    <label for="" class="fw-bold">Jenis Kegiatan:</label>
                    <select name="jenis_kegiatan" id="" class="select select2 form-control">
                        <option value="">Semua</option>
                        <option value="Riset">Penelitian/Riset</option>
                        <option value="KKP">Kuliah Kerja Praktik</option>
                        <option value="Prakerin">Praktik Kerja Industri</option>
                    </select>
                </div>

                <div class="d-flex flex-column gap-1">
                    <label for="" class="fw-bold">Status:</label>
                    <select name="jenis_kegiatan" id="" class="select select2 form-control">
                        <option value="">Semua</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Disetujui">Disetujui</option>
                    </select>
                </div>
            </div>

            <div class="me-3">
                <span class="text-danger fw-bold" style="cursor: pointer" onclick="reset()">Reset</span>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="pengajuan">
                <thead>
                    <tr>
                        <th>Jenis Kegiatan</th>
                        <th>Nama Pemohon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
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
        $('#pengajuan').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.pengajuan.index') }}',
            columns: [{
                    data: 'jenis_kegiatan',
                    name: 'jenis_kegiatan'
                },
                {
                    data: 'pemohon.nama_pemohon',
                    name: 'pemohon.nama_pemohon'
                },
                {
                    data: 'approval_admin',
                    name: 'approval_admin'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // jika select jenis kegiatan atau status diubah maka akan mereload datatable dan mengambil data sesuai dengan jenis kegiatan atau status yang dipilih
        $('select').on('change', function() {
            $('#pengajuan').DataTable().ajax.url('{{ route('admin.pengajuan.index') }}?jenis_kegiatan=' + $(
                'select[name=jenis_kegiatan]').val() + '&status=' + $('select[name=status]').val()).load();
        });

        function reset() {
            $('select').val('');
            $('#pengajuan').DataTable().ajax.url('{{ route('admin.pengajuan.index') }}').load();
        }
    </script>
@endpush
