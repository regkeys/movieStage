<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class MovieInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('uploads')->insert([
            'name' => 'John Doe',
            'title' => 'Iron Man',
            'length' => '1 hr',
            'start' => '7:00 pm',
            'description' => 'This is a great movie.',
            'tickets' => '20',
            'rating' => '3',
            'poster' => '',
            'timestamps' => now(),
            'interger' => '3'
        ]);
    }
}
