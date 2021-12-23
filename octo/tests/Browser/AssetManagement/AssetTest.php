<?php

namespace Tests\Browser\AssetManagement;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AssetTest extends DuskTestCase
{
	public function testAssetsList() {
		$this->browse(function (Browser $browser) {
			$browser->loginAs(User::find(config('octo.testUser')))
				->visit('/asset-management/assets')
				->assertSee('Assets');
		});
	}
	
	
	public function testAssetCreate() {
		$this->browse(function (Browser $browser) {
			$browser->loginAs(User::find(config('octo.testUser')))
				->visit('/crm/contacts/contact/create')
				->assertSee('Add contact');
		});
	}
}
