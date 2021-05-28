<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;

class ValidateUserType
{

    public function handle(Request $request, Closure $next, string $user_type)
    {
        abort_unless($request->user()->isOfType(UserTypeEnum::from($user_type)), 403);

        return $next($request);
    }
}
