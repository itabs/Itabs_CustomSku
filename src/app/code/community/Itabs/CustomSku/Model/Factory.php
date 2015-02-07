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
 * Class Itabs_CustomSku_Model_Factory
 */
class Itabs_CustomSku_Model_Factory
{
    /**
     * Retrieve the service
     *
     * @return Itabs_CustomSku_Model_Service_GetCustomSkuInterface
     */
    public function getServiceGetCustomSku()
    {
        /* @var $service Itabs_CustomSku_Model_Service_GetCustomSkuInterface */
        $service = Mage::getModel('itabs_customsku/service_getCustomSku');
        $service->setIsCacheEnabled(true);

        return $service;
    }

    /**
     * Retrieve the service
     *
     * @return Itabs_CustomSku_Model_Service_CheckCustomSkuExistsInterface
     */
    public function getServiceCheckCustomSkuExits()
    {
        /** @var $service Itabs_CustomSku_Model_Service_CheckCustomSkuExistsInterface */
        $service = Mage::getModel('itabs_customsku/service_checkCustomSkuExists');

        return $service;
    }
}
