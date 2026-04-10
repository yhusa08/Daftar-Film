@extends('layouts.app')

@section('title', 'Daftar Genre - Film Showlist App')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Genre</h1>
        <a href="{{ route('genres.create') }}" class="btn btn-tambah btn-primary">+ Tambah Genre Baru</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($genres->isEmpty())
        <div class="alert alert-info text-center mt-5">
            <h4>Belum ada genre</h4>
            <p>Silakan <a href="{{ route('genres.create') }}">tambah genre baru</a> untuk memulai.</p>
        </div>
    @else
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="40%">Nama</th>
                    <th width="55%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td><strong>{{ $genre->nama }}</strong></td>
                        <td>
                            <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus genre ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
