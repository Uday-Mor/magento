<?php
class Ccc_Practice_Block_Adminhtml_One extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'practice';
        $this->_controller = 'adminhtml_one';


        parent::__construct();
        $this->_updateButton('add', 'label', $this->__('View Query'));
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/viewone');
    }
}