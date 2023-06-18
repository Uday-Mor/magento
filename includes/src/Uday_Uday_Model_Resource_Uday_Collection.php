<?php
class Uday_Uday_Model_Resource_Uday_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('uday');
		parent::__construct();	
	}
}