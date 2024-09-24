@extends('layouts.back.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="admin-sertifikat">
                <thead>
                    <tr>
                        <th>Peserta</th>
                        <th>Kegiatan</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#admin-sertifikat').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.sertifikat.index') }}',
            columns: [{
                    data: 'user.pemohon.nama_pemohon',
                    name: 'user.pemohon.nama_pemohon'
                },
                {
                    data: 'kegiatan.nama_kegiatan',
                    name: 'kegiatan.nama_kegiatan'
                },
                {
                    data: 'hasil',
                    name: 'hasil',
                    render: function(data, type, row) {
                        return data ? data : '-';
                    }
                },
                {
                    data: 'active',
                    name: 'active',
                    render: function(data) {
                        if (data == 1) {
                            return '<span class="badge bg-success">Aktif</span>';
                        } else {
                            return '<span class="badge bg-danger">Tidak Aktif</span>';
                        }
                    },
                    orderable: false,
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    </script>
@endpush
