@extends('layouts.back.app')

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        {{-- Hello, User --}}
        <h4 class="card-title
        mb-0">Hello, {{ Auth::user()->nama }}</h4>
        <p class="text-muted">Selamat datang di dashboard admin</p>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Statistik</h5>
            </div>
            <div class="card-body pt-2">
                <div class="row gy-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-users ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $pemohon }}</h5>
                                <small>Pemohon</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-search ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $riset }}</h5>
                                <small>Riset</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-school ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $kkp }}</h5>
                                <small>KKP</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-briefcase ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $prakerin }}</h5>
                                <small>Prakerin</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-12 mb-4">
        <div class="card">
            <div class="card-header header-elements">
                <h5 class="card-title mb-0">Statistik</h5>
                <div class="card-action-element ms-auto py-0">
                    {{-- get month  & year --}}
                    <p>{{ Carbon\Carbon::now()->format('F Y') }}</p>
                </div>
            </div>
            <div class="card-body">
                <canvas id="kegiatan-chart" class="chartjs" data-height="400"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script> --}}
    <script>
        const ctx = document.getElementById('kegiatan-chart').getContext('2d');
        const data = {!! json_encode($kegiatan) !!}
        const pilpres = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => d.jenis_kegiatan),
                datasets: [{
                    label: 'Total Peserta',
                    data: data.map(d => d.total),
                    borderWidth: 2,
                    borderColor: '#5d78ff',
                    backgroundColor: '#5d78ff',
                }]
            },
            options: {},
        });
    </script>
@endpush
