<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Slider;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Type;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->orderBy('sort_order')->get();

        $hotComics = Comic::with(['type', 'genres'])
            ->hot()
            ->published()
            ->orderBy('total_views', 'desc')
            ->take(10)
            ->get();

        $latestUpdates = Comic::with(['type', 'latestChapters'])
            ->published()
            ->whereHas('chapters', function($q) {
                $q->published();
            })
            ->orderBy('updated_at', 'desc')
            ->take(18)
            ->get();

        $newReleases = Comic::with('type')
            ->published()
            ->latest('published_at')
            ->take(12)
            ->get();

        $featuredComics = Comic::with(['type', 'genres'])
            ->featured()
            ->published()
            ->take(6)
            ->get();

        $popularManhwa = Comic::with('type')
            ->published()
            ->whereHas('type', fn($q) => $q->where('slug', 'manhwa'))
            ->orderBy('total_views', 'desc')
            ->take(6)
            ->get();

        $popularManga = Comic::with('type')
            ->published()
            ->whereHas('type', fn($q) => $q->where('slug', 'manga'))
            ->orderBy('total_views', 'desc')
            ->take(6)
            ->get();

        $genres = Genre::active()->withCount('comics')->orderBy('name')->get();

        return view('frontend.home', compact(
            'sliders', 'hotComics', 'latestUpdates',
            'newReleases', 'featuredComics',
            'popularManhwa', 'popularManga', 'genres'
        ));
    }
}
