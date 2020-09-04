<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntosUsuarioPartida extends Model
{
	protected $table = 'puntos_usuario_partida';

    protected $fillable = [
    	'id',
    	'id_partida',
    	'id_usuario',
    	'id_item',
    	'puntos_total_item'
    ];}
