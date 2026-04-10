@extends('layouts.app')

@section('title', 'Daftar Series - Film Showlist App')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Series</h1>
        <a href="{{ route('series.create') }}" class="btn btn-tambah btn-primary">+ Tambah Series Baru</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($series->isEmpty())
        <div class="alert alert-info text-center mt-5">
            <h4>Belum ada series</h4>
            <p>Silakan <a href="{{ route('series.create') }}">tambah series baru</a> untuk memulai.</p>
        </div>
    @else
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Judul</th>
                    <th width="20%">Genre</th>
                    <th width="15%">Episode</th>
                    <th width="10%">Rating</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($series as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><strong>{{ $item->judul }}</strong></td>
                        <td>
                            @foreach($item->genres as $genre)
                                <span class="badge bg-primary badge-genre">{{ $genre->nama }}</span>
                            @endforeach
                        </td>
                        <td>{{ $item->jumlah_episode }} episode</td>
                        <td>{{ $item->rating }}/10</td>
                        <td>
                            <a href="{{ route('series.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('series.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('series.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus series ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
