@extends('layouts.app')

@section('title', 'Tambah Film - Film Showlist App')

@section('content')
    <div class="form-card">
        <h1>Tambah Film Baru</h1>

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

        <form action="{{ route('films.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Film <span style="color: red;">*</span></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                       id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul film" required>
                @error('judul')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Genre <span style="color: red;">*</span></label>
                <div style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; background: #f9f9f9;">
                    @if($genres->isEmpty())
                        <p style="color: #999; margin: 0;">Belum ada genre. Silakan <a href="{{ route('genres.create') }}">tambah genre</a> terlebih dahulu.</p>
                    @else
                        @foreach($genres as $genre)
                            <div style="margin-bottom: 8px;">
                                <input type="checkbox" class="form-check-input" 
                                       id="genre_{{ $genre->id }}" name="genre_ids[]" 
                                       value="{{ $genre->id }}" 
                                       {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="genre_{{ $genre->id }}" style="margin-left: 5px; cursor: pointer;">
                                    {{ $genre->nama }}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>
                @error('genre_ids')
                    <div class="error-message" style="margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tahun_rilis" class="form-label">Tahun Rilis <span style="color: red;">*</span></label>
                <input type="number" class="form-control @error('tahun_rilis') is-invalid @enderror" 
                       id="tahun_rilis" name="tahun_rilis" value="{{ old('tahun_rilis') }}" 
                       placeholder="Contoh: 2024" min="1900" max="{{ date('Y') }}" required>
                @error('tahun_rilis')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi (menit) <span style="color: red;">*</span></label>
                <input type="number" class="form-control @error('durasi') is-invalid @enderror" 
                       id="durasi" name="durasi" value="{{ old('durasi') }}" 
                       placeholder="Contoh: 120" min="1" required>
                @error('durasi')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating (0-10) <span style="color: red;">*</span></label>
                <input type="number" class="form-control @error('rating') is-invalid @enderror" 
                       id="rating" name="rating" value="{{ old('rating') }}" 
                       placeholder="Contoh: 8.5" step="0.1" min="0" max="10" required>
                @error('rating')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit btn-primary">Simpan</button>
            <a href="{{ route('films.index') }}" class="btn btn-kembali btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
