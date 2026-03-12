<!-- Footer -->
<footer class="bg-dark-900 border-t border-dark-800 mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center shadow-lg">
                        <span class="text-white font-extrabold text-lg">M</span>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight">
                        <span class="gradient-text">Manga</span><span class="text-white">Cuy</span>
                    </span>
                </a>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Baca komik manhwa, manga, manhua, dan doujin terbaru dan terlengkap dalam Bahasa Indonesia. Gratis, tanpa iklan berlebihan!
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-sm text-gray-300 uppercase tracking-wider mb-4">Menu</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Home</a></li>
                    <li><a href="{{ route('comics.index') }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Daftar Komik</a></li>
                    <li><a href="{{ route('comics.popular') }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Terpopuler</a></li>
                    <li><a href="{{ route('comics.latest') }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Update Terbaru</a></li>
                    <li><a href="{{ route('genres.index') }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Genre</a></li>
                </ul>
            </div>

            <!-- Genres -->
            <div>
                <h3 class="font-bold text-sm text-gray-300 uppercase tracking-wider mb-4">Genre Populer</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('search', ['q' => 'action']) }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Action</a></li>
                    <li><a href="{{ route('search', ['q' => 'romance']) }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Romance</a></li>
                    <li><a href="{{ route('search', ['q' => 'fantasy']) }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Fantasy</a></li>
                    <li><a href="{{ route('search', ['q' => 'comedy']) }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Comedy</a></li>
                    <li><a href="{{ route('search', ['q' => 'drama']) }}" class="text-sm text-gray-500 hover:text-primary-400 transition">Drama</a></li>
                </ul>
            </div>

            <!-- Info -->
            <div>
                <h3 class="font-bold text-sm text-gray-300 uppercase tracking-wider mb-4">Informasi</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-sm text-gray-500 hover:text-primary-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-primary-400 transition">Kontak</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-primary-400 transition">DMCA</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-primary-400 transition">Privacy Policy</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-primary-400 transition">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-dark-800 mt-10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-600">
                &copy; {{ date('Y') }} <span class="text-primary-400 font-semibold">MangaCuy</span>. All rights reserved.
            </p>
            <p class="text-xs text-gray-700">
                Disclaimer: Website ini tidak menyimpan file di server. Semua gambar yang ada berasal dari pihak ketiga.
            </p>
        </div>
    </div>
</footer>
