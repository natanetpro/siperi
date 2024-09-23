@extends('layouts.back.app')

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        {{-- Hello, User --}}
        <h4 class="card-title
    mb-0">Hello, {{ Auth::user()->pemohon->nama_pemohon }}</h4>
        <p class="text-muted">Selamat datang di dashboard peserta</p>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Statistik</h5>
            </div>
            <div class="card-body pt-2">
                <div class="row gy-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-warning me-3 p-2">
                                <i class="ti ti-clock ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $menunggu }}</h5>
                                <small>Logbook Menunggu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-circle-check ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $diterima }}</h5>
                                <small>Logbook Disetujui</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-ban ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $ditolak }}</h5>
                                <small>Logbook Ditolak</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
