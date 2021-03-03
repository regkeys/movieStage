<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

// use faker package for multiple
use Faker\Factory as Faker;


class MovieInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 5) as $index){
            DB::table('uploads')->insert([
                'id' => $faker->numberBetween(51, 100),
                'name' => $faker->name,
                'title' => $faker->text(12),
                'length' => '1 hr',
                'start' => '7:00 pm',
                'description' => $faker->sentence(12),
                'tickets' => '20',
                'rating' => '3',
                'poster' => '',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => '3'
            ]);
        }
    }
}
