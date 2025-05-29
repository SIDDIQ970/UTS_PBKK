<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'customer_id' => 'CUST001',
            'name'        => 'admin',
            'email'       => 'admin@gmail.com',
            'password'    => Hash::make('password'),
            'phone'       => '0895334400261',
            'address'     => 'Pontianak'
        ]);
    }
}
