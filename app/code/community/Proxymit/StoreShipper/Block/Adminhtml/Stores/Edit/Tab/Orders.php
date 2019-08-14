<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Related Orders Tab
 *
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tab_Orders extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		$this->setForm ( $form );
		$fieldset = $form->addFieldset ( 'orders_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Related Orders' ) 
		) );
		
		$model = Mage::registry ( 'storeshipper' );
		
		if (! $model) {
			$model = Mage::getModel ( 'storeshipper/stores' );
		}
		if ($model->getId ()) {
			$fieldset->addField ( 'id', 'hidden', array (
					'name' => 'id' 
			) );
		}
		
		$fieldset->addField ( 'orders', 'text', array (
				'name' => 'orders',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'orders' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'orders' ),
				'required' => true 
		) );
		
		
		$form->setValues ( $model->getData () );
		return parent::_prepareForm ();
	}
}