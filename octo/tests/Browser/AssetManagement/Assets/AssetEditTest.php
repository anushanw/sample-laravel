<?php

namespace Tests\Browser\AssetManagement\Assets;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AssetEditTest extends DuskTestCase
{
    public function testAssetEditPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/edit/589ffb9a1d41c8501761ffa2')
                ->assertTitleContains('Edit asset')
                ->assertSee('Edit asset');
        });
    }

    public function checkAssetCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/edit/589ffb9a1d41c8501761ffa2')
                ->mouseover('hover')
                ->clickLink('Asset create')
                ->assertSee('Asset create')
                ->assertPathIs('/asset-management/assets/create');
        });
    }


    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/asset-management/assets/edit/589ffb9a1d41c8501761ffa2')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Edit asset')
                ->assertPathIs('/asset-management/assets/edit/589ffb9a1d41c8501761ffa2');
        });
    }

}
