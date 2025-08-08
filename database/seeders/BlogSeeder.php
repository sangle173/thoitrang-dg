<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Blog::create([
                'title' => "Sample Blog Post $i",
                'slug' => Str::slug("Sample Blog Post $i"),
                'content' => "<p>This is the content of blogs post number $i. It contains some <strong>HTML formatting</strong>.</p>",
                'thumbnail' => null, // Optional: Add image later
            ]);
        }
    }
}
