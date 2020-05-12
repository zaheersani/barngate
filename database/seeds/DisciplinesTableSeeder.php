<?php

use Illuminate\Database\Seeder;

class DisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disciplines')->truncate();

        DB::table('disciplines')->insert([
            "name" => "Breeding",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Cutting",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Roping",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Draft",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Mounted Shooting",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Pole Beding",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Racing",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Ranch Horse",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Reining",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Working Cowhorse",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Team Penning",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Trail Riding",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "All Around",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Halter",
            "animal_id" => 2,
        ]);

        DB::table('disciplines')->insert([
            "name" => "Western Pleasure",
            "animal_id" => 2,
        ]);


        DB::table('disciplines')->insert([
            "name" => "Driving",
            "animal_id" => 2,
        ]);

         DB::table('disciplines')->insert([
            "name" => "Other",
            "animal_id" => 2,
        ]);
    }
}
