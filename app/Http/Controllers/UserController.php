<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Presenters\UserPresenter;
use App\Traits\ImageTrait;
use App\User;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;


class UserController extends Controller
{

    use ImageTrait;


    public function index()
    {

        $usuarios = User::query()
            ->with('roles')
            ->Where('belongs_to_user', auth()->id())
            ->orWhereHas('roles', function ($query) {
                $query->where('name', 'tecnico');
            })->unless(auth()->user()->isAn('admin'), function ($q) {
                $q->where('belongs_to_user', auth()->id());
            })->paginate();


        return view('users.index', compact('usuarios'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');

    }


    public function store(UserCreateRequest $request)
    {

        $this->authorize('create', User::class);

        $user = $request->createUser();

        return redirect()->route('usuarios.index')->withcreated('El espectador ha sido creado satisfactoriamente');
    }


    public function show(User $usuario)
    {
        $image = $usuario->getImage();

        return view('users.show', compact('usuario', 'image'));
    }


    public function edit(User $usuario)
    {
        $this->authorize('update', $usuario);
        return view('users.edit', compact('usuario'));
    }


    public function update(UserEditRequest $request, User $usuario)
    {
        $this->authorize('update', $usuario);
        $request->updateUser($usuario);

        return redirect()->route('usuarios.show', $usuario)
            ->withedited('El usuario ha sido actualizado satisfactoriamente');
    }

    public function update_image(User $usuario, Request $request)
    {
        if ($request->hasFile('image')) {
            $this->tratarImagen($request->file('image'), $usuario);
            $data['image'] = "." . $request->file('image')->getClientOriginalExtension();
        }

        $usuario->update(['image'=>$data['image']]);
        return redirect()->route('usuarios.show',$usuario)->withupdateprofile('Foto de perfil actualizada');
    }


    public function destroy(User $usuario)
    {
        $this->isUserImage($usuario);
        $usuario->equipos()->detach();
        $usuario->delete();
        return redirect('usuarios');
    }
}
