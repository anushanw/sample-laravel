<?php

namespace App\Http\Middleware;

use Closure;

class DoCache
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $response->header('Cache-Control', 'private, max-age=2');
        $response->header('Access-Control-Allow-Origin', 'https://cdn.octosaas.com, https://cdn.octoerp.com, https://maxcdn.bootstrapcdn.com, https://fonts.googleapis.com, https://cdnjs.cloudflare.com');
        $response->header('Vary', 'Accept-Encoding');

        return $response;
    }
}
