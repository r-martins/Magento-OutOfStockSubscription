<?php

class BusinessKing_OutofStockSubscription_Model_Mysql4_Subscriber extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('outofstocksubscription/info', 'id');
    }
}