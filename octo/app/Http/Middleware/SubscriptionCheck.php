<?php

namespace App\Http\Middleware;

use Laravel\Spark\Spark;
use Illuminate\Support\Str;

use Closure;


class SubscriptionCheck
{
    public function handle($request, $next, $subscription = 'default', $plan = null)
    {
	    $currentTeam = $request->session()->get('currentTeam', function() use($request) {
		    $currentTeamSessionData = $request->user()->currentTeam;
		    $request->session()->put('currentTeam', $currentTeamSessionData);
		    return $currentTeamSessionData;
	    });
	    
    	if($currentTeam->isEnterprise) {
    		if($currentTeam->isSuspended) {
			    return $request->ajax() || $request->wantsJson()
					    ? response('Account is suspended', 402)
					    : redirect('/system/messages/suspended');
		    } else {
			    return $next($request);
		    }
	    } else {
		    if ($this->subscribed($request->user(), $subscription, $plan, func_num_args() === 2)) {
			    return $next($request);
		    }
		
		    return $request->ajax() || $request->wantsJson()
				    ? response('Subscription Required.', 402)
				    : redirect('/settings/' . Str::plural(Spark::teamsPrefix()).'/'.$request->user()->currentTeam->id.'#/subscription');
	    }
    }
	
	
	protected function subscribed($user, $subscription, $plan, $defaultSubscription)
	{
		if (! $user || ! $user->currentTeam) {
			return false;
		}
		
		return ($defaultSubscription && $user->currentTeam->onGenericTrial()) ||
				$user->currentTeam->subscribed($subscription, $plan);
	}
}
