<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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
            'name' => $faker->firstName('m') . ' ' . $faker->lastName('m'),
            'email' => $faker->email(),
            'password' => Hash::make('testpass'),
            'role' => 'admin'
        ]);
    }
}
