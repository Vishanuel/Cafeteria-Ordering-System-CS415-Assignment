<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu_food_item extends Model
{
    //
	public function getQuantityAttribute($value)
    {
        return ucfirst($value);
    }
	
	protected $table = 'menu_food_item';
}
