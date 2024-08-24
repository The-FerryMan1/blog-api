<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class LogsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function getLogs(User $user)
    {
        $role = $user->role;

        if (!$role) {
            return Response::deny('Unauthorized: No role found for this user.');
        }

        return $role->permission === '0755'
            ? Response::allow()
            : Response::deny('Unauthorized');
    }
}
