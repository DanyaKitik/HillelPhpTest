<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['name' => 'admin', 'username' => 'admin','email' => 'admin@gmail.com', 'password' => Hash::make('admin')]);

        $tags = Tag::factory(10)->create();

        User::factory(25)->create()->each(function ($user) use ($tags){
            $user->posts()->saveMany(Post::factory(rand(1,3))->create(['user_id' => $user->id])->each(function ($post) use($tags){
                $tags->shuffle();
                $post->tags()->attach($tags->pluck('id')->random(rand(3,5)));
            }));
        });
    }
}
