<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'name' => 'Sokha Chan',
            'email' => 'sokha@example.com',
            'date_time' => '2025-06-01 10:00:00',
            'destination' => 'Siem Reap',
            'message' => 'Looking forward to the trip!',
        ]);

        Booking::create([
            'name' => 'Dara Lim',
            'email' => 'dara@example.com',
            'date_time' => '2025-06-02 14:30:00',
            'destination' => 'Kampot',
            'message' => 'Need early confirmation.',
        ]);
    }
}