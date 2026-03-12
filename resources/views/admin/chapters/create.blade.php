@extends('layouts.admin')

@section('title', 'Unggah Chapter Baru')

@section('content')
<div class="max-w-4xl">
    <div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
            <h3 class="font-bold text-lg">Form Unggah Chapter</h3>
            <a href="{{ route('admin.chapters.index') }}" class="text-gray-400 hover:text-white transition text-sm">Kembali</a>
        </div>

        @if(session('error'))
        <div class="bg-red-500/20 text-red-500 p-4 m-6 rounded-xl border border-red-500/30">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('admin.chapters.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Pilih Komik</label>
                    <select name="comic_id" required class="w-full bg-dark-800 border {{ $errors->has('comic_id') ? 'border-red-500' : 'border-dark-700' }} rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50 transition">
                        <option value="">Pilih Seri Komik...</option>
                        @foreach($comics as $comic)
                        <option value="{{ $comic->id }}" {{ old('comic_id') == $comic->id ? 'selected' : '' }}>{{ $comic->title }}</option>
                        @endforeach
                    </select>
                    @error('comic_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">No. Chapter</label>
                        <input type="number" step="0.1" name="chapter_number" value="{{ old('chapter_number') }}" required placeholder="Contoh: 1, 1.5, 2..."
                               class="w-full bg-dark-800 border {{ $errors->has('chapter_number') ? 'border-red-500' : 'border-dark-700' }} rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none transition">
                        @error('chapter_number')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Judul (Opsional)</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul arc..."
                               class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none transition">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2 border-b border-dark-700 pb-2">Halaman Gambar</label>
                <div class="border-2 border-dashed border-dark-700 hover:border-primary-500 py-10 rounded-2xl p-4 text-center transition bg-dark-800/50">
                    <svg class="w-12 h-12 text-primary-500/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-sm text-gray-300 font-bold mb-1">Pilih Semua Gambar yang ingin diunggah</p>
                    <p class="text-xs text-gray-500 mb-4">Pastikan nama file berurutan, misal: 01.jpg, 02.jpg atau pilih berurutan saat Upload.<br>Bisa seleksi banyak gambar sekaligus (Max: 3MB / gambar).</p>
                    
                    <input type="file" name="images[]" multiple required accept="image/*"
                         class="mx-auto text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary-500 file:text-white hover:file:bg-primary-600 cursor-pointer">
                </div>
                @error('images')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                @error('images.*')<p class="text-red-400 text-xs mt-1">Satu atau beberapa gambar gagal divalidasi (ukuran melebihi 3MB atau format salah).</p>@enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-8 py-3 w-full sm:w-auto bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition shadow-lg shadow-primary-600/30">Mulai Unggah Chapter</button>
            </div>
        </form>
    </div>
</div>
@endsection
