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
     * @param  mixed ...$roles  // rol nomlarini enum value sifatida qabul qiladi
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        $user = $request->user(); 
        if (!$user) {
            abort(401, 'Login qilishingiz kerak'); // Unauthorized
        }

       
        $allowedRoles = array_map(fn($role) => UserRole::tryFrom($role), $roles);

        
        if (!in_array($user->role, $allowedRoles, true)) {
            abort(403, 'Sizda ruxsat yo‘q'); // Forbidden
        }

       
        return $next($request);
    }
}
