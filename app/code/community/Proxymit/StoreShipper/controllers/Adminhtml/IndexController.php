<?php 
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml_IndexController
 *
 */
class Proxymit_StoreShipper_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * Init Action
	 */
	protected function _initAction()
	{	
		$this->loadLayout()->_setActiveMenu('storeshipper/stores')
		->_addBreadcrumb('Store Manager','test Manager');
		
		return $this;
	}
	/**
	 * Index Action
	 */
	public function indexAction()
	{
		$this->_initAction();
		$this->renderLayout();
		
	}
	/**
	 * Add New Store Action
	 */
	public function newAction()
	{
			$this->loadLayout();
			$this->_addContent($this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit'))
			->_addLeft($this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tabs'));
			$this->renderLayout();
		
		//$this->_forward('edit');
	}
	/**
	 * Edit Store Action
	 */
	public function editAction()
	{
		$this->_initAction();
		 
		// Get id if available
		$id  = $this->getRequest()->getParam('id');
		$model = Mage::getModel('storeshipper/stores');
		
		if ($id) {
			// Load record
			$model->load($id);
			 
			// Check if record is loaded
			if (!$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('This store no longer exists.'));
				$this->_redirect('*/*/');
				 
				return;
			}else{
				
			}
		}
		 
		$this->_title($model->getId() ? $model->getName() : $this->__('New Store'));
		 
		$data = Mage::getSingleton('adminhtml/session')->getBazData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		 
		Mage::register('storeshipper', $model);
		 
		$this->_initAction()
		->_addContent($this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit')->setData('action', $this->getUrl('*/*/save')))
		->_addLeft($this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tabs'))
		->renderLayout();
	}
	
	/**
	 * Delete Store Action
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('storeshipper/stores');
	
				$model->setId($this->getRequest()->getParam('id'))
				->delete();
	
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
	
	/**
	 * Save Store Action
	 */	 
	public function saveAction()
	{
		if ($postData = $this->getRequest()->getPost()) {
			$model = Mage::getSingleton('storeshipper/stores');
			// Load Store From ID
			if($this->getRequest()->getParam('id')){
				$model=Mage::getModel("storeshipper/stores")->load($this->getRequest()->getParam('id'));
			}else{
				$model=Mage::getModel("storeshipper/stores");
			}
			
			
			// Unset ID Store if there is on
			if($this->getRequest()->getParam('id') == null){
				unset($postData["id"]);
			}else{
				$model->setId($this->getRequest()->getParam('id'));
			}
			$model->setData($postData);
			if($this->getRequest()->getParam('id')){
				$model->setId($this->getRequest()->getParam('id'));
			}
			try {
				
				$model->save();
				
				// Upload Images while Saving Store
				if(isset($_FILES['store_image']['name']) and (file_exists($_FILES['store_image']['tmp_name']))) {
					try {
						$uploader = new Varien_File_Uploader('store_image');
						$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
						$uploader->setAllowRenameFiles(true);
						$uploader->setFilesDispersion(false);
						// Build Path Under media/storeshipper/id_store
						$path = Mage::getBaseDir('media') . DS. 'storeshipper'.DS.$this->getRequest()->getParam('id').DS ;
						$uploader->save($path, $_FILES['store_image']['name']);
						$data['store_image'] = $_FILES['store_image']['name'];
					}catch(Exception $e) {
					
					}
				}
				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The store has been saved.'));
				$this->_redirect('*/*/');
	
				return;
			}
			catch (Mage_Core_Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this store.'));
			}
	
			Mage::getSingleton('adminhtml/session')->setBazData($postData);
			$this->_redirectReferer();
		}
	}
	
	/**
	 * Delete image of a store by store ID - Action
	 */
	public function deleteImageAction()
	{
		$path = Mage::getBaseDir ( 'media' ) . DS . 'storeshipper' . DS .$this->getRequest()->getParam('id').DS;
		$nm = $this->getRequest()->getParam('imagename');
		unlink($path.$nm);
		$this->_redirect('*/*/edit/id/'.$this->getRequest()->getParam('id').'/');
	}	
	
	/**
	 * Add Image for a store Action
	 */
	public function addImageAction()
	{
		$this->_redirect('*/*/edit/id/'.$this->getRequest()->getParam('id').'/');
		
	}
	
	/**
	 * Message content Action
	 */
	public function messageAction()
	{
		$data = Mage::getModel('storeshipper/stores')->load($this->getRequest()->getParam('id'));
		echo $data->getContent();
	}
	 

	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('storeshipper/stores');
	}
	
	/**
	 * Import list of stores CSV Action
	 */
	public function importCsvAction() {
		
		// Import file path
		$fileName = Mage::getBaseDir()."\\stores.csv";
		// delimeter
		$delimiter = ',';
		// enclosure
		$enclosure = '"';
		// init store model
		$model = Mage::getModel('storeshipper/stores');
		// open file on read access
		$file = fopen ( $fileName, "r" );
		if(!$file){
			Mage::getSingleton('adminhtml/session')->addError($this->__('File not found : '.Mage::getBaseUrl().'stores.csv !'));
			$this->_redirect("*/*/", array());
			return;
		}
		
		$csvArr=array();
		$i=0;
		while ( ! feof ( $file ) ) {
			$csvArr = fgetcsv ( $file, 0, $delimiter, $enclosure );
			if($i>0){
				$data=array();
				$data["name"]=$csvArr[1];
				$data["status"]=$csvArr[2];
				$data["shipping_price"]=$csvArr[3];
				$data["adress"]=$csvArr[4];
				$data["city"]=$csvArr[5];
				$data["zipcode"]=$csvArr[6];
				$data["country"]=$csvArr[7];
				$data["state"]=$csvArr[8];
				$data["latitude"]=$csvArr[9];
				$data["longitude"]=$csvArr[10];
				$data["description"]=$csvArr[11];
				$data["website"]=$csvArr[12];
				$data["email"]=$csvArr[13];
				$data["phone"]=$csvArr[14];
				$data["fax"]=$csvArr[15];
				$data["manager_name"]=$csvArr[16];
				$data["manager_email"]=$csvArr[17];
				$data["manager_show_frontend"]=$csvArr[18];
				$data["manager_fax"]=$csvArr[19];
				$data["manager_phone"]=$csvArr[20];
				$data["id_schedule"]=NULL;
				$data["available_at_storeview"]=$csvArr[22];
				$data["available_after"]=$csvArr[23];
				$data["monday_open"]=$csvArr[24];
				$data["monday_close"]=$csvArr[25];
				$data["tuesday_open"]=$csvArr[26];
				$data["tuesday_close"]=$csvArr[27];
				$data["wednesday_open"]=$csvArr[28];
				$data["wednesday_close"]=$csvArr[29];
				$data["thursday_open"]=$csvArr[30];
				$data["thursday_close"]=$csvArr[31];
				$data["friday_open"]=$csvArr[32];
				$data["friday_close"]=$csvArr[33];
				$data["saturday_open"]=$csvArr[34];
				$data["saturday_close"]=$csvArr[35];
				$data["sunday_open"]=$csvArr[36];
				$data["sunday_close"]=$csvArr[37];
				
				// set model data
				if($data["name"] != NULL){
					$model->setData($data);
					// save line
					$model->save();
				}
				
			}
			$i++;
			
		}
		
		fclose ( $file );
		Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Stores imported successfully '));
		$this->_redirect("*/*/", array());
		
	}
	
	
	/**
	 * Export list of stores CSV Action
	 */
	public function exportCsvAction()
	{
// 		$fileName   = 'stores.csv';
// 		$content    = $this->getLayout()->createBlock('storeshipper/adminhtml_stores_grid')
// 		->getCsv();
		$fileName = 'stores.csv'; //file path of the CSV file in which the data to be saved
		
		//$mage_csv = new Varien_File_Csv(); //mage CSV
		$content = Mage::helper('storeshipper')->generateMlnList();
		
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * Export list of stores XML Action
	 */
	public function exportXmlAction()
	{
		$fileName   = 'stores.xml';
		$content    = $this->getLayout()->createBlock('storeshipper/adminhtml_stores_grid')
		->getXml();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	
	
	/**
	 * Store Manager Email Notification
	 */
	public function notifyStoreManagerAction()
	{
	if($this->getRequest()->getParam('order_id')){
			// Retrieve Order ID From redirection
			$order=Mage::getModel('sales/order')->load($this->getRequest()->getParam('order_id'));
			
			// Get Store ID
			$storeId = Mage::app()->getStore()->getStoreId();
				
			// Get Store Manager Email Adress
			$store_order=Mage::getModel('storeshipper/orders')->getCollection()->addFieldToFilter('id_order',$order->getId() );
			$data=$store_order->getData();
			$store= Mage::getModel('storeshipper/stores')->load($data[0]["id_store"]);
			$email= $store->getManagerEmail();
			
			// Retrieve store manager email template id
			$templateId = Mage::getStoreConfig('carriers/pickup/email_manager_template');
			//Zend_Debug::dump($templateId);
			//die();
			
			// If default template send email with default template
			if($templateId == "carriers_pickup_email_manager_template"){
				
				/**
				 * $templateId can be set to numeric or string type value.
				 * You can use Id of transactional emails (found in
				 * "System->Trasactional Emails"). But better practice is
				 * to create a config for this and use xml path to fetch
				 * email template info (whatever from file/db).
				 */
				//const EMAIL_TEMPLATE_XML_PATH = 'customer/testemail/email_template';
				//$templateId = Mage::getStoreConfig('store');
				
				$mailSubject = 'StoreShipper Notification';
				
				/**
				 * $sender can be of type string or array. You can set identity of
				 * diffrent Store emails (like 'support', 'sales', etc.) found
				 * in "System->Configuration->General->Store Email Addresses"
				 */
				$sender = Array('name'  => Mage::getStoreConfig('trans_email/ident_general/name', $storeId),
						'email' => Mage::getStoreConfig('trans_email/ident_general/email', $storeId));
				
				/**
				 * If $name = null, then magento will parse the email id
				 * and use the base part as name.
				 */
				$name = Mage::getStoreConfig('trans_email/ident_general/name', $storeId);
				
				$vars = Array();
				/* An example how you can pass magento objects and normal variables*/
				
				 $vars = Array('order'=>$order);
				
				/*This is optional*/
				$storeId = Mage::app()->getStore()->getId();
				
				$translate  = Mage::getSingleton('core/translate');
				try{
				Mage::getModel('core/email_template')->loadDefault('storeshipper_manager')
				->setTemplateSubject($mailSubject)
				->sendTransactional($templateId, $sender, $email, $name, $vars, $storeId);
				$translate->setTranslateInline(true);
				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Store Manager has been notified to '.$email));
                $this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));

				}catch(Exception $e){
					Mage::getSingleton('adminhtml/session')->addError($this->__('Error : Email was not sent !'));
					$this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));
				}
				return;	
			}
			if($templateId){
				$mailer = Mage::getModel('core/email_template_mailer');
				$emailInfo = Mage::getModel('core/email_info');
				$emailInfo->addTo($email, "Customer Notification");
	
				$mailer->addEmailInfo($emailInfo);
				// Set all required params and send emails
				$mailer->setSender(Mage::getStoreConfig('sales_email/shipment/identity', $storeId));
				$mailer->setStoreId($storeId);
				$mailer->setTemplateId($templateId);
	
				$mailer->setTemplateParams(array(
						'order' => $order,
				)
				);
				try {
					// SEND EMAIL
					$mailer->send();
					// Mage::log($mailer);
					Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Store Manager has been notified to '.$email));
					$this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));
				}
				catch (Exception $e) {
					Mage::logException($e);
					Mage::getSingleton('adminhtml/session')->addError($this->__('Invalide Email Template ! Please select a new email template in the Global StoreShipper Config'));
					$this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));
				}
			}else{
				Mage::log("Invalide Template");
			}
		}
	}
	/**
	 * Client Email Notification
	 */
	public function notifyCustomerAction()
	{
		if($this->getRequest()->getParam('order_id')){
			// Retrieve Order ID From redirection
			$order=Mage::getModel('sales/order')->load($this->getRequest()->getParam('order_id'));	
			// Get Store ID
			$storeId = Mage::app()->getStore()->getStoreId();
				
			// Get Customer Email Adress
			$email = $order->getCustomerEmail();
				
			// Retrieve store manager email template id
			$templateId = Mage::getStoreConfig('carriers/pickup/email_customer_template');
			//Zend_Debug::dump($templateId);
			//die();
			
			// If default template send email with default template
			if($templateId == "carriers_pickup_email_customer_template"){
				
				/**
				 * $templateId can be set to numeric or string type value.
				 * You can use Id of transactional emails (found in
				 * "System->Trasactional Emails"). But better practice is
				 * to create a config for this and use xml path to fetch
				 * email template info (whatever from file/db).
				 */
				//const EMAIL_TEMPLATE_XML_PATH = 'customer/testemail/email_template';
				//$templateId = Mage::getStoreConfig('store');
				
				$mailSubject = 'Customer StoreShipper Notification';
				
				/**
				 * $sender can be of type string or array. You can set identity of
				 * diffrent Store emails (like 'support', 'sales', etc.) found
				 * in "System->Configuration->General->Store Email Addresses"
				 */
				$sender = Array('name'  => Mage::getStoreConfig('trans_email/ident_general/name', $storeId),
						'email' => Mage::getStoreConfig('trans_email/ident_general/email', $storeId));
				
				/**
				 * If $name = null, then magento will parse the email id
				 * and use the base part as name.
				 */
				$name = Mage::getStoreConfig('trans_email/ident_general/name', $storeId);
				
				$vars = Array();
				/* An example how you can pass magento objects and normal variables*/
				
				 $vars = Array('order'=>$order);
				
				/*This is optional*/
				$storeId = Mage::app()->getStore()->getId();
				
				$translate  = Mage::getSingleton('core/translate');
				try{
				Mage::getModel('core/email_template')->loadDefault('storeshipper_customer')
				->setTemplateSubject($mailSubject)
				->sendTransactional($templateId, $sender, $email, $name, $vars, $storeId);
				$translate->setTranslateInline(true);
				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Customer has been notified to '.$email));
                $this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));

				}catch(Exception $e){
					Mage::getSingleton('adminhtml/session')->addError($this->__('Error : Email was not sent !'));
					$this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));
				}
				return;	
			}
			if($templateId){
				$mailer = Mage::getModel('core/email_template_mailer');
				$emailInfo = Mage::getModel('core/email_info');
				$emailInfo->addTo($email, "Customer Notification");
	
				$mailer->addEmailInfo($emailInfo);
				// Set all required params and send emails
				$mailer->setSender(Mage::getStoreConfig('sales_email/shipment/identity', $storeId));
				$mailer->setStoreId($storeId);
				$mailer->setTemplateId($templateId);
	
				$mailer->setTemplateParams(array(
						'order' => $order,
				)
				);
				try {
					// SEND EMAIL
					$mailer->send();
					// Mage::log($mailer);
					Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Customer has been notified at '.$email));
					$this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));
				}
				catch (Exception $e) {
					Mage::logException($e);
					Mage::getSingleton('adminhtml/session')->addError($this->__('Invalide Email Template ! Please select a new email template in the Global StoreShipper Config'));
					$this->_redirect("adminhtml/sales_order/view", array('order_id'=>$order->getId()));
				}
			}else{
				Mage::log("Invalide Template");
			}
		}
	}
	
}
?>