<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Theme;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProposedArticle>
 */
class ProposedArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), //* Generate a random sentence for the title
            'content' => $this->faker->paragraph(), //* Generate a paragraph for the content
            'theme_id' => Theme::factory(), //* Generate or use an existing Theme
            'author_id' => User::factory(), //* Generate or use an existing User
            'created_at' => now(), //* Set the current timestamp
            'updated_at' => now(), //* Set the current timestamp
        ];
    }
}
