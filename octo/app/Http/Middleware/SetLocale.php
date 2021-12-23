<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;

class SetLocale
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
    	if($user = Auth::user()) {
		    App::setLocale($user->locale);
	    }
    	
        return $next($request);
    }
}
