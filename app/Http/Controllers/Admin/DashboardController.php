<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik singkat untuk Dashboard
        $stats = [
            'total_comics' => Comic::count(),
            'total_chapters' => Chapter::count(),
            'total_users' => User::count(),
            'total_genres' => Genre::count(),
        ];

        // Ambil komik terbaru untuk preview
        $latest_comics = Comic::with('type', 'status')->latest()->take(5)->get();
        // Ambil chapter terbaru
        $latest_chapters = Chapter::with('comic')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_comics', 'latest_chapters'));
    }
}
