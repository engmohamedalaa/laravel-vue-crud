<?php

// /** @var \Illuminate\Database\Eloquent\Factories\Factory $factory */
//
// use App\Post;
// use Faker\Generator as Faker;
//
// $factory->define(Post::class, function (Faker $faker) {
//   return [
//     "title" => $this->faker->word(),
//     "body" => $this->faker->sentence(),
//   ];
// });

namespace Database\Factories;

use App\Post;
use App\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          "title"       => $this->faker->word(),
          "body"        => $this->faker->sentence(),
          "category_id" => Category::all()->random()->id,
        ];
    }
}
