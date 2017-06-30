<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TransferInventoryVoucherRowsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TransferInventoryVoucherRowsController Test Case
 */
class TransferInventoryVoucherRowsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transfer_inventory_voucher_rows',
        'app.transfer_inventory_vouchers',
        'app.items',
        'app.item_categories',
        'app.banners',
        'app.carts',
        'app.customers',
        'app.referral_details',
        'app.from_customer',
        'app.jain_cash_points',
        'app.orders',
        'app.jain_thela_admins',
        'app.promo_codes',
        'app.order_details',
        'app.wallets',
        'app.plans',
        'app.customer_addresses',
        'app.delivery_times',
        'app.franchise_item_categories',
        'app.franchises',
        'app.cities',
        'app.companies',
        'app.users',
        'app.term_conditions',
        'app.company_details',
        'app.supplier_areas',
        'app.units',
        'app.item_ledgers',
        'app.drivers',
        'app.warehouses'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
