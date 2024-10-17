<?php

namespace Database\Factories;

use App\Utils\PostTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->name(),
            'title' => fake()->title(),
            'description' => fake()->text(),
            'type' => PostTypeEnum::POST_WORK_ORDER_TYPE->value
        ];
    }
}
