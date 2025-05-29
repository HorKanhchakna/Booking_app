<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['icon' => 'fa-ship', 'title' => 'Island Hopping', 'desc' => 'Phi Phi, James Bond Island & hidden lagoons with private speedboats', 'badge' => 'Most Popular'],
            ['icon' => 'fa-umbrella-beach', 'title' => 'Beach Resorts', 'desc' => 'Exclusive deals at 5-star properties like The Surin and Trisara', 'badge' => 'Luxury'],
            ['icon' => 'fa-utensils', 'title' => 'Food Tours', 'desc' => 'Michelin-starred restaurants to authentic street food adventures', 'badge' => 'New'],
            ['icon' => 'fa-spa', 'title' => 'Wellness Retreats', 'desc' => 'Traditional Thai massage and luxury spa packages', 'badge' => null],
            ['icon' => 'fa-camera', 'title' => 'Photo Sessions', 'desc' => 'Professional photographers at iconic Phuket locations', 'badge' => null],
            ['icon' => 'fa-water', 'title' => 'Diving Packages', 'desc' => 'PADI-certified trips to Similan Islands and Shark Point', 'badge' => 'Adventure'],
            ['icon' => 'fa-ring', 'title' => 'Wedding Planning', 'desc' => 'Complete beach wedding coordination and VIP services', 'badge' => null],
            ['icon' => 'fa-car', 'title' => 'Private Transfers', 'desc' => 'Luxury vehicles with English-speaking drivers', 'badge' => '24/7']
        ];

        foreach ($services as $service) {
            Service::create($service);

        }
    }
}
