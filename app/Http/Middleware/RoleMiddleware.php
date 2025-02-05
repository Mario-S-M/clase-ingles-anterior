<?php

//namespace Spatie\Permission\Middlewares;
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRole;


class RoleMiddleware
{
    
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            // throw UnauthorizedException::notLoggedIn();
           // if ($request->ajax()) {
               // return response('Unauthorized.', 403);
          //  } else {
                return redirect()->guest('login');
           // }
        }
        //$request->user()->assignRole('SuperAdmin');
        //dd($request->user()->hasAnyRole(['SuperAdmin', 'Admin']));
        $roles = is_array($role)
            ? $role 
            : explode('|', $role);                
            if (! Auth::user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }
        return $next($request);
    }
}
