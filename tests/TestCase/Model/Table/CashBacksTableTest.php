<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashBacksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashBacksTable Test Case
 */
class CashBacksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CashBacksTable
     */
    public $CashBacks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cash_backs',
        'app.customers',
        'app.referral_details',
        'app.from_customer',
        'app.jain_cash_points',
        'app.orders',
        'app.jain_thela_admins',
        'app.promo_codes',
        'app.item_categories',
        'app.items',
        'app.units',
        'app.franchises',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.term_conditions',
        'app.company_details',
        'app.supplier_areas',
        'app.api_versions',
        'app.item_ledgers',
        'app.drivers',
        'app.warehouses',
        'app.transfer_inventory_vouchers',
        'app.transfer_inventory_voucher_rows',
        'app.carts',
        'app.customer_addresses',
        'app.delivery_times',
        'app.banners',
        'app.order_details',
        'app.wallets',
        'app.plans',
        'app.cancel_reasons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CashBacks') ? [] : ['className' => CashBacksTable::class];
        $this->CashBacks = TableRegistry::get('CashBacks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CashBacks);

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
