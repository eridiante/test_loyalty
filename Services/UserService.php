<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    public function getUserById($userId): User
    {
        return User::findOrFail($userId);
    }

    public function getUserGroups($user): Collection | null
    {
        return $user->groups;
    }
}
