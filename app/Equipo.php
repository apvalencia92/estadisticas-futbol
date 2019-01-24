<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{

    protected $fillable = ['name'];


    public function users()
    {
        return $this->belongsToMany(User::class,'user_equipo');
    }
}
