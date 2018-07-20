<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the table categories.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 10)->create();
    }
}
