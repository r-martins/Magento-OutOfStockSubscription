<?php

/**
 * @category    BusinessKing
 * @package     BusinessKing_OutofStockSubscription
 */
class BusinessKing_OutofStockSubscription_Model_Observer
{
	const OUTOFSTOCKSUBSCRIPTION_MAIL_TEMPLATE = 'outofstock_subscription';
	
	public function sendEmailToOutofStockSubscription($observer)
    {  
        $product = $observer->getEvent()->getProduct();

		if ($product) {
			if ($product->getStockItem()) {
				$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product->getId());

		           //$isInStock = $product->getStockItem()->getIsInStock();
				$isInStock = $stockItem->getIsInStock();

			    if ($isInStock>=1) { 
			    	$subscriptions = Mage::getResourceModel('outofstocksubscription/info')->getSubscriptions($product->getId());
			    	if (count($subscriptions) > 0) {
			    		
					//$prodUrl = $product->getProductUrl();
					$prodUrl = Mage::getBaseUrl();
					$prodUrl = str_replace("/index.php", "", $prodUrl);
					$prodUrl = $prodUrl.$product->getData('url_path');

			    		$storeId = Mage::app()->getStore()->getId();
		            	
		            	// get email template    
			    		$emailTemplate = Mage::getStoreConfig('outofstocksubscription/mail/template', $storeId);
						if (!is_numeric($emailTemplate)) {
							$emailTemplate = self::OUTOFSTOCKSUBSCRIPTION_MAIL_TEMPLATE;
						}
				
						$translate = Mage::getSingleton('core/translate');
							
			    		foreach ($subscriptions as $subscription) {
			    			
			    			$translate->setTranslateInline(false);	
			               	Mage::getModel('core/email_template')
					            ->setDesignConfig(array('area'=>'frontend', 'store'=>$storeId))
					            ->sendTransactional(
					                $emailTemplate,
					                'support',
					                $subscription['email'],
					                '',
					                array(
					                	'product'     => $product->getName(),
					                	'product_url' => $prodUrl,			                	
					                ));			
					        $translate->setTranslateInline(true);
					        
					        Mage::getResourceModel('outofstocksubscription/info')->deleteSubscription($subscription['id']);
			    		}
			    	}			
			    }
			}
		}
        //return $this;
    }
    
	public function cancelOrderItem($observer)
    {
        $item = $observer->getEvent()->getItem();

        $productId = $item->getProductId();
		if ($productId) {
    		$subscriptions = Mage::getResourceModel('outofstocksubscription/info')->getSubscriptions($productId);
	    	if (count($subscriptions) > 0) {
	    		
	    		$product = Mage::getModel('catalog/product')->load($productId);
				$prodUrl = Mage::getBaseUrl();
				$prodUrl = str_replace("/index.php", "", $prodUrl);
				$prodUrl = $prodUrl.$product->getData('url_path');

	    		$storeId = Mage::app()->getStore()->getId();
            	
            	// get email template    	
	    		$emailTemplate = Mage::getStoreConfig('outofstocksubscription/mail/template', $storeId);
				if (!is_numeric($emailTemplate)) {
					$emailTemplate = self::OUTOFSTOCKSUBSCRIPTION_MAIL_TEMPLATE;
				}
				 
				$translate = Mage::getSingleton('core/translate');
					
	    		foreach ($subscriptions as $subscription) {
	    			
	    			$translate->setTranslateInline(false);	
	               	Mage::getModel('core/email_template')
			            ->setDesignConfig(array('area'=>'frontend', 'store'=>$storeId))
			            ->sendTransactional(
			                $emailTemplate,
			                'support',
			                $subscription['email'],
			                '',
			                array(
			                	'product'     => $product->getName(),
			                	'product_url' => $prodUrl,			                	
			                ));			
			        $translate->setTranslateInline(true);
			        
			        Mage::getResourceModel('outofstocksubscription/info')->deleteSubscription($subscription['id']);
	    		}
	    	}
		}
    }
}
