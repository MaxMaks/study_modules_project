<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection();


$installer->run("ALTER TABLE ".$installer->getTable('banner/banner')." ADD INDEX sort_index(sort)");
$installer->run("ALTER TABLE ".$installer->getTable('banner/banner')." ADD INDEX status_index(status)");

$installer->endSetup();