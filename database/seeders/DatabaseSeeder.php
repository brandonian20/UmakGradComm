<?php

namespace Database\Seeders;

use \App\Models\User;
use Carbon\Carbon;


use Illuminate\Database\Seeder;
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

        // User::create([
        //     'name' => 'Timothy Cuizon',
        //     'email' => 'timothywaltercuizon@gmail.com',
        //     'password' => Hash::make("tim123"),
        //     'created_at' => Carbon::now()->toDateTimeString(),
        //     'updated_at' => Carbon::now()->toDateTimeString(),
        // ]);
        // User::create([
        //     'name' => 'Brandon Penalosa',
        //     'email' => 'brandonian2000@gmail.com',
        //     'password' => Hash::make("brandon123"),
        //     'created_at' => Carbon::now()->toDateTimeString(),
        //     'updated_at' => Carbon::now()->toDateTimeString(),
        // ]);

        // User::create([
        //     'name' => 'Elias Cabo',
        //     'email' => 'eliascabo@gmail.com',
        //     'password' => Hash::make("eli123"),
        //     'created_at' => Carbon::now()->toDateTimeString(),
        //     'updated_at' => Carbon::now()->toDateTimeString(),
        // ]);
        // User::create([
        //     'name' => 'Cedric Clavecillas',
        //     'email' => 'iancedric@gmail.com',
        //     'password' => Hash::make("ced123"),
        //     'created_at' => Carbon::now()->toDateTimeString(),
        //     'updated_at' => Carbon::now()->toDateTimeString(),
        // ]);

    }
}
