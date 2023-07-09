<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Log\Logger;

class ServiceTherapistSeeder extends Seeder
{
    public function run()
    {
        $therapists = \App\Models\User::where('role', 'therapist')->get();
        $services = \App\Models\Service::all();

        foreach ($therapists as $therapist) {
            // Get a random number of services to assign
            $numServices = $services->count() - rand(0, $services->count());

            // Get random unique service IDs
            $serviceIds = $services->random($numServices)->pluck('id')->toArray();

            // Attach services to the therapist
            $therapist->services()->attach($serviceIds);
        }
    }
}
