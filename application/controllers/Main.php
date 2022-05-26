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
		$this->load->view('wallet/index2');
	}

	public function homeView(){
		$this->load->view('wallet/index');
	}

	//arl_05-22-22 homeViewPro
	public function homeViewPro(){
		$this->load->view('wallet/indexPro');
	}

	public function paypaltest(){
		$this->load->view('paypal/paypaltest');
	}

	public function error(){
		$this->load->view('404Error');
	}

	public function checkLoginCredentials(){
   		$email = $_GET['emailAddress'];
   		$userPassInput = $_GET['password'];
   		$ip = $_GET['ip'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("user_tbl.*,trc20_wallet.address as trc20_wallet,bsc_wallet.address as bsc_wallet,erc20_wallet.address as erc20_wallet"), 
	   		$tables = array('user_tbl','trc20_wallet','bsc_wallet','erc20_wallet'), 
	   		$fieldName = array('user_tbl.email'), $where = array($email), 
	   		$join = array('user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array('inner','inner','inner'), $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		$wrongFlag = 0;
   		$dataToSend = "";

   		if (count($test) == 1) {
	    	session_start();

   			if (md5($userPassInput) == $test[0]->password) {
   				if ($test[0]->isBlocked == 1) {
					$wrongFlag = 3;	
					//not verified 
   				}else{
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

	public function saveSignUpForm(){
		$data = $_GET;

		if (isset($data['network'])) {
			$networks = explode(',', $data['network']);
		}

		$insertRecord = array(
			'email' => $data['email'],
			'password' => md5($data['password']),
			'fullname' => $data['fullName'],
			'timestamp' => $this->_getTimeStamp(),
			'birthday' => $data['birthdate'],
			'verified' => 1,
		);

		$saveQueryNotifUserId = $this->_insertRecords($tableName = 'user_tbl', $insertRecord);

		if ($saveQueryNotifUserId) {
			$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8"; // API Key in your account panel
			$password = md5($data['password']);


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

					echo json_encode(true);
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
						'address' => $resultdecoded['binancecoinaddress'],
						'dateCreated' => $this->_getTimeStamp(),
						'userOwner' => $saveQueryNotifUserId,
					);

					$saveQueryNotif = $this->_insertRecords($tableName = 'erc20_wallet', $insertRecord);

					echo json_encode(true);
				}else{
					echo json_encode(false);
				}
			//ETHER
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
		require_once(APPPATH . '/vendor/autoload.php');

		\SMSGlobal\Credentials::set('6160b90bef96d3e7cffbc810c81294e6', 'dd9d942a06b4bc599aaf2ec7ac6e2fdc');

		$sms = new \SMSGlobal\Resource\Sms();
		$generatedOtp = $_GET['generatedOtp'];
		$destination = $_GET['destination'];

		try {
		    $response = $sms->sendToOne($destination, 'This is your OTP for signing up in Application Name /n/n '.$generatedOtp);
		    echo $response;
		} catch (\Exception $e) {
		    echo $e->getMessage();
		}
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
		foreach ($_FILES as $key => $value) {
			$config['upload_path'] = 'assets/imgs/profle_pic';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES[$key]['name'].'.'.strval(explode("/",$_FILES[$key]['type'])[1]);
			unlink($config['upload_path'].'/'.$_POST['oldPic']);

   			$this->load->library('upload', $config);
   			$this->load->helper("file");

			if(!$this->upload->do_upload($_FILES[$key]['name'])){
				array_push($response, array('ERROR'=>'1','Reason'=>'Cant upload to server, please contact admin','MORE'=>$this->upload->display_errors(),$exif));
            }else{  
				$data = $this->upload->data();
			}

			$tableName="user_tbl";
			$fieldName='userID';
			$where=$_POST['userID'];

			$insertRecord = array(
				'profile_pic'=>$config['file_name'],
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

			echo json_encode($config['file_name']);
			// echo json_encode($_POST['oldPic']);
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

		// foreach ($notif as $key => $value) {
		// 	$tableName="notif_center";
		// 	$fieldName='id';
		// 	$where=$value->id;

		// 	$insertRecord = array(
		// 		'isViewed'=>1,
		// 	);

		// 	$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
		// }

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

	

	


	

	


	


	
}
