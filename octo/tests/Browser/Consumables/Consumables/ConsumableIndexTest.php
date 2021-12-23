<?php

namespace Tests\Browser\Consumables\Consumables;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class ConsumableIndexTest extends DuskTestCase
{
    public function testConsumablesPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables')
                ->assertTitleContains('Consumables')
                ->assertSee('Consumables');
        });
    }

    public function checkConsumableCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables')
                ->mouseover('hover')
                ->clickLink('Create consumable')
                ->assertSee('Create consumable item')
                ->assertPathIs('/consumables/consumables/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Consumables')
                ->assertPathIs('/consumables/consumables');
        });
    }

}
