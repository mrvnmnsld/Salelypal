<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class testPlatform extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	    // $_SESSION['networkId'] = $res['networkId'];
	    // session_destroy();
	}
	public function indexNormal(){
		$this->load->view('wallet/test-platform/index');
	}	
	//arl_05-19-22

		public function indexPro(){
			$this->load->view('wallet/test-platform/index-pro');
		}
	//arl_05-19-22	


	public function getTronBalance(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_platform_token_balance'),
	   		$fieldName = array('token'), 
	   		$where = array('trx'), 
	   		$join = null, 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($selectedTokens[0]);
	}

	public function getBinancecoinBalance(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_platform_token_balance'),
	   		$fieldName = array('token'), 
	   		$where = array('bnb'), 
	   		$join = null, 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($selectedTokens[0]);
	}

	public function getEthereumBalance(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_platform_token_balance'),
	   		$fieldName = array('token'), 
	   		$where = array('eth'), 
	   		$join = null, 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($selectedTokens[0]);
	}

	public function getTokenBalanceBySmartAddress(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_platform_token_balance'),
	   		$fieldName = array('smartContract'), 
	   		$where = array($_GET['contractaddress']), 
	   		$join = null, 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		if (count($selectedTokens)==0) {
			$insertRecord = array(
				'smartContract' => $_GET['contractaddress'],
				'balance' => 0,
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'test_platform_token_balance', $insertRecord);

			echo json_encode(array(
				"balance"=>"0"
			));
		}else{
			echo json_encode($selectedTokens[0]);
		}
	}
	
	public function riseFallWinPosition(){
		$newIncome = $_GET['newIncome'];
		$amountStaked = $_GET['amountStaked'];
		$amountUsdt = $_GET['amountUsdt'];

		$newBalance = $amountUsdt+$amountStaked+$newIncome;

		$tableName="test_platform_token_balance";
		$fieldName='smartContract';
		$where='TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t';

		$insertRecord = array(
			'balance'=>$newBalance,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function riseFallOpenPosition(){
		$amountStaked = $_GET['amountStaked'];
		$totalAvailAmount = $_GET['totalAvailAmount'];

		$newAmount = $totalAvailAmount-$amountStaked;

		$tableName="test_platform_token_balance";
		$fieldName='smartContract';
		$where='TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t';

		$insertRecord = array(
			'balance'=>$newAmount,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function futureWinPosition(){
		$amountStaked = $_GET['amountStaked'];
		$amountUsdt = $_GET['amountUsdt'];

		$newBalance = $amountUsdt+$amountStaked;

		$tableName="test_platform_token_balance";
		$fieldName='smartContract';
		$where='TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t';

		$insertRecord = array(
			'balance'=>$newBalance,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function getUserPurchase(){
		$userID =  $_GET['userID'];

		$purchaseHistory = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_platform_buy_crypto_history_tbl'), 
	   		$fieldName = array('userID'), $where = array($userID), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($purchaseHistory);
	}

	public function buyCrypto(){
		$postValues = $_POST;
		$tokenArray = $postValues["tokenArray"];

		$insertRecord = array(
			'amountPaid' => $postValues['amountPaid'],
			'referenceID' => $postValues['referenceID'],
			'token' => $postValues['token'],
			'tokenValue' => $postValues['tokenValue'],
			'userID' => $postValues['userID'],
			'amountBought' => $postValues['amountBought'],
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'test_platform_buy_crypto_history_tbl', $insertRecord);

		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_platform_token_balance'),
	   		$fieldName = array('smartContract'), 
	   		$where = array($tokenArray[2]), 
	   		$join = null, 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		if (count($selectedTokens)==0) {
			$insertRecord = array(
				'smartContract' => $tokenArray[2],
				'balance' => $postValues['amountBought'],
				'token' => $tokenArray[0],
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'test_platform_token_balance', $insertRecord);
		}else{
			$tableName="test_platform_token_balance";
			$fieldName='smartContract';
			$where=$tokenArray[2];

			$insertRecord = array(
				'balance'=>$selectedTokens[0]->balance+$postValues['amountPaid'],
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
		}
	}

	public function newBalance(){
		// echo $_GET['tokenName']."<br>";
		if ($_GET['smartAddress']==null||$_GET['smartAddress']=='null') {
			$tableName="test_platform_token_balance";
			$fieldName='token';
			$where=$_GET['tokenName'];

			$insertRecord = array(
				'balance'=>$_GET['newAmount'],
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

			if ($updateRecordsRes) {
				echo true;
			}else{
				echo false;
			}
		}else if($_GET['smartAddress']!=null){
			$tableName="test_platform_token_balance";
			$fieldName='smartContract';
			$where=$_GET['smartAddress'];

			$insertRecord = array(
				'balance'=>$_GET['newAmount'],
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

			if ($updateRecordsRes) {
				echo true;
			}else{
				echo false;
			}
		}		
	}

	// get data from database
	public function getUsers(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('user_tbl'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = null,	 
	   		$joinType = null,
	   		$sortBy = array("userID"), 
	   		$sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		// $md5Password = MD5($_GET["password"]);
		// $password = $_GET['password'];
		// $passwordMd5 = $res[0]->password;

		// if (MD5($password)==$res[0]->password) {
		// 	echo
		// }

		echo json_encode($res);
	}

	// save new user
	public function saveNewUser(){
		$insertRecord = array(
			'email' => $_GET['email'],
			'fullname' => $_GET['fullname'],
			'password' => $_GET['password'],
			'birthday' => $_GET['birthday'],
			'mobileNumber' => $_GET['mobilenumber'],
			'timestamp' => $this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'user_tbl', $insertRecord);

		if($saveQueryNotif){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}

	
	}
	//delete
	public function deleteUser(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "user_tbl",
		 	$fieldName = array("userID"),
		  	$where = array($_GET['userID'])
		);


		echo json_encode($deleteQuery);
	}
	//update user
	public function updateUserInfo(){
		$insertRecord = array(
			'email' => $_GET['email'],
			'fullname' => $_GET['fullname'],
			'password' => $_GET['password'],
			'birthday' => $_GET['birthday'],
			'mobileNumber' => $_GET['mobilenumber']
		);

		$tableName="user_tbl";
		$fieldName='userID';
		$where= $_GET['userID'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}
	//compare email
	public function compareEmailUpdate(){
   		$email = $_GET['email'];
   		$currentEmail = $_GET['currentEmail'];

   		// echo json_encode(array($email,$currentEmail,$email == $currentEmail));

   		if ($email == $currentEmail){
   			echo true;
   		}else{
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

   		
	}
	


	

}
