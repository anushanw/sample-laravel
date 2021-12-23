<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DB;
use Session;

class GetValues
{
    public function handle($request, Closure $next)
    {
        if ($request->user() != NULL) {
	        /**     Number of support tickets     **/
	        if ( Session::get('aoid') != NULL) {
	        	$aoid = Session::get('aoid');
		        $qCacheTime = 300;   // Cache time in seconds
		        if ( !Session::has('STCount') || ( Session::has('STCountTs') && ( (Session::get('STCountTs') + $qCacheTime) > time() ) ) ) {
			        
			        $STCounts = DB::connection('mongodb')->collection('stats')
					        ->where('oid', $aoid)
					        ->where('uid', 0)
					        ->where('type', 27)
					        ->where('subType', 2)
					        ->first();
			
			        $STCount = ( !is_null($STCounts) && !is_null($STCounts->value) && ($STCounts->value > 0)) ? $STCounts->value : 0;
			
			        Session::forget('STCount');
			        Session::forget('STCountTs');
			
			        Session::put('STCount', $STCount);
			        Session::put('STCountTs', time());
		        }
	        }

	        return $next($request);

        } else {
	        return redirect('/auth/login');
        }
    }
}
