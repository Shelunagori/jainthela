<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransferInventoryVouchersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransferInventoryVouchersTable Test Case
 */
class TransferInventoryVouchersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransferInventoryVouchersTable
     */
    public $TransferInventoryVouchers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transfer_inventory_vouchers',
        'app.items',
        'app.item_categories',
        'app.banners',
        'app.carts',
        'app.customers',
        'app.referral_details',
        'app.from_customer',
        'app.jain_cash_points',
        'app.orders',
        'app.jain_thela_admins',
        'app.promo_codes',
        'app.order_details',
        'app.wallets',
        'app.plans',
        'app.customer_addresses',
        'app.delivery_times',
        'app.units',
        'app.franchises',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.term_conditions',
        'app.company_details',
        'app.supplier_areas',
        'app.item_ledgers',
        'app.drivers',
        'app.warehouses',
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
        $config = TableRegistry::exists('TransferInventoryVouchers') ? [] : ['className' => TransferInventoryVouchersTable::class];
        $this->TransferInventoryVouchers = TableRegistry::get('TransferInventoryVouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransferInventoryVouchers);

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
