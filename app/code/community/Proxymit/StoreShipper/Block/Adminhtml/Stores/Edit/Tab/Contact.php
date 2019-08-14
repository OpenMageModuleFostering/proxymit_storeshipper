<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Contact Infromation Tab
 *
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tab_Contact extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		$this->setForm ( $form );
		$fieldset = $form->addFieldset ( 'contact_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Contact Information' ) 
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
		
		$fieldset->addField ( 'email', 'text', array (
				'name' => 'email',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Email' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Email' ),
				'required' => true 
		) );
		$fieldset->addField ( 'website', 'text', array (
				'name' => 'website',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Website' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Website' ),
				'required' => false 
		) );
		
		$fieldset->addField ( 'phone', 'text', array (
				'name' => 'phone',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Phone Number' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Phone Number' ),
				'required' => true 
		) );
		$fieldset->addField ( 'fax', 'text', array (
				'name' => 'fax',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Fax' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Fax' ),
				'required' => false 
		) );
		$fieldset = $form->addFieldset ( 'images_contact_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Store Images' ) 
		) );
		$customField = $fieldset->addField ( 'images', 'text', array (
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Images' ),
				'name' => 'images' 
		) );
		$customField->setRenderer ( $this->getLayout ()->createBlock ( 'storeshipper/adminhtml_stores_edit_images' ) );
		
		$fieldset->addField ( 'store_image', 'image', array (
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Add Image' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Add Image' ),
				'value' => '',
				'name' => 'store_image'
		) );
		$customField = $fieldset->addField ( 'add_image', 'text', array (
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Add Image' ),
				'name' => 'add_image',
				'title' => ' '
		) );
		$customField->setRenderer ( $this->getLayout ()->createBlock ( 'storeshipper/adminhtml_stores_edit_button' ) );
		
		$fieldset = $form->addFieldset ( 'manager_contact_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Manager Information' ) 
		) );
		$fieldset->addField ( 'manager_name', 'text', array (
				'name' => 'manager_name',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Manager Name' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Manager Name' ),
				'required' => true 
		) );
		$fieldset->addField ( 'manager_email', 'text', array (
				'name' => 'manager_email',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Manager Email' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Manager Email' ),
				'required' => true 
		) );
		
		$form->setValues ( $model->getData () );
		return parent::_prepareForm ();
	}
}