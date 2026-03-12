@extends('layouts.admin')

@section('title', 'Edit Data Chapter')

@section('content')
<div class="max-w-4xl">
    <div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
            <h3 class="font-bold text-lg">Form Edit Chapter</h3>
            <a href="{{ route('admin.chapters.index') }}" class="text-gray-400 hover:text-white transition text-sm">Kembali</a>
        </div>

        <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST" class="p-6">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Seri Komik</label>
                    <select name="comic_id" required class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none">
                        @foreach($comics as $comic)
                        <option value="{{ $comic->id }}" {{ old('comic_id', $chapter->comic_id) == $comic->id ? 'selected' : '' }}>{{ $comic->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">No. Chapter</label>
                        <input type="number" step="0.1" name="chapter_number" value="{{ old('chapter_number', $chapter->chapter_number) }}" required
                               class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Judul Opsional</label>
                        <input type="text" name="title" value="{{ old('title', $chapter->title) }}"
                               class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none transition">
                    </div>
                </div>
            </div>

            <div class="mt-8 mb-6 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl text-yellow-500 text-sm">
                <p><strong>Catatan:</strong> Penggantian/Pengeditan File Gambar Chapter saat ini belum didukung melalui form. Harap hapus chapter dan upload ulang jika urutan halaman salah.</p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-8 py-3 sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow-lg shadow-blue-600/30">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
