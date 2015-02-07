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
 * Class Itabs_CustomSku_Block_Customer_List
 */
class Itabs_CustomSku_Block_Customer_List extends Mage_Core_Block_Template
{
    /**
     * @var Itabs_CustomSku_Model_Resource_CustomSku_Collection
     */
    protected $_collection = null;

    /**
     * Retrieve the custom sku collection
     *
     * @return Itabs_CustomSku_Model_Resource_CustomSku_Collection
     */
    public function getCollection()
    {
        if (null === $this->_collection) {
            $customer = Mage::helper('customer')->getCustomer();

            /* @var $collection Itabs_CustomSku_Model_Resource_CustomSku_Collection */
            $collection = Mage::getResourceModel('itabs_customsku/customSku_collection');
            $collection->addCustomerFilter($customer);
            $collection->setOrder('sku');

            $this->_collection = $collection;
        }

        return $this->_collection;
    }

    /**
     * Retrieve the delete url for the given item
     *
     * @param  Itabs_CustomSku_Model_CustomSku $item Item
     * @return string
     */
    public function getDeleteUrl($item)
    {
        return $this->getUrl('*/*/delete', array('id' => $item->getId()));
    }

    /**
     * Retrieve url for add product to cart or return url for product view if product has required options
     *
     * @param  string $sku        Sku
     * @param  array  $additional Additional route params
     * @return string
     */
    public function getAddToCartUrl($sku, $additional = array())
    {
        /* @var $product Mage_Catalog_Model_Product */
        $product = Mage::getModel('catalog/product')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->loadByAttribute('sku', $sku);

        // Check if product exists
        if (!$product || !$product->getId()) {
            return false;
        }

        // If product has no required options, return direct add to cart url
        if (!$product->getTypeInstance(true)->hasRequiredOptions($product)) {
            return $this->helper('checkout/cart')->getAddUrl($product, $additional);
        }

        // If product has required options, return product url
        if (!isset($additional['_escape'])) {
            $additional['_escape'] = true;
        }
        if (!isset($additional['_query'])) {
            $additional['_query'] = array();
        }

        return $this->getProductUrl($product, $additional);
    }

    /**
     * Retrieve Product URL using UrlDataObject
     *
     * @param  Mage_Catalog_Model_Product $product    Product
     * @param  array                      $additional Additional route params
     * @return string
     */
    public function getProductUrl($product, $additional = array())
    {
        if ($this->hasProductUrl($product)) {
            if (!isset($additional['_escape'])) {
                $additional['_escape'] = true;
            }

            return $product->getUrlModel()->getUrl($product, $additional);
        }

        return false;
    }

    /**
     * Check Product has URL
     *
     * @param  Mage_Catalog_Model_Product $product Product
     * @return bool
     */
    public function hasProductUrl($product)
    {
        if ($product->getVisibleInSiteVisibilities()) {
            return true;
        }

        return false;
    }
}
