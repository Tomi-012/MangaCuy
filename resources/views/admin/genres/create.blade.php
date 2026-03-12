@extends('layouts.admin')

@section('title', 'Ciptakan Genre Baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
            <h3 class="font-bold text-lg">Form Tambah Genre</h3>
            <a href="{{ route('admin.genres.index') }}" class="text-gray-400 hover:text-white transition text-sm">Kembali</a>
        </div>
        
        <form action="{{ route('admin.genres.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">Nama Genre</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Action, Fantasy..." required
                       class="w-full bg-dark-800 border {{ $errors->has('name') ? 'border-red-500' : 'border-dark-700' }} rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50 transition">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="mb-5">
                <label for="color" class="block text-sm font-semibold text-gray-300 mb-2">Warna (Hex)</label>
                <div class="flex items-center gap-3">
                    <input type="color" id="colorPicker" value="{{ old('color', '#6366f1') }}" class="h-11 w-11 rounded-xl cursor-pointer bg-dark-800 border border-dark-700 p-1"
                           onchange="document.getElementById('color').value = this.value">
                    <input type="text" id="color" name="color" value="{{ old('color', '#6366f1') }}" placeholder="#ffffff"
                           class="flex-1 bg-dark-800 border {{ $errors->has('color') ? 'border-red-500' : 'border-dark-700' }} rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50 transition"
                           oninput="document.getElementById('colorPicker').value = this.value">
                </div>
                @error('color')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-300 mb-2">Deskripsi (Opsional)</label>
                <textarea id="description" name="description" rows="3" placeholder="Deskripsi singkat mengenai genre ini..."
                          class="w-full bg-dark-800 border {{ $errors->has('description') ? 'border-red-500' : 'border-dark-700' }} rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50 transition">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition shadow-lg shadow-primary-600/30">Simpan Genre</button>
            </div>
        </form>
    </div>
</div>
@endsection
