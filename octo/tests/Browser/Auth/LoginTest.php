<?php

namespace Tests\Browser\Auth;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    public function testLoginPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Sign-in to OCTO SaaS');
        });
    }
	
	
	public function testLogin()
	{
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
					->type('email', 'anushanw@flatorb.com')
					->type('password', 'Abc@1234')
					->click('#m_login_signin_submit')
					->assertSee('Dashboard');
		});
	}
}
