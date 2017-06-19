<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseOutwardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseOutwardsTable Test Case
 */
class PurchaseOutwardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseOutwardsTable
     */
    public $PurchaseOutwards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_outwards',
        'app.vendors',
        'app.franchises',
        'app.item_categories',
        'app.items',
        'app.units',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.ledger_accounts',
        'app.jain_thela_admins',
        'app.account_groups',
        'app.purchase_outward_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PurchaseOutwards') ? [] : ['className' => PurchaseOutwardsTable::class];
        $this->PurchaseOutwards = TableRegistry::get('PurchaseOutwards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseOutwards);

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
