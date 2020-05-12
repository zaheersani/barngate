<?php

use Illuminate\Database\Seeder;

class AgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ages')->truncate();
        
         /* DOG */

        $dog = ["Puppy", "Young", "Adult", "Senior"];

        for ($i=0; $i <= count($dog) - 1; $i++) {

            DB::table('ages')->insert([
                "name" => $dog[$i],
                "animal_id" => 6,
            ]);
        }



         /* CAT */

        $CAT = ["Kitten", "Young", "Adult", "Senior"];

        for ($i=0; $i <= count($cat) - 1; $i++) {

            DB::table('ages')->insert([
                "name" => $cat[$i],
                "animal_id" => 7,
            ]);
        }
    }
}
