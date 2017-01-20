<?php


$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('banner/banner'));
$table->addColumn(
    'id',
    Varien_Db_Ddl_Table::TYPE_INTEGER, 
    10, 
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$table->addColumn(
    'tittle', 
    Varien_Db_Ddl_Table::TYPE_VARCHAR, 
    255, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'url', 
    Varien_Db_Ddl_Table::TYPE_VARCHAR, 
    255, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'sort', 
    Varien_Db_Ddl_Table::TYPE_INTEGER, 
    10, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'image', 
    Varien_Db_Ddl_Table::TYPE_VARCHAR, 
    255, 
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'status', 
    Varien_Db_Ddl_Table::TYPE_BOOLEAN, 
    null, 
    array(
        'nullable' => false,
    )
);

/**
 * A couple of important lines that are often missed.
 */
$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');

/**
 * Create the table!
 */
$installer->getConnection()->createTable($table);

$installer->endSetup();