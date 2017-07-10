<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CancelReasonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CancelReasonsTable Test Case
 */
class CancelReasonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CancelReasonsTable
     */
    public $CancelReasons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cancel_reasons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CancelReasons') ? [] : ['className' => CancelReasonsTable::class];
        $this->CancelReasons = TableRegistry::get('CancelReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CancelReasons);

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
