@extends('layouts.admin')

@section('title', 'Edit Komik: ' . Str::limit($comic->title, 30))

@section('content')
<div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
        <h3 class="font-bold text-lg">Edit Komik</h3>
        <a href="{{ route('admin.comics.index') }}" class="text-gray-400 hover:text-white transition text-sm">Kembali</a>
    </div>

    <form action="{{ route('admin.comics.update', $comic) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="space-y-6 lg:col-span-1">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Cover Saat Ini</label>
                    <img src="{{ $comic->cover_url }}" class="w-32 h-44 object-cover rounded-xl border border-dark-700 mb-3 shadow-lg">
                    
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Ganti Cover</label>
                    <input type="file" name="cover_image" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-dark-700 file:text-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Ganti Banner</label>
                    <input type="file" name="banner_image" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-dark-700 file:text-gray-300">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Type</label>
                        <select name="type_id" required class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $comic->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Status</label>
                        <select name="status_id" required class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('status_id', $comic->status_id) == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Judul Komik</label>
                    <input type="text" name="title" value="{{ old('title', $comic->title) }}" required
                           class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Alternatif Judul</label>
                    <input type="text" name="alternative_title" value="{{ old('alternative_title', $comic->alternative_title) }}"
                           class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Author</label>
                        <input type="text" name="author" value="{{ old('author', $comic->author) }}" class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Artist</label>
                        <input type="text" name="artist" value="{{ old('artist', $comic->artist) }}" class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Tahun Rilis</label>
                        <input type="number" name="released_year" value="{{ old('released_year', $comic->released_year) }}" class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">Genre</label>
                    @php $comicGenres = $comic->genres->pluck('id')->toArray(); @endphp
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 bg-dark-800/50 p-4 rounded-xl border border-dark-700 h-48 overflow-y-auto">
                        @foreach($genres as $genre)
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="w-4 h-4 text-primary-500 rounded border-dark-600 bg-dark-900"
                                   {{ in_array($genre->id, old('genres', $comicGenres)) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-400 group-hover:text-white">{{ $genre->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Sinopsis</label>
                    <textarea name="synopsis" rows="5"
                              class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500">{{ old('synopsis', $comic->synopsis) }}</textarea>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-dark-800 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow-lg shadow-blue-600/30">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
