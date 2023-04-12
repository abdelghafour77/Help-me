<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // call the seeder class
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            VoteSeeder::class,
            LogSeeder::class,
        ]);
    }
}
