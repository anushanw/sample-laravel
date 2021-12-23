<?php

namespace Tests\Browser\AssetManagement\Audits;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AuditIndexTest extends DuskTestCase
{
    public function testAuditsPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits')
                ->assertTitleContains('Audits')
                ->assertSee('Audits');
        });
    }

    public function checkAuditCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits')
                ->mouseover('hover')
                ->clickLink('Create audit')
                ->assertSee('Create audit')
                ->assertPathIs('/asset-management/audits/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/audits')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Audits')
                ->assertPathIs('/asset-management/audits');
        });
    }

}
