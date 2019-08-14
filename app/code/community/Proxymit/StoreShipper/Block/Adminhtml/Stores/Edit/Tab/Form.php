<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block 
 * Location : StoreShipper->Manage Stores->Edit Store->General Infromation Tab
 * 
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		$this->setForm ( $form );
		$fieldset = $form->addFieldset ( 'info_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Store Information' ) 
		) );
		
		if (Mage::registry ( 'storeshipper' )->_data ["id"] != NULL) {
			$model = Mage::getModel ( 'storeshipper/stores' )->load ( Mage::registry ( 'storeshipper' )->getId () );
		} else {
			$model = Mage::getModel ( 'storeshipper/stores' );
		}

		
		if ($model->getId ()) {
			$fieldset->addField ( 'id', 'hidden', array (
					'name' => 'id' 
			) );
		}
		
		$fieldset->addField ( 'name', 'text', array (
				'name' => 'name',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Name' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Name' ),
				'required' => true 
		) );
		$fieldset->addField ( 'status', 'select', array (
				'name' => 'status',
				'label' => $this->__ ( 'Enable' ),
				'values' => Mage::getModel ( 'adminhtml/system_config_source_yesno' )->toOptionArray () 
		) );

// 		$fieldset->addField ( 'shipping_price', 'text', array (
// 				'name' => 'shipping_price',
// 				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Shipping Price' ),
// 				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Shipping Price' ),
// 				'required' => true
// 		) );
		
		// Get All Storeviews
		$storess=array();
		array_push($storess, array('value' => -1 , 'label' => 'Show in all stores'));
		foreach (Mage::app()->getWebsites() as $website) {
			foreach ($website->getGroups() as $group) {
				$stores = $group->getStores();
				foreach ($stores as $store) {
					array_push($storess, array('value' => $store->getId() , 'label' => $store->getName()));
				}
			}
		}
		// Get All Countries
		$pays=array();
		array_push($pays, array('value' => '' , 'label' => ''));
		
		$_countries = Mage::getResourceModel('directory/country_collection')
		->loadData()->toOptionArray(false);
		foreach($_countries as $_country){
			array_push($pays, array('value' => $_country['label'] , 'label' => $_country['label']));
		}
		
		$fieldset->addField ( 'available_at_storeview', 'select', array (
				'name' => 'available_at_storeview',
				'label' => $this->__ ( 'Show in Storeview' ),
				'values' => $storess
		) );
		
		$fieldset->addField ( 'adress', 'textarea', array (
				'name' => 'adress',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Adress' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Adress' ),
				'required' => true 
		) );

		$fieldset->addField('country', 'select', array(
				'name'  => 'country',
				'label'     => 'Country',
				'required' => true,
				'values'    => Mage::getModel('adminhtml/system_config_source_country')->toOptionArray(),
		));
		$fieldset->addField ( 'state', 'text', array (
				'name' => 'state',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'State' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'State' ),
				'required' => true
		) );
		$fieldset->addField ( 'city', 'text', array (
				'name' => 'city',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'City' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'City' ),
				'required' => true
		) );

		$fieldset->addField ( 'zipcode', 'text', array (
				'name' => 'zipcode',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Zip code' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Zip code' ),
				'required' => true
		) );
		
		$form->setValues ( $model->getData () );
		
		return parent::_prepareForm ();
	}
}