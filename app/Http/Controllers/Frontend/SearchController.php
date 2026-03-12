<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $comics = collect();

        if (strlen($query) >= 2) {
            $comics = Comic::with(['type', 'status', 'genres'])
                ->published()
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('alternative_title', 'like', "%{$query}%")
                      ->orWhere('author', 'like', "%{$query}%")
                      ->orWhere('artist', 'like', "%{$query}%");
                })
                ->orderBy('total_views', 'desc')
                ->paginate(24);
        }

        return view('frontend.search.results', compact('comics', 'query'));
    }

    public function suggest(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $comics = Comic::select('id', 'title', 'slug', 'cover_image', 'type_id')
            ->with('type:id,name')
            ->published()
            ->where('title', 'like', "%{$query}%")
            ->orderBy('total_views', 'desc')
            ->take(5)
            ->get()
            ->map(fn($comic) => [
                'title' => $comic->title,
                'slug' => $comic->slug,
                'cover' => $comic->cover_url,
                'type' => $comic->type->name ?? '',
                'url' => route('comic.show', $comic->slug),
            ]);

        return response()->json($comics);
    }
}
