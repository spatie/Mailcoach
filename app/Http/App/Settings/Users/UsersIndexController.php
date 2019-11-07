<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Http\App\Queries\UsersQuery;
use App\Http\App\Resources\UserResource;
use App\Models\User;

class UsersIndexController
{
    public function __invoke(UsersQuery $usersQuery)
    {
        $users = $usersQuery->jsonPaginate();

        return inertia()->render('users.Index', [
            'users' => UserResource::collection($users)->toResponse(request())->getData(),
            'total_users_count' => User::count(),
        ]);
    }
}
