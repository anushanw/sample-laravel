<?php

namespace Tests\Browser\AssetManagement\Assets;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AssetCreateTest extends DuskTestCase
{
    public function testAssetCreatePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/create')
                ->assertTitleContains('Asset create')
                ->assertSee('Asset create');
        });
    }

    public function checkAssetCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/create')
                ->mouseover('hover')
                ->clickLink('Asset create')
                ->assertSee('Asset create')
                ->assertPathIs('/asset-management/assets/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/create')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Asset create')
                ->assertPathIs('/asset-management/assets/create');
        });
    }
}
