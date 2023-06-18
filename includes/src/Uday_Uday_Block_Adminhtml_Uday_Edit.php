<?php
class Uday_Uday_Block_Adminhtml_Uday_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'uday';
        $this->_controller = 'adminhtml_uday';
        $this->_headerText = 'Add Uday';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}