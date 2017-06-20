<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComboOffersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComboOffersTable Test Case
 */
class ComboOffersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ComboOffersTable
     */
    public $ComboOffers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.combo_offers',
        'app.combo_offer_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ComboOffers') ? [] : ['className' => ComboOffersTable::class];
        $this->ComboOffers = TableRegistry::get('ComboOffers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ComboOffers);

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
