<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            ['country' => 'Thailand', 'image' => 'destination-1.jpg', 'discount' => '30% OFF'],
            ['country' => 'Malaysia', 'image' => 'destination-2.jpg', 'discount' => '25% OFF'],
            ['country' => 'Australia', 'image' => 'destination-3.jpg', 'discount' => '35% OFF'],
            ['country' => 'Indonesia', 'image' => 'destination-4.jpg', 'discount' => '20% OFF'],
        ];

        foreach ($destinations as $item) {
            Destination::create($item);
        }
    }
}