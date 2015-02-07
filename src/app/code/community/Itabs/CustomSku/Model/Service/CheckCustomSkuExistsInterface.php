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
 * Interface Itabs_CustomSku_Model_Service_CustomSkuInterface
 */
interface Itabs_CustomSku_Model_Service_CheckCustomSkuExistsInterface
{
    /**
     * Checks if the customer already has this custom sku
     *
     * @param  string                       $customSku Custom SKU
     * @param  Mage_Customer_Model_Customer $customer  Customer
     * @return bool
     */
    public function execute($customSku, Mage_Customer_Model_Customer $customer);

    /**
     * Set the model id which should be excluded from the check
     *
     * @param int $excludeId Excluded Model ID
     */
    public function setExcludeId($excludeId);
}
