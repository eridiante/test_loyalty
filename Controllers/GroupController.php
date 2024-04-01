<?php

namespace App\Controllers;

use App\Services\GroupService;
use App\Services\UserService;

class GroupController extends AbstractController
{
    public $userService;
    public $groupService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
        $this->groupService = new GroupService();
    }

    public function getUserPermissions(int $userId)
    {
        $user = $this->userService->getUserById($userId);
        $userGroups = $this->userService->getUserGroups($user);
        $permissions = [];

        $allowPermissions = [];
        $blockedPermissions = [];
        foreach ($userGroups as $group) {
            if ($this->groupService->isGroupBanned($group)) {
                $blockedPermissions = array_merge($blockedPermissions, $this->groupService->getGroupPermissions($group));
            } else {
                $allowPermissions = array_merge($allowPermissions, $this->groupService->getGroupPermissions($group));
            }
        }

        $allowPermissions = array_diff(array_unique($allowPermissions), array_unique($blockedPermissions));

        $allPermissions = $this->groupService->getAllPermissions();
        $permissions = [];

        foreach ($allPermissions as $permission) {
            $permissions[$permission] = !$this->groupService->isGroupBanned($group);
            if (in_array($permission, $allowPermissions)) {
                $permissions[$permission] = true;
            } else {
                $permissions[$permission] = false;
            }
        }

        return $this->response->json($permissions);
    }

    public function getUserGroups(int $userId)
    {
        $user = $this->userService->getUserById($userId);
        $groups = $user->groups->map(function ($group) {
            return [
                'group' => $group->name,
            ];
        });

        return $this->response->json($groups);
    }

    public function addUserToGroup(int $userId, int $groupId)
    {
        $user = $this->userService->getUserById($userId);
        $group = $this->groupService->getGroupById($groupId);

        if ($user->groups->contains($group)) {
            $this->response->httpCode(400);
            return $this->response->json([
                'status' => 'error',
                'message' => 'The user is already a member of this group.',
            ]);
        }

        $user->groups()->attach($groupId);

        return $this->response->json([
            'status' => 'success',
        ]);
    }

    public function removeUserFromGroup(int $userId, int $groupId)
    {
        $user = $this->userService->getUserById($userId);
        $group = $this->groupService->getGroupById($groupId);

        if (!$user->groups->contains($group)) {
            $this->response->httpCode(400);
            return $this->response->json([
                'message' => 'The user is not a member of this group.'
            ]);
        }

        $user->groups()->detach($groupId);

        return $this->response->json([
            'status' => 'success',
        ]);
    }
}