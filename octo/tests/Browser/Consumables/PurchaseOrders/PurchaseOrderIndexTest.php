<?php

namespace Tests\Browser\Consumables\PurchaseOrders;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class PurchaseOrderIndexTest extends DuskTestCase
{
    public function testPurchaseOrdersPageLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/purchase-orders')
                ->assertTitleContains('Consumables purchase orders')
                ->assertSee('Consumables purchase orders');
        });
    }

    public function checkPOCreateClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/purchase-orders')
                ->mouseover('hover')
                ->clickLink('Create purchase order')
                ->assertSee('Create purchase order item item')
                ->assertPathIs('/consumables/purchase-orders/create');
        });
    }

    public function checkRefreshClick(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(config('octo.testUser')))
                ->visit('/consumables/purchase-orders')
                ->mouseover('hover')
                ->clickLink('Refresh')
                ->assertSee('Consumables purchase orders')
                ->assertPathIs('/consumables/purchase-orders');
        });
    }

}
