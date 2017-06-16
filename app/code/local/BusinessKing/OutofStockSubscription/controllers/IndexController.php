<?php

/**
 * Out of Stock Subscription index controller
 *
 * @category    BusinessKing
 * @package     BusinessKing_OutofStockSubscription
 */
class BusinessKing_OutofStockSubscription_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$productId = $this->getRequest()->getPost('product');
		$email = $this->getRequest()->getPost('subscription_email');
		$validEmail = new Zend_Validate_EmailAddress();
		$validEmail = $validEmail->isValid($email);
		$validateFormkey = Mage::getStoreConfigFlag('cataloginventory/outofstocksubscription/formkey');

		if ($email &&
            $productId &&
            Mage::getStoreConfigFlag('cataloginventory/outofstocksubscription/active') &&
            $validEmail
        ) {

		    if($validateFormkey && !$this->_validateFormKey())
		    {
		        die('Invalid formkey');
            }
			Mage::getModel('outofstocksubscription/info')->saveSubscrition($productId, $email);
			
			$this->_getSession()->addSuccess($this->__('Subscription added successfully.'));
						
			$product = Mage::getModel('catalog/product')->load($productId);
			//$product->getProductUrl();
			$this->_redirectBack();
		}
		else {
			$this->_redirect('');
		}		
	}
	
    protected function _getSession()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * Redirect to referrer URL or otherwise to index page without params
     *
     * @return BusinessKing_OutofStockSubscription_IndexController
     */
    protected function _redirectBack()
    {
        $url = $this->_getRefererUrl();
        if (Mage::app()->getStore()->getBaseUrl() == $url) {
            $url = Mage::getUrl('*/*/index');
        }
        $this->_redirectUrl($url);
        return $this;
    }
}