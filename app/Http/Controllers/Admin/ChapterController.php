<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Comic;
use App\Models\ChapterImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('comic')->latest()->paginate(15);
        return view('admin.chapters.index', compact('chapters'));
    }

    public function create()
    {
        $comics = Comic::orderBy('title')->get();
        return view('admin.chapters.create', compact('comics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'chapter_number' => 'required|numeric',
            'title' => 'nullable|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        try {
            DB::beginTransaction();

            // Buat Chapter Note: slug gabungan nomor dan acak agar unique
            $chapter = Chapter::create([
                'comic_id' => $request->comic_id,
                'chapter_number' => $request->chapter_number,
                'title' => $request->title,
                'slug' => 'chapter-' . $request->chapter_number . '-' . Str::random(5),
                'published_at' => now(),
            ]);

            // Buat direktori unik per chapter di public storage
            $comicTitleSlug = Str::slug($chapter->comic->title);
            $chapCount = $request->chapter_number;
            
            // Urutkan gambar dan simpan
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store("chapters/{$comicTitleSlug}/ch-{$chapCount}", 'public');
                    
                    ChapterImage::create([
                        'chapter_id' => $chapter->id,
                        'image_path' => $path,
                        'sort_order' => $index + 1,
                    ]);
                }
            }

            // Update timestamp updated_at pada tabel comic untuk menaikkan status 'Latest Update'
            $chapter->comic->touch();

            DB::commit();

            return redirect()->route('admin.chapters.index')->with('success', 'Chapter berhasil diunggah.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Chapter $chapter)
    {
        $comics = Comic::orderBy('title')->get();
        return view('admin.chapters.edit', compact('chapter', 'comics'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'chapter_number' => 'required|numeric',
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        try {
            DB::beginTransaction();

            $chapter->update([
                'comic_id' => $request->comic_id,
                'chapter_number' => $request->chapter_number,
                'title' => $request->title,
            ]);

            // Jika ada gambar baru yang diunggah
            if ($request->hasFile('images')) {
                // Hapus gambar lama dari storage & database
                foreach ($chapter->images as $oldImage) {
                    if ($oldImage->image_path) {
                        Storage::disk('public')->delete($oldImage->image_path);
                    }
                    $oldImage->delete();
                }

                // Simpan gambar baru
                $comicTitleSlug = Str::slug($chapter->comic->title);
                $chapCount = $request->chapter_number;

                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store("chapters/{$comicTitleSlug}/ch-{$chapCount}", 'public');
                    
                    ChapterImage::create([
                        'chapter_id' => $chapter->id,
                        'image_path' => $path,
                        'sort_order' => $index + 1,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.chapters.index')->with('success', 'Data chapter diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Chapter $chapter)
    {
        // Hapus file gambar di storage terlebih dahulu
        foreach ($chapter->images as $image) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        
        $chapter->delete();

        return redirect()->route('admin.chapters.index')->with('success', 'Chapter dihapus.');
    }
}
