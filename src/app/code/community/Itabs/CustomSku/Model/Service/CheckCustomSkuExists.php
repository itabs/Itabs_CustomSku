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
 * Class Itabs_CustomSku_Model_Service_Sku
 */
class Itabs_CustomSku_Model_Service_CheckCustomSkuExists
    implements Itabs_CustomSku_Model_Service_CheckCustomSkuExistsInterface
{
    /**
     * @var null|int
     */
    protected $_excludeId = null;

    /**
     * Checks if the customer already has this custom sku
     *
     * @param  string                       $customSku Custom SKU
     * @param  Mage_Customer_Model_Customer $customer  Customer
     * @return bool
     */
    public function execute($customSku, Mage_Customer_Model_Customer $customer)
    {
        /* @var $collection Itabs_CustomSku_Model_Resource_CustomSku_Collection */
        $collection = Mage::getResourceModel('itabs_customsku/customSku_collection');
        $collection->addCustomerFilter($customer);
        $collection->addFieldToFilter('custom_sku', $customSku);

        // Exclude the given model id
        if (null !== $this->_excludeId) {
            $collection->addFieldToFilter('id', array('neq' => $this->_excludeId));
        }

        // Check if there is a result
        if ($collection->count()) {
            return true;
        }

        return false;
    }

    /**
     * Set the model id which should be excluded from the check
     *
     * @param int $excludeId Excluded Model ID
     */
    public function setExcludeId($excludeId)
    {
        $this->_excludeId = $excludeId;
    }
}
