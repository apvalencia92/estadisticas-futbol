<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Silber\Bouncer\Bouncer;
use Illuminate\Support\Facades\File as File;


class EquipoController extends Controller
{

    public function index()
    {
        $this->authorize('index', Equipo::class);

        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }


    public function show(Equipo $equipo)
    {
        $image = $equipo->getImage();

        $this->authorize('view', $equipo);
        return view('equipos.show', compact('equipo', 'image'));
    }

    public function edit(Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        return view('equipos.edit', compact('equipo'));
    }

    public function update(Equipo $equipo, Request $request)
    {

        $this->authorize('update', $equipo);

        $fecha_actual = date('Y-m-d');
        $fechalimite = date('Y-m-d', strtotime($fecha_actual . "+ 1 days"));


        $data = $request->validate([
            'name' => ['required', 'string'],
            'logo' => ['nullable', 'image'],
            'fecha_nacimiento' => ['nullable', 'date', "before:$fechalimite"]
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = 'logo' . '.' . $request->file('logo')->getClientOriginalExtension();
            $this->tratarImagen($request->file('logo'), $equipo, $data['logo']);
        }

        $equipo->update($data);

        return redirect()->route('equipos.show',
            $equipo)->withupdate('La información del equipo ha sido actualizada correctamente');;

    }


    public function tratarImagen($file, $equipo, $nameImage)
    {
        $user = auth()->user();

        $this->doesequipoHasImage($user, $equipo, $nameImage);
        Image::make($file)
            ->resize(200, 200)
            ->save("img/{$user->email}/perfil/" . $nameImage);

    }


    public function doesequipoHasImage($user, $equipo)
    {
        if ($equipo->logo != null) {
            File::delete("img/$user->email/perfil/$equipo->logo");
        } else {
            $this->createDirectory($user, $equipo);
        }
    }


    public function createDirectory($user)
    {
        if (!File::exists("img/$user->email")) {
            File::makeDirectory("img/$user->email");
            File::makeDirectory("img/$user->email/perfil");
        }
    }


}
