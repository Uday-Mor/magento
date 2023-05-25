<?php
class UM_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Gender extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return '$label';
    }
}