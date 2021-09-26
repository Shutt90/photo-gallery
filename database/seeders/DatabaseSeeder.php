<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //password=password
        \App\Models\User::factory(1)->create();
        Gallery::factory(5)->create();
        Category::factory(5)->create();
    }
}
