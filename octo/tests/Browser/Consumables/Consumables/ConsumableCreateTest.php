<?php

namespace Tests\Browser\Consumables\Consumables;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class ConsumableCreateTest extends DuskTestCase
{
    public function testConsumableCreatePageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables/create')
                ->assertTitleContains('Create consumable item')
                ->assertSee('Create consumable item');
        });
    }

    public function checkConsumableCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables/create')
                ->mouseover('hover')
                ->clickLink('Create consumable item')
                ->assertSee('Create consumable item')
                ->assertPathIs('/consumables/consumables/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables/create')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Create consumable item')
                ->assertPathIs('/consumables/consumables/create');
        });
    }

    public function testConsumableCreate(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/consumables/create')
                ->type('name', 'Blade')
                ->type('sku', 'FX9012')
                ->type('barcode', '901211')

                ->select('category')

                ->type('price', '8900')
                ->type('description', 'This is a demo description')

                ->click('saveButton')

                ->assertSee('Consumable item');
        });
    }

}
