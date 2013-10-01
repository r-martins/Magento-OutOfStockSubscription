<?php
/**
 * @category   BusinessKing
 * @package    BusinessKing_OutofStockSubscription
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('outofstocksubscription_info')}`;
CREATE TABLE `{$this->getTable('outofstocksubscription_info')}` (
  `id` INTEGER unsigned NOT NULL auto_increment,
  `product_id` INTEGER unsigned NOT NULL,
  `email` TEXT NOT NULL default '',
  `is_active` ENUM('0','1') NOT NULL DEFAULT '0',
  `date` DATETIME default '0000-00-00 00:00:00',  
  PRIMARY KEY  (`id`),
  KEY `FK_OUTOFSTOCKSUBSCRIPTION_PRODUCT_ID` (`product_id`),
  CONSTRAINT `FK_OUTOFSTOCKSUBSCRIPTION_PRODUCT_ID` FOREIGN KEY (`product_id`) REFERENCES `{$this->getTable('catalog_product_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

");

$installer->endSetup();
