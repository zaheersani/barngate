<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats_rooms', function (Blueprint $table) {
            $table->bigIncrements('chat_id');
            $table->text('token_chat');
            $table->integer("user_id");
            $table->integer("user_two_id");
            $table->boolean("disabled_user_id")->default(0);
            $table->boolean("disabled_user_two_id")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats_rooms');
    }
}
