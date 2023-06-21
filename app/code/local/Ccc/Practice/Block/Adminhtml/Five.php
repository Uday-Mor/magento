<?php
class Ccc_Practice_Block_Adminhtml_Five extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'practice';
        $this->_controller = 'adminhtml_five';


        parent::__construct();
        $this->_updateButton('add', 'label', $this->__('View Query'));
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/viewfive');
    }
}