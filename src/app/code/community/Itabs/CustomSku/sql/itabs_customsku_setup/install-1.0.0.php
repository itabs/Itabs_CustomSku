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
 * Setup script
 */

/* @var $installer Mage_Eav_Model_Entity_Setup */
$installer = $this;
$installer->startSetup();

// Retrieve the custom sku table name
$tableName = $installer->getTable('itabs_customsku/customsku');

// Drop table if it already exists
if ($installer->getConnection()->isTableExists($tableName)) {
    $installer->getConnection()->dropTable($tableName);
}

// Add new table
$table = $installer->getConnection()->newTable($tableName)
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'primary'  => true,
        'identity' => true,
        'nullable' => false,
        'unsigned' => true
    ), 'ID')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ), 'Entity Id')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Name')
    ->addColumn('custom_sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Name')
    ->addForeignKey(
        $installer->getFkName('itabs_customsku/customsku', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id',
        $installer->getTable('customer/entity'),
        'entity_id',
        Varien_Db_Adapter_Interface::FK_ACTION_CASCADE,
        Varien_Db_Adapter_Interface::FK_ACTION_CASCADE
    )
    ->addIndex(
        $installer->getIdxName(
            'itabs_customsku/customsku',
            array('customer_id', 'sku'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('customer_id', 'sku'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
    )
    ->setComment('Itabs CustomSku Table');
$installer->getConnection()->createTable($table);


// Add custom_sku field to quote items table
$quoteItemTableName = $installer->getTable('sales/quote_item');
$installer->getConnection()->addColumn(
    $quoteItemTableName,
    'custom_sku',
    array(
        'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'  => 255,
        'comment' => 'Custom SKU'
    )
);

// Add custom_sku field to order items table
$orderItemTableName = $installer->getTable('sales/order_item');
$installer->getConnection()->addColumn(
    $orderItemTableName,
    'custom_sku',
    array(
        'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'  => 255,
        'comment' => 'Custom SKU'
    )
);

$installer->endSetup();
