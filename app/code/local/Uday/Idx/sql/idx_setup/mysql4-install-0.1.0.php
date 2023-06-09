<?php

$installer = $this;

$installer->startSetup();

$installer->run("

    CREATE TABLE IF NOT EXISTS {$this->getTable('import_product_idx')} (
        `index` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `sku` varchar(255) NOT NULL,
        `price` decimal(10,2) NOT NULL,
        `cost` decimal(10,2) NOT NULL,
        `quantity` int(11) NOT NULL,
        `brand` varchar(255) NOT NULL,
        `brand_id` int(11) NOT NULL,
        `collection` varchar(255) NOT NULL,
        `collection_id` int(11) NOT NULL,
        `description` varchar(255) NOT NULL,
        `status` tinyint(2) NOT NULL DEFAULT 2,
        PRIMARY KEY (`index`),
        UNIQUE KEY(`sku`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    ALTER TABLE `import_product_idx` CHANGE `product_id` `product_id` INT(11) NULL DEFAULT NULL;
    ALTER TABLE `import_product_idx` CHANGE `brand_id` `brand_id` INT(11) NULL DEFAULT NULL;
    ALTER TABLE `import_product_idx` CHANGE `collection_id` `collection_id` INT(11) NULL DEFAULT NULL;

    ");

$installer->endSetup();




