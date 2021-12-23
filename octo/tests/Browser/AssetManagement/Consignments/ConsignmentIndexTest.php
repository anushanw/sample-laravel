<?php

namespace Tests\Browser\AssetManagement\Consignments;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ConsignmentIndexTest extends DuskTestCase
{
    public function testConsignmentsPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/consignments')
                ->assertTitleContains('Consignments')
                ->assertSee('Consignments');
        });
    }

    public function checkConsignmentCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/consignments')
                ->mouseover('hover')
                ->clickLink('Create consignment')
                ->assertSee('Create consignments')
                ->assertPathIs('/asset-management/consignments/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/consignments')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Consignments')
                ->assertPathIs('/asset-management/consignments');
        });
    }

}
