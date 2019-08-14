<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores
 * Comments : Stores
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores extends Mage_Adminhtml_Block_Widget_Grid_Container {
	public function __construct() {
		$this->_blockGroup = 'storeshipper';
		$this->_controller = 'adminhtml_stores';
		$this->_headerText = $this->__ ( 'Stores' );
		
		$this->_addButton('sync', array(
				'label' => Mage::helper('adminhtml')->__('Import CSV'),
				'onclick' => "confirmSetLocation('Import Stores from ".$this->getBaseUrl()."stores.csv  ?','".$this->getUrl('*/*/importCsv', array('_current'=>true))."')",
				'class' => 'add',
		), -100);
		
		parent::__construct ();
	}
}
