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
            [
                "name" => "Laravel",
                "slug" => "laravel",
                "description" => "laravel description",
                "color" => "red-700",
                "image" => "laravel.png"
            ],
            [
                "name" => "PHP",
                "slug" => "php",
                "description" => "php description",
                "color" => "indigo-700",
                "image" => "php.png"

            ],
            [
                "name" => "Javascript",
                "slug" => "javascript",
                "description" => "javascript description",
                "color" => "yellow-300",
                "image" => "javascript.png"
            ],
            [
                "name" => "VueJs",
                "slug" => "vuejs",
                "description" => "vuejs description",
                "color" => "green-500",
                "image" => "vuejs.png"
            ],
            [
                "name" => "ReactJs",
                "slug" => "reactjs",
                "description" => "reactjs description",
                "color" => "blue-300",
                "image" => "reactjs.png"
            ],
            [
                "name" => "NodeJs",
                "slug" => "nodejs",
                "description" => "nodejs description",
                "color" => "green-500",
                "image" => "nodejs.png"
            ],
            [
                "name" => "MySql",
                "slug" => "mysql",
                "description" => "mysql description",
                "color" => "yellow-500",
                "image" => "mysql.png"
            ],
            [
                "name" => "Mongodb",
                "slug" => "mongodb",
                "description" => "mongodb description",
                "color" => "green-500",
                "image" => "mongodb.png"
            ],
            [
                "name" => "Redis",
                "slug" => "redis",
                "description" => "redis description",
                "color" => "red-500",
                "image" => "redis.png"
            ],
            [
                "name" => "Docker",
                "slug" => "docker",
                "description" => "docker description",
                "color" => "blue-500",
                "image" => "docker.png"
            ],
            [
                "name" => "Git",
                "slug" => "git",
                "description" => "git description",
                "color" => "red-500",
                "image" => "git.png"
            ],
            [
                "name" => "Github",
                "slug" => "github",
                "description" => "github description",
                "color" => "gray-500",
                "image" => "github.png"
            ],
            [
                "name" => "Gitlab",
                "slug" => "gitlab",
                "description" => "gitlab description",
                "color" => "red-500",
                "image" => "gitlab.png"
            ],
            [
                "name" => "Linux",
                "slug" => "linux",
                "description" => "linux description",
                "color" => "gray-500",
                "image" => "linux.png"
            ],
            [
                "name" => "Ubuntu",
                "slug" => "ubuntu",
                "description" => "ubuntu description",
                "color" => "yellow-500",
                "image" => "ubuntu.png"
            ],
            [
                "name" => "Centos",
                "slug" => "centos",
                "description" => "centos description",
                "color" => "pink-500",
                "image" => "centos.png"
            ],
            [
                "name" => "Windows",
                "slug" => "windows",
                "description" => "windows description",
                "color" => "blue-500",
                "image" => "windows.png"
            ],
            [
                "name" => "Macos",
                "slug" => "macos",
                "description" => "macos description",
                "color" => "gray-500",
                "image" => "macos.png"
            ],
            [
                "name" => "Nginx",
                "slug" => "nginx",
                "description" => "nginx description",
                "color" => "green-500",
                "image" => "nginx.png"
            ],
            [
                "name" => "Apache",
                "slug" => "apache",
                "description" => "apache description",
                "color" => "red-500",
                "image" => "apache.png"
            ],
            [
                "name" => "AWS",
                "slug" => "aws",
                "description" => "aws description",
                "color" => "yellow-400",
                "image" => "aws.png"
            ],
            [
                "name" => "Google Cloud",
                "slug" => "google-cloud",
                "description" => "google-cloud description",
                "color" => "blue-400",
                "image" => "google-cloud.png"
            ],
            [
                "name" => "Digitalocean",
                "slug" => "digitalocean",
                "description" => "digitalocean description",
                "color" => "blue-500",
                "image" => "digitalocean.png"
            ],

            [
                "name" => "Server",
                "slug" => "server",
                "description" => "server description",
                "color" => "gray-800",
                "image" => "server.png"
            ],
            [
                "name" => "Api",
                "slug" => "api",
                "description" => "api description",
                "color" => "gray-800",
                "image" => "api.png"
            ],
            [
                "name" => "Rest",
                "slug" => "rest",
                "description" => "rest description",
                "color" => "blue-300",
                "image" => "rest.png"
            ],
            [
                "name" => "Graphql",
                "slug" => "graphql",
                "description" => "graphql description",
                "color" => "pink-500",
                "image" => "graphql.png"
            ],
            [
                "name" => "Laravel Nova",
                "slug" => "laravel-nova",
                "description" => "laravel-nova description",
                "color" => "blue-400",
                "image" => "laravel-nova.png"
            ],
            [
                "name" => "Laravel Breeze",
                "slug" => "laravel-breeze",
                "description" => "laravel-breeze description",
                "color" => "yellow-300",
                "image" => "laravel-breeze.png"
            ],
            [
                "name" => "Laravel Livewire",
                "slug" => "laravel-livewire",
                "description" => "laravel-livewire description",
                "color" => "pink-400",
                "image" => "laravel-livewire.png"
            ],
            [
                "name" => "Laravel Sail",
                "slug" => "laravel-sail",
                "description" => "laravel-sail description",
                "color" => "blue-300",
                "image" => "laravel-sail.png"
            ]
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::create($tag);
        }
        // \App\Models\Tag::factory()->count(10)->create();
    }
}
