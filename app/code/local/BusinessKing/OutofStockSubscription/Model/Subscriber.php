<?php

class BusinessKing_OutofStockSubscription_Model_Subscriber extends Mage_Core_Model_Abstract
{
    /**
     * Init model
     */
    protected function _construct()
    {
        $this->_init('outofstocksubscription/info');
    }
}