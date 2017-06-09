<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FranchisesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FranchisesTable Test Case
 */
class FranchisesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FranchisesTable
     */
    public $Franchises;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.franchises',
        'app.cities',
        'app.franchise_item_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Franchises') ? [] : ['className' => FranchisesTable::class];
        $this->Franchises = TableRegistry::get('Franchises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Franchises);

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
