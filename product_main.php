<?php
	global $emxTECH;
	
	$currSiteURL = ORG_URL;

	// =======================================================
	// display MAIN section HERE
	// =======================================================
	
	$paraData = array();
	$paraData1 = array();
	$queryProduct = $emxTECH->primDB->emx_mysql_db_query("select * from eProducts where product_mac = 'ACE' and product_visible = '1'");		
	
	while($exAll = $emxTECH->primDB->emx_mysql_fetch_array($queryProduct)) {
		$aLink = $currSiteURL."product_1_".$exAll['product_id'].".html";
		$imageLink = "http://www.acealloywheel.com/".$exAll['product_limage'];
		$paraData1[] = array('<!--VGO PRODUCT_LINK -->' => $aLink,
							 '<!--VGO PRODUCT_IMAGE -->' => $imageLink,
							 '<!--VGO PRODUCT_NAME -->' => $exAll['product_name'],
							 '<!--VGO PRODUCT_CODE -->' => $exAll['product_code'],
							 '<!--VGO PRODUCT_DES -->' => $exAll['product_brief'],
							 'vgo_scenario' => 0);
	}	
	
	print $emxTECH->showTemplateLoopAjax("product", 0, 0, 'content', $paraData, $paraData1);
	
	/*$aLink = $currSiteURL."templates/images/dummy.jpg";
	$paraData1[] = array('<!--VGO PRODUCT_IMAGE -->' => $aLink,
						 'vgo_scenario' => 0);
	$paraData1[] = array('<!--VGO PRODUCT_IMAGE -->' => $aLink,
						 'vgo_scenario' => 0);
	$paraData1[] = array('<!--VGO PRODUCT_IMAGE -->' => $aLink,
						 'vgo_scenario' => 0);
	print $emxTECH->showTemplateLoopAjax("product", 2, 0, 'content', array(), $paraData1);*/
	
?>
