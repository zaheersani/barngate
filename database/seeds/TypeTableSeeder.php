<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('types')->truncate();
        /* GOAT */

        $goat = ["Dairy goats - Nigerian Dwarf", "Dairy goats - Alpine", "Dairy goats - Nubian", "Fiber goats - Angora", "Fiber goats - Pygora", "Fiber goats - Nygora", "Meat goats - Spanish", "Meat goats - Boer", "Meat goats - Kiko"];

        for ($i=0; $i <= count($goat) - 1; $i++) {

            DB::table('types')->insert([
                "name" => $goat[$i],
                "animal_id" => 4,
            ]);
        }
    }
}
