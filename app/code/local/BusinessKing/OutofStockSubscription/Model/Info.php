<?php

class BusinessKing_OutofStockSubscription_Model_Info extends Mage_Core_Model_Abstract
{
	protected function _construct()
    {
        
    }
    
    public function saveSubscrition($productId, $email)
    { 
    	Mage::getResourceSingleton('outofstocksubscription/info')->saveSubscrition($productId, $email);    	
    }
    
    public function deleteSubscrition($id)
    {
    	Mage::getResourceSingleton('outofstocksubscription/info')->deleteSubscrition($id);
    }
    
    public function getProducts()
    {
    	return Mage::getResourceSingleton('outofstocksubscription/info')->getProducts();
    }
    
    public function saveProductAttributesInfo($productId, $supplier, $supplierSku)
    {
    	Mage::getResourceSingleton('outofstocksubscription/info')->saveProductAttributesInfo($productId, $supplier, $supplierSku);
    }
    
    public function getSupplierAttributeId()
    {
    	return Mage::getResourceSingleton('outofstocksubscription/info')->getSupplierAttributeId();
    }
    
    public function getSupplierValues($supplierAttributeId)
    {
    	return Mage::getResourceSingleton('outofstocksubscription/info')->getSupplierValues($supplierAttributeId);
    }
    
    public function getCollection()
    {
    	return Mage::getResourceSingleton('outofstocksubscription/info')->getCollection();
    }
}    