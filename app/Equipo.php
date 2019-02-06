<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class Equipo extends Model
{

    use HasRolesAndAbilities;


    protected $fillable = ['name', 'logo','fecha_nacimiento'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_equipo');
    }


    // Retorna el id del usuario asignado al equipo, en este caso es el usuario con el rol tecnico
    public function getIdUser()
    {
        return $this->users()->first()->pivot->user_id;
    }


    /* Retorna el id de un usuario espectador,
     * este metodo es llamado en el modelo User en el metodo canEspectadorViewEquipo
     *
     */
    public function doBelongthisEquipo(User $user)
    {
        if(empty($this->users()->where('user_id', $user->id)->first())){
            return false;
        }

        return true;
//        return $this->users()->where('user_id', $user->id)->value('user_id');
    }


    public function getUser()
    {
        return $this->users()->first();
    }


    public function getImage()
    {
        if ($this->logo) {
            return asset("img/{$this->getUser()->email}/perfil/{$this->logo}");
        } else {
            return asset('img/logo-equipo.png');
        }


    }


}
