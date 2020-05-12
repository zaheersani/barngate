<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('class')->truncate();
        
        /* SHEEP */

        $sheep = ["Ewes", "Gimmers", "Hoggs", "Lambs", "Rams", "Shearlings"];

        for ($i=0; $i <= count($sheep) - 1; $i++) {

            DB::table('class')->insert([
                "name" => $sheep[$i],
                "animal_id" => 3,
            ]);
        }



        /* GOAT */

        $goat = ["Buck", "Doe / Doeling", "Wether"];

        for ($i=0; $i <= count($goat) - 1; $i++) {

            DB::table('class')->insert([
                "name" => $goat[$i],
                "animal_id" => 4,
            ]);
        }



         /* PIG */

        $pig = ["Barrow", "Boar", "Gilts", "Piglets", "Sows"];

        for ($i=0; $i <= count($pig) - 1; $i++) {

            DB::table('class')->insert([
                "name" => $pig[$i],
                "animal_id" => 5,
            ]);
        }


    }
}
