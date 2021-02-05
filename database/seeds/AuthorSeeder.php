<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1 ; $i <= 10 ; $i++) {
            $author = new \App\Author();
            $author->first_name= $faker->firstName;
            $author->last_name= $faker->lastName;
            $author->email= $faker->email;
            $author->password= bcrypt('123456');
            $author->save();
        }
    }
}
