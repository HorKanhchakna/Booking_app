<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call other seeders here
        $this->call([
            ServiceSeeder::class,
            DestinationSeeder::class,
            GallerySeeder::class,
            TourPackageSeeder::class,
        ]);
    }
}
