<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $primaryKey = 'favorite_id';
    protected $table = 'favorites';
}
