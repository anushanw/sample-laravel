<?php

namespace Tests\Browser\AssetManagement\Assets;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AssetIndexTest extends DuskTestCase
{
    public function testAssetsPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets')
                ->assertTitleContains('Assets')
                ->assertSee('Assets');
        });
    }

    public function checkAssetCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets')
                ->mouseover('hover')
                ->clickLink('Asset create')
                ->assertSee('Asset create')
                ->assertPathIs('/asset-management/assets/create');
        });
    }

    public function checkAssetProfileClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets')
                ->clickLink('1761ffa2')
                ->assertSee('Asset')
                ->assertPathIs('/asset-management/assets/asset/589ffb9a1d41c8501761ffa2');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Assets')
                ->assertPathIs('/asset-management/assets');
        });
    }
}
