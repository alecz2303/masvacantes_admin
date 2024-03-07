<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpresaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // Permitir al Administrador ver todas las publicaciones
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Empresa $empresa)
    {
        // Permitir al Administrador ver todas las publicaciones
        if ($user->hasRole('Admin')) {
            return true;
        }

        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Empresa $empresa)
    {
        // Permitir al Administrador ver todas las publicaciones
        if ($user->hasRole('Admin')) {
            return true;
        }

        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Empresa $empresa)
    {
        // Permitir al Administrador ver todas las publicaciones
        if ($user->hasRole('Admin')) {
            return true;
        }

        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Empresa $empresa)
    {
        // Permitir al Administrador ver todas las publicaciones
        if ($user->hasRole('Admin')) {
            return true;
        }

        return $user->id === $empresa->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Empresa $empresa)
    {
        // Permitir al Administrador ver todas las publicaciones
        if ($user->hasRole('Admin')) {
            return true;
        }

        return $user->id === $empresa->user_id;
    }
}
