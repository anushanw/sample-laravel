<?php

namespace Tests\Browser\AssetManagement\Maintenances;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class MaintenanceShowTest extends DuskTestCase
{
    public function testMaintenanceProfilePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/5b9747b0421aa92f607d3f22')
                ->assertTitleContains('Maintenance profile')
                ->assertSee('Maintenance profile');
        });
    }

    public function checkMaintenanceCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/5b9747b0421aa92f607d3f22')
                ->mouseover('hover')
                ->clickLink('Create maintenance')
                ->assertSee('Create maintenance')
                ->assertPathIs('/asset-management/maintenances/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/5b9747b0421aa92f607d3f22')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Maintenance profile')
                ->assertPathIs('/asset-management/maintenances/5b9747b0421aa92f607d3f22');
        });
    }

}
