<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Type;
use App\Models\Status;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::with('type', 'status')->latest()->paginate(10);
        return view('admin.comics.index', compact('comics'));
    }

    public function create()
    {
        $types = Type::all();
        $statuses = Status::all();
        $genres = Genre::orderBy('name')->get();
        return view('admin.comics.create', compact('types', 'statuses', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'alternative_title' => 'nullable|string|max:255',
            'type_id' => 'required|exists:types,id',
            'status_id' => 'required|exists:statuses,id',
            'author' => 'nullable|string|max:100',
            'artist' => 'nullable|string|max:100',
            'synopsis' => 'nullable|string',
            'released_year' => 'nullable|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $comicData = $validated;
        $comicData['slug'] = Str::slug($request->title);
        $comicData['uploaded_by'] = auth()->id();

        if ($request->hasFile('cover_image')) {
            $comicData['cover_image'] = $request->file('cover_image')->store('comics/covers', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $comicData['banner_image'] = $request->file('banner_image')->store('comics/banners', 'public');
        }

        $comic = Comic::create($comicData);

        if ($request->has('genres')) {
            $comic->genres()->attach($request->genres);
        }

        return redirect()->route('admin.comics.index')->with('success', 'Komik berhasil ditambahkan.');
    }

    public function edit(Comic $comic)
    {
        $types = Type::all();
        $statuses = Status::all();
        $genres = Genre::orderBy('name')->get();
        return view('admin.comics.edit', compact('comic', 'types', 'statuses', 'genres'));
    }

    public function update(Request $request, Comic $comic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'alternative_title' => 'nullable|string|max:255',
            'type_id' => 'required|exists:types,id',
            'status_id' => 'required|exists:statuses,id',
            'author' => 'nullable|string|max:100',
            'artist' => 'nullable|string|max:100',
            'synopsis' => 'nullable|string',
            'released_year' => 'nullable|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $comicData = $validated;
        
        // Hanya update slug jika judul berubah drastis? Biasanya tidak untuk SEO.
        // Tapi kita biarkan terganti untuk konsistensi sederhana
        if ($comic->title !== $request->title) {
            $comicData['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        if ($request->hasFile('cover_image')) {
            if ($comic->cover_image) Storage::disk('public')->delete($comic->cover_image);
            $comicData['cover_image'] = $request->file('cover_image')->store('comics/covers', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($comic->banner_image) Storage::disk('public')->delete($comic->banner_image);
            $comicData['banner_image'] = $request->file('banner_image')->store('comics/banners', 'public');
        }

        $comic->update($comicData);

        if ($request->has('genres')) {
            $comic->genres()->sync($request->genres);
        } else {
            $comic->genres()->detach();
        }

        return redirect()->route('admin.comics.index')->with('success', 'Data komik berhasil diperbarui.');
    }

    public function destroy(Comic $comic)
    {
        if ($comic->cover_image) Storage::disk('public')->delete($comic->cover_image);
        if ($comic->banner_image) Storage::disk('public')->delete($comic->banner_image);
        
        $comic->delete();
        
        return redirect()->route('admin.comics.index')->with('success', 'Komik berhasil dihapus beserta file gambarnya.');
    }
}
