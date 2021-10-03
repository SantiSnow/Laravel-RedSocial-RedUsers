<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title'=>Str::random(10),
            'description'=>Str::random(150),
            'image'=>Str::random(10).".jpg",
            'likes'=> rand(1, 1000),
            'user_id'=> 6,
        ]);
    }
}
