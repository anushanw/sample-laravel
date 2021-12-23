<?php

namespace App\Libraries\Quality;

use App\Models\Quality\Profile;
use App\Models\Quality\ProfileGroup;

class ProfilesGroups {
	public function groups($profileID)
    {
		$groups = ProfileGroup::where('profileID', $profileID)->get();
		
		return $groups;
	}
	
	
}
