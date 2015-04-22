<?php
// ***********************************************
// VGO E-Commerce system template v1.0
// Designed by: Patrick Fan-Chiang
// Date: 04/15/2004
// ***********************************************
//define('INCL_CUSTLIBS', "");
//define('DECLARE_CLASS', "");
define('INCL_CUSTLIBS', "ecom_catalog.php");
define('DECLARE_CLASS', "ecomCatalog");
require('/home/storegm4/includes/kaneiusa/init_site.php');

$emxTECH->loadMainLayout('main_layout');

// get the infomation, including layout defines and meta tags
// this file should includes <html><head><body> tags, see sample at index_key.html
$layoutKey = $emxTECH->readKeyHTML('index_key.html');

// include extra css style sheet file and javascript HERE
$mExtraCSS = '<link type="text/css" href="'.TEMPLATES_DIR.'css/style2.css" rel="stylesheet" />'."\n";
$mExtraCSS .= '<link type="text/css" href="'.TEMPLATES_DIR.'css/magnific-popup.css" rel="stylesheet" />'."\n";
$mExtraJS = '<script src="'.TEMPLATES_DIR.'js/ace.js" type="text/javascript"></script>'."\n";
$mExtraJS .= '<script src="'.TEMPLATES_DIR.'js/jquery.magnific-popup.min.js" type="text/javascript"></script>'."\n";
$mExtraJS .= '<script src="'.TEMPLATES_DIR.'js/vgo_ajax3.js" type="text/javascript"></script>'."\n";

$parseKey = array("<!--VGO PAGE_TITLE -->" => PAGE_TITLE
			,"<!--VGO META_KEYWORD -->" => META_KEYWORD
			,"<!--VGO TEMPLATES_DIR -->" => TEMPLATES_DIR
			,"<!--VGO META_DESCRIPTION -->" => META_DESCRIPTION
			,"<!--VGO EXTRA_CSS_LINK -->" => $mExtraCSS
			,"<!--VGO EXTRA_JS_LINK -->" => $mExtraJS
);

// load HTML Page Header portion
echo $emxTECH->displayPageHeader($layoutKey['header'], $parseKey);

// load HTML Page Main Content portion
// reset loading main content PHP script, default: site_main.php
$emxTECH->setSiteMainScript('site_main.php');
// $emxTECH->setSiteLeftScript('site_main.php');
// $emxTECH->setSiteRightScript('site_main.php');
// $emxTECH->setSiteHeaderScript('site_main.php');
// $emxTECH->setSiteFooterScript('site_main.php');

echo $emxTECH->displayPageMain();

// load HTML Page Footer portion
echo $emxTECH->displayPageFooter($layoutKey['footer'], $parseKey);
?>
