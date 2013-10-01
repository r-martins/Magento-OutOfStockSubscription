<?php

class BusinessKing_OutofStockSubscription_Model_Mysql4_Info extends Mage_Core_Model_Mysql4_Abstract
{
	protected function _construct()
    {
        $this->_init('core/store', 'store_id');
    }

    public function saveSubscrition($productId, $email)
    {
    	$write = $this->_getWriteAdapter();
    	$read = $this->_getReadAdapter();
    	
        $select = $read->select()
            ->from($this->getTable('outofstocksubscription/info'))
            ->where("product_id = ".$productId." AND email = '".$email."'");
    	$result = $read->fetchRow($select);
    	 
    	if (!isset($result['id'])) {
    		$write->insert($this->getTable('outofstocksubscription/info'), array('product_id'=>$productId, 'email'=>$email, 'date'=>date('Y-m-d H:i:s')));
    	}                
    }
    
    public function deleteSubscrition($id)
    {
    	if ($id)
    	{
    		$write = $this->_getWriteAdapter();
    		$write->delete($this->getTable('outofstocksubscription/info'), 'id='.$id);
    	}
    }
    
    public function getProducts()
    {
    	$read = $this->_getReadAdapter();
    	
        $select = "SELECT DISTINCT(product_id) FROM ".$this->getTable('outofstocksubscription/info');
            
    	return $read->fetchAll($select);
    }
        
    public function getSubscriptions($productId)
    {
    	$read = $this->_getReadAdapter();
    	
        $select = $read->select()
            ->from($this->getTable('outofstocksubscription/info'))
            ->where("product_id = ".$productId);
            
    	return $read->fetchAll($select);
    }
    
    public function deleteSubscription($id)
    {
    	$write = $this->_getWriteAdapter();
    	$write->delete($this->getTable('outofstocksubscription/info'), 'id='.$id);
    }
    	
	public function getAttributeId()
	{
		$read = $this->_getReadAdapter();
    	
        $select = $read->select()
            ->from('eav_entity_type', 'entity_type_id')
            ->where("entity_type_code = 'catalog_product'");            
    	$entityTypeId = $read->fetchOne($select);
		if (!$entityTypeId) {
			$entityTypeId = 4;
		}
		$select = $read->select()
            ->from('eav_attribute', 'attribute_id')
            ->where("entity_type_id = ".$entityTypeId." AND attribute_code = 'name'");            
    	return $read->fetchOne($select);
	}
}    