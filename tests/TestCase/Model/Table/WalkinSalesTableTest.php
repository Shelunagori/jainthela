<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WalkinSalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WalkinSalesTable Test Case
 */
class WalkinSalesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WalkinSalesTable
     */
    public $WalkinSales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.users',
        'app.walkin_sale_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WalkinSales') ? [] : ['className' => WalkinSalesTable::class];
        $this->WalkinSales = TableRegistry::get('WalkinSales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WalkinSales);

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
