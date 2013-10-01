<?php

class BusinessKing_OutofStockSubscription_Block_Adminhtml_Subcriber extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
    {
        $this->_blockGroup = 'outofstocksubscription';
        $this->_controller = 'adminhtml_subcriber';
        $this->_headerText = Mage::helper('outofstocksubscription')->__('Out of Stock Subscribers');
        parent::__construct();
        $this->_removeButton('add');
    }
}