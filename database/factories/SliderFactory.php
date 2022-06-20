<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::oldest()->first();
        $article = Article::inRandomOrder()->first();

        return [
            'article_id' => $article->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }
}
