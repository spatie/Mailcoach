<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Http\App\Queries\UsersQuery;
use App\Models\User;

class UsersIndexController
{
    public function __invoke(UsersQuery $usersQuery)
    {
        return view('app.users.index', [
            'users' => $usersQuery->paginate(),
            'totalUsersCount' => User::count(),
        ]);
    }
}
