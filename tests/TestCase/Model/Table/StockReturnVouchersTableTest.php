<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockReturnVouchersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockReturnVouchersTable Test Case
 */
class StockReturnVouchersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StockReturnVouchersTable
     */
    public $StockReturnVouchers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stock_return_vouchers',
        'app.drivers',
        'app.cities',
        'app.driver_locations',
        'app.jain_thela_admins',
        'app.item_ledgers',
        'app.items',
        'app.item_categories',
        'app.banners',
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
        'app.auto_order_nos',
        'app.customer_addresses',
        'app.cancel_reasons',
        'app.cash_backs',
        'app.users',
        'app.term_conditions',
        'app.company_details',
        'app.supplier_areas',
        'app.combo_offer_details',
        'app.combo_offers',
        'app.warehouses',
        'app.grns',
        'app.vendors',
        'app.franchises',
        'app.franchise_item_categories',
        'app.companies',
        'app.ledger_accounts',
        'app.account_groups',
        'app.account_categories',
        'app.grn_details',
        'app.walkin_sales',
        'app.ledgers',
        'app.purchase_bookings',
        'app.purchase_booking_details',
        'app.ledgers_accounts',
        'app.walkin_sale_details',
        'app.purchase_outwards',
        'app.purchase_outward_details',
        'app.delivery_times',
        'app.cancel_reason',
        'app.order_details',
        'app.units',
        'app.transfer_inventory_vouchers',
        'app.transfer_inventory_voucher_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StockReturnVouchers') ? [] : ['className' => StockReturnVouchersTable::class];
        $this->StockReturnVouchers = TableRegistry::get('StockReturnVouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StockReturnVouchers);

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
