<?php
$installer = $this;

$installer->startSetup();
$installer->run("

ALTER TABLE `brand` ADD `banner_image` VARCHAR(255) NOT NULL AFTER `update_time`, ADD `status` TINYINT(2) NOT NULL AFTER `banner_image`, ADD `sort_order` INT NOT NULL DEFAULT '0' AFTER `status`;
    
");