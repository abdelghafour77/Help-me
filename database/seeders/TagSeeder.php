<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 15 tags without factory just using model
        $tags = [
            // [
            //     "name" => "Backend",
            //     "slug" => "backend",
            //     "description" => "Backend description",
            //     "color" => "#543222",
            //     "image" => "backend.png"
            // ],
            // [
            //     "name" => "frontend",
            //     "slug" => "frontend",
            //     "description" => "frontend description",
            //     "color" => "#ffff",
            //     "image" => "frontend.png"
            // ],
            // [
            //     "name" => "fullstack",
            //     "slug" => "fullstack",
            //     "description" => "fullstack",
            //     "color" => "#eeee",
            //     "image" => "fullstack.png"
            // ],
            [
                "name" => "laravel",
                "slug" => "laravel",
                "description" => "laravel description",
                "color" => "#eeee",
                "image" => "laravel.png"
            ],
            [
                "name" => "php",
                "slug" => "php",
                "description" => "php description",
                "color" => "#eeee",
                "image" => "php.png"

            ],
            [
                "name" => "javascript",
                "slug" => "javascript",
                "description" => "javascript description",
                "color" => "#eeee",
                "image" => "javascript.png"
            ],
            [
                "name" => "vuejs",
                "slug" => "vuejs",
                "description" => "vuejs description",
                "color" => "#eeee",
                "image" => "vuejs.png"
            ]
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::create($tag);
        }
        // \App\Models\Tag::factory()->count(10)->create();
    }
}
