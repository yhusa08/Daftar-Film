<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Film;
use App\Models\Genre;
use App\Models\Series;

echo "=== GENRES ===\n";
$genres = Genre::all();
foreach ($genres as $g) {
    echo "ID: {$g->id}, Nama: {$g->nama}\n";
}

echo "\n=== FILMS ===\n";
$films = Film::all();
foreach ($films as $f) {
    echo "ID: {$f->id}, Judul: {$f->judul}, Genre: {$f->genre}\n";
}

echo "\n=== SERIES ===\n";
$series = Series::all();
foreach ($series as $s) {
    echo "ID: {$s->id}, Judul: {$s->judul}, Genre ID: {$s->genre_id}\n";
}
?>
