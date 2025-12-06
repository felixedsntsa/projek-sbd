<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Felix Edna Santosa',
            'email' => 'felixsantosa@gmail.com',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Naufal Kemal Athilla',
            'email' => 'naufalkemal@gmail.com',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Naufal Fadlilah Aji',
            'email' => 'naufalaji@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}
