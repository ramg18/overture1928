<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model
{
    protected $table = 'transacciones';

    protected $fillable = [
        'tipo_transaccion',
        'tipo_de_punto',
        'cantidad_puntos',
        'id_usuario_transaccion'
    ];
}
