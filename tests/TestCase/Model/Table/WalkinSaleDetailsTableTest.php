<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WalkinSaleDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WalkinSaleDetailsTable Test Case
 */
class WalkinSaleDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WalkinSaleDetailsTable
     */
    public $WalkinSaleDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.walkin_sale_details',
        'app.walkin_sales',
        'app.drivers',
        'app.cities',
        'app.jain_thela_admins',
        'app.warehouses',
        'app.item_ledgers',
        'app.items',
        'app.item_categories',
        'app.units',
        'app.franchises',
        'app.franchise_item_categories',
        'app.companies',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WalkinSaleDetails') ? [] : ['className' => WalkinSaleDetailsTable::class];
        $this->WalkinSaleDetails = TableRegistry::get('WalkinSaleDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WalkinSaleDetails);

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
