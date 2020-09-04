<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AsistenciaPartida;
use App\ItemPartida;
use App\Partida;
use App\PuntosUsuarioPartida;
use App\Items;
use App\User;

class PartidaController extends Controller
{
	private $Numero_Partida;

    public function Demo(Request $request) {
    	$this->Numero_Partida = $this->CrearPartida();
    	$this->CrearAsistencia($request->users);
    	$this->CrearItems($request->items);
    	$this->AsignarPuntos($request->users ,$request->items);
    	return $this->Numero_Partida;
    }

    function CrearPartida() {
    	$CrearPartida = Partida::create([]);
    	return $CrearPartida->id;
    }

    function CrearAsistencia($asistencias) {
    	foreach ($asistencias as $usuario) {
    		$CrearAsistencia = AsistenciaPartida::create([
    			'id_usuario' => $usuario['id'],
    			'id_partida' => $this->Numero_Partida
    		]);
    	}
    }

    function CrearItems($items) {
    	foreach ($items as $item) {
    		$CrearItems = ItemPartida::create([
    			'id_partida' => $this->Numero_Partida,
    			'id_item' => $item['id'],
    			'cantidad_item' => $item['amount']
    		]);
    	}
    }

    function AsignarPuntos($asistencias, $items) {
    	$total_asistencias = count($asistencias);
    	foreach ($asistencias as $usuario) {
    		foreach ($items as $item) {
    			$ValorItem = Items::select('valorppt')->where('id',$item['id'])->get();
    			$ValorItem = $ValorItem[0]['valorppt'] * $item['amount'];
    			$total_puntos = $ValorItem / $total_asistencias;
    			
    			$CrearPuntosUsuarioPartida = PuntosUsuarioPartida::create([
    				'id_partida' => $this->Numero_Partida,
    				'id_usuario' => $usuario['id'],
    				'id_item' => $item['id'],
    				'puntos_total_item' => $total_puntos
    			]);
    		}
    	}
    }

    function ObtenerPuntosPartida($id){
        $Consulta = PuntosUsuarioPartida::select('id_usuario','id_item','puntos_total_item')->where('id_partida', $id)->get();

        return $Consulta;
    }
}
