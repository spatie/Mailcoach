<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WelcomesNewUsers
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->hasValidSignature()) {
            abort(Response::HTTP_FORBIDDEN, __mc('The welcome link does not have a valid signature or is expired.'));
        }

        if (! $request->user) {
            abort(Response::HTTP_FORBIDDEN, __mc('Could not find a user to be welcomed.'));
        }

        if (is_null($request->user->welcome_valid_until)) {
            abort(Response::HTTP_FORBIDDEN, __mc('The welcome link has already been used.'));
        }

        if (Carbon::create($request->user->welcome_valid_until)->isPast()) {
            abort(Response::HTTP_FORBIDDEN, __mc('The welcome link has expired.'));
        }

        return $next($request);
    }
}
