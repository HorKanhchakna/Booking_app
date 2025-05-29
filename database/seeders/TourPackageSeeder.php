<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TourPackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Phi Phi Islands Tour',
                'title' => 'Phi Phi Islands Tour',
                'location' => 'Phi Phi Islands',
                'duration' => '1 day',
                'max_people' => '12 Person',
                'price' => 2500.00,
                'rating' => 4.8,
                'description' => 'Visit Maya Bay, Monkey Beach, and snorkel in crystal clear waters with lunch included',
                'image_path' => 'package-1.jpg'
            ],
            [
                'name' => 'James Bond Island Tour',
                'title' => 'James Bond Island Tour',
                'location' => 'Phang Nga Bay',
                'duration' => '1 day',
                'max_people' => '8 Person',
                'price' => 3800.00,
                'rating' => 4.9,
                'description' => 'Canoe through sea caves and visit the famous limestone karst of Khao Phing Kan',
                'image_path' => 'package-2.jpg'
            ],
            [
                'name' => 'Phuket City Tour',
                'title' => 'Phuket City Tour',
                'location' => 'Phuket Town',
                'duration' => '6 hours',
                'max_people' => 'Private',
                'price' => 1900.00,
                'rating' => 4.2,
                'description' => 'Explore Old Phuket Town\'s Sino-Portuguese architecture and visit Big Buddha',
                'image_path' => 'package-3.jpg'
            ]
        ];

        foreach ($packages as $package) {
            DB::table('tour_packages')->insert([
                'title' => $package['title'],
                'location' => $package['location'],
                'name' => $package['title'], // Assuming 'name' is the same as 'title'
                'duration' => $package['duration'],
                'max_people' => $package['max_people'],
                'price' => $package['price'],
                'rating' => $package['rating'],
                'description' => $package['description'],
                'image_path' => $package['image_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
