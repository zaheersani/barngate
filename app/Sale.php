<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';

    public function color()
    {
    	return $this->belongsTo(Color::class, "color_id");
    }
}
