<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 22/1/2019
 * Time: 02:19
 */

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as File;
use Intervention\Image\Facades\Image;
use Silber\Bouncer\Database\HasRolesAndAbilities;


trait ImageTrait
{

    use HasRolesAndAbilities;


    public function tratarPassword($data)
    {
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password'], $data['password-confirm']);
        }

        return $data;

    }


    public function tratarImagen($file, $user)
    {
        $this->isUserImage($user);

        $nameModify = camel_case($user->name);
        $extension = $file->getClientOriginalExtension();
        $file_name = $user->id . "_" . $nameModify . '.' . $extension;

        $this->createDirectory($user);

        if ($user->isAn('tecnico')) {
            Image::make($file)
                ->resize(200, 200)
                ->save("img/{$user->email}/perfil/" . $file_name);
        }

        if ($user->isAn('espectador')) {
            $tecnico = User::where('id', $user->belongs_to_user)->first();
            Image::make($file)
                ->resize(200, 200)
                ->save("img/{$tecnico->email}/espectadores/" . $file_name);
        }

    }


    // VERIFICAR AQUI
    public function isUserImage($user)
    {

        if ($user->image != null) {
            $name = camel_case($user->name);
            if ($user->isAn('tecnico')) {
                File::delete("img/{$user->email}/perfil/" . $user->id . '_' . $name);
            } elseif ($user->isAn('espectador')) {
                $tecnico = User::where('id', $user->belongs_to_user)->first();
                File::delete("img/{$tecnico->email}/espectadores/" . $user->id . '_' . $name . $user->image);
            }
        }
    }


    public function createDirectory($user)
    {

        if ($user->isAn('espectador')) {
            $tecnico = User::where('id', $user->belongs_to_user)->first();
            if (!File::exists("img/{$tecnico->email}")) {
                File::makeDirectory("img/{$tecnico->email}");
                File::makeDirectory("img/{$tecnico->email}/espectadores");
            } else {

                if (File::exists("img/{$tecnico->email}/espectadores")) {
                    return;
                } else {
                    File::makeDirectory("img/{$tecnico->email}/espectadores");
                }

            }
        } elseif (!File::exists("img/{$user->email}")) {
            File::makeDirectory("img/{$user->email}");
            File::makeDirectory("img/{$user->email}/perfil");
        } else {
            if (!File::exists("img/{$user->email}/perfil")) {
                File::makeDirectory("img/{$user->email}/perfil");
            }

        }
    }

}