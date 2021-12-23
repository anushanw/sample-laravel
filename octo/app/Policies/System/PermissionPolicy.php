<?php

namespace App\Policies\System;

use Illuminate\Auth\Access\HandlesAuthorization;

use Arr;
use Auth;

use App\Models\User;
use App\Models\Team;
use App\Models\System\Role;

use Facades\App\Libraries\System\Permissions;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


	public function access($user, $key) {
		if(empty($user) && Auth::check()) {
			$user = Auth::user();
		}

		$aoid = $user->current_team_id;

        if($user->roleOn($user->current_team) == 'owner' || $user->roleOn($user->current_team) == 'admin') {
            if(substr_count($key, '.') == 0) {
                $response = $this->isModuleAllowed($user, $key);
            } else {
                $response = TRUE;
            }
        } else if(!empty(session('aoid')) && (session('aoid') == $aoid) && !empty(session('permissions'))) {
            $permissions = session('permissions');

            $response = (isset($permissions[$key]) && $permissions[$key]) ? TRUE : FALSE;
        } else if(!empty($userPermissions = Role::where('oid', $aoid)->where('type', 1)->where('typeID', $user->id)->first())) {
            $permissions = json_decode($userPermissions->permissions, TRUE);
            session([
                'aoid' => $aoid,
                'permissions' => $permissions
            ]);

            $response = (isset($permissions[$key]) && $permissions[$key]) ? TRUE : FALSE;
		} else {
            $teamRolesCount = Role::where('oid', $aoid)->where('type', 41)->where('typeID', $aoid)->get();
            if($teamRolesCount->count()) {
                $response = FALSE;
            } else {
                $response = Permissions::systemDefaultPermission($key);
            }
		}

		return $response;
	}



	public function isModuleAllowed($user, $moduleKey) {
		abort_unless(Auth::check(), 403);

		$aoid = $user->currentTeam()->id;

		if(!empty(session('aoid')) && (session('aoid') == $aoid) && !empty(session('modulesAllowed'))) {
			$modulesAllowed = session('modulesAllowed');
		} else {
			$modulesAllowed = json_decode(Team::find($aoid)['modulesAllowed'], TRUE);
			session([
					'aoid' => $aoid,
					'modulesAllowed' => $modulesAllowed
			]);
		}

		if(Arr::has($modulesAllowed, $moduleKey) && Arr::get($modulesAllowed, $moduleKey)) {
			if(!empty(session('orgSettings'))) {
				$orgSettings = session('orgSettings');
			} else {
				$permissionRecord = Role::where('oid', $aoid)->where('type', 2)->where('typeID', $aoid)->first();

				if (!isset($permissionRecord->id)) {
				    $permissionRecord = Role::create([
				        'oid' => $aoid,
                        'type' => 2,
                        'typeID' => $aoid,
                        'permissions' => json_encode($modulesAllowed)
                    ]);
                }

				$orgSettings = json_decode($permissionRecord['permissions'], TRUE);
				session(['orgSettings' => $orgSettings]);
			}

			$orgModules = !empty($orgSettings['modules']) ? $orgSettings['modules'] : array();

			if(Arr::has($orgModules, $moduleKey)) {
				if(Arr::get($orgModules, $moduleKey) == TRUE) {
					$response = TRUE;
				} else {
					$response = FALSE;
				}
			} else {
				// Here because no organization level module setting specifying to or not to use the module.
				// But allowed to use the module by the system and makind the module available.
				$response = TRUE;
			}
		} else {
			$response = FALSE;
		}

		return $response;
	}
}
