<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class Equipo extends Model
{

    use HasRolesAndAbilities;


    protected $fillable = ['name'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_equipo');
    }


    public function getIdUser()
    {
        return $this->users()->first()->pivot->user_id;
    }


}
