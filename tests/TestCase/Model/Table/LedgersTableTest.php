<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LedgersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LedgersTable Test Case
 */
class LedgersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LedgersTable
     */
    public $Ledgers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ledgers',
        'app.ledger_accounts',
        'app.jain_thela_admins',
        'app.vendors',
        'app.franchises',
        'app.item_categories',
        'app.items',
        'app.units',
        'app.item_ledgers',
        'app.drivers',
        'app.cities',
        'app.warehouses',
        'app.grns',
        'app.grn_details',
        'app.walkin_sales',
        'app.ledgers_accounts',
        'app.walkin_sale_details',
        'app.transfer_inventory_vouchers',
        'app.transfer_inventory_voucher_rows',
        'app.carts',
        'app.customers',
        'app.referral_details',
        'app.from_customer',
        'app.jain_cash_points',
        'app.orders',
        'app.promo_codes',
        'app.order_details',
        'app.wallets',
        'app.plans',
        'app.banners',
        'app.auto_order_nos',
        'app.customer_addresses',
        'app.cancel_reasons',
        'app.cash_backs',
        'app.users',
        'app.term_conditions',
        'app.company_details',
        'app.supplier_areas',
        'app.api_versions',
        'app.combo_offer_details',
        'app.combo_offers',
        'app.delivery_times',
        'app.cancel_reason',
        'app.order_details',
        'app.franchise_item_categories',
        'app.companies',
        'app.account_groups',
        'app.purchase_bookings',
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
        $config = TableRegistry::exists('Ledgers') ? [] : ['className' => LedgersTable::class];
        $this->Ledgers = TableRegistry::get('Ledgers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ledgers);

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
