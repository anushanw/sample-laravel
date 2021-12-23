<?php

namespace Tests\Feature\Pages;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Auth extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	public function testLogin() {
		$response = $this->get('/login');
		$response->assertStatus(200);
	}
	
	public function testRegister() {
		$response = $this->get('/register');
		$response->assertStatus(200);
	}
}
