<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Seed the table comments.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 100)->create();
    }
}
