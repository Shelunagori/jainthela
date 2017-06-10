<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorsTable Test Case
 */
class VendorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorsTable
     */
    public $Vendors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendors',
        'app.franchises',
        'app.item_categories',
        'app.items',
        'app.franchise_item_categories',
        'app.cities',
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
        $config = TableRegistry::exists('Vendors') ? [] : ['className' => VendorsTable::class];
        $this->Vendors = TableRegistry::get('Vendors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vendors);

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
