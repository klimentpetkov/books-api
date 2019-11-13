<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $limit = 30;
        $genders = ['f', 'm'];

        for ($i=0; $i < $limit; $i++) {
            $gender = $genders[array_rand($genders, 1)];

            DB::table('books')->insert([
                'title' => $faker->sentence(3),
                'description' => $faker->sentence(15),
                'author' => json_encode(['first_name' => $faker->firstName($gender), 'last_name' => $faker->lastName($gender)]),
                'created_at' => Carbon\Carbon::now()
            ]);
        }
    }
}
