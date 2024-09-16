@extends('layouts.back.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
            <h3 class="text-center">{{ Auth::user()->userKegiatan->kegiatan->nama_kegiatan }}</h3>
            <p class="text-center mb-0 px-3">Silahkan isi logbook harian dan laporan akhir setelah kegiatan selesai.</p>
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
                        <button class="btn btn-success mb-3" onclick="openModalLogbook('create')">Tambah
                            Aktivitas</button>
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

                                                        <button class="btn btn-warning btn-sm"
                                                            onclick="openModalLogbook('edit', {{ $logbook->id }})"><i
                                                                class="ti ti-pencil"></i></button>
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
                                    <span class="align-middle">Delivery</span>
                                </h4>
                                <small>Lorem ipsum, dolor sit amet.</small>
                            </div>
                        </div>
                        <div id="accordionDelivery" class="accordion">
                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        aria-expanded="true" data-bs-target="#accordionDelivery-1"
                                        aria-controls="accordionDelivery-1">
                                        Q1: How would you ship my order?
                                    </button>
                                </h2>

                                <div id="accordionDelivery-1" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        For large products, we deliver your product via a third party logistics company
                                        offering
                                        you the “room of choice” scheduled delivery service. For small products, we offer
                                        free
                                        parcel delivery.
                                    </div>
                                </div>
                            </div>

                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionDelivery-2" aria-controls="accordionDelivery-2">
                                        Q2: What is the delivery cost of my order?
                                    </button>
                                </h2>
                                <div id="accordionDelivery-2" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        The cost of scheduled delivery is $69 or $99 per order, depending on the destination
                                        postal code. The parcel delivery is free.
                                    </div>
                                </div>
                            </div>

                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionDelivery-4" aria-controls="accordionDelivery-4">
                                        Q3: What to do if my product arrives damaged?
                                    </button>
                                </h2>
                                <div id="accordionDelivery-4" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        We will promptly replace any product that is damaged in transit. Just contact our
                                        <a href="javascript:void(0);">support team</a>, to notify us of the situation
                                        within 48
                                        hours of product arrival.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /FAQ's -->
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="logbook-modal" tabindex="-1" role="dialog" aria-labelledby="logbook-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="logbook-title">Tambah Aktivitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="aktivitas" class="form-label">Aktivitas</label>
                            <textarea class="form-control" id="aktivitas @error('aktivitas') is-invalid @enderror" name="aktivitas"
                                rows="3" required></textarea>
                            @error('aktivitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hasil" class="form-label">Dokumentasi (link drive)</label>
                            <input type="text" class="form-control @error('dokumentasi') is-invalid @enderror" required
                                placeholder="https://drive.google.com/" name="dokumentasi">
                            @error('dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
        function openModalLogbook(action, id = null) {
            $('#logbook-modal form').trigger('reset');
            if (action === 'create') {
                $('#logbook-title').text('Tambah Aktivitas');
                $('#logbook-modal').modal('show');
                $('#logbook-modal form').attr('action', '{{ route('peserta.kegiatan.store') }}');
            } else if (action === 'edit', id != null) {
                $('#logbook-title').text('Edit Aktivitas');
                $('#logbook-modal').modal('show');

                $.ajax({
                    url: `/peserta/kegiatan/${id}`,
                    type: 'GET',
                    success: function(response) {
                        $('#logbook-modal form').attr('action', `/peserta/kegiatan/${id}`);
                        $("#logbook-modal form").append('<input type="hidden" name="_method" value="PUT">');
                        $('#logbook-modal form input[name="tanggal"]').val(response.logbook.tanggal);
                        $('#logbook-modal form textarea[name="aktivitas"]').val(response.logbook.aktivitas);
                        $('#logbook-modal form input[name="dokumentasi"]').val(response.logbook.dokumentasi);
                    }
                })
            }
        }
    </script>
@endpush
