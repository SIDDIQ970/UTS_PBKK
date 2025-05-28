<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder agar user admin@ifump.net dibuat
        $this->call([
            CustomerSeeder::class,
        ]);
    }
}
