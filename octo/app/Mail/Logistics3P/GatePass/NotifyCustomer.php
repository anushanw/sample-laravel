<?php

namespace App\Mail\Logistics3P\GatePass;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\URL;

use App\Models\Store\GatePass;

class NotifyCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $gatePass;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(GatePass $gatePass)
    {
        $this->gatePass = $gatePass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    $gatePassNumber = substr( $this->gatePass->_id, -8 );
	    
	    return $this->from('noreply@octoerp.com')
			    ->subject("[OCTO] Gate-pass #{$gatePassNumber}")
			    ->with([
					    'link' => URL::to("/shared/74/{$this->gatePass->id}")
			    ])
			    ->markdown('emails.logistics3p.gatepass.notify.customer');
    }
}
