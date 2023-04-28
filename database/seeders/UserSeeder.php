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
            'full_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '0620785937',
            'birthday' => '2000-11-28',
            'score' => 377,
            'password' => bcrypt('password'),
        ])->assignRole('admin');
        \App\Models\User::factory()->create([
            'full_name' => 'Super Admin',
            'username' => 's_admin',
            'email' => 'super.admin@admin.com',
            'phone' => '0620785938',
            'birthday' => '2000-11-28',
            'score' => 377,
            'password' => bcrypt('password'),
        ])->assignRole('super admin');
        // create 10 user using factory and assign role user
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
