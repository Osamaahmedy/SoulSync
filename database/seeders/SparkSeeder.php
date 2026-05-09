<?php

namespace Database\Seeders;

use App\Models\Spark;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class SparkSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $user = User::first() ?? User::factory()->create(['name' => 'Demo User', 'email' => 'demo@example.com']);

        $reflections = [
            [
                'content' => 'Grateful for the chance to work on such a meaningful project today. Small steps lead to big changes.',
                'category_id' => $categories->where('name', 'Work & Career')->first()->id,
                'mood_score' => 8,
            ],
            [
                'content' => 'Started practicing mindfulness meditation for 10 minutes. Felt a significant shift in my focus.',
                'category_id' => $categories->where('name', 'Health & Wellness')->first()->id,
                'mood_score' => 9,
            ],
            [
                'content' => 'Reconnected with an old friend today. It reminds me how important social bonds are for our well-being.',
                'category_id' => $categories->where('name', 'Social & Family')->first()->id,
                'mood_score' => 10,
            ],
            [
                'content' => 'Felt a bit overwhelmed by the workload, but taking a walk in nature really helped clear my mind.',
                'category_id' => $categories->where('name', 'Health & Wellness')->first()->id,
                'mood_score' => 6,
            ],
            [
                'content' => 'Completed a challenging module in my online course. Learning something new every day!',
                'category_id' => $categories->where('name', 'Learning')->first()->id,
                'mood_score' => 9,
            ],
        ];

        foreach ($reflections as $ref) {
            Spark::create(array_merge($ref, [
                'user_id' => $user->id,
                'author' => $user->name,
                'color' => Category::find($ref['category_id'])->color,
                'created_at' => now()->subDays(rand(0, 6)),
            ]));
        }
    }
}
