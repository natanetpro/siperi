@extends('layouts.back.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.setelan.menu.modul.update', $modul->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" class="form-control @error('nama_menu') is-invalid @enderror"
                                name="nama_menu" required value="{{ $modul->nama_menu }}" />
                            @error('nama_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parent Menu</label>
                            <select name="parent" class="form-select @error('parent') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ $menu->id == $modul->parent ? 'selected' : '' }}>
                                        {{ $menu->nama_menu }}</option>
                                @endforeach
                            </select>
                            @error('parent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                                value="{{ $modul->url }}" />
                            @error('url')
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
    @if (session('success'))
        <script>
            Swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @elseif($errors->any())
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
