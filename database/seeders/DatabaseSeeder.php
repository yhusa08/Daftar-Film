<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Film;
use App\Models\Series;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create genres
        $action = Genre::create([
            'nama' => 'Action',
            'deskripsi' => 'Film dengan banyak adegan pertarungan dan kejar-kejaran',
            'user_id' => $user->id,
        ]);

        $comedy = Genre::create([
            'nama' => 'Comedy',
            'deskripsi' => 'Film yang menghibur dan penuh dengan tawa',
            'user_id' => $user->id,
        ]);

        $romance = Genre::create([
            'nama' => 'Romance',
            'deskripsi' => 'Film tentang cinta dan hubungan romantis',
            'user_id' => $user->id,
        ]);

        // Create films for each genre
        $greenBook = Film::create([
            'judul' => 'Green Book',
            'tahun_rilis' => 2018,
            'durasi' => 130,
            'rating' => 8.0,
            'user_id' => $user->id,
        ]);
        $greenBook->genres()->attach([$action->id, $romance->id]);

        $actionHero = Film::create([
            'judul' => 'Action Hero',
            'tahun_rilis' => 2022,
            'durasi' => 120,
            'rating' => 7.5,
            'user_id' => $user->id,
        ]);
        $actionHero->genres()->attach([$action->id]);

        $laughOutLoud = Film::create([
            'judul' => 'Laugh Out Loud',
            'tahun_rilis' => 2020,
            'durasi' => 95,
            'rating' => 7.0,
            'user_id' => $user->id,
        ]);
        $laughOutLoud->genres()->attach([$comedy->id]);

        $loveStory = Film::create([
            'judul' => 'Love Story',
            'tahun_rilis' => 2019,
            'durasi' => 110,
            'rating' => 7.8,
            'user_id' => $user->id,
        ]);
        $loveStory->genres()->attach([$romance->id]);

        // Create series for each genre
        $comedyShow = Series::create([
            'judul' => 'Comedy Show Season 1',
            'jumlah_episode' => 10,
            'rating' => 8.5,
            'user_id' => $user->id,
        ]);
        $comedyShow->genres()->attach([$comedy->id]);

        $actionAdventure = Series::create([
            'judul' => 'Action Adventure Series',
            'jumlah_episode' => 12,
            'rating' => 8.0,
            'user_id' => $user->id,
        ]);
        $actionAdventure->genres()->attach([$action->id]);

        Series::create([
            'judul' => 'Romance Chronicles',
            'jumlah_episode' => 8,
            'rating' => 8.2,
            'user_id' => $user->id,
        ])->genres()->attach([$romance->id]);
    }
}
