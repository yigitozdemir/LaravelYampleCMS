<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DocValues;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'test@example.com',
            'email' => 'test@example.com',
            'password' => Hash::make('passw0rd')
        ]);

        $this->call([
            PropertyTypeSeeder::class,
            DocTypeSeeder::class,
            DocPropertyMapSeeder::class,
            DocumentSeeder::class,
            DocValuesSeeder::class,
        ]);
    }
}
