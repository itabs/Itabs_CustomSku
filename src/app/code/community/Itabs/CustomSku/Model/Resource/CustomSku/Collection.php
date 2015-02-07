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
 * Class Itabs_CustomSku_Model_Resource_CustomSku_Collection
 */
class Itabs_CustomSku_Model_Resource_CustomSku_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Init the model
     */
    protected function _construct()
    {
        $this->_init('itabs_customsku/customSku');
    }

    /**
     * Add customer filter
     *
     * @param  int|Mage_Customer_Model_Customer $customer Customer
     * @return Itabs_CustomSku_Model_Resource_CustomSku_Collection
     */
    public function addCustomerFilter($customer)
    {
        if ($customer instanceof Mage_Customer_Model_Customer) {
            $customer = $customer->getId();
        }

        $this->getSelect()->where('customer_id = ?', $customer);

        return $this;
    }
}
