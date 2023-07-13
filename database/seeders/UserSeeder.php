<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
            'name' => 'naufal',
            'email' => 'naufal@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen1',
            'email' => 'dosen1@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen2',
            'email' => 'dosen2@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen3',
            'email' => 'dosen3@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen4',
            'email' => 'dosen4@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen5',
            'email' => 'dosen5@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen6',
            'email' => 'dosen6@gmail.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'dosen',
            'email' => 'dosen7@gmail.com',
            'password' => Hash::make('password'),
        ],
        ]);
    }
}
