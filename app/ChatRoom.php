<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $primaryKey = 'chat_id';
    protected $table = 'chats_rooms';
}
