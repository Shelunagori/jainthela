<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseBookingDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseBookingDetailsTable Test Case
 */
class PurchaseBookingDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseBookingDetailsTable
     */
    public $PurchaseBookingDetails;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PurchaseBookingDetails') ? [] : ['className' => PurchaseBookingDetailsTable::class];
        $this->PurchaseBookingDetails = TableRegistry::get('PurchaseBookingDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseBookingDetails);

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
