<?php
// ===========================================================================================
// ECOMMAX TECH engine - CLASSES v2.0
// created at Feb, 2014
// ===========================================================================================

// *******************************************************************************************
// 
// implements ECOMMAX - BASE objectde
//
// *******************************************************************************************
class ecomBase extends ecomAtom {
	private $custProfile;
	
	public function __construct($sess_name) {
        parent::__construct($sess_name); // Call the parent class's constructor
		// implement new initial setup HERE
		
		if($this->primSess->emx_sess_registered('cust_profile')) {
			// restore session variable to $custProfile
			$this->custProfile = $this->primSess->emx_sess_get('cust_profile');
		}else {
			// initial $custProfile
			$this->custProfile = array();
		}
    }

	// ===========================================================================================
	// define Login/Sign-in/Logout methods
	// ===========================================================================================
	public function emx_account_login($user_id, $user_pass) {
		$stringXML = file_get_contents(OUTSRC_URL."login_remote.php?uid=".urlencode($user_id)."&pass=".urlencode($user_pass));
		
		$rtnData = $this->emx_xml_to_array($stringXML);
		if($rtnData['result'] == "ok") {
			// store customer profile in the session
			$this->custProfile = array('customer_id' => $rtnData['data']['customer_id']
						,'customer_firstname' => $rtnData['data']['customer_firstname']
						,'customer_company' => $rtnData['data']['customer_company']
						,'customer_btype' => $rtnData['data']['customer_btype']
						,'customer_discount' => $rtnData['data']['customer_discount']
						,'customer_billing_id' => $rtnData['data']['billing_id']
						,'customer_shipping_id' => $rtnData['data']['shipping_id']
			);
			
			$this->primSess->emx_sess_set('cust_profile', $this->custProfile);
			
			return true;
		}else {
			return false;
		}
	}

	public function emx_is_login() {
		if($this->primSess->emx_sess_registered('cust_profile')) {
			return $this->custProfile;
		}
		
		return false;
	}

	public function emx_account_logout() {
		if($this->primSess->emx_sess_registered('cust_profile')) {
			$this->custProfile = array();
			$this->primSess->emx_sess_terminate();
			$this->primSess->emx_sess_unrgister('cust_profile');
		}
		
		return true;
	}

}
?>
