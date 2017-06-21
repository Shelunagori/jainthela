<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PushNotificationCustomersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PushNotificationCustomersTable Test Case
 */
class PushNotificationCustomersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PushNotificationCustomersTable
     */
    public $PushNotificationCustomers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.push_notification_customers',
        'app.push_notifications',
        'app.customers',
        'app.referral_details',
        'app.from_customer',
        'app.jain_cash_points',
        'app.orders',
        'app.jain_thela_admins',
        'app.promo_codes',
        'app.item_categories',
        'app.items',
        'app.units',
        'app.franchises',
        'app.franchise_item_categories',
        'app.cities',
        'app.companies',
        'app.users',
        'app.term_conditions',
        'app.company_details',
        'app.order_details',
        'app.wallets',
        'app.plans',
        'app.deep_links'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PushNotificationCustomers') ? [] : ['className' => PushNotificationCustomersTable::class];
        $this->PushNotificationCustomers = TableRegistry::get('PushNotificationCustomers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PushNotificationCustomers);

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
