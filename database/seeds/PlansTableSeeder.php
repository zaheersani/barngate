<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('plans')->truncate();
        
        DB::table('plans')->insert([
            "name" => "BASIC",
            "price" => "0",
            "duration" => "30 days",
            "num_photos" => "1 photo"
        ]);

        DB::table('plans')->insert([
            "name" => "STANDARD",
            "price" => "10",
            "duration" => "90 days",
            "num_photos" => "5 photo"
        ]);

        DB::table('plans')->insert([
            "name" => "PREMIUM",
            "price" => "20",
            "duration" => "180 days",
            "num_photos" => "-",
            "more_options" => "{ options ['Guide to take the best pictures of your Animal', 'Upload Videos', 'Guide to take the best Videos of your Animal'] }"
        ]);
    }
}
