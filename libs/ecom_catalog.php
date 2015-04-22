<?php
// ===========================================================================================
// ECOMMAX TECH engine - CLASSES v2.0
// created at Feb, 2014
// ===========================================================================================

// *******************************************************************************************
// 
// implements ECOMMAX - onlineCatalog object for Homepage, Product Listing/Details pages
//
// *******************************************************************************************
class ecomCatalog extends ecomBase {
	private $cid;
	private $valchk1010;
	
	public function __construct($sess_name) {
        parent::__construct($sess_name); // Call the parent class's constructor
		// implement new initial setup HERE
        // echo "A new constructor in " . __CLASS__ . ".<br />";
		
		if($this->primSess->emx_sess_registered('valchk1010')) {			
			$this->valchk1010 = $this->primSess->emx_sess_get('valchk1010');
		}else {			
			$this->valchk1010 = '';
		}
    }

	public function display_home_banners() {
		print "display banners";
	}
	
	public function is_set($name) {
		if($this->primSess->emx_sess_registered($name)) 
			return true;
		else
			return false;
	}
	
	public function set_cid($mCID) {
		$this->cid = $mCID;
	}
	
	public function display_catalog() {
		$paraData = array();
		$paraData1 = array();
		
		if(!$this->cid) {			
			// display home page
			print $this->showTemplateAjax("site_home", 0, 0, 'content', $paraData);					
		}else {
			// diplay product list page			
			// $queryProduct = $this->primDB->emx_mysql_db_query("select * from eProducts where product_mac = 'ACE' and product_visible = '1'");	
			$queryProduct = $this->primDB->emx_mysql_db_query("select * from eProducts LEFT JOIN Products2Categories ON eProducts.product_id=Products2Categories.product_id where category_id = '1' ORDER BY eProducts.product_order");	
	
			// $paraData = array('<!--VGO FILTER_FLAG -->' => $this->filter_on);
	
			while($exAll = $this->primDB->emx_mysql_fetch_array($queryProduct)) {
				$aLink = ORG_URL."product_1_".$exAll['product_id'].".html";
				$imageLink = ORG_URL.$exAll['product_limage'];
				$paraData1[] = array('<!--VGO PRODUCT_LINK -->' => $aLink,
									 '<!--VGO PRODUCT_IMAGE -->' => $imageLink,
									 '<!--VGO PRODUCT_NAME -->' => $exAll['product_name'],
									 '<!--VGO PRODUCT_CODE -->' => $exAll['product_code'],
									 '<!--VGO PRODUCT_DES -->' => $exAll['product_brief'],									 
							 		'vgo_scenario' => 0);
			}
			print $this->showTemplateLoopAjax("product", 0, 0, 'content', $paraData, $paraData1);				
		}
	}
}
?>
