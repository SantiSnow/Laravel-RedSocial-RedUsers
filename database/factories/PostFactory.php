<?php

namespace Database\Factories;

use App\Models\Post;
use Carbon\Carbon;
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
            'title'=>$this->faker->sentence(5, true),
            'description'=>$this->faker->paragraph(3, true),
            'image'=>$this->faker->image(),
            'likes'=> rand(1, 1000),
            'user_id'=> 34,
            'created_at'=> Carbon::now()->toDateTimeString(),
            'updated_at'=> Carbon::now()->toDateTimeString(),
        ];
    }
}
