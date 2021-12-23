<?php

namespace App\Policies\Crm;

use App\Models\User;
use App\App\Models\Crm\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
    	if($user->isSuperAdmin()) {
    		return true;
    	}
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\Crm\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
//    	if($user->roleOnCurrentTeam() == 'owner' || )
//        return $response;
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\Crm\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\Crm\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        //
    }
}
