<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

         /* CATTLE */

        $cattle = ["Bred Heifers for Sale", "Bulls for Sale", "Cow Calf Pairs for Sale", "Cows for Sale", "Embryos for Sale", "Feeder Cattle for Sale", 
                    "Replacement Heifers for Sale", "Semen for Sale", "Stocker Cattle for Sale"];

        for ($i=0; $i <= count($cattle) - 1; $i++) {

            DB::table('categories')->insert([
                "name" => $cattle[$i],
                "animal_id" => 1,
            ]);
        }
    }
}
