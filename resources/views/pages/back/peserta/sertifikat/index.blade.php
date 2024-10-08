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
            <!-- FAQ's -->
            <div class="col-lg-9 col-md-8 col-12">
                <div class="tab-content py-0">
                    <div class="tab-panel" id="certificate" role="tabpanel">
                        <div class="d-flex mb-3 gap-3">
                            <div>
                                <span class="badge bg-label-primary rounded-2 p-2">
                                    <i class="ti ti-certificate ti-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-0">
                                    <span class="align-middle">Sertifikat</span>
                                </h4>
                                <small>Silahkan download sertifikat kegiatan anda (Harap menyelesaikan logbook dan laporan
                                    akhir)</small>
                            </div>
                        </div>
                        {{-- check jika logbook semua logbook telah disetujui dan telah upload laporan akhir --}}
                        @if (Auth::user()->userKegiatan->logbooks->where('approval_pembimbing', 'Disetujui')->count() ==
                                Auth::user()->userKegiatan->logbooks->count() &&
                                Auth::user()->userKegiatan->laporan_akhir->where('approval_pembimbing', 'Disetujui')->count() > 0)
                            <a href="{{ route('peserta.sertifikat.show', Auth::user()->userKegiatan->id) }}"
                                class="btn btn-success mb-3" target="_blank">Download
                                Sertifikat</a>
                        @endif
                        {{-- <a href="" class="btn btn-success mb-3">Download Sertifikat</a> --}}
                    </div>
                </div>
            </div>
            <!-- /FAQ's -->
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endpush
