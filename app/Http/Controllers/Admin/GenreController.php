<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('comics')->orderBy('name')->paginate(15);
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name',
            'color' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,'.$genre->id,
            'color' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil dihapus.');
    }
}
