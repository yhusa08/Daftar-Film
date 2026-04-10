@extends('layouts.app')

@section('title', 'Tambah Genre - Film Showlist App')

@section('content')
    <div class="form-card">
        <h1>Tambah Genre</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Mohon periksa input Anda:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('genres.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Genre <span style="color: red;">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                       id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Drama" required>
                @error('nama')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit btn-primary">Simpan Genre</button>
            <a href="{{ route('genres.index') }}" class="btn btn-kembali btn-secondary">← Kembali</a>
        </form>
    </div>
@endsection
