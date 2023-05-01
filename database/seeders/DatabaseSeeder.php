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
        // call the seeder class
        $this->call([
            RolesAndPermissionsSeeder::class,
            ReportTypesSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            QuestionSeeder::class,
            QuestionTagSeeder::class,
            AnswerSeeder::class,
            VoteSeeder::class,
            // LogSeeder::class,
        ]);
    }
}
