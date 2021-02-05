<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
            $user = new \App\User();
            $user->first_name= $faker->firstName;
            $user->last_name= $faker->lastName;
            $user->email= $faker->email;
            $user->password= bcrypt('123456');
            $user->save();
        }
    }
}
