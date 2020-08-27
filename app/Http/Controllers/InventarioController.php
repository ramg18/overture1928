<?php

namespace App\Http\Controllers;
use App\User;
use App\Items;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function listUser() {
        $user = User::all();
        return $user;
    }

    public function ingresoShare( Request $request ) {

        // buscar items registrados para el share
        $items = Items::all();
        return $items;
        // buscar items registrados para el share

        //

    }
}
