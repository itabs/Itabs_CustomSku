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
 * Class Itabs_CustomSku_Test_Model_Observer
 *
 * @group Itabs_CustomSku
 */
class Itabs_CustomSku_Test_Model_Observer extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Itabs_CustomSku_Model_Observer
     */
    protected $_model;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_model = Mage::getModel('itabs_customsku/observer');
    }

    /**
     * @test
     * @loadFixture ~Itabs_CustomSku/customer
     * @loadFixture ~Itabs_CustomSku/customsku
     * @doNotIndexAll
     */
    public function setCustomSkuOnQuoteItem()
    {
        $product = new Varien_Object();
        $product->setData('sku', 'ABC');

        $customer = Mage::getModel('customer/customer')->load(1);
        $quote = new Varien_Object();
        $quote->setData('customer', $customer);

        $quoteItem = new Varien_Object();
        $quoteItem->setData('quote', $quote);


        $event = new Varien_Event();
        $event->setData('product', $product);
        $event->setData('quote_item', $quoteItem);

        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);


        $this->_model->setCustomSkuOnQuoteItem($observer);

        $this->assertEquals('123456', $observer->getEvent()->getQuoteItem()->getData('custom_sku'));
    }
}
