<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;
use App\Models\Comment;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
      protected $model = Comment::class;
    public function definition(): array
    {
        return [
            'comment' => fake()->text(50),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'article_id' => function () {
                return Article::inRandomOrder()->first()->id;
            },
        ];
    }
}
