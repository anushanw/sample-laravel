<?php

namespace App\Listeners\User\Register;

use App\Mail\SuperAdmin\UserRegister;
use Laravel\Spark\Events\Auth\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;
use Mail;

class NotifySuperAdmin
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
    	$user = Auth::user();
    	
    	Mail::to('contact@octoerp.com')->send(new UserRegister($user));
    }
}
