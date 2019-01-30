<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;


class EquipoController extends Controller
{
    public function index()
    {
        $this->authorize('index',Equipo::class);

        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }



    public function show(Equipo $equipo)
    {
        $this->authorize('view',$equipo);
        return view('equipos.show', compact('equipo'));
    }
}
