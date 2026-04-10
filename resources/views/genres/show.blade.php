@extends('layouts.app')

@section('title', 'Detail Genre - Film Showlist App')

@section('content')
    <div class="detail-card">
        <h1>Detail Genre</h1>

        <div>
            <div class="detail-title">Nama Genre</div>
            <div class="detail-text">{{ $genre->nama }}</div>
        </div>

        <div style="margin-top: 30px;">
            <div class="detail-title">Film dalam Genre Ini</div>
            @if($films->isEmpty())
                <div class="detail-text">Belum ada film dalam genre ini.</div>
            @else
                <div style="margin-top: 15px;">
                    @foreach($films as $film)
                        <div style="padding: 10px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px; background: #f9f9f9;">
                            <strong>{{ $film->judul }}</strong>
                            <div style="color: #666; font-size: 0.9rem; margin-top: 5px;">
                                {{ $film->tahun_rilis }} | {{ $film->durasi }} menit | {{ $film->rating }}/10
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div style="margin-top: 30px;">
            <div class="detail-title">Series dalam Genre Ini</div>
            @if($series->isEmpty())
                <div class="detail-text">Belum ada series dalam genre ini.</div>
            @else
                <div style="margin-top: 15px;">
                    @foreach($series as $item)
                        <div style="padding: 10px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px; background: #f9f9f9;">
                            <strong>{{ $item->judul }}</strong>
                            <div style="color: #666; font-size: 0.9rem; margin-top: 5px;">
                                {{ $item->jumlah_episode }} episode | {{ $item->rating }}/10
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <a href="{{ route('genres.index') }}" class="btn btn-kembali btn-secondary" style="margin-top: 30px;">Kembali ke Daftar Genre</a>
    </div>
@endsection
