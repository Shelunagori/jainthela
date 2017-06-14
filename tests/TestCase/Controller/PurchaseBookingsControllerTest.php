<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PurchaseBookingsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PurchaseBookingsController Test Case
 */
class PurchaseBookingsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_bookings',
        'app.grns',
        'app.vendors',
        'app.franchises',
        'app.item_categories',
        'app.items',
        'app.units',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.grn_details',
        'app.item_ledgers',
        'app.jain_thela_admins',
        'app.drivers',
        'app.warehouses',
        'app.purchase_booking_details'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
