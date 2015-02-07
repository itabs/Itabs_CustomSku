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
 * Class Itabs_CustomSku_Model_Service_GetCustomSku
 */
class Itabs_CustomSku_Model_Service_GetCustomSku
    implements Itabs_CustomSku_Model_Service_GetCustomSkuInterface
{
    /**
     * @var array
     */
    protected static $_cache = array();

    /**
     * @var bool
     */
    protected $_isCacheEnabled = false;

    /**
     * Fetch the custom SKU for the given SKU and customer
     *
     * @param  string                       $sku      SKU
     * @param  Mage_Customer_Model_Customer $customer Customer
     * @return string|null
     */
    public function execute($sku, Mage_Customer_Model_Customer $customer)
    {
        $customerId = $customer->getId();
        $cacheKey = $sku . '_' . $customerId;

        // Load cached data, if applicable
        if ($this->_isCacheEnabled && isset(self::$_cache[$cacheKey])) {
            return self::$_cache[$cacheKey];
        }

        /* @var $collection Itabs_CustomSku_Model_Resource_CustomSku_Collection */
        $collection = Mage::getResourceModel('itabs_customsku/customSku_collection');
        $collection->addCustomerFilter($customerId);
        $collection->addFieldToFilter('sku', $sku);
        $collection->getSelect()->limit(1);

        $model = $collection->getFirstItem();
        if (!$model || !$model->getId()) {
            return null;
        }

        $customSku = $model->getData('custom_sku');
        self::$_cache[$cacheKey] = $customSku;

        return $customSku;
    }

    /**
     * Set the value if caching of the results is enabled
     *
     * @param bool $isCacheEnabled Flag
     */
    public function setIsCacheEnabled($isCacheEnabled)
    {
        $this->_isCacheEnabled = $isCacheEnabled;
    }
}
