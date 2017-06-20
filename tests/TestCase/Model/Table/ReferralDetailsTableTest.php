<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReferralDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReferralDetailsTable Test Case
 */
class ReferralDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReferralDetailsTable
     */
    public $ReferralDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.referral_details',
        'app.from_customers',
        'app.to_customers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReferralDetails') ? [] : ['className' => ReferralDetailsTable::class];
        $this->ReferralDetails = TableRegistry::get('ReferralDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReferralDetails);

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
