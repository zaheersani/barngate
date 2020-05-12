<?php

use Illuminate\Database\Seeder;

class DataTypoNotifications extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('typo_notifications')->truncate();
        
        DB::table('typo_notifications')->insert([
            "notificacion" => "chat",
        ]);

        DB::table('typo_notifications')->insert([
            "notificacion" => "vencimiento_anuncio",
        ]);

        DB::table('typo_notifications')->insert([
            "notificacion" => "proximo_vencimiento_anuncio",
        ]);
    }
}
