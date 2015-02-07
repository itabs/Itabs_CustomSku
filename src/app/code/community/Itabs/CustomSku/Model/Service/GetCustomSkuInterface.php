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
 * Interface Itabs_CustomSku_Model_Service_GetCustomSkuInterface
 */
interface Itabs_CustomSku_Model_Service_GetCustomSkuInterface
{
    /**
     * Fetch the custom SKU for the given SKU and customer
     *
     * @param  string                       $sku      SKU
     * @param  Mage_Customer_Model_Customer $customer Customer
     * @return string|null
     */
    public function execute($sku, Mage_Customer_Model_Customer $customer);

    /**
     * Set the value if caching of the results is enabled
     *
     * @param bool $isCacheEnabled Flag
     */
    public function setIsCacheEnabled($isCacheEnabled);
}
