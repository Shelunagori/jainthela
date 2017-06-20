<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeepLinksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeepLinksTable Test Case
 */
class DeepLinksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DeepLinksTable
     */
    public $DeepLinks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('DeepLinks') ? [] : ['className' => DeepLinksTable::class];
        $this->DeepLinks = TableRegistry::get('DeepLinks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DeepLinks);

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
