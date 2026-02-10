<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            abort(401, 'Login qilishingiz kerak');
        }

        foreach ($roles as $role) {
            $role = ucfirst(strtolower($role));

            if (! defined(UserRole::class . '::' . $role)) {
                abort(403, "Noma'lum rol: $role");
            }

            if ($user->role === constant(UserRole::class . '::' . $role)) {
                return $next($request);
            }
        }

        abort(403, 'Sizda ruxsat yo‘q');
    }
}
