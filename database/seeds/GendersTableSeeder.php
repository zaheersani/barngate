<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('genders')->truncate();

        /* HORSES */

        $horses = ["Colt", "Filly", "Gelding", "Mare", "Stallion"];

        for ($i=0; $i <= count($horses) - 1; $i++) {

            DB::table('genders')->insert([
                "name" => $horses[$i],
                "animal_id" => 2,
            ]);
        }



        /* SHEEP */

        $sheep = ["Female", "Male", "Both"];

        for ($i=0; $i <= count($sheep) - 1; $i++) {

            DB::table('genders')->insert([
                "name" => $sheep[$i],
                "animal_id" => 3,
            ]);
        }



        /* GOAT */

        $goat = ["Female", "Male", "Both"];

        for ($i=0; $i <= count($goat) - 1; $i++) {

            DB::table('genders')->insert([
                "name" => $goat[$i],
                "animal_id" => 4,
            ]);
        }



        /* PIG */

        $pig = ["Female", "Male", "Both genders"];

        for ($i=0; $i <= count($pig) - 1; $i++) {

            DB::table('genders')->insert([
                "name" => $pig[$i],
                "animal_id" => 5,
            ]);
        }



        /* DOG */

        $dog = ["Female", "Male"];

        for ($i=0; $i <= count($dog) - 1; $i++) {

            DB::table('genders')->insert([
                "name" => $dog[$i],
                "animal_id" => 6,
            ]);
        }




        /* CATº */

        $cat = ["Female", "Male"];

        for ($i=0; $i <= count($cat) - 1; $i++) {

            DB::table('genders')->insert([
                "name" => $cat[$i],
                "animal_id" => 7,
            ]);
        }

    }
}
