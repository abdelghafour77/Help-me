<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create user using model and assign role admin
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');
        // create 10 user using factory and assign role user
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
