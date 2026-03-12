<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookmarks = auth()->user()->bookmarks()
            ->with(['comic.type', 'comic.latestChapters', 'chapter'])
            ->latest()
            ->paginate(24);

        return view('frontend.user.bookmarks', compact('bookmarks'));
    }

    public function toggle(Request $request, $comicId)
    {
        $bookmark = auth()->user()->bookmarks()
            ->where('comic_id', $comicId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $message = 'Bookmark dihapus';
            $status = false;
        } else {
            auth()->user()->bookmarks()->create([
                'comic_id' => $comicId,
            ]);
            $message = 'Ditambahkan ke bookmark';
            $status = true;
        }

        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        }

        return back()->with('success', $message);
    }
}
