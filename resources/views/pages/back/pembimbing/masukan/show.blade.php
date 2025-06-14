@extends('layouts.back.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ route('pembimbing.masukan.store') }}" method="post">
            <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded">
                @csrf
                <h3 class="text-center">Masukan dan Saran</h3>
                <small class="font-light mb-3" style="margin-top: -20px">(Untuk:
                    {{ $peserta->user->pemohon->nama_pemohon }})</small>
                <div class="input-wrapper mb-3 input-group input-group-lg input-group-merge">
                    <textarea class="form-control @error('masukan_saran') is-invalid @enderror" placeholder="Masukan & saran"
                        aria-label="Masukan & Saran" aria-describedby="basic-addon1" name="masukan_saran" required></textarea>
                </div>
                <input type="hidden" value="{{ $peserta->id }}" name="user_kegiatan_id">
                <button class="btn btn-success">Kirim</button>
            </div>
        </form>

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
                    <div class="tab-pane fade show active" id="payment" role="tabpanel">
                        <div class="d-flex mb-3 gap-3">
                            <div>
                                <span class="badge bg-label-primary rounded-2 p-2">
                                    <i class="ti ti-book ti-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-0">
                                    <span class="align-middle">Masukkan & Saran</span>
                                </h4>
                                <small>
                                    Masukan dan saran untuk peserta
                                </small>
                            </div>
                        </div>

                        <div id="accordionPayment" class="accordion">
                            @forelse ($masukan as $m)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p class="card-text">
                                                {{ $m->masukan_saran }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada masukan & saran</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- /FAQ's -->
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
        // function approveLogbook(id) {
        //     Swal.fire({
        //         title: 'Apakah anda yakin?',
        //         text: "Data yang sudah disimpan tidak dapat diubah kembali!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, Simpan!',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $('#approve-logbook').submit();
        //         }
        //     })
        // }


        // function rejectLogbook(id) {
        //     $('#reject-logbook').modal('show');
        //     $('#reject-logbook form').attr('action', `{{ route('pembimbing.logbook.reject', '') }}/${id}`);
        // }
    </script>
@endpush
