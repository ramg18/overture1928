<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPartida extends Model
{
	protected $table = 'item_partida';

    protected $fillable = [
    	'id_partida',
    	'id_item',
    	'cantidad_item'
    ];
}
