<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenciaPartida extends Model
{
	protected $table = 'asistencia_partida';

    protected $fillable = [
    	'id',
    	'id_usuario',
    	'id_partida'
    ];
}
