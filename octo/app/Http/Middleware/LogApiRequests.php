<?php

namespace App\Http\Middleware;

use App\Http\Requests;

use Closure;

use Facades\App\Libraries\Log\LogOCTO;

class LogApiRequests
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
        LogOCTO::request($request);

        return $next($request);
    }
}
