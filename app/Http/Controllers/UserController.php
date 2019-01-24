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

        $users = User::query()
            ->with('roles')
            ->Where('belongs_to_user', auth()->id())
            ->orWhereHas('roles', function ($query) {
                $query->where('name', 'tecnico');
            })->unless(auth()->user()->isAn('admin'), function ($q) {
                $q->where('belongs_to_user', auth()->id());
            })->paginate();


        return view('users.index', compact('users'));
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

        return redirect()->route('users.index')->withcreated('El espectador ha sido creado satisfactoriamente');
    }


    public function show(User $user)
    {
        $image = $user->getImage();

        return view('users.show', compact('user', 'image'));
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    public function update(UserEditRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $request->updateUser($user);

        return redirect()->route('users.show', $user)
            ->withedited('El usuario ha sido actualizado satisfactoriamente');
    }

    public function update_image(User $user, Request $request)
    {
        if ($request->hasFile('image')) {
            $this->tratarImagen($request->file('image'), $user);
            $data['image'] = "." . $request->file('image')->getClientOriginalExtension();
        }

        $user->update(['image'=>$data['image']]);
        return redirect()->route('users.show',$user)->withupdateprofile('Foto de perfil actualizada');
    }


    public function destroy(User $user)
    {
        $this->isUserImage($user);
        $user->equipos()->detach();
        $user->delete();
        return redirect('usuarios');
    }
}
