<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Create Admin User
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $faker = FakerFactory::create();

        // Create  users
        for ($i = 1; $i <= 4; $i++) {
            \App\Models\User::factory()->create([
                'name' => $faker->name,
                'email' => "user{$i}@example.com",
                'role' => 'user',
                'password' => Hash::make('password'),
            ]);
        }

        // Create 10 therapists
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\User::factory()->create([
                'name' => $faker->name,
                'email' => "therapist{$i}@example.com",
                'role' => 'therapist',
                'password' => Hash::make('password'),
            ]);
        }

        // Create Services
        $services = [
            'Counseling',
            'Psychiatry',
            'Clinical Psychology',
            'Marriage and Family Therapy',
            'Substance Abuse Counseling',
            'Child Psychology',
            'Geriatric Psychology',
            'Neuropsychology',
            'Industrial-Organizational Psychology',
            'Educational Psychology',
        ];
        foreach ($services as $service) {
            \App\Models\Service::factory()->create([
                'name' => $service,
            ]);
        }

        $this->call([
            ServiceTherapistSeeder::class,
        ]);
    }
}
