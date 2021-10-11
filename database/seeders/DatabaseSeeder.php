<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        //User::factory(1)->hasPosts(1)->create();
        Post::factory(5)->create();
        //Comment::factory(5)->create();
        /*$this->call([
            //UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);*/
    }
}
