@extends('layouts.frontend')

@section('title', 'Daftar - ' . config('app.name'))

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-600/30">
                    <span class="text-white font-extrabold text-2xl">M</span>
                </div>
            </a>
            <h1 class="text-2xl font-extrabold">Buat Akun Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Bergabung dengan komunitas MangaCuy</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="bg-dark-900/50 border border-dark-800 rounded-2xl p-8 space-y-5">
            @csrf

            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/50 focus:outline-none transition placeholder-gray-600"
                       placeholder="John Doe">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/50 focus:outline-none transition placeholder-gray-600"
                       placeholder="johndoe">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/50 focus:outline-none transition placeholder-gray-600"
                       placeholder="email@example.com">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Password</label>
                <input type="password" name="password" required
                       class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/50 focus:outline-none transition placeholder-gray-600"
                       placeholder="Minimal 6 karakter">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-dark-800 border border-dark-700 rounded-xl px-4 py-3 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/50 focus:outline-none transition placeholder-gray-600"
                       placeholder="Ulangi password">
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl transition-all hover:shadow-lg hover:shadow-primary-600/30">
                Daftar
            </button>

            <p class="text-center text-sm text-gray-500">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-primary-400 hover:text-primary-300 font-medium">Masuk</a>
            </p>
        </form>
    </div>
</div>
@endsection
