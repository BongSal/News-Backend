<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::oldest()->first();
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'description' => $this->faker->realText(),
            'profile' => $this->getImage(),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }

    private function getImage()
    {
        return basename(collect(Storage::allFiles('files'))->random());
    }
}
