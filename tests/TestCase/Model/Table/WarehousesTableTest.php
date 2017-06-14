<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WarehousesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WarehousesTable Test Case
 */
class WarehousesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WarehousesTable
     */
    public $Warehouses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.warehouses',
        'app.jain_thela_admins',
        'app.item_ledgers',
        'app.drivers',
        'app.cities',
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
        $config = TableRegistry::exists('Warehouses') ? [] : ['className' => WarehousesTable::class];
        $this->Warehouses = TableRegistry::get('Warehouses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Warehouses);

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
