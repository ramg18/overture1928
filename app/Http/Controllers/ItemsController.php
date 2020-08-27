<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;

class ItemsController extends Controller
{
    public function crearItem( Request $request ) {

        $item = Items::insert([
            'nombre' => $request->nombre,
            'valorppt' => $request->valor
        ]);

        return response()->json([
            'response' => 201,
            'state' => 'ok'
        ]);

    }

    public function listarItems() {
        $items = Items::all();
        return $items;
    }

    public function listarItem( $id ) {
        $search = Items::where('id', $id)
                            ->get();

        return $search;
    }

    public function editarItem( Request $request ){
        $update = Items::where('id',$request->id)
                            ->update([
                                'nombre' => $request->nombre,
                                'valorppt'    => $request->valorppt
                            ]);

        return $update;
    }
}
