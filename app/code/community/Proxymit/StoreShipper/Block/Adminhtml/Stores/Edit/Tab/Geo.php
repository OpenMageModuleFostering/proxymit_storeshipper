<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block 
 * Location : StoreShipper->Manage Stores->Edit Store->Geolocation Tab
 * 
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tab_Geo extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		$this->setForm ( $form );
		$fieldset = $form->addFieldset ( 'geo_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Geolocation' ) 
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
		
		$fieldset->addField ( 'latitude', 'text', array (
				'name' => 'latitude',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Latitude' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Latitude' ),
				'required' => true 
		) );
		$fieldset->addField ( 'longitude', 'text', array (
				'name' => 'longitude',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Longitude' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Longitude' ),
				'required' => true
		) );
		$customField = $fieldset->addField('test', 'text', array( 'label' => Mage::helper('storeshipper')->__('Map'), 'name' => 'map', ));
		$customField->setRenderer($this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_map'));
		$form->setValues ( $model->getData () );
		
		return parent::_prepareForm ();
	}
}