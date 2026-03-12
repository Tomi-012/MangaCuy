@extends('layouts.admin')

@section('title', 'Data Pengguna')

@section('content')
<div class="bg-dark-900/50 border border-dark-800 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-dark-800 flex justify-between items-center bg-dark-900/80">
        <h3 class="font-bold text-lg">Daftar Pengguna</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark-800/50 text-gray-400 text-sm border-b border-dark-700">
                    <th class="py-3 px-4 font-semibold">Nama / Username</th>
                    <th class="py-3 px-4 font-semibold">Email</th>
                    <th class="py-3 px-4 font-semibold">Role</th>
                    <th class="py-3 px-4 font-semibold">Status</th>
                    <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-800 text-sm">
                @forelse($users as $user)
                <tr class="hover:bg-dark-800/40 transition">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center font-bold text-white text-xs shrink-0">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ '@'.$user->username }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-300">{{ $user->email }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs rounded-md font-bold uppercase {{ $user->role === 'admin' ? 'bg-primary-500/20 text-primary-400' : 'bg-dark-700 text-gray-300' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs rounded-md {{ $user->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                            {{ $user->is_active ? 'Aktif' : 'Banned' }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded transition">Edit</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-500">Tidak ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-dark-800">
        {{ $users->links('partials.pagination') }}
    </div>
</div>
@endsection
