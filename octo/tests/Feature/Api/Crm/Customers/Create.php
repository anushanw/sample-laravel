<?php

namespace Tests\Feature\Api\Crm\Customers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use Faker\Generator;

class Create extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample() {
    	$user = User::find(1);
    	$faker = new Generator();
    	
    	$response = $this->actingAs($user)->json('POST', '/api/v1/crm/customers/customer/create',[
    			'subType' => 1,
	            'name' => $faker->name,
	            'prefix' => 'Mr.',
	            'telephones' => array($faker->e164PhoneNumber, $faker->e164PhoneNumber)
	    ]);

    	$response->assertStatus(200);
    }
}
