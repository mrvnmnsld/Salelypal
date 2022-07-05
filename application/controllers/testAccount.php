<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once(APPPATH . '/vendor/autoload.php');
// use Codenixsv\CoinGeckoApi\CoinGeckoClient;
// $test = new Monarobase\CountryList\CountryList;

class testAccount extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	}

	public function index(){
		$this->load->view('testAccount/index');
	}

	public function wallet(){
		$this->load->view('testAccount/wallet');
	}

	public function getTestAccount(){
   		$users = $this->_getRecordsData(
   			$selectfields = array('test_accounts_tbl.*'), 
	   		$tables = array('test_accounts_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = array('userID'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($users);
    }

    public function saveNewAccount(){
		$insertRecord = array(
			'username' => $_GET['username'],
			'password' => MD5($_GET['password']),
			'dateCreated' => $this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'test_accounts_tbl', $insertRecord);

		if($saveQueryNotif){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

    public function checkUserNameAvailability(){
   		$username = $_GET['username'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('test_accounts_tbl'), 
	   		$fieldName = array('username'), $where = array($username), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		if (count($test)==0) {
   			echo true;
   		}else{
   			echo false;
   		}
	}

	public function updateAccountInfo(){
		$insertRecord = array(
			'username' => $_GET['username'],
		);

		if ($_GET['password']!="") {
			$insertRecord['password'] = MD5($_GET['password']);
		}

		$tableName="test_accounts_tbl";
		$fieldName='userID';
		$where= $_GET['userID'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}
	

	public function deleteAccount(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "test_accounts_tbl",
		 	$fieldName = array("userID"),
		  	$where = array($_GET['userID'])
		);
		echo json_encode($deleteQuery);
	}


	public function getTronBalance(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_token_bal_tbl'),
	   		$fieldName = array('token','userID'), 
	   		$where = array('trx',$_GET['userID']), 
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
				'token' => 'trx',
				'balance' => 0,
				'userID' => $_GET['userID'],
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_token_bal_tbl', $insertRecord);

			echo json_encode(array(
				"balance"=>"0"
			));
		}else{
			echo json_encode($selectedTokens[0]);
		}
	}

	public function getBinancecoinBalance(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_token_bal_tbl'),
	   		$fieldName = array('token','userID'), 
	   		$where = array('bnb',$_GET['userID']), 
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
				'token' => 'bnb',
				'balance' => 0,
				'userID' => $_GET['userID'],
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_token_bal_tbl', $insertRecord);

			echo json_encode(array(
				"balance"=>"0"
			));
		}else{
			echo json_encode($selectedTokens[0]);
		}
	}

	public function getEthereumBalance(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('test_account_token_bal_tbl'),
			$fieldName = array('token','userID'), 
			$where = array('eth',$_GET['userID']), 
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
				'token' => 'eth',
				'balance' => 0,
				'userID' => $_GET['userID'],
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_token_bal_tbl', $insertRecord);

			echo json_encode(array(
				"balance"=>"0"
			));
		}else{
			echo json_encode($selectedTokens[0]);
		}
	}

	public function getTokenBalanceBySmartAddress(){
		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_token_bal_tbl'),
	   		$fieldName = array('smartContract',"userID"), 
	   		$where = array($_GET['contractaddress'],$_GET['userID']), 
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
				'userID' => $_GET['userID']
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_token_bal_tbl', $insertRecord);

			echo json_encode(array(
				"balance"=>"0"
			));
		}else{
			echo json_encode($selectedTokens[0]);
		}
	}

	public function updateNewBalance(){
		$balance=0;
		$updateRecordsRes=0;

		if ($_GET['balance']!='null'||$_GET['balance']!='') {
			$balance=$_GET['balance'];
		}

		$insertRecord = array(
			'balance' => $balance,
		);

		if ($_GET['smartContract']!='null') {
			$updateRecordsRes = $this->_updateRecords("test_account_token_bal_tbl",array('userID','smartContract'), array($_GET['userID'],$_GET['smartContract']), $insertRecord);
		}else{
			$updateRecordsRes = $this->_updateRecords("test_account_token_bal_tbl",array('userID','token'), array($_GET['userID'],$_GET['tokenName']), $insertRecord);
		}

		echo $updateRecordsRes;
	}

	public function checkLoginCredentials(){
   		$username = $_GET['username'];
   		$userPassInput = $_GET['password'];

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('test_accounts_tbl'), 
			$fieldName = array('test_accounts_tbl.username'), $where = array($username), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

   		$wrongFlag = 0;
   		$dataToSend = "";

   		if (count($res) >= 1) {
	    	session_start();
			$dataToSend = $res;

   			if (md5($userPassInput) == $res[0]->password) {
   				$dataToSend = $res[0];
   				$_SESSION["currentUser"] = $dataToSend;
				$wrongFlag = 0;	
				// correct sila
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

	public function getAllSelectedTokensVer2(){
		$tokenSelectedTable = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_accounts_token_selected'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		// echo json_encode($test);
		
		$selectfieldsString = '';

		foreach (explode(",", $tokenSelectedTable[0]->tokenIDSelected) as $value) {
			if ($selectfieldsString == '') {
				$selectfieldsString = 'token_reference.id ='.$value;
			}else{
				$selectfieldsString = $selectfieldsString.' OR token_reference.id ='.$value;

			}
		}

		$selectedTokens = $this->_getRecordsData(
			$selectfields = array("token_reference.*,network_reference.network as networkName"), 
	   		$tables = array('token_reference','network_reference'),
	   		$fieldName = null, $where = null, 
	   		$join = array('token_reference.networkID = network_reference.id'), $joinType = array('inner'),
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = array($selectfieldsString), $groupBy = null 
		);

		echo json_encode($selectedTokens);
	}

	public function getClosedRiseFallPositions(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_risefall_positions'),
	   		$fieldName = array('userID','tradePair'), $where = array($_GET['userID'],$_GET['tradePair']), 
	   		$join = null, $joinType = null,
	   		$sortBy = array('id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = array("status != 'PENDING'"), 
	   		$groupBy = null 
		);

		echo json_encode(array_slice($res, 0, 10));
	}

	public function getNewNotifs(){
		$userID = $_GET['userID'];

		$notif = 
			$this->_getRecordsData($selectfields = array("*"), 
			$tables = array('test_account_notif_center'), 
			$fieldName = array('userID','isViewed'),  $where = array($userID,0), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		
   		echo json_encode($notif);
	}

	public function getBettingSettings(){
   		$res = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('test_account_contract_settings_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($res);
	}

	public function getFutureRisefallTimings(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_risefall_timings'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = null,	 
	   		$joinType = null,
	   		$sortBy = array("id"), 
	   		$sortOrder = array('asc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}


	

	



}
