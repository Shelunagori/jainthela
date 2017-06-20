<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComboOfferDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComboOfferDetailsTable Test Case
 */
class ComboOfferDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ComboOfferDetailsTable
     */
    public $ComboOfferDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.combo_offer_details',
        'app.combo_offers',
        'app.items',
        'app.item_categories',
        'app.units',
        'app.franchises',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.term_conditions',
        'app.company_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ComboOfferDetails') ? [] : ['className' => ComboOfferDetailsTable::class];
        $this->ComboOfferDetails = TableRegistry::get('ComboOfferDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ComboOfferDetails);

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
