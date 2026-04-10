@extends('layouts.app')

@section('title', 'Daftar Film - Film Showlist App')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Film</h1>
        <a href="{{ route('films.create') }}" class="btn btn-tambah btn-primary">+ Tambah Film Baru</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($films->isEmpty())
        <div class="alert alert-info text-center mt-5">
            <h4>Belum ada film</h4>
            <p>Silakan <a href="{{ route('films.create') }}">tambah film baru</a> untuk memulai.</p>
        </div>
    @else
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Judul</th>
                    <th width="15%">Genre</th>
                    <th width="10%">Tahun Rilis</th>
                    <th width="10%">Durasi</th>
                    <th width="10%">Rating</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td>{{ $film->id }}</td>
                        <td><strong>{{ $film->judul }}</strong></td>
                        <td>
                            @foreach($film->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->nama }}</span>
                            @endforeach
                        </td>
                        <td><span class="tahun">{{ $film->tahun_rilis }}</span></td>
                        <td><span class="durasi">{{ $film->durasi }} menit</span></td>
                        <td><span class="rating">{{ $film->rating }}/10</span></td>
                        <td>
                            <a href="{{ route('films.show', $film->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <style>
        .rating { color: #ffc107; font-weight: bold; }
        .durasi { color: #667eea; font-weight: bold; }
        .tahun { color: #764ba2; font-weight: bold; }
    </style>
@endsection
