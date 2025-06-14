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
                    <select name="jenis_kegiatan" id="" class="select form-control">
                        <option value="">Semua</option>
                        <option value="Riset">Penelitian/Riset</option>
                        <option value="KKP">Kuliah Kerja Praktik</option>
                        <option value="Prakerin">Praktik Kerja Industri</option>
                    </select>
                </div>

                <div class="d-flex flex-column gap-1">
                    <label for="" class="fw-bold">Status:</label>
                    <select name="status" id="" class="select form-control">
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

    {{-- Modal --}}
    <div class="modal fade" id="pengajuan-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form-approval">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold">Data Diri</h5>
                                <div class="row">
                                    {{-- gunakan p --}}
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Nama Lengkap:</p>
                                            <span id="nama_lengkap"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Email:</p>
                                            <span id="email"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Telepon:</p>
                                            <span id="no_telp"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Jenis Kelamin:</p>
                                            <span id="jenis_kelamin"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Tempat/Tanggal Lahir:</p>
                                            <span id="tempat_tanggal_lahir"></span>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-bold">Data Pendidikan</h5>
                                <div class="row kuliah">
                                    {{-- gunakan p --}}
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">NIM:</p>
                                            <span id="nim"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Universitas:</p>
                                            <span id="universitas"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Fakultas:</p>
                                            <span id="fakultas"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Prodi:</p>
                                            <span id="prodi"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Semester:</p>
                                            <span id="semester"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row sekolah">
                                    {{-- gunakan p --}}
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">NIS:</p>
                                            <span id="nis"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Sekolah:</p>
                                            <span id="sekolah"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Jurusan:</p>
                                            <span id="jurusan"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Kelas:</p>
                                            <span id="kelas"></span>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-bold">Data Kegiatan</h5>
                                <div class="row">
                                    {{-- gunakan p --}}
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Jenis Kegiatan:</p>
                                            <span id="jenis_kegiatan"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Nama Kegiatan:</p>
                                            <span id="nama_kegiatan"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Tanggal Mulai:</p>
                                            <span id="tanggal_mulai"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Tanggal Selesai:</p>
                                            <span id="tanggal_selesai"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-1">
                                            <p class="fw-bold">Surat Permohonan:</p>
                                            <span id="surat_permohonan"></span>
                                        </div>
                                    </div>
                                </div>

                                <label for="" class="fw-bold">Persetujuan</label>
                                <select name="approval_admin" id="" class="form-select">
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Disetujui">Disetujui</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>

                                <div class="alasan-ditolak mt-3" style="display:none">
                                    <label for="" class="fw-bold">Alasan Ditolak</label>
                                    <textarea name="catatan_admin" id="" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="confirmUpdate()" class="btn btn-primary"
                                id="submit-pengajuan">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    <!-- Large Modal -->
    <div class="modal fade" id="pembimbing-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Pasang Pembimbing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="pembimbing" class="form-label">Nama Dosen Pembimbing</label>
                                <select class="form-select @error('pembimbing_id') is-invalid @enderror"
                                    name="pembimbing_id" id="">
                                    @foreach ($pembimbing as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pembimbing_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">Set</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    'Terjadi kesalahan saat input data',
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
                        // modif jika status menunggu maka akan ditampilkan warna kuning, jika ditolak warna merah, jika disetujui warna hijau
                        data: 'approval_admin',
                        name: 'approval_admin',
                        render: function(data) {
                            if (data == 'Menunggu') {
                                return '<span class="badge bg-warning">' + data + '</span>';
                            } else if (data == 'Ditolak') {
                                return '<span class="badge bg-danger">' + data + '</span>';
                            } else {
                                return '<span class="badge bg-success">' + data + '</span>';
                            }
                        }
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

            function openModalPengajuan(id) {
                $('#pengajuan-modal').modal('show');
                $('#pengajuan-modal .modal-title').text('Detail Pengajuan');

                $.ajax({
                    url: `pengajuan/${id}`,
                    type: 'GET',
                    success: function(response) {
                        $('#nama_lengkap').text(response.pemohon.nama_pemohon);
                        $('#email').text(response.pemohon.email_pemohon);
                        $('#no_telp').text(response.pemohon.no_telp_pemohon);
                        $('#jenis_kelamin').text(response.pemohon.jenis_kelamin);
                        $('#tempat_tanggal_lahir').text(response.pemohon.tempat_lahir + '/' + response.pemohon
                            .tanggal_lahir);
                        $('#jenis_kegiatan').text(response.jenis_kegiatan);
                        $('#nama_kegiatan').text(response.nama_kegiatan);
                        $('#tanggal_mulai').text(response.tanggal_mulai);
                        $('#tanggal_selesai').text(response.tanggal_selesai);
                        $('#surat_permohonan').html(
                            `<a href="${response.media[0].original_url}" target="_blank">Lihat Surat</a>`
                        );
                        $('select[name=approval_admin]').val(response.approval_admin);

                        if (response.jenis_kegiatan == 'Riset' || response.jenis_kegiatan == 'KKP') {
                            $('.kuliah').show();
                            $('.sekolah').hide();
                            $('#nim').text(response.pemohon.detail_pemohon_kuliah.nim);
                            $('#universitas').text(response.pemohon.detail_pemohon_kuliah.universitas);
                            $('#fakultas').text(response.pemohon.detail_pemohon_kuliah.fakultas);
                            $('#prodi').text(response.pemohon.detail_pemohon_kuliah.prodi);
                            $('#semester').text(response.pemohon.detail_pemohon_kuliah.semester);
                        } else {
                            $('.kuliah').hide();
                            $('.sekolah').show();
                            $('#nis').text(response.pemohon.detail_pemohon_sekolah.nis);
                            $('#sekolah').text(response.pemohon.detail_pemohon_sekolah.sekolah);
                            $('#jurusan').text(response.pemohon.detail_pemohon_sekolah.jurusan);
                            $('#kelas').text(response.pemohon.detail_pemohon_sekolah.kelas);
                        }

                        if (response.approval_admin == 'Ditolak' || response.approval_admin == 'Disetujui') {
                            $('select[name=approval_admin]').attr('disabled', true);
                            $('form#form-approval').attr('action', '#');
                            $('button#submit-pengajuan').attr('disabled', true);
                            $('button#submit-pengajuan').text('Data sudah disimpan');
                        } else {
                            $('select[name=approval_admin]').attr('disabled', false);
                            $('button#submit-pengajuan').attr('disabled', false);
                            $('form#form-approval').attr('action', 'pengajuan/' + id);
                            $('button#submit-pengajuan').text('Simpan');
                        }

                        if (response.approval_admin === 'Ditolak') {
                            $('.alasan-ditolak').show();
                            $('textarea[name=catatan_admin]').val(response.catatan_admin);
                            $('textarea[name=catatan_admin]').attr('disabled', true);
                        } else {
                            $('.alasan-ditolak').hide();
                            $('textarea[name=catatan_admin]').val('');
                            $('textarea[name=catatan_admin]').attr('disabled', false);
                        }

                        $('form#form-approval').attr('action', 'pengajuan/' + id);

                    }
                });
            }

            $('select[name=approval_admin]').on('change', function() {
                if ($(this).val() == 'Ditolak') {
                    $('.alasan-ditolak').show();
                    $('textarea[name=catatan_admin]').attr('required', true);
                    $('textarea[name=catatan_admin]').attr('disabled', false);
                } else {
                    $('.alasan-ditolak').hide();
                    $('textarea[name=catatan_admin]').val('');
                    $('textarea[name=catatan_admin]').attr('required', false);
                    $('textarea[name=catatan_admin]').attr('disabled', true);
                }
            });

            function confirmUpdate() {
                $('#pengajuan-modal').modal('hide');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang sudah disimpan tidak dapat diubah kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-approval').submit();
                    }
                })
            }

            function openModalPembimbing(id) {
                $('#pembimbing-modal').modal('show');
                $('#pembimbing-modal form').attr('action', 'pengajuan/' + id + '/set-pembimbing');
            }

            function deletePemohon(id) {
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
                            url: `{{ route('admin.pengajuan.destroy', '') }}/${id}`,
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
