@extends('layouts.app')

@section('title', 'Detail Film - Film Showlist App')

@section('content')
    <div class="detail-card">
        <div style="background: #f0f0f0; padding: 10px 15px; border-radius: 5px; color: #666; font-size: 0.9rem; margin-bottom: 20px;">
            <strong>Film ID:</strong> #{{ $film->id }}
        </div>

        <div style="text-align: center; margin-bottom: 40px; padding-bottom: 30px; border-bottom: 3px solid #667eea;">
            <h1 style="color: #667eea; font-weight: bold; margin: 20px 0; font-size: 2.5rem;">{{ $film->judul }}</h1>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;">
                @foreach($film->genres as $genre)
                    <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 8px 15px; border-radius: 20px; font-weight: bold;">{{ $genre->nama }}</span>
                @endforeach
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee; font-size: 1.1rem;">
            <div style="color: #667eea; font-weight: bold; width: 40%;">📅 Tahun Rilis</div>
            <div style="color: #333; width: 60%; text-align: right;"><span style="color: #764ba2; font-weight: bold;">{{ $film->tahun_rilis }}</span></div>
        </div>

        <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee; font-size: 1.1rem;">
            <div style="color: #667eea; font-weight: bold; width: 40%;">⏱️ Durasi</div>
            <div style="color: #333; width: 60%; text-align: right;"><span style="color: #667eea; font-weight: bold;">{{ $film->durasi }} menit</span></div>
        </div>

        <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee; font-size: 1.1rem;">
            <div style="color: #667eea; font-weight: bold; width: 40%;">⭐ Rating</div>
            <div style="color: #333; width: 60%; text-align: right;"><span style="color: #ffc107; font-size: 1.3rem; font-weight: bold;">{{ $film->rating }}/10</span></div>
        </div>

        <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: none; font-size: 1.1rem;">
            <div style="color: #667eea; font-weight: bold; width: 40%;">Tanggal Input</div>
            <div style="color: #333; width: 60%; text-align: right;">{{ $film->created_at->format('d M Y H:i') }}</div>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px; justify-content: center;">
            <a href="{{ route('films.edit', $film->id) }}" style="padding: 12px 30px; font-weight: bold; border: none; border-radius: 5px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none;">Edit Film</a>
            <a href="{{ route('films.index') }}" style="padding: 12px 30px; font-weight: bold; border: none; border-radius: 5px; background: #6c757d; color: white; text-decoration: none;">Kembali</a>
            <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display: inline-block; margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 12px 30px; font-weight: bold; border: none; border-radius: 5px; background: #dc3545; color: white; cursor: pointer;" onclick="return confirm('Yakin ingin menghapus film ini?')">Hapus Film</button>
            </form>
        </div>
    </div>
@endsection
