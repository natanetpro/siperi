@extends('layouts.back.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
            <h3 class="text-center">{{ $kegiatan->kegiatan->nama_kegiatan }}</h3>
            <p class="text-center mb-0 px-3">Oleh: {{ $kegiatan->user->pemohon->nama_pemohon }}
                ({{ \Carbon\Carbon::parse($kegiatan->kegiatan->tanggal_mulai)->format('d M Y') }} -
                {{ \Carbon\Carbon::parse($kegiatan->kegiatan->tanggal_selesai)->format('d M Y') }})</p>
            @switch($kegiatan->active)
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
                                <small>Detail laporan akhir peserta bimbingan</small>
                            </div>
                        </div>
                        @if (!$kegiatan->laporan_akhir)
                            <p>Belum ada laporan akhir</p>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ $kegiatan->laporan_akhir->media[0]->original_url }}" class="card-text">
                                            Lihat Dokumen Akhir
                                            @if ($kegiatan->laporan_akhir->approval_pembimbing == 'Menunggu')
                                                <span class="badge ms-3 bg-warning">
                                                    {{ $kegiatan->laporan_akhir->approval_pembimbing }}
                                                @elseif($kegiatan->laporan_akhir->approval_pembimbing == 'Disetujui')
                                                    <span class="badge ms-3 bg-success">
                                                        {{ $kegiatan->laporan_akhir->approval_pembimbing }}
                                                    @elseif($kegiatan->laporan_akhir->approval_pembimbing == 'Ditolak')
                                                        <span class="badge ms-3 bg-danger">
                                                            {{ $kegiatan->laporan_akhir->approval_pembimbing }}
                                            @endif
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="text-danger">{{ $kegiatan->laporan_akhir->catatan_pembimbing }}</span>
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
@endsection
