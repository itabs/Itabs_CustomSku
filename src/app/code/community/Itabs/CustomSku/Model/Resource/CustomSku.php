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
 * Class Itabs_CustomSku_Model_Resource_CustomSku
 */
class Itabs_CustomSku_Model_Resource_CustomSku
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Init the main table and primary key field
     */
    protected function _construct()
    {
        $this->_init('itabs_customsku/customsku', 'id');
    }
}
