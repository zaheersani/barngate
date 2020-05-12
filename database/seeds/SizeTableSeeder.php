<?php

use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sizes')->truncate();
        /* DOG */

        $dog = ["Small", "Medium", "Large", "XL"];

        for ($i=0; $i <= count($dog) - 1; $i++) {

            DB::table('sizes')->insert([
                "name" => $dog[$i]
            ]);
        }
    }
}
