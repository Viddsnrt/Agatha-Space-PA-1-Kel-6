<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Agatha',
            'email' => 'adminagathaspace@gmail.com',
            'password' => Hash::make('Admin') // Password: Admin
        ]);
    }
}
