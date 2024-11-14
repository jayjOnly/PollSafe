<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_name = $request->user()->name;
        $user_role = UserRole::where('id', $request->user()->role_id)->first()->role;
        View::share('user_name', $user_name);
        View::share('user_role', $user_role);
        return $next($request);
    }
}
