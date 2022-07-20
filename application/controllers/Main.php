<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once(APPPATH . '/vendor/autoload.php');
// use Codenixsv\CoinGeckoApi\CoinGeckoClient;
// $test = new Monarobase\CountryList\CountryList;

class main extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	}

	public function view(){
		$this->load->view('home');
	}

	public function index(){
		$this->load->view('index');
	}

	public function homeView2(){
		$this->load->view('wallet/homeView');
	}

	public function homeView(){
		$this->load->view('wallet/homeView');
	}

	public function homeViewPro(){
		$this->load->view('wallet/homeViewPro');
	}

	public function homeViewNotVerified(){
		$this->load->view('wallet/homeViewNotVerified');
	}

	public function paypaltest(){
		$this->load->view('paypal/paypaltest');
	}

	public function blogSite(){
		$this->load->view('wallet/blogSite');
	}


	public function error(){
		$this->load->view('404Error');
	}

	public function checkLoginCredentials(){
   		$email = $_GET['emailAddress'];
		$mobileNumber = $_GET['mobileNumber'];
   		$userPassInput = $_GET['password'];
   		$ip = $_GET['ip'];
   		$test=null;

		if($email!=''){
			$test = $this->_getRecordsData(
				$selectfields = array("user_tbl.*,trc20_wallet.address as trc20_wallet,bsc_wallet.address as bsc_wallet,erc20_wallet.address as erc20_wallet"), 
				$tables = array('user_tbl','trc20_wallet','bsc_wallet','erc20_wallet'), 
				$fieldName = array('user_tbl.email'), $where = array($email), 
				$join = array('user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array('inner','inner','inner'), $sortBy = null, 
				$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);
		}else{
			$test = $this->_getRecordsData(
				$selectfields = array("user_tbl.*,trc20_wallet.address as trc20_wallet,bsc_wallet.address as bsc_wallet,erc20_wallet.address as erc20_wallet"), 
				$tables = array('user_tbl','trc20_wallet','bsc_wallet','erc20_wallet'), 
				$fieldName = array('user_tbl.mobileNumber'), $where = array($mobileNumber), 
				$join = array('user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array('inner','inner','inner'), $sortBy = null, 
				$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);
		}

   		$wrongFlag = 0;
   		$dataToSend = "";

   		if (count($test) >= 1) {
	    	session_start();
			$dataToSend = $test;

   			if (md5($userPassInput) == $test[0]->password) {
   				if ($test[0]->isBlocked == 1) {
					$wrongFlag = 3;	
					//blocked 
   				}elseif($test[0]->verified == 1){
	   				$dataToSend = $test[0];
	   				$_SESSION["currentUser"] = $dataToSend;
					$wrongFlag = 0;	

					$tableName="user_tbl";
					$fieldName='userID';
					$where=$test[0]->userID;

					$insertRecord = array(
						'ip_lastLogin'=>$ip,
						'lastLoginDate'=>$this->_getTimeStamp()
					);

					$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
					// correct sila
   				}else{
   					$dataToSend = $test[0];
	   				$wrongFlag = 4;
	   				//not verified	
   				}
   			} else {
   				$wrongFlag = 2;
				//means wrong pass
   			}
   		}else{
   			$wrongFlag = 1;
   			//wrong user
   		}
   		
   		echo json_encode(array("errorCode" => '',"wrongFlag" => $wrongFlag,"data"=>$dataToSend));
   		// echo json_encode(array($_GET));
	}

	public function checkEmailAvailability(){
   		$email = $_GET['email'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('user_tbl'), 
	   		$fieldName = array('email'), $where = array($email), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		if (count($test)==0) {
   			echo true;
   		}else{
   			echo false;
   		}
	}

	public function checkIfReferalLinkIsValid(){
   		$referalCode = $_GET['referalCode'];
   		$referType = $_GET['referType'];
   		$table = '';
   		$fieldNameOuter = '';

   		if ($referType=="agent") {
   			$table = "agent_profile_tbl";
   			$fieldNameOuter = 'id';
   		}elseif($referType=="user"){
   			$table = "user_tbl";
   			$fieldNameOuter = 'userID';
   		}
   		
   		$res = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array($table), 
	   		$fieldName = array($fieldNameOuter), $where = array($referalCode), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		if (count($res)==1) {
   			echo json_encode(true);
   		}else{
   			echo json_encode(false);
   		}
	}

	public function checkMobileNumberAvailability(){
		$mobileNumber = $_GET['mobileNumber'];

		$test = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('mobileNumber'), $where = array($mobileNumber), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		if (count($test)==0) {
			echo true;
		}else{
			echo false;
		}
	}

	public function saveSignUpForm(){
		$data = $_GET;

		$insertRecord = array(
			'email' => $data['email'],
			'password' => md5($data['password']),
			'fullname' => $data['fullName'],
			'mobileNumber' => $data['countryCode'].$data['mobileNumber'],
			'timestamp' => $this->_getTimeStamp24Hours(),
			// 'birthday' => $data['birthdate'],
			'verified' => 0,
			'isPro' => 0,//change
			'isStrict' => 1,//change
		);

		if (isset($data['referalCode'])) {
			$insertRecord['referred_user_id'] = $data["referalCode"];
			$insertRecord['referType'] = $data["referType"];
		}

		$saveQueryNotifUserId = $this->_insertRecords($tableName = 'user_tbl', $insertRecord);

		$insertRecord = array(
			'tokenIDSelected' => '1,3,4,19',
			'userID' => $saveQueryNotifUserId,
			'timestamp_edit' => $this->_getTimeStamp(),
		);

		$tokenSelectedRes = $this->_insertRecords($tableName = 'token_selected', $insertRecord);

		if ($tokenSelectedRes) {
			$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8"; // API Key in your account panel
			$password = md5($data['password']);

			// // create wallets
				//TRX
					$ch = curl_init("https://eu.trx.chaingateway.io/v1/newAddress");

					curl_setopt( $ch, CURLOPT_HTTPHEADER, 
						array(
							"Content-Type:application/json",
							"Authorization:".$apikey
						)
					);

					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

					$result = curl_exec($ch);
					$resultdecoded = json_decode($result, true);
					curl_close($ch);

					if ($resultdecoded['ok']==true) {
						$insertRecord = array(
							'privateKey' => $resultdecoded['privatekey'],
							'hexAddress' => $resultdecoded['hexaddress'],
							'address' => $resultdecoded['address'],
							'dateCreated' => $this->_getTimeStamp(),
							'userOwner' => $saveQueryNotifUserId,
						);

						$saveQueryNotif = $this->_insertRecords($tableName = 'trc20_wallet', $insertRecord);
					}else{
						echo json_encode(false);
					}
				//TRX

				//BSC
					$ch = curl_init("https://eu.bsc.chaingateway.io/v1/newAddress");
					$payload = json_encode(
						array(
							"password" => $password,
						) 
					);

					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

					# Return response instead of printing.
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

					$result = curl_exec($ch);
					$resultdecoded = json_decode($result, true);
					curl_close($ch);

					if ($resultdecoded['ok']==true) {
						$insertRecord = array(
							'password' => $resultdecoded['password'],
							'address' => $resultdecoded['binancecoinaddress'],
							'dateCreated' => $this->_getTimeStamp(),
							'userOwner' => $saveQueryNotifUserId,
						);

						$saveQueryNotif = $this->_insertRecords($tableName = 'bsc_wallet', $insertRecord);
					}else{
						echo json_encode(false);
					}
				//BSC

				//ETHER
					$ch = curl_init("https://eu.eth.chaingateway.io/v1/newAddress");
					$payload = json_encode(
						array(
							"password" => $password,
						) 
					);

					curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

					# Return response instead of printing.
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

					$result = curl_exec($ch);
					$resultdecoded = json_decode($result, true);
					curl_close($ch);

					if ($resultdecoded['ok']==true) {
						$insertRecord = array(
							'password' => $resultdecoded['password'],
							'address' => $resultdecoded['ethereumaddress'],
							'dateCreated' => $this->_getTimeStamp(),
							'userOwner' => $saveQueryNotifUserId,
						);

						$saveQueryNotif = $this->_insertRecords($tableName = 'erc20_wallet', $insertRecord);
					}else{
						echo json_encode(false);
					}
				//ETHER
			// // create wallets

			echo json_encode($saveQueryNotifUserId);
		}else{
			echo json_encode(false);
		}
	}
	
	public function quickLoadPage(){
		// if ($this->load->view($_GET['pagename'],'',TRUE)!== ''){
	 //        $this->load->view($_GET['pagename'],'',TRUE);
	 //    } else {
	 //        $this->load->view('404Error');
	 //    }	

	    if (is_file(APPPATH.'views/' . $_GET['pagename'] . EXT))
	    {
	        $this->load->view($_GET['pagename']);
	    } else {
	        $this->load->view('404Error');
	    }	
	}

	public function sendOtp(){
		// {"sid": "SM36795022c27b43d8a33b7dc49e2a0d26", "date_created": "Thu, 07 Jul 2022 18:39:41 +0000", "date_updated": "Thu, 07 Jul 2022 18:39:41 +0000", "date_sent": null, "account_sid": "AC51784290c7fcecfe437a217b6d796bbc", "to": "+639613002479", "from": null, "messaging_service_sid": "MG617e80a04a486d9a00e3fc9bf04e1f50", "body": "This is the body...", "status": "accepted", "num_segments": "0", "num_media": "0", "direction": "outbound-api", "api_version": "2010-04-01", "price": null, "price_unit": null, "error_code": null, "error_message": null, "uri": "/2010-04-01/Accounts/AC51784290c7fcecfe437a217b6d796bbc/Messages/SM36795022c27b43d8a33b7dc49e2a0d26.json", "subresource_uris": {"media": "/2010-04-01/Accounts/AC51784290c7fcecfe437a217b6d796bbc/Messages/SM36795022c27b43d8a33b7dc49e2a0d26/Media.json"}}

		$payload = [
		    'To' => $_GET['mobileNumber'],
		    'MessagingServiceSid' => 'MG617e80a04a486d9a00e3fc9bf04e1f50',
		    'Body' => 'SafelyPal SignUp OTP: '.$_GET['otp']
		];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		curl_setopt($ch, CURLOPT_URL, 'https://api.twilio.com/2010-04-01/Accounts/AC51784290c7fcecfe437a217b6d796bbc/Messages.json');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, 'AC51784290c7fcecfe437a217b6d796bbc' . ':' . 'ea88a2518e7dd83022ac1bd19e9052bf');

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);

		echo $result;
	}

	public function editProfile(){
		// $user_id = $_GET['user_id'];
		$data = $_GET;

		$insertRecord = [];

		if ($data['fullName'] != "") {
			$insertRecord['fullname'] = $data['fullName'];
		}

		if ($data['birthday'] != "") {
			$insertRecord['birthday'] = $data['birthday'];
		}

		foreach ($data as $key => $value) {
			// echo json_encode(array($key,$value));
			if ($value != '' && $key != 'oldPassword') {
				if ($key == "newPassword") {
					$insertRecord['password'] = md5($value);
				}else{
					$insertRecord[$key] = $value;
				}
			}
		}

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$data['userID'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	public function editProfileV2(){
		// $user_id = $_GET['user_id'];
		$data = $_GET;

		$insertRecord = array(
			'fullname' => $data['fullNameEdit'],
			'birthday' => $data['birthdayEdit'],
			'mobileNumber' => $data['mobileNumberEdit']
		);

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$data['userID'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes==1){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	public function checkPasswordMatch(){
		$matchingPassword = $_GET['matchingPassword'];
		$oldPassword = $_GET['oldPassword'];

		if ($oldPassword == md5($matchingPassword)) {
			echo true;
		}else{
			echo false;
		}

		// echo json_encode(array($matchingPassword,$oldPassword));
	}

	public function loadAnnouncement(){
		$id = $_POST['id'];

		$test = $this->_getRecordsData($selectfields = array("*"), 
		$tables = array('announcement_tbl'), 
		$fieldName = array('id'), $where = array($id), 
		$join = null, $joinType = null, $sortBy = null, 
		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );

		echo json_encode($test);
	}

	public function saveNewProfilePic(){
		$response = array();

		foreach ($_FILES as $key => $value) {
			$config['upload_path'] = 'assets/imgs/profile_pic';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES[$key]['name'].'.'.strval(explode("/",$_FILES[$key]['type'])[1]);
			unlink($config['upload_path'].'/'.$_POST['oldPic']);

   			$this->load->library('upload', $config);
   			$this->load->helper("file");

			if(!$this->upload->do_upload($_FILES[$key]['name'])){
				array_push($response, array('error'=>'1','reason'=>'Cant upload to server, please contact admin','more'=>$this->upload->display_errors()));
            }else{  
				$data = $this->upload->data();

				array_push($response, array('error'=>'0','reason'=>'','more'=>''));
			}

			$tableName="user_tbl";
			$fieldName='userID';
			$where=$_POST['userID'];

			$insertRecord = array(
				'profile_pic'=>$config['file_name'],
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

			echo json_encode($response);
		}       		
	}
	
	public function saveFaceImageKyc(){
		$response = array();

		foreach ($_FILES as $key => $value) {
			$config['upload_path'] = 'assets/imgs/kyc-imgs/face-imgs';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES[$key]['name'].'.'.strval(explode("/",$_FILES[$key]['type'])[1]);

			$checkIfExist = $this->_getRecordsData(
				$selectfields = array("*"), 
				$tables = array('kyc_image_tbl'), 
				$fieldName = array('userID'), $where = array($_POST['userID']), 
				$join = null, $joinType = null, $sortBy = null, 
				$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);

			if(count($checkIfExist)==0){
				$insertRecord = array(
					'FaceImagePath'=>$config['file_name'],
					'userID'=>$_POST['userID'],
					'timestamp' => $this->_getTimeStamp24Hours(),
				);

				$insertRecord = $this->_insertRecords($tableName = 'kyc_image_tbl', $insertRecord);
			}else{
				$tableName="kyc_image_tbl";
				$fieldName='userID';
				$where=$_POST['userID'];

				$insertRecord = array(
					'FaceImagePath'=>$config['file_name'],
					'timestamp' => $this->_getTimeStamp24Hours(),
				);
				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				$tableName="user_tbl";
				$fieldName='userID';
				$where=$_POST['userID'];

				$insertRecord = array(
					'verified'=>0,
				);
				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
				

				if ($checkIfExist[0]->FaceImagePath != "") {
					unlink($config['upload_path'].'/'.$_POST['userID'].'_faceImage'.'.'.explode("/",$_FILES[$key]['type'])[1]);
				}

			}

   			$this->load->library('upload', $config);
   			$this->load->helper("file");

			if(!$this->upload->do_upload($_FILES[$key]['name'])){
				array_push($response, array('error'=>'1','reason'=>'Cant upload to server, please contact admin','more'=>$this->upload->display_errors()));
            }else{  
				$data = $this->upload->data();

				array_push($response, array('error'=>'0','reason'=>'','more'=>''));
			}

			echo json_encode($response[0]);
		}       		
	}

	public function saveIDImageKyc(){
		$response = array();

		foreach ($_FILES as $key => $value) {
			$config['upload_path'] = 'assets/imgs/kyc-imgs/id-imgs';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES[$key]['name'].'.'.strval(explode("/",$_FILES[$key]['type'])[1]);

			$checkIfExist = $this->_getRecordsData(
				$selectfields = array("*"), 
				$tables = array('kyc_image_tbl'), 
				$fieldName = array('userID'), $where = array($_POST['userID']), 
				$join = null, $joinType = null, $sortBy = null, 
				$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);

			if(count($checkIfExist)==0){
				$insertRecord = array(
					'IDImagePath'=>$config['file_name'],
					'userID'=>$_POST['userID'],
					'timestamp' => $this->_getTimeStamp24Hours(),
				);
				$insertRecord = $this->_insertRecords($tableName = 'kyc_image_tbl', $insertRecord);
			}else{
				$tableName="kyc_image_tbl";
				$fieldName='userID';
				$where=$_POST['userID'];

				$insertRecord = array(
					'IDImagePath'=>$config['file_name'],
					'timestamp' => $this->_getTimeStamp24Hours(),
				);
				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				$tableName="user_tbl";
				$fieldName='userID';
				$where=$_POST['userID'];

				$insertRecord = array(
					'verified'=>0,
				);
				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);


				if ($checkIfExist[0]->IDImagePath != "") {
					unlink($config['upload_path'].'/'.$_POST['userID'].'_IDImage'.'.'.explode("/",$_FILES[$key]['type'])[1]);
				}

			}


   			$this->load->library('upload', $config);
   			$this->load->helper("file");

			
			if(!$this->upload->do_upload($_FILES[$key]['name'])){
				array_push($response, array('error'=>'1','reason'=>'Cant upload to server, please contact admin','more'=>$this->upload->display_errors()));
            }else{  
				$data = $this->upload->data();

				array_push($response, array('error'=>'0','reason'=>'','more'=>''));
			}

			echo json_encode($response[0]);
			// echo json_encode($insertRecord);
		}       		
	}

	public function confirmPassword(){
   		$password = md5($_GET['password']);
   		$userID = $_GET['currentUser'];

   		$userConfirmPassword = $this->_getRecordsData(
   			$selectfields = array("user_tbl.*"), 
	   		$tables = array('user_tbl'), 
	   		$fieldName = array('password','userID'), $where = array($password,$userID), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		// if (count($userConfirmPassword)==1) {
   		// 	echo true;
   		// }else{
   		// 	echo false;
   		// }

   		echo json_encode(count($userConfirmPassword)==1);
	}

	public function getCurrentPrice(){
		$params =[
		  	'fsym' => $_GET['token'],
		  	'tsyms' => $_GET['currency']
		];

		$endpoint = 'https://min-api.cryptocompare.com/data/price';

		$url = $endpoint . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		$resp = curl_exec($curl);
	    // echo $resp;
	}

	public function getUserTypePriv(){
		$userType = $_POST['userType'];

		$selectfields = "priviledge_tbl.type,priviledge_tbl.desc,priviledge_tbl.descCode,priviledge_tbl.typeParent,priviledge_tbl.priorityNum";

		$test = 
			$this->_getRecordsData($selectfields = array("$selectfields"), 
			$tables = array('usertypepriv_tbl','priviledge_tbl'), 
			$fieldName = array('usertypepriv_tbl.userType'),  $where = array($userType), 
			$join = array('usertypepriv_tbl.priviledgesID = priviledge_tbl.privilegesID'), $joinType = array('inner'), $sortBy = array('type','priorityNum'), 
			$sortOrder = array('desc','asc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

   		echo json_encode($test);
	}

	public function testing(){

		// $apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";
		// $password = "kurusaki13";

		// // $binancecoinaddress = "0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312";

		// // $ch = curl_init("https://eu.bsc.chaingateway.io/v1/exportAddress");

		// // # Setup request to send json via POST. This is where all parameters should be entered.
		// // $payload = json_encode(
		// // 	array(
		// // 		"binancecoinaddress" => $binancecoinaddress,
		// // 		"password" => $password,
		// // 	) 
		// // );

		// // // ea3d45bdae1c295bc1a097dc1e63354755a02a20d1f13d937d50a2a6d2b269f0
		// // // fd84f455da4ad1325cf5bc7beb06bf3052919278c76373a67507aaa68bcebab3


		// // curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		// // curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		// // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		// // $result = curl_exec($ch);
		// // curl_close($ch);

		// echo $result;


		//create wallet
			// # Define function endpoint
			// $ch = curl_init("https://eu.bsc.chaingateway.io/v1/newAddress");

			// # Setup request to send json via POST. This is where all parameters should be entered.
			// $payload = json_encode(
			// 	array(
			// 		"password" => $password,
			// 	) 
			// );
			// curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
			// curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

			// # Return response instead of printing.
			// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			// # Send request.
			// $result = curl_exec($ch);
			// curl_close($ch);

			// echo json_encode($result);

		// $params =[
		//   	'module' => 'account',
		//   	'action' => 'txlist',
		//   	'address' => '0xA1fECDC43c1A5F7aCd387F2b709DAd69975d0Ca8',
		//   	'startblock' => 0,
		//   	'endblock' => 99999999,
		//   	'page' => 1,
		//   	'offset' => 10,
		//   	'sort' => 'desc',
		//   	'apikey' => 'QFT8NW8IFPJ8QEHM8JI5MX1SJCUGZ2IY9H',
		// ];

		// // $params =[
		// //   	'module' => 'account',
		// //   	'action' => 'balance',
		// //   	'address' => '0xA1fECDC43c1A5F7aCd387F2b709DAd69975d0Ca8',
		// //   	'apikey' => 'QFT8NW8IFPJ8QEHM8JI5MX1SJCUGZ2IY9H',
		// // ];

		// $endpoint = 'https://api.bscscan.com/api';

		// $url = $endpoint . '?' . http_build_query($params);
		// $curl = curl_init();
		// curl_setopt($curl, CURLOPT_URL, $url);

		// $resp = curl_exec($curl);
		// // echo $resp;

		// curl_close($curl);

		// $apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8"; // API Key in your account panel
		// $contractaddress = "0xB8c77482e45F1F44dE1745F52C74426C631bDD52"; // Smart contract address of the Token
		// $from = "0x719951c1ff1974fd3879606d08d20e43f03de275"; // Binancecoin address you want to send from (must have been created with Chaingateway.io)
		// $to = "0xA1fECDC43c1A5F7aCd387F2b709DAd69975d0Ca8"; // Receiving Binancecoin address
		// $password = md5("test@123"); // Password of the Binancecoin address (which you specified when you created the address)
		// $amount = 0.0001; // Amount of Tokens to send
		// # -------------------------------------------------------

		# Setup request to send json via POST. This is where all parameters should be entered.
		// $ch = curl_init("https://eu.bsc.chaingateway.io/v1/exportAddress");
		// $ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendBinancecoin");
		// $ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendToken");

		// $payload = json_encode(
		// 	array(
		// 		"to" => $to,
		// 		"from" => $from,
		// 		"password" => $password,
		// 		"amount" => $amount,
		// 		"nonce" => "15",
		// 	) 
		// );

		// $payload = json_encode(array(
		// 	"contractaddress" => $contractaddress,
		// 	"from" => $from,
		// 	"to" => $to,
		// 	"password" => $password,
		// 	"amount" => $amount
		// ));

		// $payload = json_encode(array(
		// 	"binancecoinaddress" => '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312',
		// 	"password" => 'kurusaki13',
		// ));

		// curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		// curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		// # Return response instead of printing.
		// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		// # Send request.
		// $result = curl_exec($ch);
		// curl_close($ch);

		// # Decode the received JSON string
		// $resultDecoded = json_decode($result);

		// # Print the transaction id of the transaction
		// // var_dump($resultDecoded);
		// echo json_encode($resultDecoded->content);

		// use Codenixsv\CoinGeckoApi\CoinGeckoClient;
		// $test = new vendor\coingecko\src\CoinGeckoClient\CoinGeckoClient;
		// echo 'test';

		// M:\xampp v7.4\htdocs\securityWallet\application\vendor\coingecko\src

		// $client = new CoinGeckoClient();
		// $data = $client->ping();

		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";
		$to = "TPuW6CaJ8iSGtvoekkYrc2SeLhCHEvn1GY";
		$privatekey = "283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c";
		$amount = "5";
		$tokenid= "0";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"to" => $to,
				"privatekey" => $privatekey,
				"amount" => $amount,
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-CMC_PRO_API_KEY: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;

		// X-CMC_PRO_API_KEY
	}

	public function getNewNotifs(){
		$userID = $_GET['userID'];

		$notif = 
			$this->_getRecordsData($selectfields = array("*"), 
			$tables = array('notif_center'), 
			$fieldName = array('userID','isViewed'),  $where = array($userID,0), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

   		echo json_encode($notif);
	}

	public function getNewNotifsToViewed(){
		$userID = $_GET['userID'];

		$notif = 
			$this->_getRecordsData($selectfields = array("*"), 
			$tables = array('notif_center'), 
			$fieldName = array('userID','isViewed'),  $where = array($userID,0), 
			$join = null, $joinType = null, $sortBy = array('id'), 
			$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		foreach ($notif as $key => $value) {
			$tableName="notif_center";
			$fieldName='id';
			$where=$value->id;

			$insertRecord = array(
				'isViewed'=>1,
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
		}

   		echo json_encode($notif);
	}

	public function pushNewNotif(){
		$userID = $_GET['userID'];
		$tittle = $_GET['tittle'];
		$content = $_GET['content'];

		$insertRecord = array(
			'userID' => $userID,
			'tittle' => $tittle,
			'content' => $content,
			'dateCreated' => $this->_getTimeStamp24Hours()
		);

		$saveQueryNotifUserId = $this->_insertRecords($tableName = 'notif_center', $insertRecord);

		echo $saveQueryNotifUserId;
	}

	public function makeMeMd5(){
		echo md5($_GET['string']);
	}

	public function saveCredentialEdit(){
		$userID = $_GET['userID'];
		$email = $_GET['email_container'];
		$password = $_GET['password_container'];

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'email'=>$email,
			'password'=>md5($password),
		);

		$updateRecordsRes = $this->_updateRecords(
			$tableName,
			array($fieldName),
			array($where),
			$insertRecord
		); 

   		echo json_encode($updateRecordsRes);
	}

	public function getTokenInfoViaID(){
		$tokenid = $_GET['tokenID'];

		$res = $this->_getRecordsData(
			$selectfields = array("token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,network_reference.network"), 
			$tables = array('token_reference','network_reference'),
			$fieldName = array('token_reference.id'), 
			$where = array($tokenid), 
			$join = array('token_reference.networkId = network_reference.id'), 
			$joinType = array('inner','inner'),
			$sortBy = null, 
			$sortOrder = null, 
			$limit = null, 
			$fieldNameLike = null, 
			$like = null,
			$whereSpecial = null, 
			$groupBy = null 
		);

		echo json_encode($res[0]);
	}

	public function loadCryptoNews(){

		$params =[
		  	'q' => 'bitcoin',
		  	'lang' => 'en',
		  	'page' => '1',
		  	'page_size' => '25',
		];

		$endpoint = 'https://api.bscscan.com/api';

		$url = $endpoint . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'x-rapidapi-key: f507486caemsha13c4fe752c8b0ap13cb81jsna5def341fe2a',
		    'x-rapidapi-host: free-news.p.rapidapi.com'
		));

		$resp = curl_exec($curl);
		// echo $resp;

		curl_close($curl);
	}

	public function referalLink(){
		$this->load->view('index');
	}

	public function sendOTPViaEmail(){
		$email = $_GET['email'];

		require APPPATH.'third_party/phpmailer/src/exemption.php';
		require APPPATH.'third_party/phpmailer/src/phpmailer.php';
		require APPPATH.'third_party/phpmailer/src/smtp.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		
        $mail->IsSMTP();
		$mail->SMTPAuth=false;
		$mail->SMTPSecure = 'tls'; 
		$mail->SMTPDebug = 2;
        $mail->Host = 'localhost';
        $mail->Port = '587';
        $mail->Username='marvin.developer@waweb.online';
		$mail->Password='kurusaki13';
		
		$mail->setFrom('marvin.developer@waweb.online','SafetyPal Mailer');
		$mail->addAddress($email);
		// $mail->addReplyTo($email,'marvin.developer@waweb.online');
		
		$mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->isHTML(true);
		$mail->Subject='SafelyPal - Mailer';
    
		$mail->Body=
		'<html>'.
			'<head>'.
			'</head>'.
			'<body>'.
				'<div>'.
					'<div style="background-color: #aea9b3; padding: 10px">'.

						'<div style="width: 550px; border-radius:20px 20px 0px 0px ; background-color: #9327f8; margin:auto; padding: 20px">'.
							'<div style="color: #fff; text-align: center;">'.
								'<div style="font-weight: bold; font-size: 3em;">Welcome to SafetyPal!</div>'.
							'</div>'.
						'</div>'.

						'<div style="height: 350px; width: 550px; background-color: #fff; border-radius: 0px 0px 20px 20px; margin:auto; padding: 20px">'.
							'<div style="text-align: center;">'.
								'<img src="http://testingcenter.xyz/assets/imgs/Email_OTP.png" style="height:100px; width: 100px;margin-top: 50px;">'.
								'<h1 style="color: #9327f8; font-family: Poppins, sans-serif;">'.
								    'Verify your Account'.
								'</h1>'.
								'<h3 style="color: #aea9b3;">Here is your One Time Password '.
				                'to validate your account</h3>'.
								'<p style="font-size: 2em; letter-spacing: 5px; font-weight: bold; border: 1px solid #9327f8; width: 50%; margin:auto; border-radius: 20px;">'.$_GET["otp"].'</p>'.
							'</div>'.
						'</div>'.

					'</div>'.
				'</div>'.
			'</body>'.
		'</html>';
		

		$resultsArray = array();
		

		if(!$mail->send()){
		  	$resultsArray['successEmail'] = false;
		}else{
		  	$resultsArray['successEmail'] = true;
		}


		echo json_encode($resultsArray);

		// echo json_encode(array(
		// 	"successEmail"=>false,
		// 	"successSave"=>false,
		// ));
		exit();
	}

	public function sendSMS(){
		$endpoint = 'https://api.twilio.com/2010-04-01/Accounts/AC51784290c7fcecfe437a217b6d796bbc/Messages.json';

		$url = $endpoint;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		   '--data-urlencode: To=+639613002479',
		   '--data-urlencode: MessagingServiceSid=MG617e80a04a486d9a00e3fc9bf04e1f50',
		   '--data-urlencode: Body=test',
		   '--data-urlencode: From=+19896013789',
		   '-u AC51784290c7fcecfe437a217b6d796bbc:ea88a2518e7dd83022ac1bd19e9052bf'
		));

		$resp = curl_exec($curl);

		echo $curl;
	}

	public function saveBirthday(){
		$birthday = $_GET['birthday'];
		$userID = $_GET['userID'];

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'birthday'=>$birthday,
		);

		$updateRecordsRes = $this->_updateRecords(
			$tableName,
			array($fieldName),
			array($where),
			$insertRecord
		); 

		if ($updateRecordsRes != 1) {
   			echo false;
		}else{
   			echo true;
		}
	}

	public function saveCountry(){
		$country = $_GET['country'];
		$userID = $_GET['userID'];

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'country'=>$country,
		);

		$updateRecordsRes = $this->_updateRecords(
			$tableName,
			array($fieldName),
			array($where),
			$insertRecord
		); 

		if ($updateRecordsRes != 1) {
   			echo false;
		}else{
   			echo true;
		}
	}

	public function saveName(){
		$fullname = $_GET['fullname'];
		$userID = $_GET['userID'];

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'fullname'=>$fullname,
		);

		$updateRecordsRes = $this->_updateRecords(
			$tableName,
			array($fieldName),
			array($where),
			$insertRecord
		); 

		if ($updateRecordsRes != 1) {
   			echo false;
		}else{
   			echo true;
		}
	}

	

	

	public function getUserInvites(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('referType','referred_user_id'), $where = array('user',$_GET['userID']), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($res);
	}

	public function privacyPolicy(){
		$this->load->view('pricvacy_policy');
	}

	public function termsAndConditions(){
		$this->load->view('terms');
	}

	public function cameraTest(){
		$this->load->view('cameraTest');
	}

	public function checkIfKYCPhotoExists(){
		$checkIfExist = $this->_getRecordsData(
			$selectfields = array("kyc_image_tbl.*,user_tbl.birthday,user_tbl.fullname,user_tbl.verified,user_tbl.isPro,user_tbl.country"), 
			$tables = array('user_tbl','kyc_image_tbl'), 
			$fieldName = array('user_tbl.userID'), $where = array($_GET['userID']), 
			$join = array("user_tbl.userID = kyc_image_tbl.userID"), $joinType = array("left"), $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		if (count($checkIfExist)>=1) {
			echo json_encode($checkIfExist[0]);
		}else{
			echo json_encode(false);
		}

	}

	public function saveLastAllTokenValue(){
		$tableName="user_tbl";
		$fieldName='userID';
		$where=$_GET['userID'];
		
		$insertRecord = array(
			'lastAllTokenValue'=>$_GET['value'],
			'lastTokenCurrency'=>$_GET['currency'],
			'lastUpdatedTokenValue'=>$this->_getTimeStamp()
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	public function getLastAllTokenValue(){
		$getLastAllTokenValue = $this->_getRecordsData(
			$selectfields = array("user_tbl.*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('user_tbl.userID'), $where = array($_GET['userID']), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($getLastAllTokenValue[0]);
	}


	public function checkIfReferalCodeIsValid(){
   		$referalCode = $_GET['referalCode'];

   		if (strpos($referalCode,"@")) {
	   		$test = $this->_getRecordsData(
	   			$selectfields = array("*"), 
		   		$tables = array('user_tbl'), 
		   		$fieldName = array('email'), $where = array($referalCode), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
	   		);

	   		if (count($test)==1) {
	   			echo json_encode(array(true,$test[0]->userID));
	   		}else{
	   			echo json_encode(array(false,null));
	   		}
   		}else{
	   		$test = $this->_getRecordsData(
	   			$selectfields = array("*"), 
		   		$tables = array('agent_profile_tbl'), 
		   		$fieldName = array('username'), $where = array($referalCode), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
	   		);

	   		if (count($test)==1) {
	   			echo json_encode(array(true,$test[0]->id));
	   		}else{
	   			echo json_encode(array(false,null));
	   		}
   		}
   		
	}

}
