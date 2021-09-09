<?php
namespace Database\Factories;

use App\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            "name" => $this->faker->word(),
        ];
    }
}
