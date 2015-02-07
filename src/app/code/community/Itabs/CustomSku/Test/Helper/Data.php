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
 * Class Itabs_CustomSku_Test_Helper_Data
 *
 * @group Itabs_CustomSku
 */
class Itabs_CustomSku_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case_Controller
{
    /**
     * @var Itabs_CustomSku_Helper_Data
     */
    protected $_helper;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_helper = Mage::helper('itabs_customsku');
    }

    /**
     * @test
     */
    public function getFactory()
    {
        $this->assertInstanceOf('Itabs_CustomSku_Model_Factory', $this->_helper->getFactory());
    }

    /**
     * @test
     */
    public function getSession()
    {
        $this->assertInstanceOf('Mage_Customer_Model_Session', $this->_helper->getSession());
    }

    /**
     * @test
     */
    public function getCustomer()
    {
        $this->assertInstanceOf('Mage_Customer_Model_Customer', $this->_helper->getCustomer());
    }

    /**
     * @test
     * @singleton customer/session
     * @loadFixture ~Itabs_CustomSku/customer
     * @doNotIndexAll
     */
    public function getCustomerId()
    {
        $this->setCurrentStore(Mage_Core_Model_Store::DEFAULT_CODE);
        $customer = Mage::getModel('customer/customer')->load(1);

        $customerSessionMock = $this->getModelMock('customer/session', array('getCustomer'));
        $customerSessionMock->expects($this->any())
            ->method('getCustomer')
            ->will($this->returnValue($customer));
        $customerSessionMock->setId(1);
        $this->replaceByMock('singleton', 'customer/session', $customerSessionMock);

        $this->assertEquals(1, $this->_helper->getCustomerId());
    }

    /**
     * @test
     * @singleton customer/session
     * @loadFixture ~Itabs_CustomSku/customer
     * @doNotIndexAll
     */
    public function hasCorrectCustomerId()
    {
        $this->setCurrentStore(Mage_Core_Model_Store::DEFAULT_CODE);
        $customer = Mage::getModel('customer/customer')->load(1);

        $customerSessionMock = $this->getModelMock('customer/session', array('getCustomer'));
        $customerSessionMock->expects($this->any())
            ->method('getCustomer')
            ->will($this->returnValue($customer));
        $customerSessionMock->setId(1);
        $this->replaceByMock('singleton', 'customer/session', $customerSessionMock);

        $model = new Varien_Object();

        $model->setData('customer_id', 2);
        $this->assertFalse($this->_helper->hasCorrectCustomerId($model));

        $model->setData('customer_id', 1);
        $this->assertTrue($this->_helper->hasCorrectCustomerId($model));
    }
}
