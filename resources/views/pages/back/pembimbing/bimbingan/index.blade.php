@extends('layouts.back.app')
@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="bimbingan">
                <thead>
                    <tr>
                        <th>Jenis Kegiatan</th>
                        <th>Nama Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#bimbingan').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('pembimbing.daftar-bimbingan.index') }}",
            columns: [{
                    data: 'kegiatan.jenis_kegiatan',
                    name: 'kegiatan.jenis_kegiatan'
                },
                {
                    data: 'user.pemohon.nama_pemohon',
                    name: 'user.pemohon.nama_pemohon'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    </script>
@endpush
