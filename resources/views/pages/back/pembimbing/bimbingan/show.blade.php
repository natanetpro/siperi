@extends('layouts.back.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
            <h3 class="text-center">{{ $peserta->userKegiatan->kegiatan->nama_kegiatan }}</h3>
            <p class="text-center mb-0 px-3">Oleh: {{ $peserta->pemohon->nama_pemohon }}
                ({{ \Carbon\Carbon::parse($peserta->userKegiatan->kegiatan->tanggal_mulai)->format('d M Y') }} s/d
                {{ \Carbon\Carbon::parse($peserta->userKegiatan->kegiatan->tanggal_selesai)->format('d M Y') }})</p>
        </div>

        <div class="row mt-4">
            <!-- Navigation -->
            <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
                <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
                    <ul class="nav nav-align-left nav-pills flex-column">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#payment">
                                <i class="ti ti-book me-1 ti-sm"></i>
                                <span class="align-middle fw-semibold">Logbook</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery">
                                <i class="ti ti-file me-1 ti-sm"></i>
                                <span class="align-middle fw-semibold">Laporan Akhir</span>
                            </button>
                        </li>
                    </ul>
                    <div class="d-none d-md-block">
                        <div class="mt-4">
                            <img src="{{ asset('assets/img/illustrations/girl-sitting-with-laptop.png') }}"
                                class="img-fluid" width="270" alt="FAQ Image" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Navigation -->

            <!-- FAQ's -->
            <div class="col-lg-9 col-md-8 col-12">
                <div class="tab-content py-0">
                    <div class="tab-pane fade show active" id="payment" role="tabpanel">
                        <div class="d-flex mb-3 gap-3">
                            <div>
                                <span class="badge bg-label-primary rounded-2 p-2">
                                    <i class="ti ti-book ti-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-0">
                                    <span class="align-middle">Logbook</span>
                                </h4>
                                <small>Masukkan seluruh aktivitas kegiatan anda</small>
                            </div>
                        </div>

                        <div id="accordionPayment" class="accordion">
                            @forelse ($logbooks as $logbook)
                                <div class="card accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            aria-expanded="true" data-bs-target="#accordionPayment-{{ $logbook->id }}"
                                            aria-controls="accordionPayment-1">
                                            Tanggal: {{ Carbon\Carbon::parse($logbook->tanggal)->format('d M Y') }}

                                            @if ($logbook->approval_pembimbing == 'Menunggu')
                                                <span class="badge bg-warning ms-3">
                                                    {{ $logbook->approval_pembimbing }}
                                                @elseif($logbook->approval_pembimbing == 'Disetujui')
                                                    <span class="badge bg-success ms-3">
                                                        {{ $logbook->approval_pembimbing }}
                                                    @elseif($logbook->approval_pembimbing == 'Ditolak')
                                                        <span class="badge bg-danger ms-3">
                                                            {{ $logbook->approval_pembimbing }}
                                            @endif
                                            </span>
                                        </button>
                                    </h2>

                                    <div id="accordionPayment-{{ $logbook->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="card-text">
                                                            {{ $logbook->aktivitas }}
                                                        </p>
                                                        @if ($logbook->approval_pembimbing === 'Menunggu')
                                                            <div class="d-flex gap-3">
                                                                <form id="approve-logbook"
                                                                    action="{{ route('pembimbing.daftar-bimbingan.approve-logbook', $logbook->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="button"
                                                                        onclick="approveLogbook({{ $logbook->id }})"
                                                                        class="btn btn-success btn-sm"><i
                                                                            class="ti ti-check"></i></button>
                                                                </form>
                                                                <form onsubmit="return false;">
                                                                    <button onclick="rejectLogbook({{ $logbook->id }})"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="ti ti-x"></i></button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column gap-2">
                                                        <a href="{{ url($logbook->dokumentasi) }}" target="_blank">
                                                            {{ $logbook->dokumentasi }}
                                                        </a>
                                                        <span class="text-danger">{{ $logbook->catatan_pembimbing }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada aktivitas</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <div class="d-flex mb-3 gap-3">
                            <div>
                                <span class="badge bg-label-primary rounded-2 p-2">
                                    <i class="ti ti-file ti-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-0">
                                    <span class="align-middle">Laporan Akhir</span>
                                </h4>
                                <small>Masukkan laporan akhir sebagai validasi kegiatan anda</small>
                            </div>
                        </div>
                        @if (!$laporan_akhir)
                            <p>Belum ada laporan akhir</p>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ $laporan_akhir->media[0]->original_url }}" class="card-text">
                                            Lihat Dokumen Akhir
                                            @if ($laporan_akhir->approval_pembimbing == 'Menunggu')
                                                <span class="badge ms-3 bg-warning">
                                                    {{ $laporan_akhir->approval_pembimbing }}
                                                @elseif($laporan_akhir->approval_pembimbing == 'Disetujui')
                                                    <span class="badge ms-3 bg-success">
                                                        {{ $laporan_akhir->approval_pembimbing }}
                                                    @elseif($laporan_akhir->approval_pembimbing == 'Ditolak')
                                                        <span class="badge ms-3 bg-danger">
                                                            {{ $laporan_akhir->approval_pembimbing }}
                                            @endif
                                            </span>
                                        </a>
                                        <div class="d-flex gap-3">
                                            @if ($laporan_akhir->approval_pembimbing === 'Menunggu')
                                                <form id="approve-laporan-akhir"
                                                    action="{{ route('pembimbing.daftar-bimbingan.approve-laporan-akhir', $laporan_akhir->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button"
                                                        onclick="approveLaporanAkhir({{ $laporan_akhir->id }})"
                                                        class="btn btn-success btn-sm"><i class="ti ti-check"></i></button>
                                                </form>
                                                <form onsubmit="return false;">
                                                    <button onclick="rejectLaporanAkhir({{ $laporan_akhir->id }})"
                                                        class="btn btn-danger btn-sm"><i class="ti ti-x"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="text-danger">{{ $laporan_akhir->catatan_pembimbing }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /FAQ's -->
        </div>
    </div>

    {{-- Modal Reject Logbook --}}
    <div class="modal fade" id="reject-logbook" tabindex="-1" role="dialog" aria-labelledby="logbook-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="logbook-title">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <div class="mb-3">
                            <label for="laporan_akhir" class="form-label
                            ">Catatan</label>
                            <textarea class="form-control @error('catatan_pembimbing') is-invalid @enderror" name="catatan_pembimbing"
                                id="catatan_pembimbing" rows="3" required></textarea>
                            @error('catatan_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reject-laporan-akhir" tabindex="-1" role="dialog"
        aria-labelledby="laporan-akhir-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="logbook-title">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <div class="mb-3">
                            <label for="laporan_akhir" class="form-label
                            ">Catatan</label>
                            <textarea class="form-control @error('catatan_pembimbing') is-invalid @enderror" name="catatan_pembimbing"
                                id="catatan_pembimbing" rows="3" required></textarea>
                            @error('catatan_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
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
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan, harap periksa kembali form',
            });
        </script>
    @endif
    <script>
        function approveLogbook(id) {
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
                    $('#approve-logbook').submit();
                }
            })
        }


        function rejectLogbook(id) {
            $('#reject-logbook').modal('show');
            $('#reject-logbook form').attr('action', `{{ url('pembimbing/daftar-bimbingan/${id}/reject-logbook') }}`);
        }

        function approveLaporanAkhir(id) {
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
                    $('#approve-laporan-akhir').submit();
                }
            })
        }

        function rejectLaporanAkhir(id) {
            $('#reject-laporan-akhir').modal('show');
            $('#reject-laporan-akhir form').attr('action',
                `{{ url('pembimbing/daftar-bimbingan/${id}/reject-laporan-akhir') }}`);
        }
    </script>
@endpush
