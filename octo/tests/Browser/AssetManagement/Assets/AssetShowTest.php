<?php

namespace Tests\Browser\AssetManagement\Assets;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AssetShowTest extends DuskTestCase
{
    public function testAssetProfilePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/asset/589ffb9a1d41c8501761ffa2')
                ->assertTitleContains('Asset')
                ->assertSee('Asset');
        });
    }

    public function checkAssetCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/asset/589ffb9a1d41c8501761ffa2')
                ->mouseover('hover')
                ->clickLink('Asset create')
                ->assertSee('Asset create')
                ->assertPathIs('/asset-management/assets/create');
        });
    }

    public function checkAssetEditClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/asset/589ffb9a1d41c8501761ffa2')
                ->clickLink('Edit')
                ->assertSee('Edit asset')
                ->assertPathIs('/asset-management/assets/edit/589ffb9a1d41c8501761ffa2');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/asset/589ffb9a1d41c8501761ffa2')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Asset')
                ->assertPathIs('/asset-management/assets/asset/589ffb9a1d41c8501761ffa2');
        });
    }
}
