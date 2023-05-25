<?php 

$this->startSetup();

$this->addEntityType(Uday_Uday_Model_Resource_Uday::ENTITY,[
	'entity_model'=>'uday/uday',
	'attribute_model'=>'uday/attribute',
	'table'=>'uday/uday',
	'increment_per_store'=> '0',
	'additional_attribute_table' => 'uday/eav_attribute',
	'entity_attribute_collection' => 'uday/uday_attribute_collection'
]);

$this->createEntityTables('uday');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('uday', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'uday'");

$this->endSetup();