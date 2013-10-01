<?php

class BusinessKing_OutofStockSubscription_Block_Adminhtml_Subcriber_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    { 
        parent::__construct();
        $this->setId('subcribersGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

        $this->setTemplate('outofstocksubscription/widget/grid.phtml');
    }

    protected function _prepareCollection()
    {
        /*$collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('supplier')
            ->addAttributeToSelect('supplier_sku')
            ->joinField('email',
                'outofstocksubscription_info',
                'email',
                'product_id=entity_id')
            //->join(array('table_alias'=>'outofstocksubscription_info'), 'e.entity_id = table_alias.product_id', array('table_alias.email'));
            ;
    	*/
        $collection = Mage::getResourceModel('outofstocksubscription/subscriber_collection');
        //echo $collection->getSelect();              
        $this->setCollection($collection);
        //$this->getCollection()->getSelect()->joinRight(array('table_alias'=>'outofstocksubscription_info'), 'e.entity_id = table_alias.product_id', array('table_alias.email'));
        
        parent::_prepareCollection();
        //echo $this->getCollection()->getSelect();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('email', array(
            'header'    => Mage::helper('outofstocksubscription')->__('Email'),
            'width'     => '100px',
            'index'     => 'email',            
        ));
        
        $this->addColumn('product_id', array(
            'header'    => Mage::helper('outofstocksubscription')->__('Product ID'),
            'width'     => '50px',
            'index'     => 'product_id',
            'type'      => 'number'
        ));
        
        $this->addColumn('sku', array(
            'header'    => Mage::helper('outofstocksubscription')->__('SKU'),
            'width'     => '100px',
            'index'     => 'sku',            
        ));

        $this->addColumn('product_name', array(
            'header'    => Mage::helper('outofstocksubscription')->__('Product Name'),
            'width'     => '100px',
            'index'     => 'product_id',			
        ));
        
        $this->addColumn('date', array(
            'header' => Mage::helper('outofstocksubscription')->__('Subscribed On'),
            'index' => 'date',
            'type' => 'datetime',
            'width' => '100px',
        ));
                
        $this->addColumn('action', array(
            'header'    => Mage::helper('outofstocksubscription')->__('Action'),
            'width'     => '50px',
            'index'     => 'id',			
		'filter'    => false,
              'sortable'  => false,  
        ));
        
        /*$this->addColumn('action',
            array(
                'header'    => Mage::helper('outofstocksubscription')->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('outofstocksubscription')->__('Delete'),
                        'url'     => array(
                            'base'=>'outofstocksubscription/adminhtml_subscriber/delete'                    		                            
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,                
        ));*/
         
        return parent::_prepareColumns();
    } 
}