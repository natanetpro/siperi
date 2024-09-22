@extends('layouts.back.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
            <h3 class="text-center">{{ Auth::user()->userKegiatan->kegiatan->nama_kegiatan }}</h3>
            <p class="text-center mb-0 px-3">Oleh: {{ Auth::user()->pemohon->nama_pemohon }}
                ({{ \Carbon\Carbon::parse(Auth::user()->pemohon->tanggal_mulai)->format('d M Y') }} -
                {{ \Carbon\Carbon::parse(Auth::user()->pemohon->tanggal_selesai)->format('d M Y') }})</p>
            @switch(Auth::user()->userKegiatan->active)
                @case(true)
                    <span class="badge bg-success mt-4">Sedang Berjalan</span>
                @break

                @case(false)
                    <span class="badge bg-danger mt-4">Selesai</span>
                @break
            @endswitch
        </div>

        <div class="row mt-4">
            <!-- Navigation -->
            <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
                <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
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
                    <div class="tab-panel" id="delivery" role="tabpanel">
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
                        @if (Auth::user()->userKegiatan->active && !$laporanAkhir)
                            <button class="btn btn-success mb-3" onclick="openModalLaporanAkhir('create')">Kirim Laporan
                                Akhir</button>
                        @endif
                        @if (!$laporanAkhir)
                            <p>Belum ada laporan akhir</p>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ $laporanAkhir->media[0]->original_url }}" class="card-text">
                                            Lihat Dokumen Akhir
                                            @if ($laporanAkhir->approval_pembimbing == 'Menunggu')
                                                <span class="badge ms-3 bg-warning">
                                                    {{ $laporanAkhir->approval_pembimbing }}
                                                @elseif($laporanAkhir->approval_pembimbing == 'Disetujui')
                                                    <span class="badge ms-3 bg-success">
                                                        {{ $laporanAkhir->approval_pembimbing }}
                                                    @elseif($laporanAkhir->approval_pembimbing == 'Ditolak')
                                                        <span class="badge ms-3 bg-danger">
                                                            {{ $laporanAkhir->approval_pembimbing }}
                                            @endif
                                            </span>
                                        </a>
                                        @if (Auth::user()->userKegiatan->active && $laporanAkhir->approval_pembimbing == 'Menunggu')
                                            <button onclick="openModalLaporanAkhir('edit', {{ $laporanAkhir->id }})"
                                                class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></button>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="text-danger">{{ $laporanAkhir->catatan_pembimbing }}</span>
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

    {{-- Modal --}}

    <div class="modal fade" id="laporan-akhir-modal" tabindex="-1" role="dialog"
        aria-labelledby="laporan-akhir-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="laporan-akhir-title">Kirim Laporan Akhir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <div class="mb-3">
                            <label for="laporan_akhir" class="form-label
                            ">Laporan
                                Akhir (.pdf, Max. 2048KB)</label>
                            <input type="file" class="form-control @error('laporan_akhir') is-invalid @enderror"
                                id="laporan_akhir" name="laporan_akhir" required>
                            @error('laporan_akhir')
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
    {{-- /Modal --}}
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
        function openModalLaporanAkhir(action, id = null) {
            $('#laporan-akhir-modal form').trigger('reset');
            if (action === 'create') {
                $('#laporan-akhir-title').text('Kirim Laporan Akhir');
                $('#laporan-akhir-modal').modal('show');
                $('#laporan-akhir-modal form').attr('action', '{{ route('peserta.laporan-akhir.store') }}');
                // remove method input if exists
                $("#laporan-akhir-modal form input[name='_method']").remove();
            } else if (action === 'edit', id != null) {
                $('#laporan-akhir-title').text('Edit Laporan Akhir');
                $('#laporan-akhir-modal').modal('show');

                $('#laporan-akhir-modal form').attr('action', `{{ route('peserta.laporan-akhir.update', '') }}/${id}`);
                $("#laporan-akhir-modal form").append('<input type="hidden" name="_method" value="PUT">');
            }

        }
    </script>
@endpush
