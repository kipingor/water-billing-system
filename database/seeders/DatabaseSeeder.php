<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Antony Kipingor',
            'email' => 'kipingor@gmail.com',
            'password' => Hash::make('deadenman80'),
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Antony Kipingor',
        //     'email' => 'kipingor@gmail.com',
        //     'password' => Hash::make('deadenman80'),
        // ]);

        $this->call([
            MeterReadingSeeder::class,           
        ]);
    }
}
