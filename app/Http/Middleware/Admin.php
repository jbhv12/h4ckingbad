<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( (!Auth::user()) || (!Auth::user()->isAdmin())){
            $request->session()->flash('flashDanger', 'Unautherized Access, Access Denied!');
            return back();
        }
        return $next($request);
    }
}
