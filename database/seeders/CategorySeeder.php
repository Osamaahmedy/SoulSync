<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Personal Growth', 'icon' => '🌱', 'color' => 'emerald'],
            ['name' => 'Work & Career', 'icon' => '💼', 'color' => 'blue'],
            ['name' => 'Health & Wellness', 'icon' => '🧘', 'color' => 'rose'],
            ['name' => 'Social & Family', 'icon' => '❤️', 'color' => 'purple'],
            ['name' => 'Learning', 'icon' => '📚', 'color' => 'gold'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
