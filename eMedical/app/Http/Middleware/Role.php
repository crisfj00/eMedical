<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Role  
{

public function handle($request, Closure $next)
{
    if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
        return redirect('login');

    $user = Auth::user();

    $allowed_roles = array_slice(func_get_args(), 2);

    if(in_array("admin", $allowed_roles) && $user->isAdmin())
        return $next($request);

    if(in_array("doctor", $allowed_roles) && $user->isDoctor())
    return $next($request);

    if(in_array("patient", $allowed_roles) && $user->isPatient())
    return $next($request);

    return redirect('home');
}

}
