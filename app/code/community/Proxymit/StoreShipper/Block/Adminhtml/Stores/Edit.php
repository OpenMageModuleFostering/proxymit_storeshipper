<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store
 * Comments : Edit Store
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	 * Init class
	 */
	public function __construct()
	{
		$this->_blockGroup = 'storeshipper';
		$this->_controller = 'adminhtml_stores';
		 
		parent::__construct();
		 
		$this->_updateButton('save', 'label', $this->__('Save Store'));
		$this->_updateButton('delete', 'label', $this->__('Delete Store'));
	}
	 
	/**
	 * Get Header text
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
 		if (Mage::registry('storeshipper')) {
 			return $this->__('Edit Store');
 		}
 		else {
			return $this->__('New Store');
 		}
	}
}
