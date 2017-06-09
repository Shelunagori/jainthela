<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FranchiseItemCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FranchiseItemCategoriesTable Test Case
 */
class FranchiseItemCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FranchiseItemCategoriesTable
     */
    public $FranchiseItemCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.franchise_item_categories',
        'app.franchises',
        'app.cities',
        'app.companies',
        'app.users',
        'app.item_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FranchiseItemCategories') ? [] : ['className' => FranchiseItemCategoriesTable::class];
        $this->FranchiseItemCategories = TableRegistry::get('FranchiseItemCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FranchiseItemCategories);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
