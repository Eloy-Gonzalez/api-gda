<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        Users::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => \Str::random(10),
            'createdBy' => 0,
            'version' => 0
        ]);

        // Users with role Journalist
        Users::factory()->count(5)->create();
    }
}
