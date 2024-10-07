<?php

namespace Database\Seeders;

use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $japan = Country::create([
            'code' => 'jp',
            'name' => 'Japan',
        ]);

        $japan->cities()->createMany([
            [
                'name' => 'Tokyo',
                'latitude' => 35.6762,
                'longitude' => 139.6503,
            ],
            [
                'name' => 'Yokohama',
                'latitude' => 35.4437,
                'longitude' => 139.6380,
            ],
            [
                'name' => 'Kyoto',
                'latitude' => 35.0116,
                'longitude' => 135.7681,
            ],
            [
                'name' => 'Osaka',
                'latitude' => 34.6937,
                'longitude' => 135.5023,
            ],
            [
                'name' => 'Sapporo',
                'latitude' => 43.0621,
                'longitude' => 141.3544,
            ],
            [
                'name' => 'Nagoya',
                'latitude' => 35.1815,
                'longitude' => 136.9066,
            ],
        ]);

    }
}
