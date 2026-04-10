<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Auth::user()->films()->with('genres')->get();
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Auth::user()->genres;
        return view('films.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre_ids' => 'required|array|min:1',
            'genre_ids.*' => 'exists:genres,id',
            'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
            'durasi' => 'required|integer|min:1',
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        $film = Auth::user()->films()->create([
            'judul' => $validated['judul'],
            'tahun_rilis' => $validated['tahun_rilis'],
            'durasi' => $validated['durasi'],
            'rating' => $validated['rating'],
        ]);

        $film->genres()->sync($validated['genre_ids']);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Auth::user()->films()->with('genres')->findOrFail($id);
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $film = Auth::user()->films()->with('genres')->findOrFail($id);
        $genres = Auth::user()->genres;
        return view('films.edit', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $film = Auth::user()->films()->findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre_ids' => 'required|array|min:1',
            'genre_ids.*' => 'exists:genres,id',
            'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
            'durasi' => 'required|integer|min:1',
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        $film->update([
            'judul' => $validated['judul'],
            'tahun_rilis' => $validated['tahun_rilis'],
            'durasi' => $validated['durasi'],
            'rating' => $validated['rating'],
        ]);

        $film->genres()->sync($validated['genre_ids']);

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $film = Auth::user()->films()->findOrFail($id);
        $film->delete();

        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus!');
    }
}
