<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Response;

class TypeMiddleware
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
        if(Auth::check() && auth()->user()->usertype === 'Admin')
        {
            return $next($request);
        }
        //If user role is patron
        if(Auth::check() && auth()->user()->usertype === 'Patron')
        {
             return redirect('/home');
        }

        //If user role is menu manager
        else if(Auth::check() && auth()->user()->usertype ==='Menu Manager')
        {
             return Response::view('menu manager.home');
        }   
		
		else if(Auth::check() && auth()->user()->usertype ==='Cafeteria Staff')
        {
             return redirect('/cafeteria');
        } 
		
		else if(Auth::check() && auth()->user()->usertype ==='Meal Deliverer')
        {
             return Response::view('meal deliverer.home');
        } 
    }
}
