<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountCategoriesTable Test Case
 */
class AccountCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountCategoriesTable
     */
    public $AccountCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.account_categories',
        'app.account_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountCategories') ? [] : ['className' => AccountCategoriesTable::class];
        $this->AccountCategories = TableRegistry::get('AccountCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountCategories);

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
}
