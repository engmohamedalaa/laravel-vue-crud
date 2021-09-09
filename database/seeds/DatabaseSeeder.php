<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Category::factory(10)->create();
        Post::factory(100)->create();
    }
}
