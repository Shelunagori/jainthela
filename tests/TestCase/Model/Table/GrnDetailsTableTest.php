<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrnDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrnDetailsTable Test Case
 */
class GrnDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GrnDetailsTable
     */
    public $GrnDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.grn_details',
        'app.items',
        'app.item_categories',
        'app.units',
        'app.franchises',
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
        $config = TableRegistry::exists('GrnDetails') ? [] : ['className' => GrnDetailsTable::class];
        $this->GrnDetails = TableRegistry::get('GrnDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GrnDetails);

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
