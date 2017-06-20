<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseOutwardDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseOutwardDetailsTable Test Case
 */
class PurchaseOutwardDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseOutwardDetailsTable
     */
    public $PurchaseOutwardDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_outward_details',
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
        $config = TableRegistry::exists('PurchaseOutwardDetails') ? [] : ['className' => PurchaseOutwardDetailsTable::class];
        $this->PurchaseOutwardDetails = TableRegistry::get('PurchaseOutwardDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseOutwardDetails);

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
