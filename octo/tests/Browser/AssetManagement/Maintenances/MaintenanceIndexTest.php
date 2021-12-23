<?php

namespace Tests\Browser\AssetManagement\Maintenances;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class MaintenanceIndexTest extends DuskTestCase
{
    public function testMaintenancesPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances')
                ->assertTitleContains('Maintenance')
                ->assertSee('Maintenance');
        });
    }

    public function checkMaintenanceCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances')
                ->mouseover('hover')
                ->clickLink('Create maintenance')
                ->assertSee('Create maintenance')
                ->assertPathIs('/asset-management/maintenances/create');
        });
    }

    public function checkMaintenanceProfileClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances')
                ->clickLink('607d3f22')
                ->assertSee('Maintenance profile')
                ->assertPathIs('/asset-management/maintenances/5b9747b0421aa92f607d3f22');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Maintenance')
                ->assertPathIs('/asset-management/maintenances');
        });
    }

}
