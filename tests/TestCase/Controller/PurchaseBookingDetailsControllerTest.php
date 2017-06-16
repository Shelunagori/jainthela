<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PurchaseBookingDetailsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PurchaseBookingDetailsController Test Case
 */
class PurchaseBookingDetailsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_booking_details',
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
        'app.jain_thela_admins',
        'app.grn_details',
        'app.item_ledgers',
        'app.drivers',
        'app.warehouses'
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
