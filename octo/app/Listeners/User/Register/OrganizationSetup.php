<?php

namespace App\Listeners\User\Register;

use Laravel\Spark\Events\Auth\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;

use App\Models\Team;

class OrganizationSetup
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
    	// Create the default team modules only if the current team doesnt have any module availability information
    	if(!empty(Auth::user()->currentTeam) && empty(Auth::user()->currentTeam->modulesAllowed)) {
		    $timestampnow = date('Y-m-d H:i:s');

		    if(!empty(Auth::user()->currentTeam->current_billing_plan)) {
                $settings['crm'] = TRUE;
                $settings['support'] = TRUE;
                $settings['sales'] = TRUE;
                $settings['hr'] = TRUE;
                $settings['products'] = TRUE;
                $settings['finance'] = TRUE;
                $settings['inventory'] = TRUE;
                $settings['purchasing'] = TRUE;
                $settings['projects'] = TRUE;
                $settings['production'] = TRUE;
                $settings['marketing'] = TRUE;
                $settings['assetManagement'] = TRUE;
                $settings['warehouse'] = TRUE;
                $settings['salesForce'] = TRUE;
                $settings['workflow'] = TRUE;
                $settings['distributionCenters'] = TRUE;
                $settings['distribution'] = TRUE;
                $settings['lms'] = TRUE;
                $settings['fleetManagement'] = TRUE;
                $settings['gamification'] = TRUE;
                $settings['deviceCloud'] = TRUE;
            } else {
                $settings['purchasing'] = TRUE;
		    }

		    $team = Team::find(Auth::user()->currentTeam->id);
			$team->modulesAllowed = json_encode($settings);
            $team->updated_at = $timestampnow;
			$team->save();
	    }
    }
}
