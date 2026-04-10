<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Auth::user()->genres;
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:120',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();

        Genre::create($validated);

        return redirect()->route('genres.index')->with('success', 'Genre berhasil ditambahkan!');
    }

    public function show(Genre $genre)
    {
        // Pastikan genre milik user
        if ($genre->user_id !== Auth::id()) {
            abort(403);
        }

        // Ambil film yang memiliki genre ini dan milik user
        $films = Auth::user()->films()->whereHas('genres', function ($query) use ($genre) {
            $query->where('genres.id', $genre->id);
        })->get();
        
        // Ambil series yang memiliki genre ini dan milik user
        $series = Auth::user()->series()->whereHas('genres', function ($query) use ($genre) {
            $query->where('genres.id', $genre->id);
        })->get();
        
        return view('genres.show', compact('genre', 'films', 'series'));
    }

    public function edit(Genre $genre)
    {
        if ($genre->user_id !== Auth::id()) {
            abort(403);
        }
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        if ($genre->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:120',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $genre->update($validated);

        return redirect()->route('genres.index')->with('success', 'Genre berhasil diperbarui!');
    }

    public function destroy(Genre $genre)
    {
        if ($genre->user_id !== Auth::id()) {
            abort(403);
        }

        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre berhasil dihapus!');
    }
}
