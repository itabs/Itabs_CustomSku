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
 * Class Itabs_CustomSku_Model_Observer
 */
class Itabs_CustomSku_Model_Observer
{
    /**
     * Set the custom sku on the quote item
     * Event: <sales_quote_item_set_product>
     *
     * @param Varien_Event_Observer $observer Observer
     */
    public function setCustomSkuOnQuoteItem(Varien_Event_Observer $observer)
    {
        /* @var Mage_Sales_Model_Quote_Item $quoteItem */
        $quoteItem = $observer->getEvent()->getQuoteItem();
        /* @var $product Mage_Catalog_Model_Product */
        $product = $observer->getEvent()->getProduct();

        $service = $this->getFactory()->getServiceGetCustomSku();

        // Fetch custom sku for customer and add to quote item
        $customSku = $service->execute($product->getSku(), $quoteItem->getQuote()->getCustomer());
        if (null !== $customSku) {
            $quoteItem->setData('custom_sku', $customSku);
        }
    }

    public function adminhtmlBlockHtmlBefore(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();

    }

    /**
     * Retrieve the factory class
     *
     * @return Itabs_CustomSku_Model_Factory
     */
    public function getFactory()
    {
        return Mage::getModel('itabs_customsku/factory');
    }
}
