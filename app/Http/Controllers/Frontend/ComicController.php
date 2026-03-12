<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Genre;
use App\Models\Type;
use App\Models\Status;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        $query = Comic::with(['type', 'status', 'genres', 'latestChapters'])->published();

        if ($request->filled('type')) {
            $query->whereHas('type', fn($q) => $q->where('slug', $request->type));
        }

        if ($request->filled('status')) {
            $query->whereHas('status', fn($q) => $q->where('slug', $request->status));
        }

        if ($request->filled('genre')) {
            $query->whereHas('genres', fn($q) => $q->where('slug', $request->genre));
        }

        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('total_views', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'za':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->latest('published_at');
        }

        $comics = $query->paginate(24);
        $types = Type::active()->get();
        $statuses = Status::all();
        $genres = Genre::active()->orderBy('name')->get();

        return view('frontend.comic.index', compact('comics', 'types', 'statuses', 'genres'));
    }

    public function show($slug)
    {
        $comic = Comic::with(['type', 'status', 'genres', 'chapters' => function($q) {
                $q->published()->orderBy('chapter_number', 'desc');
            }])
            ->withCount(['bookmarks', 'ratings'])
            ->withAvg('ratings', 'rating')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $comic->increment('total_views');

        $isBookmarked = false;
        if (auth()->check()) {
            $isBookmarked = auth()->user()->bookmarks()
                ->where('comic_id', $comic->id)->exists();
        }

        $relatedComics = Comic::with('type')
            ->whereHas('genres', function($q) use ($comic) {
                $q->whereIn('genres.id', $comic->genres->pluck('id'));
            })
            ->where('id', '!=', $comic->id)
            ->published()
            ->inRandomOrder()
            ->take(6)
            ->get();

        $firstChapter = $comic->chapters()->published()
            ->orderBy('chapter_number', 'asc')->first();

        $lastChapter = $comic->chapters()->published()
            ->orderBy('chapter_number', 'desc')->first();

        return view('frontend.comic.show', compact(
            'comic', 'isBookmarked', 'relatedComics',
            'firstChapter', 'lastChapter'
        ));
    }

    public function popular()
    {
        $comics = Comic::with(['type', 'latestChapters'])
            ->published()
            ->orderBy('total_views', 'desc')
            ->paginate(24);

        return view('frontend.comic.index', [
            'comics' => $comics,
            'pageTitle' => 'Komik Terpopuler',
            'types' => Type::active()->get(),
            'statuses' => Status::all(),
            'genres' => Genre::active()->orderBy('name')->get(),
        ]);
    }

    public function latest()
    {
        $comics = Comic::with(['type', 'latestChapters'])
            ->published()
            ->latest('updated_at')
            ->paginate(24);

        return view('frontend.comic.index', [
            'comics' => $comics,
            'pageTitle' => 'Update Terbaru',
            'types' => Type::active()->get(),
            'statuses' => Status::all(),
            'genres' => Genre::active()->orderBy('name')->get(),
        ]);
    }

    public function newReleases()
    {
        $comics = Comic::with(['type', 'latestChapters'])
            ->published()
            ->latest('published_at')
            ->paginate(24);

        return view('frontend.comic.index', [
            'comics' => $comics,
            'pageTitle' => 'Rilis Baru',
            'types' => Type::active()->get(),
            'statuses' => Status::all(),
            'genres' => Genre::active()->orderBy('name')->get(),
        ]);
    }
}
