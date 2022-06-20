<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::oldest()->first();
        $author = Author::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'category_id' => $category->id,
            'slug' => $this->faker->slug(),
            'title' => $this->faker->jobTitle(),
            'body' => $this->faker->randomHtml(),
            'image' => $this->getImage(),
            'total_views' => random_int(0, 200),
            'author_id' => $author->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }

    private function getImage()
    {
        return basename(collect(Storage::allFiles('public/images'))->random());
    }
}
