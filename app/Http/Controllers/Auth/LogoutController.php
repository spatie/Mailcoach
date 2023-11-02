<?php

namespace App\Http\Controllers\Auth;

class LogoutController extends LoginController
{
    public function __construct()
    {
        // empty constructor to avoid the parent applying unwanted middleware
    }

    public function __invoke()
    {
        $this->guard()->logout();

        session()->flush();

        return redirect()->action([LoginController::class, 'showLoginForm']);
    }
}
