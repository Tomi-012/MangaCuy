<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Comic;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::active()
            ->withCount('comics')
            ->orderBy('name')
            ->get();

        return view('frontend.genre.index', compact('genres'));
    }

    public function show($slug)
    {
        $genre = Genre::where('slug', $slug)->firstOrFail();

        $comics = Comic::with(['type', 'latestChapters'])
            ->whereHas('genres', fn($q) => $q->where('genres.id', $genre->id))
            ->published()
            ->latest('updated_at')
            ->paginate(24);

        return view('frontend.genre.show', compact('genre', 'comics'));
    }
}
