<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::create([
            'name' => 'Thailand',
            'description' => 'Beautiful beaches and culture.',
            'image' => 'img/destination-1.jpg',
            'discount' => '30% OFF'
        ]);

        Destination::create([
            'name' => 'Malaysia',
            'description' => 'Amazing rainforest adventures.',
            'image' => 'img/destination-2.jpg',
            'discount' => '25% OFF'
        ]);

        Destination::create([
            'name' => 'Australia',
            'description' => 'Explore the Outback and wildlife.',
            'image' => 'img/destination-3.jpg',
            'discount' => '35% OFF'
        ]);

        Destination::create([
            'name' => 'Indonesia',
            'description' => 'Island paradise with rich culture.',
            'image' => 'img/destination-4.jpg',
            'discount' => '20% OFF'
        ]);
    }
}
