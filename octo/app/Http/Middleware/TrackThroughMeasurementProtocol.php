<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Irazasyed\LaravelGAMP\Facades\GAMP;

use Auth;

class TrackThroughMeasurementProtocol
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
        // Create a new UUID which is used as the Client ID
        $uuid = Auth::check() ? (string) Auth::user()->id : (string) Str::uuid();
    
        $gamp = GAMP::setClientId($uuid);
        $gamp->setDocumentPath('/' . $request->path());
        $gamp->setDocumentReferrer($request->server('HTTP_REFERER', ''));
        $gamp->setUserAgentOverride($request->server('HTTP_USER_AGENT'));
    
        // Override the sent IP with the IP from the current request.
        // Otherwhise the servers IP would be sent.
        $gamp->setIpOverride($request->getClientIp());
    
        $gamp->sendPageview();
        
        return $next($request);
    }
}
