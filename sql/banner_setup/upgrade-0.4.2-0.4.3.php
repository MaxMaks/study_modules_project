<?php

$installer = $this;

$installer->startSetup();


$installer->run("ALTER TABLE ".$installer->getTable('banner/banner')." CHANGE `id` `banner_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT");
$installer->run("ALTER TABLE ".$installer->getTable('banner/banner')." CHANGE `tittle` `title` VARCHAR(255) NOT NULL");


$installer->endSetup();
