<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DriverLocationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DriverLocationsTable Test Case
 */
class DriverLocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DriverLocationsTable
     */
    public $DriverLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.driver_locations',
        'app.drivers',
        'app.cities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DriverLocations') ? [] : ['className' => DriverLocationsTable::class];
        $this->DriverLocations = TableRegistry::get('DriverLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DriverLocations);

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
