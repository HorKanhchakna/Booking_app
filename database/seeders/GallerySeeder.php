<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $images = [
            'img/package-1.jpg',
            'img/package-2.jpg',
            'img/package-3.jpg',
            'img/package-4.webp',
            'img/package-5.jpg',
            'img/package-6.webp',
        ];

        foreach ($images as $img) {
            Gallery::create(['image' => $img]);
        }
    }
}
