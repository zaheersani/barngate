<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('colors')->truncate();

        /* horses */
        
        $horses = ["Bay", "Black", "Brown", "Buckskin", "Chestnut", "Cremello", "Dun", "Gray", "Grulla", 
                    "Palomino", "Perlino", "Roan", "Sorrel", "White"];


        for ($i=0; $i <= count($horses) - 1; $i++) {

            DB::table('colors')->insert([
                "name" => $horses[$i],
                "animal_id" => 2,
            ]);
        }




        /* dogs */

        $dogs = ["Apricot / Beige", "Bicolor", "Black", "Brindle", "Brown / Chocolate", "Golden", "Gray / Blue / Silver", "Harlequin", 
                 "Merle (Blue)", "Merle (Red)", "Red / Chestnut / Orange", "Sable", "Tricolor (Brown, Black, & White)", "White / Cream", "Yellow / Tan / Blond / Fawn"];


        for ($i=0; $i <= count($dogs) - 1; $i++) {

            DB::table('colors')->insert([
                "name" => $dogs[$i],
                "animal_id" => 6,
            ]);
        }



        /* cats */

        $cats = ["Black", "Black & White / Tuxedo", "Blue Cream", "Blue Point", "Brown / Chocolate", "Buff & White", "Buff / Tan / Fawn", "Calico", "Chocolate Point", 
                 "Cream / Ivory", "Cream Point", "Dilute Calico", "Dilute Tortoiseshell", "Flame Point", "Gray & White", "Gray / Blue / Silver", "Lilac Point", 
                 "Orange & White", "Orange / Red", "Seal Point", "Smoke", "Tabby (Brown / Chocolate)", "Tabby (Buff / Tan / Fawn)", "Tabby (Gray / Blue / Silver)", 
                 "Tabby (Leopard / Spotted)", "Tabby (Orange / Red)", "Tabby (Tiger Striped)", "Torbie", "Tortoiseshell", "White"];


        for ($i=0; $i <= count($cats) - 1; $i++) {

            DB::table('colors')->insert([
                "name" => $cats[$i],
                "animal_id" => 7,
            ]);
        }





    }
}
