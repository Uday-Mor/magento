<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('catalog_product_entity')}
  ADD `brand_id` int(10);

");

$installer->endSetup();
