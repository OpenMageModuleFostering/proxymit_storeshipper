<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Schedule Tab
 *
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tab_Schedule extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		$this->setForm ( $form );
		$fieldset = $form->addFieldset ( 'schedule_form', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Holidays' )				
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
		
		$fieldset->addField ( 'description', 'textarea', array (
				'name' => 'description',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Holidays' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Holidays' ),
				'required' => false 
		) );
		$fieldset = $form->addFieldset ( 'schedule_monday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Monday' )
		) );
		$fieldset->addField ( 'monday_open', 'text', array (
				'name' => 'monday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false 
		) );
		$fieldset->addField ( 'monday_close', 'text', array (
				'name' => 'monday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false 
		) );

		$fieldset = $form->addFieldset ( 'tuesday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Tuesday' )
		) );
		$fieldset->addField ( 'tuesday_open', 'text', array (
				'name' => 'tuesday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false 
		) );
		$fieldset->addField ( 'tuesday_close', 'text', array (
				'name' => 'tuesday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false 
		) );

		$fieldset = $form->addFieldset ( 'wednesday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Wednesday' )
		) );
		$fieldset->addField ( 'wednesday_open', 'text', array (
				'name' => 'wednesday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false 
		) );
		$fieldset->addField ( 'wednesday_close', 'text', array (
				'name' => 'wednesday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false 
		) );

		$fieldset = $form->addFieldset ( 'thursday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Thursday' )
		) );
		$fieldset->addField ( 'thursday_open', 'text', array (
				'name' => 'thursday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false 
		) );
		$fieldset->addField ( 'thursday_close', 'text', array (
				'name' => 'thursday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false 
		) );

		$fieldset = $form->addFieldset ( 'friday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Friday' )
		) );
		$fieldset->addField ( 'friday_open', 'text', array (
				'name' => 'friday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false 
		) );
		$fieldset->addField ( 'friday_close', 'text', array (
				'name' => 'friday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false 
		) );

		$fieldset = $form->addFieldset ( 'saturday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Saturday' )
		) );
		$fieldset->addField ( 'saturday_open', 'text', array (
				'name' => 'saturday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false 
		) );
		$fieldset->addField ( 'saturday_close', 'text', array (
				'name' => 'saturday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false 
		) );


		$fieldset = $form->addFieldset ( 'sunday', array (
				'legend' => Mage::helper ( 'storeshipper' )->__ ( 'Sunday' )
		) );
		$fieldset->addField ( 'sunday_open', 'text', array (
				'name' => 'sunday_open',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Opening' ),
				'required' => false
		) );

		$fieldset->addField ( 'sunday_close', 'text', array (
				'name' => 'sunday_close',
				'label' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'title' => Mage::helper ( 'storeshipper' )->__ ( 'Closing' ),
				'required' => false
		) );

		$form->setValues ( $model->getData () );
		return parent::_prepareForm ();
	}
}