<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'IanBom',
            'email' => 'ianbom2@gmail.com',
            'password' => Hash::make('ianbom123')
        ]);

        User::create([
            'name' => 'IanBom',
            'email' => 'ianbom3@gmail.com',
            'password' => Hash::make('ianbom123')
        ]);

        User::create([
            'name' => 'IanBom',
            'email' => 'ianbom4@gmail.com',
            'password' => Hash::make('ianbom123')
        ]);

        User::create([
            'name' => 'IanBom',
            'email' => 'ianbom5@gmail.com',
            'password' => Hash::make('ianbom123')
        ]);
    }
}
