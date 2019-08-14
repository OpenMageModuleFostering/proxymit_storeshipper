<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block 
 * Location : StoreShipper->Manage Stores->Edit Store->General Infromation Tab
 * 
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	public function __construct()
	{
		parent::__construct();
		 
		$this->setId('storeshipper_stores_form');
		$this->setTitle($this->__('Store Information'));
	}
	 
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
				'id' => 'edit_form',
				'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
				'method' => 'post',
                'enctype' => 'multipart/form-data'
		)
		);
	
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
	
}