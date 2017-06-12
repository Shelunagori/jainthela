<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemLedgersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemLedgersTable Test Case
 */
class ItemLedgersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemLedgersTable
     */
    public $ItemLedgers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_ledgers',
        'app.items',
        'app.item_categories',
        'app.units',
        'app.franchises',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.purchase_inward_vouchers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemLedgers') ? [] : ['className' => ItemLedgersTable::class];
        $this->ItemLedgers = TableRegistry::get('ItemLedgers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemLedgers);

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
