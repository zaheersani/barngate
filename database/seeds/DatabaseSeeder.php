<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(BreedsTableSeeder::class);
        $this->call(AnimalsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(DisciplinesTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(PlansTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);
        $this->call(ClassTableSeeder::class);
        $this->call(SizeTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(DataTypoNotifications::class);
    }
}
