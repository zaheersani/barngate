<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendMailExpirationDate;
use App\Mail\SendMailTwoDaysExpiration;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use DB;

class CheckExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checked:animals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se revisan los productos que ya expiro su plan y se manda correo a los propietarios';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d', time());

        //CODIGO PARA INFORMAR AL USUARIO QUE FALTAN 2 DIAS PARA QUE SU ANUNCIO EXPIRE
        $salesMedia = DB::table("sales")
                            ->join("users", "sales.user_id", "users.user_id")
                            ->join("animals", "sales.animal_id", "animals.animal_id")
                            ->select("sales.*", "users.*", "animals.name as name_animal")
                            ->where("sales.disabled", 0)
                            ->get();

        foreach ($salesMedia as $salesM) {
            $fechafinalM = strtotime ( '-2 day' , strtotime ( $salesM->date_end ) ) ;
            $fechafinalM = date ( 'Y-m-d' , $fechafinalM );
            // var_dump($fechafinalM);

            if ($date == $fechafinalM) {
                try {
                    Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new SendMailTwoDaysExpiration($salesM));

                    if ($salesM->receive_text == 1) {
                        $mensaje = "The reason for this message is to inform you that your animal - ".$salesM->name_animal." - your plan is 2 days from expiring.";
                        $this->sendMessageTwilio($salesM->phone, $mensaje);
                    }
                    
                    //NOTIFICACION DE QUE EL ANUNCIO EXPIRA EN 2 DÍAS
                    DB::table("notifications")->insert([
                        "user_id" => $salesM->user_id,
                        "sale_id" => $salesM->sale_id,
                        "typo_notify_id" => 3,
                        "created_at" => $date
                    ]);
                } catch(Exception $e) {
                    \Log::error("El error de Email de Demonio. checando animales que ya expiro su plan ".$e->getMessage());
                }
            }
        }


        //CODIGO PARA INFORMAR AL USUARIO QUE SU ANUNCIO YA EXPIRO
        $sales = DB::table("sales")
                    ->join("users", "sales.user_id", "users.user_id")
                    ->join("animals", "sales.animal_id", "animals.animal_id")
                    ->select("sales.*", "users.*", "animals.name as name_animal")
                    ->where("sales.date_end", '<', $date)
                    ->where("sales.disabled", 0)
                    ->get();


        if ($sales != null) {
            foreach ($sales as $sale) {
                try {
                    //MANDAR MAIL AL USUARIO DE QUE EXPIRO SU ANUNCIO
                    DB::table("sales")->where("sale_id", $sale->sale_id)->update(['disabled' => 1]);
                    Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new SendMailExpirationDate($sale));

                    if ($sale->receive_text == 1) {
                        $mensaje = "The reason for this message is to inform you that your animal - ".$sale->name_animal." - your plan has expired.";
                        $this->sendMessageTwilio($sale->phone, $mensaje);
                    }

                    //NOTIFICACION DE QUE EL ANUNCIO EXPIRO DDD
                    DB::table("notifications")->insert([
                        "user_id" => $sale->user_id,
                        "sale_id" => $sale->sale_id,
                        "typo_notify_id" => 2,
                        "created_at" => $date
                    ]);


                } catch(Exception $e) {
                    \Log::error("El error de Email de Demonio. checando animales que ya expiro su plan ".$e->getMessage());
                }
            }
        }
    }


    public function sendMessageTwilio($phone, $msj)
    {
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );

        $client->messages->create(
            $phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => env( 'TWILIO_FROM' ),
                // the body of the text message you'd like to send
                'body' => $msj
            )
        );
    }
}
