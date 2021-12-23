<?php

namespace Tests\Browser\AssetManagement\Maintenances;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class MaintenanceCreateTest extends DuskTestCase
{
    public function testMaintenanceCreatePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/create')
                ->assertTitleContains('Create maintenance')
                ->assertSee('Create maintenance');
        });
    }

    public function checkMaintenanceCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/create')
                ->mouseover('hover')
                ->clickLink('Create maintenance')
                ->assertSee('Create maintenance')
                ->assertPathIs('/asset-management/maintenances/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/create')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Create maintenance')
                ->assertPathIs('/asset-management/maintenances/create');
        });
    }

    public function testMaintenaceCreate(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/maintenances/create')
                ->select('typeID')

                ->type('name', 'Maintenance on 20th')
                ->type('dateDue', '2019-02-25')
                ->type('description', 'This is a demo description')

                ->click('saveButton')

                ->assertSee('Maintenance profile');
        });
    }

}
