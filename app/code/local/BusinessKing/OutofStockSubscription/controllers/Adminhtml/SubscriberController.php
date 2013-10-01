<?php

/**
 * Out of Stock Subscriber controller
 *
 * @category   BusinessKing
 * @package    BusinessKing_OutofStockSubscription
 */
class BusinessKing_OutofStockSubscription_Adminhtml_SubscriberController extends Mage_Adminhtml_Controller_Action
{
    public function _initAction()
    {
        $this->loadLayout()
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Out of Stock Subscribers'), Mage::helper('adminhtml')->__('Out of Stock Subscribers'));
        return $this;
    }

    public function indexAction()
    { 
    	if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }
        $this->loadLayout();

        /**
         * Set active menu item
         */
        $this->_setActiveMenu('outofstocksubscription');

        $this->_addContent(
            $this->getLayout()->createBlock('outofstocksubscription/adminhtml_subcriber')
        );

        /**
         * Add breadcrumb item
         */
        $this->_addBreadcrumb(Mage::helper('outofstocksubscription')->__('Out of Stock Subscribers'), Mage::helper('outofstocksubscription')->__('Out of Stock Subscribers'));

        $this->renderLayout();            
    }
    
 	public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('outofstocksubscription/adminhtml_subcriber_grid')->toHtml());
    }
    
    public function deleteAction()
    {
    	$id  = (int) $this->getRequest()->getParam('id');
    	Mage::getSingleton('outofstocksubscription/info')->deleteSubscrition($id);
    	$this->_getSession()->addSuccess($this->__('The subscription has been deleted.'));
    	$this->_redirect('*/*/');
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('outofstocksubscription');
    }
}