<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAdmin extends Middleware
{
    protected function redirectTo($request): ?string
    {
        return $request->expectsJson() ? null : route('admin.login.form');
    }
}
