<?php

/**
 * @category   BusinessKing
 * @package    BusinessKing_OutofStockSubscription
 */
class BusinessKing_OutofStockSubscription_Model_Mysql4_Subscriber_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Initialize collection
     *
     */
    protected function _construct()
    {
        $this->_init('outofstocksubscription/subscriber');   
    }

    protected function _initSelect()
    { 
    	parent::_initSelect();
		//$attributeId = Mage::getResourceSingleton('outofstocksubscription/info')->getAttributeId();
    	$this->getSelect()->join(array("cpe" => 'catalog_product_entity'), 'main_table.product_id=cpe.entity_id', array('sku'=>'cpe.sku'));
    	//$this->getSelect()->join(array("cpev" => 'catalog_product_entity_varchar'), 'cpe.entity_id=cpev.entity_id', array('value'=>'cpev.value'));
    	//$this->getSelect()->where("cpev.attribute_id=".$attributeId);
    	
    	//$this->getSelect()->group("con.ticket_id");
    	//$this->getSelect()->order("con.comment_date DESC");
    	//exit($this->getSelect());
    }
}
