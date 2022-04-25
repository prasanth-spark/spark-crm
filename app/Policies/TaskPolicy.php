<?php

namespace App\Policies;

use App\Models\TaskSheet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskSheet  $taskSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TaskSheet $taskSheet)
    {
        return $user->id === $taskSheet->user_id
        ? Response::allow()
        : Response::deny("You don't have permission to view this task.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskSheet  $taskSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TaskSheet $taskSheet)
    {
        return $user->id === $taskSheet->user_id
            ? Response::allow()
            : Response::deny("You don't have permission to update this task.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskSheet  $taskSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TaskSheet $taskSheet)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskSheet  $taskSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TaskSheet $taskSheet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskSheet  $taskSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TaskSheet $taskSheet)
    {
        //
    }
}
