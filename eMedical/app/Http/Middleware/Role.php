<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Role  
{

public function handle($request, Closure $next, $role)
{
    if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
        return redirect('login');

    $user = Auth::user();

    if($role=='admin' && $user->isAdmin())
        return $next($request);

    if($role=='doctor' && $user->isDoctor())
    return $next($request);

    if($role=='patient' && $user->isPatient())
    return $next($request);

    return redirect('home');
}

}
