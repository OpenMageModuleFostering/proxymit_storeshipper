<?php
class Proxymit_StoreShipper_IndexController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		$this->loadLayout ();
		$this->renderLayout ();
		
		
	}
	
	// Show only available in Storeview
	public function filterStores($data){
		$res = array();
		foreach ( $data as $st ){
			if(($st['status']==1) && ($st['available_at_storeview'] == -1 || $st['available_at_storeview'] == Mage::app()->getStore()->getStoreId())){
				array_push($res,$st);
			}
		}
		return $res;
	}
	
	public function testMethodAction() {
		echo 'test mamethode';
	}
	public function testModelAction() {
		$params = $this->getRequest ()->getParams ();
		$blogpost = Mage::getModel ( 'storeshipper/stores' );
		echo ("Loading the blogpost with an ID of " . $params ['id']);
		$blogpost->load ( $params ['id'] );
		$data = $blogpost->getData ();
		//Zend_Debug::dump ( $data );
	}
	
	public function findStores($country = "", $state = "", $city = "", $zip = "") {
		$collection = Mage::getModel ( 'storeshipper/stores' )->getCollection ();
		$collection->addFieldToFilter ( 'country', array (
				'like' => array (
						"%" . $country . "%"	
				)
		) );
		$collection->addFieldToFilter ( 'state', array (
				'like' => array (
						"%" . $state . "%"	
				)
		) );
		$collection->addFieldToFilter ( 'city', array (
				'like' => array (
						"%" . $city . "%"	
				)
		) );
		$collection->addFieldToFilter ( 'zipcode', array (
				'like' => array (
						"%" . $zip . "%"	
				)
		) );
		return $this->filterStores($collection);
	}
	public function getStoresAction() {
		$params = $this->getRequest ()->getParams ();
		$cntry=$params['country'];
		if($cntry == "All Countries"){
			$cntry="";
		}
		$stores=$this->findStores($cntry,$params['state'],$params['city'],$params['zip']);
		$stores=$this->filterStores($stores);
		?>
	<div id="stores" style="padding:0px; max-height: 300px; overflow: auto; border: 0px;" class="stores fieldset">
		<h2 class="legend">Stores list</h2>
		<div id="search-result">
		<?php if(count($stores)>0) {?>
		<table class="data-table">
			<tr>
				<th>Store Name</th>
				<?php if (isset($params['search']) && $params['search']!="2"){?><th>Adress</th><?php }?>
				<th>City</th>
				<th>Country</th>
				<th></th>
			</tr>
        <?php
		foreach ( $stores as $store ) {
			?>
          <tr>
				<td><a
						href="javascript:pointStore(<?php echo $store["latitude"].','.$store["longitude"].','.$store["id"];?>);"><?php echo $store["name"];?></a></td>
				<?php if (isset($params['search']) && $params['search']!="2"){?><td><?php echo $store["adress"];?></td><?php }?>
				<td><?php echo $store["city"];?></td>
				<td><?php echo Mage::helper ( 'storeshipper' )->getCountryName($store["country"]);?></td>
				<td><a target="_new"
					href="javascript:itiniraire('<?php echo $store["latitude"].", ".$store["longitude"];?>')"><img src="http://laviouze.free.fr/images/Map.png" width="30px" /></a></td>
			</tr>
          <?php
		}
		?>
      </table>
      <?php }else{
      echo "No store available.";
      	
		}?>
	</div>
</div>
<?php
	}
}