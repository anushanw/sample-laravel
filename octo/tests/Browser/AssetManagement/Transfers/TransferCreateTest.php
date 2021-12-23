<?php

namespace Tests\Browser\AssetManagement\Transfers;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class TransferCreateTest extends DuskTestCase
{
    public function transferCreatePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers/create')
                ->assertTitleContains('Asset transfers')
                ->assertSee('Asset transfers');
        });
    }

    public function checkTransferCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers/create')
                ->mouseover('hover')
                ->clickLink('Create transfer')
                ->assertSee('Asset transfers')
                ->assertPathIs('/asset-management/transfers/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers/create')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Asset transfers')
                ->assertPathIs('/asset-management/transfers/create');
        });
    }

    public function testTransferCreate(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/transfers/create')
                ->type('date', '2019-02-20')

                ->select('from')
                ->select('to')

                ->type('name', 'Transfer on 20th')
                ->type('description', 'This is a demo description')

                ->click('saveButton')

                ->assertSee('Transfer');
        });
    }

}
