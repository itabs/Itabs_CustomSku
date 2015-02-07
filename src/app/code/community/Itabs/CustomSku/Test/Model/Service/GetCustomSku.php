<?php
/**
 * This file is part of the Itabs_CustomSku module.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5
 *
 * @category  Itabs
 * @package   Itabs_CustomSku
 * @author    ITABS GmbH <info@itabs.de>
 * @copyright 2015 ITABS GmbH (http://www.itabs.de)
 */

/**
 * Class Itabs_CustomSku_Test_Model_Service_GetCustomSku
 *
 * @group Itabs_CustomSku
 */
class Itabs_CustomSku_Test_Model_Service_GetCustomSku extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Itabs_CustomSku_Model_Service_GetCustomSkuInterface
     */
    protected $_model;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_model = Mage::getModel('itabs_customsku/service_getCustomSku');
    }

    /**
     * @test
     * @loadFixture ~Itabs_CustomSku/customer
     * @loadFixture ~Itabs_CustomSku/customsku
     * @doNotIndexAll
     */
    public function execute()
    {
        $customer = Mage::getModel('customer/customer')->load(1);

        $this->assertNull($this->_model->execute('9999', $customer));
        $this->assertEquals('123456', $this->_model->execute('ABC', $customer));
    }
}
