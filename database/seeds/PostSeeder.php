<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1 ; $i <= 25 ; $i++) {
            $post = new \App\Post();
            $post->title= $faker->text(15);
            $post->description= $faker->realText($maxNbChars = 200, $indexSize = 2);
            $post->author_id = rand(1,10);
            $post->save();
        }
    }
}
