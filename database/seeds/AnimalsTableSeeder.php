<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animals')->truncate();
        
        DB::table('animals')->insert([
            "name" => "Cattle",
        ]);

        DB::table('animals')->insert([
            "name" => "Horse",
        ]);

        DB::table('animals')->insert([
            "name" => "Sheep",
        ]);

        DB::table('animals')->insert([
            "name" => "Goat",
        ]);

        DB::table('animals')->insert([
            "name" => "Pig",
        ]);

        DB::table('animals')->insert([
            "name" => "Dog",
        ]);

        DB::table('animals')->insert([
            "name" => "Cat",
        ]);
    }
}
