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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@infocus.fr',
            'email_verified_at' => now(),
            'password' => Hash::make('MDSinfocus74+'),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'is_admin' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
