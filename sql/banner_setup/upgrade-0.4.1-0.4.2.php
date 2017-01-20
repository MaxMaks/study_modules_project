<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection();
/* Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1

#0 /var/www/d/dev-maksk/web/app/code/core/Mage/Core/Model/Resource/Setup.php(644): Mage::exception('Mage_Core', 'Error in file: ...')
*/

$table->addColumn($installer->getTable('banner/banner'),'created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array());
$table->addColumn($installer->getTable('banner/banner'),'updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array());




$installer->endSetup();