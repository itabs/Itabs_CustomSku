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
 * Class Itabs_CustomSku_Block_Info
 *
 * @method Mage_Sales_Model_Quote_Item|Mage_Sales_Model_Order_Item getItem()
 */
class Itabs_CustomSku_Block_Info extends Mage_Core_Block_Template
{
    /**
     * Retrieve the custom sku
     *
     * @return string
     */
    public function getCustomSku()
    {
        if ($this->getParentBlock() && $this->getParentBlock()->getItem()) {
            return $this->getParentBlock()->getItem()->getData('custom_sku');
        }

        return null;
    }
}
