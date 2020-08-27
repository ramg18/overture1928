<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntosUsuario extends Model
{
    protected $table = 'puntos_usuario';

    protected $fillable = [
        'cantidad_pt_ref',
        'cantidad_pt_mm',
        'id_usuario',
        'id_usuario_modifica'
    ];
}
