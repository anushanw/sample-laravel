<?php

namespace Tests\Browser\AssetManagement\Transfers;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class TransferIndexTest extends DuskTestCase
{
    public function transfersPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers')
                ->assertTitleContains('Asset transfers')
                ->assertSee('Asset transfers');
        });
    }

    public function checkTransferCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers')
                ->mouseover('hover')
                ->clickLink('Create transfer')
                ->assertSee('Asset transfers')
                ->assertPathIs('/asset-management/transfers/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Asset transfers')
                ->assertPathIs('/asset-management/transfers');
        });
    }

}
