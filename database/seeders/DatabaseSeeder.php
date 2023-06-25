<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      User::whereEmail('admin@gmail.com')->delete();
      User::create([
        'name' => 'admin',
        'code' => 'M00001',
        'email' => 'admin@gmail.com',
        'email_verified_at' => null,
        'password' => Hash::make('12345678'),
        'phone' => '000000000000',
        'gender' => 'm',
        'address' => 'Website',
        'photo' => null,
        'role' => 'admin'
      ]);
    }
}
