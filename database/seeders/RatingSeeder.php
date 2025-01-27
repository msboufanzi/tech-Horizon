<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch all users, articles, and comments
        $users = User::all();
        $articles = Article::all();
        $comments = Comment::all();

        // Ensure there are users, articles, and comments to avoid errors
        if ($users->isEmpty() || $articles->isEmpty() || $comments->isEmpty()) {
            $this->command->info('No users, articles, or comments found. Skipping RatingSeeder.');
            return;
        }

        for ($i = 0; $i < 30; $i++) {
            Rating::create([
                'rating' => rand(1, 5), // Random rating between 1 and 5
                'user_id' => $users->random()->id, // Random user ID from existing users
                'article_id' => $articles->random()->id, // Random article ID from existing articles
                'comment_id' => $comments->random()->id, // Random comment ID from existing comments
            ]);
        }
    }
}