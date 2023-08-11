<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseFormatter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$isadmin): Response
    {
        $user = $request->user();
        if($user->is_admin == $isadmin){
            return $next($request);
        }
        else{
            return ResponseFormatter::error(
                'User Has No Access'
            );
        }
    }
}
