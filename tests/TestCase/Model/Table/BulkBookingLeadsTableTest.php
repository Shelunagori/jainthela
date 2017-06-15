<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BulkBookingLeadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BulkBookingLeadsTable Test Case
 */
class BulkBookingLeadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BulkBookingLeadsTable
     */
    public $BulkBookingLeads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bulk_booking_leads',
        'app.jain_thela_admins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BulkBookingLeads') ? [] : ['className' => BulkBookingLeadsTable::class];
        $this->BulkBookingLeads = TableRegistry::get('BulkBookingLeads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BulkBookingLeads);

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
