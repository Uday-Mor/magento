<?php 
class Uday_Uday_Model_Resource_Uday extends Mage_Eav_Model_Entity_Abstract
{
	const ENTITY = 'uday';
	public function __construct()
	{
		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');
	   parent::__construct();
    }
}