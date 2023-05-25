<?php 

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addKey($installer->getTable('uday/uday_decimal'),
    'UNQ_MEET_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('uday/uday_datetime'),
    'UNQ_MEET_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('uday/uday_int'),
    'UNQ_MEET_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('uday/uday_text'),
    'UNQ_MEET_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->endSetup();

?>