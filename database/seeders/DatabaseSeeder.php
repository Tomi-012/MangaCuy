<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Type;
use App\Models\Status;
use App\Models\Comic;
use App\Models\Chapter;
use App\Models\ChapterImage;
use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        User::create([
            'name' => 'Admin MangaCuy',
            'username' => 'admin',
            'email' => 'admin@mangacuy.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'User Demo',
            'username' => 'user',
            'email' => 'user@mangacuy.test',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_active' => true,
        ]);

        // 2. Create Types
        $types = [
            ['name' => 'Manhwa', 'slug' => 'manhwa', 'color' => '#6366f1', 'sort_order' => 1],
            ['name' => 'Manga', 'slug' => 'manga', 'color' => '#ef4444', 'sort_order' => 2],
            ['name' => 'Manhua', 'slug' => 'manhua', 'color' => '#f59e0b', 'sort_order' => 3],
            ['name' => 'Doujin', 'slug' => 'doujin', 'color' => '#ec4899', 'sort_order' => 4],
        ];
        foreach ($types as $type) {
            Type::create($type);
        }

        // 3. Create Statuses
        $statuses = [
            ['name' => 'Ongoing', 'slug' => 'ongoing', 'color' => '#10b981'],
            ['name' => 'Completed', 'slug' => 'completed', 'color' => '#3b82f6'],
            ['name' => 'Hiatus', 'slug' => 'hiatus', 'color' => '#f59e0b'],
            ['name' => 'Dropped', 'slug' => 'dropped', 'color' => '#ef4444'],
        ];
        foreach ($statuses as $status) {
            Status::create($status);
        }

        // 4. Create Genres
        $genres = [
            ['name' => 'Action', 'color' => '#ef4444'],
            ['name' => 'Adventure', 'color' => '#f59e0b'],
            ['name' => 'Comedy', 'color' => '#fbbf24'],
            ['name' => 'Drama', 'color' => '#8b5cf6'],
            ['name' => 'Fantasy', 'color' => '#6366f1'],
            ['name' => 'Horror', 'color' => '#1f2937'],
            ['name' => 'Isekai', 'color' => '#14b8a6'],
            ['name' => 'Martial Arts', 'color' => '#dc2626'],
            ['name' => 'Mystery', 'color' => '#6b7280'],
            ['name' => 'Psychological', 'color' => '#7c3aed'],
            ['name' => 'Romance', 'color' => '#ec4899'],
            ['name' => 'Sci-Fi', 'color' => '#06b6d4'],
            ['name' => 'Slice of Life', 'color' => '#84cc16'],
            ['name' => 'Sports', 'color' => '#22c55e'],
            ['name' => 'Supernatural', 'color' => '#a855f7'],
            ['name' => 'Thriller', 'color' => '#78716c'],
            ['name' => 'School Life', 'color' => '#f97316'],
            ['name' => 'Harem', 'color' => '#e11d48'],
            ['name' => 'Historical', 'color' => '#92400e'],
            ['name' => 'Mecha', 'color' => '#334155'],
            ['name' => 'Seinen', 'color' => '#475569'],
            ['name' => 'Shounen', 'color' => '#3b82f6'],
            ['name' => 'Shoujo', 'color' => '#f472b6'],
            ['name' => 'Josei', 'color' => '#c084fc'],
            ['name' => 'Reincarnation', 'color' => '#2dd4bf'],
        ];
        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
                'slug' => Str::slug($genre['name']),
                'color' => $genre['color'],
            ]);
        }

        // 5. Create Demo Comics
        $comicData = [
            [
                'title' => 'Solo Leveling',
                'alternative_title' => 'Na Honjaman Level-Up / 나 혼자만 레벨업',
                'synopsis' => 'Sung Jin-Woo adalah seorang hunter dengan pangkat E, pangkat terendah yang ada. Suatu hari, ia menemukan sebuah dungeon ganda tersembunyi yang misterius. Di sana ia mendapatkan kekuatan misterius yang memungkinkannya untuk naik level tanpa batas. Dengan kekuatan barunya ini, apakah Sung Jin-Woo bisa bangkit dari yang terlemah menjadi yang terkuat?',
                'type_id' => 1, 'status_id' => 2, 'author' => 'Chugong', 'artist' => 'Jang Sung-Rak',
                'released_year' => 2018, 'rating' => 9.2, 'total_views' => 2500000, 'is_featured' => true, 'is_hot' => true,
                'genres' => [1, 2, 5, 8],
            ],
            [
                'title' => 'Tower of God',
                'alternative_title' => 'Sinui Tap / 신의 탑',
                'synopsis' => 'Apa yang kamu inginkan? Uang dan kekayaan? Kejayaan dan ketenaran? Kekuatan dan otoritas? Balas dendam? Atau sesuatu yang melebihi semua itu? Apapun yang kamu inginkan, ada di puncak menara.',
                'type_id' => 1, 'status_id' => 1, 'author' => 'SIU', 'artist' => 'SIU',
                'released_year' => 2010, 'rating' => 8.8, 'total_views' => 1800000, 'is_featured' => true, 'is_hot' => true,
                'genres' => [1, 2, 5, 9],
            ],
            [
                'title' => 'The Beginning After the End',
                'alternative_title' => 'TBATE',
                'synopsis' => 'Raja Arthur Leywin diberikan kesempatan kedua untuk hidup di dunia lain. Dengan kenangan dan kekuatan dari kehidupan sebelumnya, ia bertekad untuk melindungi orang-orang yang dicintainya.',
                'type_id' => 1, 'status_id' => 1, 'author' => 'TurtleMe', 'artist' => 'Fuyuki23',
                'released_year' => 2018, 'rating' => 9.0, 'total_views' => 2000000, 'is_hot' => true,
                'genres' => [1, 2, 5, 7, 25],
            ],
            [
                'title' => 'One Piece',
                'alternative_title' => 'ワンピース',
                'synopsis' => 'Gol D. Roger, si Raja Bajak Laut. Ia memiliki segalanya di dunia ini termasuk harta, ketenaran, dan kekuasaan, sampai dia ditangkap dan dieksekusi. Kata-kata terakhirnya adalah "Harta karunku? Ambillah. Aku meninggalkannya di suatu tempat."',
                'type_id' => 2, 'status_id' => 1, 'author' => 'Eiichiro Oda', 'artist' => 'Eiichiro Oda',
                'released_year' => 1999, 'rating' => 9.5, 'total_views' => 5000000, 'is_featured' => true, 'is_hot' => true,
                'genres' => [1, 2, 3, 5],
            ],
            [
                'title' => 'Jujutsu Kaisen',
                'alternative_title' => '呪術廻戦',
                'synopsis' => 'Yuji Itadori adalah seorang siswa SMA biasa yang memiliki kekuatan fisik luar biasa. Setelah menelan jari Ryomen Sukuna, ia masuk ke dunia sihir dan kutukan.',
                'type_id' => 2, 'status_id' => 2, 'author' => 'Gege Akutami', 'artist' => 'Gege Akutami',
                'released_year' => 2018, 'rating' => 8.7, 'total_views' => 3000000, 'is_hot' => true,
                'genres' => [1, 15, 4, 17],
            ],
            [
                'title' => 'Chainsaw Man',
                'alternative_title' => 'チェンソーマン',
                'synopsis' => 'Denji adalah seorang pemuda miskin yang bekerja sebagai pemburu iblis bersama Pochita, iblis gergaji mesinnya. Setelah dikhianati dan dibunuh, Pochita menggabungkan diri dengannya.',
                'type_id' => 2, 'status_id' => 1, 'author' => 'Tatsuki Fujimoto', 'artist' => 'Tatsuki Fujimoto',
                'released_year' => 2018, 'rating' => 8.9, 'total_views' => 2200000, 'is_featured' => true,
                'genres' => [1, 6, 15, 4],
            ],
            [
                'title' => 'Tales of Demons and Gods',
                'alternative_title' => 'Yao Shen Ji / 妖神记',
                'synopsis' => 'Nie Li, spiritualis terkuat, terbunuh oleh Sage Emperor. Namun ia terlahir kembali ke masa lalu saat masih berusia 13 tahun. Dengan pengetahuan dari kehidupan sebelumnya, ia bertekad melindungi kotanya.',
                'type_id' => 3, 'status_id' => 1, 'author' => 'Mad Snail', 'artist' => 'Jiang Ruotai',
                'released_year' => 2015, 'rating' => 8.5, 'total_views' => 1500000,
                'genres' => [1, 5, 8, 25],
            ],
            [
                'title' => 'Martial Peak',
                'alternative_title' => 'Wǔ Liàn Diān Fēng / 武炼巅峰',
                'synopsis' => 'Perjalanan menuju puncak seni bela diri itu sunyi dan membutuhkan tekad kuat. Di tengah jalan yang panjang ini, Yang Kai menemukan batu hitam misterius.',
                'type_id' => 3, 'status_id' => 1, 'author' => 'Momo', 'artist' => 'Pikapi',
                'released_year' => 2016, 'rating' => 8.3, 'total_views' => 1200000,
                'genres' => [1, 5, 8, 25],
            ],
            [
                'title' => 'Omniscient Reader Viewpoint',
                'alternative_title' => '전지적 독자 시점',
                'synopsis' => 'Kim Dokja adalah seorang pria biasa yang menghabiskan 10 tahun membaca web novel "Three Ways to Survive the Apocalypse". Suatu hari, dunia dalam novel itu menjadi kenyataan.',
                'type_id' => 1, 'status_id' => 1, 'author' => 'Sing Shong', 'artist' => 'Sleepy-C',
                'released_year' => 2020, 'rating' => 9.1, 'total_views' => 1900000, 'is_hot' => true, 'is_featured' => true,
                'genres' => [1, 2, 5, 10],
            ],
            [
                'title' => 'Demon Slayer',
                'alternative_title' => 'Kimetsu no Yaiba / 鬼滅の刃',
                'synopsis' => 'Tanjiro Kamado hidup bersama keluarganya di pegunungan. Suatu hari, saat ia tidak ada, keluarganya diserang oleh iblis. Hanya adiknya Nezuko yang selamat, namun ia berubah menjadi iblis.',
                'type_id' => 2, 'status_id' => 2, 'author' => 'Koyoharu Gotouge', 'artist' => 'Koyoharu Gotouge',
                'released_year' => 2016, 'rating' => 8.8, 'total_views' => 2800000, 'is_hot' => true,
                'genres' => [1, 15, 6, 4],
            ],
            [
                'title' => 'Return of the Mount Hua Sect',
                'alternative_title' => '화산귀환',
                'synopsis' => 'Chung Myung, salah satu pendekar terkuat dari sekte Gunung Hua, bangkit kembali 100 tahun kemudian dan menemukan sekte-nya telah merosot.',
                'type_id' => 1, 'status_id' => 1, 'author' => 'Biga', 'artist' => 'LICO',
                'released_year' => 2021, 'rating' => 9.0, 'total_views' => 1600000,
                'genres' => [1, 3, 8, 19],
            ],
            [
                'title' => 'Nano Machine',
                'alternative_title' => '나노마신',
                'synopsis' => 'Yeo-woon adalah putra haram dari Lord Demonic Cult. Setelah menerikan nanomachine dari masa depan, hidupnya berubah drastis.',
                'type_id' => 1, 'status_id' => 1, 'author' => 'Han-Joong-Wol-Ya', 'artist' => 'Geumgang Bulpae',
                'released_year' => 2020, 'rating' => 8.7, 'total_views' => 1400000,
                'genres' => [1, 8, 12, 5],
            ],
        ];

        $placeholderCovers = [
            'https://placehold.co/300x450/6366f1/white?text=Solo+Leveling',
            'https://placehold.co/300x450/3b82f6/white?text=Tower+of+God',
            'https://placehold.co/300x450/14b8a6/white?text=TBATE',
            'https://placehold.co/300x450/ef4444/white?text=One+Piece',
            'https://placehold.co/300x450/8b5cf6/white?text=Jujutsu+Kaisen',
            'https://placehold.co/300x450/dc2626/white?text=Chainsaw+Man',
            'https://placehold.co/300x450/f59e0b/white?text=TDG',
            'https://placehold.co/300x450/ec4899/white?text=Martial+Peak',
            'https://placehold.co/300x450/6366f1/white?text=ORV',
            'https://placehold.co/300x450/ef4444/white?text=Demon+Slayer',
            'https://placehold.co/300x450/10b981/white?text=Mount+Hua',
            'https://placehold.co/300x450/3b82f6/white?text=Nano+Machine',
        ];

        foreach ($comicData as $i => $data) {
            $genreIds = $data['genres'];
            unset($data['genres']);

            $data['slug'] = Str::slug($data['title']);
            $data['published_at'] = now()->subDays(rand(1, 90));
            $data['created_by'] = 1;

            $comic = Comic::create($data);
            $comic->genres()->attach($genreIds);

            // Create demo chapters
            $chapterCount = rand(10, 50);
            for ($ch = 1; $ch <= $chapterCount; $ch++) {
                $chapter = Chapter::create([
                    'comic_id' => $comic->id,
                    'chapter_number' => $ch,
                    'slug' => 'chapter-' . $ch,
                    'published_at' => now()->subDays($chapterCount - $ch),
                    'views' => rand(1000, 50000),
                    'created_by' => 1,
                ]);

                // Create demo chapter images (3-8 per chapter for demo)
                $imgCount = rand(3, 8);
                for ($img = 1; $img <= $imgCount; $img++) {
                    ChapterImage::create([
                        'chapter_id' => $chapter->id,
                        'image_path' => "demo/chapters/{$comic->id}/{$ch}/page-{$img}.jpg",
                        'original_name' => "page-{$img}.jpg",
                        'sort_order' => $img,
                    ]);
                }
            }
        }

        // 6. Create Sliders
        $sliderComics = Comic::where('is_featured', true)->take(4)->get();
        foreach ($sliderComics as $i => $comic) {
            Slider::create([
                'title' => $comic->title,
                'subtitle' => Str::limit($comic->synopsis, 100),
                'image' => "demo/sliders/slider-" . ($i + 1) . ".jpg",
                'link' => "/comic/{$comic->slug}",
                'button_text' => 'Baca Sekarang',
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        // 7. Settings
        $settings = [
            ['key_name' => 'site_name', 'value' => 'MangaCuy', 'group_name' => 'general'],
            ['key_name' => 'site_description', 'value' => 'Baca komik manhwa, manga, manhua terbaru bahasa Indonesia', 'group_name' => 'general'],
            ['key_name' => 'site_logo', 'value' => 'assets/images/logo.png', 'group_name' => 'general'],
            ['key_name' => 'default_reader_mode', 'value' => 'long', 'group_name' => 'reading'],
            ['key_name' => 'preload_images', 'value' => '3', 'type' => 'integer', 'group_name' => 'reading'],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('🎉 Database seeded successfully with demo data!');
    }
}
