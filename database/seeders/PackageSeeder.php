<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        Package::create([
            'image' => 'img/package-1.jpg',
            'location' => 'Thailand',
            'duration' => '3 Days',
            'people' => 2,
            'price' => 149.00,
            'description' => 'Enjoy the beautiful beaches and clear water.',
        ]);

        Package::create([
            'image' => 'img/package-2.jpg',
            'location' => 'Indonesia',
            'duration' => '2 Days',
            'people' => 4,
            'price' => 200.00,
            'description' => 'Explore the majestic mountains and fresh air.',
        ]);

        Package::create([
            'image' => 'img/package-3.jpg',
            'location' => 'Malaysia',
            'duration' => '2 Days',
            'people' => 4,
            'price' => 180.00,
            'description' => 'Discover rich culture and vibrant cities.',
        ]);
    }
}
