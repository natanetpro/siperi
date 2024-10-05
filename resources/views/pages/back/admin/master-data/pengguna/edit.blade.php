{{-- @dd($pengguna->getRoleNames()) --}}
@extends('layouts.back.app')
@push('title')
    Tambah Pembimbing
@endpush
@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.master-data.pengguna.update', $pengguna->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_asli') is-invalid @enderror"
                                name="nama_asli" required value="{{ $pengguna->nama_asli }}" />
                            @error('nama_asli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Akun</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                required value="{{ $pengguna->nama }}" />
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                                required value="{{ $pengguna->no_telp }}" />
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                required value="{{ $pengguna->email }}" />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Roles</label>
                            <select name="roles[]" class="form-select select2 @error('roles') is-invalid @enderror"
                                multiple>
                                @foreach ($roles as $role)
                                    <option {{-- @dd(in_array($role->name, $pengguna->getRoleNames()->toArray())) --}} value="{{ $role->name }}"
                                        {{ in_array($role->name, $pengguna->getRoleNames()->toArray()) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($errors->any())
        <script>
            Swal.fire(
                'Error!',
                'Terdapat kesalahan. Harap periksa kembali form.',
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
@endpush
