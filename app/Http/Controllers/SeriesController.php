<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Auth::user()->series()->with('genres')->get();
        return view('series.index', compact('series'));
    }

    public function create()
    {
        $genres = Auth::user()->genres;
        return view('series.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre_ids' => 'required|array|min:1',
            'genre_ids.*' => 'exists:genres,id',
            'jumlah_episode' => 'required|integer|min:1',
            'status' => 'required|in:Belum Ditonton,Sudah Ditonton',
        ]);

        $series = Auth::user()->series()->create([
            'judul' => $validated['judul'],
            'jumlah_episode' => $validated['jumlah_episode'],
            'status' => $validated['status'],
        ]);

        $series->genres()->sync($validated['genre_ids']);

        return redirect()->route('series.index')->with('success', 'Series berhasil ditambahkan!');
    }

    public function show(Series $series)
    {
        if ($series->user_id !== Auth::id()) {
            abort(403);
        }
        $series->load('genres');
        return view('series.show', compact('series'));
    }

    public function edit(Series $series)
    {
        if ($series->user_id !== Auth::id()) {
            abort(403);
        }
        $genres = Auth::user()->genres;
        return view('series.edit', compact('series', 'genres'));
    }

    public function update(Request $request, Series $series)
    {
        if ($series->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre_ids' => 'required|array|min:1',
            'genre_ids.*' => 'exists:genres,id',
            'jumlah_episode' => 'required|integer|min:1',
            'status' => 'required|in:Belum Ditonton,Sudah Ditonton',
        ]);

        $series->update([
            'judul' => $validated['judul'],
            'jumlah_episode' => $validated['jumlah_episode'],
            'status' => $validated['status'],
        ]);

        $series->genres()->sync($validated['genre_ids']);

        return redirect()->route('series.index')->with('success', 'Series berhasil diperbarui!');
    }

    public function destroy(Series $series)
    {
        if ($series->user_id !== Auth::id()) {
            abort(403);
        }

        $series->delete();

        return redirect()->route('series.index')->with('success', 'Series berhasil dihapus!');
    }
}
