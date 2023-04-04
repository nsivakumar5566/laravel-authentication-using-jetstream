<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'user_type' => 1,
            'phone' => '9876543210',
            'address' => 'Street#22, City',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '9876543210',
            'address' => 'Street#22, City',
            'password' => Hash::make('12345678'),
        ]);
    }
}
