<?php

namespace App\Policies;

use App\User;
use App\Equipo;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Equipo  $equipo
     * @return mixed
     */
    public function view(User $user, Equipo $equipo)
    {
        return $user->id == $equipo->getIdUser();
    }

    /**
     * Determine whether the user can create equipos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Equipo  $equipo
     * @return mixed
     */
    public function update(User $user, Equipo $equipo)
    {
        //
    }

    /**
     * Determine whether the user can delete the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Equipo  $equipo
     * @return mixed
     */
    public function delete(User $user, Equipo $equipo)
    {
        //
    }

    /**
     * Determine whether the user can restore the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Equipo  $equipo
     * @return mixed
     */
    public function restore(User $user, Equipo $equipo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Equipo  $equipo
     * @return mixed
     */
    public function forceDelete(User $user, Equipo $equipo)
    {
        //
    }
}
