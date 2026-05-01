@extends('layouts.frontend')

@section('title', 'Masuk - ' . config('app.name'))

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-600/30">
                    <span class="text-white font-extrabold text-2xl">M</span>
                </div>
            </a>
            <h1 class="text-2xl font-extrabold">Selamat Datang Kembali!</h1>
            <p class="text-sm text-gray-500 mt-1">Masuk ke akun MangaCuy kamu</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="card p-8 space-y-5">
            @csrf

            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <div>
                <label class="form-label text-gray-400">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="input bg-white/5"
                       placeholder="email@example.com">
            </div>

            <div>
                <label class="form-label text-gray-400">Password</label>
                <input type="password" name="password" required
                       class="input bg-white/5"
                       placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-primary-600 focus:ring-primary-500">
                    <span class="text-gray-400">Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="w-full btn btn-lg btn-primary">
                Masuk
            </button>

            <p class="text-center text-sm text-gray-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-primary-400 hover:text-primary-300 font-medium">Daftar sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection
