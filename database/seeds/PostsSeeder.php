<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Seed the table posts.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 50)->create();
        $categories = App\Category::all();

        App\Post::all()->each(function ($post) use ($categories) {
            $post->categories()->attach(
                $categories->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
