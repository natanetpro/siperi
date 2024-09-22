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
                        @if (Auth::user()->userKegiatan->active)
                            <button class="btn btn-success mb-3" onclick="openModalLogbook('create')">Tambah
                                Aktivitas</button>
                        @endif
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
                                                        @if (Auth::user()->userKegiatan->active && $logbook->approval_pembimbing == 'Menunggu')
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="openModalLogbook('edit', {{ $logbook->id }})"><i
                                                                    class="ti ti-pencil"></i></button>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column gap-2">
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
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                name="tanggal" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="aktivitas" class="form-label">Aktivitas</label>
                            <textarea class="form-control" id="aktivitas @error('aktivitas') is-invalid @enderror" name="aktivitas" rows="3"
                                required></textarea>
                            @error('aktivitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="hasil" class="form-label">Dokumentasi (link drive)</label>
                            <input type="text" class="form-control @error('dokumentasi') is-invalid @enderror" required
                                placeholder="https://drive.google.com/" name="dokumentasi">
                            @error('dokumentasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- 
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
                                Akhir (.pdf)</label>
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
    </div> --}}
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
                $('#logbook-modal form').attr('action', '{{ route('peserta.logbook.store') }}');
                // min today
                var today = new Date().toISOString().split('T')[0];
                $('#logbook-modal form input[name="tanggal"]').attr('min', today);
                // remove method PUT
                $("#logbook-modal form input[name='_method']").remove();
            } else if (action === 'edit', id != null) {
                $('#logbook-title').text('Edit Aktivitas');
                $('#logbook-modal').modal('show');

                $.ajax({
                    url: `{{ route('peserta.logbook.show', '') }}/${id}`,
                    type: 'GET',
                    success: function(response) {
                        $('#logbook-modal form').attr('action',
                            `{{ route('peserta.logbook.update', '') }}/${id}`);
                        $("#logbook-modal form").append('<input type="hidden" name="_method" value="PUT">');
                        $('#logbook-modal form input[name="tanggal"]').val(response.tanggal);
                        $('#logbook-modal form textarea[name="aktivitas"]').val(response.aktivitas);
                    }
                })
            }
        }
    </script>
@endpush
