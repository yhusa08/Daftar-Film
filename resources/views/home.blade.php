@extends('layouts.app')

@section('title', 'Dashboard - Film Showlist App')

@section('content')
    <div class="text-center mb-5">
        <h1>Selamat datang di Film Showlist</h1>
        <p class="lead">Pilih kategori untuk mengelola data film, genre, dan series.</p>
    </div>

    <div class="row gy-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title">Film</h3>
                    <p class="card-text">Lihat, tambah, ubah, dan hapus film dalam koleksi.</p>
                    <a href="{{ route('films.index') }}" class="btn btn-primary">Buka Film</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title">Genre</h3>
                    <p class="card-text">Kelola genre untuk mengelompokkan film dan series.</p>
                    <a href="{{ route('genres.index') }}" class="btn btn-primary">Buka Genre</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title">Series</h3>
                    <p class="card-text">Tambahkan atau edit series dan hubungkan dengan genre.</p>
                    <a href="{{ route('series.index') }}" class="btn btn-primary">Buka Series</a>
                </div>
            </div>
        </div>
    </div>
@endsection
