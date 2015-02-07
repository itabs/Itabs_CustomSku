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
 * Class Itabs_CustomSku_Test_Model_Service_CheckCustomSkuExists
 *
 * @group Itabs_CustomSku
 */
class Itabs_CustomSku_Test_Model_Service_CheckCustomSkuExists extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Itabs_CustomSku_Model_Service_CheckCustomSkuExistsInterface
     */
    protected $_model;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_model = Mage::getModel('itabs_customsku/service_checkCustomSkuExists');
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

        $this->assertTrue($this->_model->execute('123456', $customer));

        $this->_model->setExcludeId(1);
        $this->assertFalse($this->_model->execute('123456', $customer));
    }
}
