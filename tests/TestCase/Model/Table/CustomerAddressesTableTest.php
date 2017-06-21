<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerAddressesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerAddressesTable Test Case
 */
class CustomerAddressesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerAddressesTable
     */
    public $CustomerAddresses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_addresses',
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
        'app.item_ledgers',
        'app.drivers',
        'app.warehouses',
        'app.banners',
        'app.order_details',
        'app.wallets',
        'app.plans'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerAddresses') ? [] : ['className' => CustomerAddressesTable::class];
        $this->CustomerAddresses = TableRegistry::get('CustomerAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerAddresses);

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
