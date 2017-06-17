<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JainCashPointsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JainCashPointsTable Test Case
 */
class JainCashPointsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JainCashPointsTable
     */
    public $JainCashPoints;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.jain_cash_points',
        'app.customers',
        'app.franchises',
        'app.item_categories',
        'app.items',
        'app.units',
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
        $config = TableRegistry::exists('JainCashPoints') ? [] : ['className' => JainCashPointsTable::class];
        $this->JainCashPoints = TableRegistry::get('JainCashPoints', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->JainCashPoints);

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
