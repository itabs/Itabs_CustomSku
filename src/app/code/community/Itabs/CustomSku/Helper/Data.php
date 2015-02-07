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
 * Class Itabs_CustomSku_Helper_Data
 */
class Itabs_CustomSku_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Retrieve the factory class
     *
     * @return Itabs_CustomSku_Model_Factory
     */
    public function getFactory()
    {
        return Mage::getModel('itabs_customsku/factory');
    }

    /**
     * Retrieve the customer session
     *
     * @return Mage_Customer_Model_Session
     */
    public function getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Retrieve the current customer
     *
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return $this->getSession()->getCustomer();
    }

    /**
     * Retrieve the current customer id
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getCustomer()->getId();
    }

    /**
     * Check if the current customer id matches with the customer id of the model
     *
     * @param  Itabs_CustomSku_Model_CustomSku $model Model
     * @return bool
     */
    public function hasCorrectCustomerId($model)
    {
        if ($model->getData('customer_id') == $this->getCustomerId()) {
            return true;
        }

        return false;
    }
}
