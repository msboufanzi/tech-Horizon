<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Article;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch all users and articles
        $users = User::all();
        $articles = Article::all();

        // Ensure there are users and articles to avoid errors
        if ($users->isEmpty() || $articles->isEmpty()) {
            $this->command->info('No users or articles found. Skipping CommentSeeder.');
            return;
        }

        // Create 50 comments
        for ($i = 0; $i < 30; $i++) {
            Comment::create([
                'text' => 'This is a sample comment for the article.',
                'user_id' => $users->random()->id, // Random user ID from existing users
                'article_id' => $articles->random()->id, // Random article ID from existing articles
            ]);
        }
    }
}