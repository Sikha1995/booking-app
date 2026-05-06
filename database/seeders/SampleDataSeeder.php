<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Demo user (API + web login): demo@booking-app.test / password
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'demo@booking-app.test'],
            [
                'name' => 'Demo Admin',
                'password' => Hash::make('password'),
            ]
        );

        $grandLisbon = Hotel::query()->firstOrCreate(
            ['name' => 'Grand Lisbon Plaza', 'city' => 'Lisbon'],
            ['country' => 'Portugal', 'rating' => 5]
        );

        $budgetLisbon = Hotel::query()->firstOrCreate(
            ['name' => 'Lisbon Budget Inn', 'city' => 'Lisbon'],
            ['country' => 'Portugal', 'rating' => 3]
        );

        $porto = Hotel::query()->firstOrCreate(
            ['name' => 'Porto Riverside Hotel', 'city' => 'Porto'],
            ['country' => 'Portugal', 'rating' => 4]
        );

        Room::query()->firstOrCreate(
            ['hotel_id' => $grandLisbon->id, 'name' => 'Deluxe Suite'],
            [
                'price_per_night' => 189.00,
                'max_occupancy' => 4,
                'available_rooms' => 3,
            ]
        );

        Room::query()->firstOrCreate(
            ['hotel_id' => $grandLisbon->id, 'name' => 'Standard Double'],
            [
                'price_per_night' => 99.00,
                'max_occupancy' => 2,
                'available_rooms' => 8,
            ]
        );

        Room::query()->firstOrCreate(
            ['hotel_id' => $budgetLisbon->id, 'name' => 'Single'],
            [
                'price_per_night' => 45.00,
                'max_occupancy' => 1,
                'available_rooms' => 12,
            ]
        );

        Room::query()->firstOrCreate(
            ['hotel_id' => $budgetLisbon->id, 'name' => 'Twin'],
            [
                'price_per_night' => 65.00,
                'max_occupancy' => 2,
                'available_rooms' => 6,
            ]
        );

        Room::query()->firstOrCreate(
            ['hotel_id' => $porto->id, 'name' => 'Family Room'],
            [
                'price_per_night' => 120.00,
                'max_occupancy' => 5,
                'available_rooms' => 4,
            ]
        );

        Room::query()->firstOrCreate(
            ['hotel_id' => $porto->id, 'name' => 'River View Double'],
            [
                'price_per_night' => 95.00,
                'max_occupancy' => 2,
                'available_rooms' => 10,
            ]
        );
    }
}
