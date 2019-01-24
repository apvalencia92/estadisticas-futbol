<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'belongs_to_user',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'password',
    ];


    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'user_equipo');
    }


    public function isTecnico()
    {
        if ($this->isNotAn('tecnico')) {
            throw new AuthorizationException;
        }
        return true;
    }

    public function espectadorCount()
    {
        return User::where('belongs_to_user', $this->id)->count();
    }


    public function getImage()
    {
        if ($this->image) {
            if ($this->isA('espectador')) {
                $tecnico = User::where('id',Auth::user()->belongs_to_user)->first();
                return asset("img/{$tecnico->email}/espectadores/{$this->id}" . '_' . camel_case($this->name) . $this->image);
            } else {
                return asset("img/{$this->email}/perfil/{$this->id}" . '_' . camel_case($this->name) . $this->image);
            }
        } else {
            return asset('img/player-default.jpg');
        }


    }



//    }

//        if ($user->isA('tecnico')) {
//            if ($this->image) {
//                return asset("img/{$this->email}/{$this->id}" . '_' . camel_case($this->name) . $this->image);
//            } else {
//                return asset('img/player-default.jpg');
//            }
//        } elseif ($user->isAn('espectador')) {
//            if ($this->image) {
//                return asset("img/{$this->email}/{$user->email}/{$this->id}" . '_' . camel_case($this->name) . $this->image);
//            } else {
//                return asset('img/player-default.jpg');
//            }
//        }


}
