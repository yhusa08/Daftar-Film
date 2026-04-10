@extends('layouts.app')

@section('title', 'Detail Series - Film Showlist App')

@section('content')
    <div class="detail-card">
        <h1>Detail Series</h1>

        <div>
            <div class="detail-title">Judul</div>
            <div class="detail-text">{{ $series->judul }}</div>
        </div>

        <div>
            <div class="detail-title">Genre</div>
            <div class="detail-text">
                @foreach($series->genres as $genre)
                    <span class="badge bg-secondary">{{ $genre->nama }}</span>
                @endforeach
            </div>
        </div>

        <div>
            <div class="detail-title">Jumlah Episode</div>
            <div class="detail-text">{{ $series->jumlah_episode }} episode</div>
        </div>

        <div>
            <div class="detail-title">Rating</div>
            <div class="detail-text">{{ $series->rating }}/10</div>
        </div>

        <a href="{{ route('series.index') }}" class="btn btn-kembali btn-secondary">Kembali ke Daftar Series</a>
    </div>
@endsection
