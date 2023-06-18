<?php 
class Uday_Uday_Block_Adminhtml_Uday extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'uday';
		$this->_controller = 'adminhtml_uday';
		$this->_headerText = $this->__('Uday Grid');
		$this->_addButtonLabel = $this->__('Add Uday');
		parent::__construct();
	}
}