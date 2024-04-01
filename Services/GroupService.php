<?php

namespace App\Services;

use App\Models\Group;
use App\Models\User;
use App\Models\Permission;

class GroupService
{
    public function getGroupById($groupId): Group | null
    {
        return Group::findOrFail($groupId);
    }

    public function isUserInGroup(User $user, Group $group): bool
    {
        return $user->groups->contains($group);
    }

    public function getGroupPermissions(Group $group): array
    {
        return $group->permissions->pluck('name')->toArray();
    }

    public function isGroupBanned(Group $group): bool
    {
        return $group->is_ban;
    }

    public function getAllPermissions(): array
    {
        return Permission::all()->pluck('name')->toArray();
    }
}
