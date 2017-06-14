<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseBookingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseBookingsTable Test Case
 */
class PurchaseBookingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseBookingsTable
     */
    public $PurchaseBookings;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PurchaseBookings') ? [] : ['className' => PurchaseBookingsTable::class];
        $this->PurchaseBookings = TableRegistry::get('PurchaseBookings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseBookings);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
