<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => $faker->firstName('female') . ' ' . $faker->lastName('female'),
            'email' => $faker->safeEmail(),
            'password' => Hash::make('testpass'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => $faker->firstName('male') . ' ' . $faker->lastName('male'),
            'email' => $faker->safeEmail(),
            'password' => Hash::make('testpass'),
            'role' => 'user'
        ]);
    }
}
