@extends('layouts.admin')

@section('title', 'Hak Akses Pengguna')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
            <h3 class="font-bold text-lg">Edit Hak Akses Pengguna</h3>
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white transition text-sm">Batal</a>
        </div>

        @if(session('error'))
        <div class="bg-red-500/20 text-red-500 p-4 m-6 rounded-xl border border-red-500/30">
            {{ session('error') }}
        </div>
        @endif

        <div class="p-6 border-b border-dark-800 flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-primary-600 flex items-center justify-center font-bold text-white text-xl">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <h4 class="font-extrabold text-lg">{{ $user->name }}</h4>
                <p class="text-gray-400 text-sm">{{ '@'.$user->username }} | {{ $user->email }}</p>
                <p class="text-xs text-gray-500 mt-1">Bergabung sejak {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
            @csrf @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Role Akses</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer transition p-3 rounded-xl border {{ $user->role === 'user' ? 'border-primary-500 bg-primary-500/10' : 'border-dark-700 bg-dark-800/50' }} hover:border-primary-400 w-1/2 justify-center">
                            <input type="radio" name="role" value="user" {{ old('role', $user->role) === 'user' ? 'checked' : '' }} class="w-4 h-4 text-primary-600 focus:ring-primary-500 border-dark-600 bg-dark-700">
                            <span class="font-bold {{ $user->role === 'user' ? 'text-primary-400' : 'text-gray-300' }}">Normal User</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer transition p-3 rounded-xl border {{ $user->role === 'admin' ? 'border-red-500 bg-red-500/10' : 'border-dark-700 bg-dark-800/50' }} hover:border-red-400 w-1/2 justify-center">
                            <input type="radio" name="role" value="admin" {{ old('role', $user->role) === 'admin' ? 'checked' : '' }} class="w-4 h-4 text-red-600 focus:ring-red-500 border-dark-600 bg-dark-700">
                            <span class="font-bold {{ $user->role === 'admin' ? 'text-red-400' : 'text-gray-300' }}">Administrator</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Status Akun</label>
                    <select name="is_active" class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500/50 transition">
                        <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>🟢 Aktif (Bisa Login & Baca)</option>
                        <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>🔴 Banned (Tidak Bisa Login)</option>
                    </select>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow-lg shadow-blue-600/30">Terapkan Perubahan Hak Akses</button>
            </div>
        </form>
    </div>
</div>
@endsection
