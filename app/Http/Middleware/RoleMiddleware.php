<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            abort(401, 'Login qilishingiz kerak'); 
        }

        
        $allowedRoles = array_map(function ($role) {
            $role = ucfirst(strtolower($role));
            return match($role) {
                'Admin' => UserRole::Admin,
                'Teacher' => UserRole::Teacher,
                'Student' => UserRole::Student,
                default => abort(500, "Noma'lum rol: $role"),
            };
        }, $roles);

        if (!in_array($user->role, $allowedRoles, true)) {
            abort(403, 'Sizda ruxsat yoq'); 
        }

        return $next($request);
    }
}
