<?php
/**
 * 
 */
class Uday_Uday_Model_Uday extends Mage_Core_Model_Abstract
{
    const ENTITY = 'uday';

    protected $_attributes;
    
	protected function _construct()
    {  
        $this->_init('uday/uday');
    }

   public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;
        return $this;
    }
}