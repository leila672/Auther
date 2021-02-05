<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $posts = App\Post::all();
        foreach($posts as $post){
            for ($i = 1 ; $i <= 5 ; $i++) {
                $post->users()->attach(rand(1,10),['comment' => $faker->realText($maxNbChars = 200, $indexSize = 2)]);
            }
        }
    }
}
