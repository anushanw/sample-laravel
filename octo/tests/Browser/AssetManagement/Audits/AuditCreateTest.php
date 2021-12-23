<?php

namespace Tests\Browser\AssetManagement\Audits;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AuditCreateTest extends DuskTestCase
{
    public function testAuditCreatePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits/create')
                ->assertTitleContains('Create audit')
                ->assertSee('Create audit');
        });
    }

    public function checkAuditCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits/create')
                ->mouseover('hover')
                ->clickLink('Create audit')
                ->assertSee('Create audit')
                ->assertPathIs('/asset-management/audits/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits/create')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Create audit')
                ->assertPathIs('/asset-management/audits/create');
        });
    }

    public function testAuditCreate(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits/create')
                ->select('locationID')

                ->type('date', '2019-02-20')
                ->type('name', 'Audit name')
                ->type('description', 'This is a demo description')

                ->click('saveButton')

                ->assertSee('Audit');
        });
    }

}
