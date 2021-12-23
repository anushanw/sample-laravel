<?php

namespace Tests\Feature\Pages;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class Crm extends TestCase
{
	public function testCustomers() {
		$user = User::find(1);
		
		$response = $this->actingAs($user)
				->get('/crm/customers');
		
		$response->assertStatus(200);
	}
}
