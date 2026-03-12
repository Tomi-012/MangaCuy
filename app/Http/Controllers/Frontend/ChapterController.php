<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function read($comicSlug, $chapterSlug)
    {
        $comic = Comic::where('slug', $comicSlug)->published()->firstOrFail();

        $chapter = Chapter::with(['images', 'comic'])
            ->where('comic_id', $comic->id)
            ->where('slug', $chapterSlug)
            ->published()
            ->firstOrFail();

        $prevChapter = Chapter::where('comic_id', $comic->id)
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->published()
            ->orderBy('chapter_number', 'desc')
            ->first();

        $nextChapter = Chapter::where('comic_id', $comic->id)
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->published()
            ->orderBy('chapter_number')
            ->first();

        $allChapters = Chapter::where('comic_id', $comic->id)
            ->published()
            ->orderBy('chapter_number', 'desc')
            ->get(['id', 'chapter_number', 'title', 'slug']);

        if (auth()->check()) {
            auth()->user()->readingHistory()->updateOrCreate(
                ['comic_id' => $comic->id, 'chapter_id' => $chapter->id],
                ['read_at' => now()]
            );
        }

        $chapter->increment('views');

        return view('frontend.chapter.read', compact(
            'comic', 'chapter', 'prevChapter', 'nextChapter', 'allChapters'
        ));
    }
}
