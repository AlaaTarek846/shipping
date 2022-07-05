<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->user_type == "admin" && Auth::user()->package_date >= now()->format('Y-m-d') && Auth::user()->is_active == 1) {
            return $next($request);
        }elseif(Auth::user()->user_type == "client" && Auth::user()->client->admin->user->package_date >= now()->format('Y-m-d') && Auth::user()->client->admin->user->is_active == 1){
            return $next($request);

        }elseif(Auth::user()->user_type == "representative" && Auth::user()->representative->admin->user->package_date >= now()->format('Y-m-d') && Auth::user()->representative->admin->user->is_active == 1){
            return $next($request);

        }elseif(Auth::user()->user_type == "employee" && Auth::user()->employee->admin->user->package_date >= now()->format('Y-m-d') && Auth::user()->employee->admin->user->is_active == 1){
            return $next($request);

        }elseif(Auth::user()->user_type == "company" && Auth::user()->company->admin->user->package_date >= now()->format('Y-m-d') && Auth::user()->company->admin->user->is_active == 1){
            return $next($request);

        } elseif(Auth::user()->user_type == "speradmin" ){
            return $next($request);

        }else
        {
            return response()->json("not active");
        }
    }
}
