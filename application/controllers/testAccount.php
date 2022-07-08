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

		$insertRecord = array(
			'tokenIDSelected' => '1,3,4,11',
			'userID' => $saveQueryNotif,
			'timestamp_edit' => $this->_getTimeStamp(),
		);

		$tokenSelectedRes = $this->_insertRecords($tableName = 'test_accounts_token_selected', $insertRecord);

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

		if ($_GET['smartContract']=='null'||$_GET['smartContract']==''||$_GET['smartContract']==null) {
			$updateRecordsRes = $this->_updateRecords("test_account_token_bal_tbl",array('userID','token'), array($_GET['userID'],$_GET['tokenName']), $insertRecord);

		}elseif($_GET['tokenName']=='null'||$_GET['tokenName']==''||$_GET['tokenName']==null){
			$updateRecordsRes = $this->_updateRecords("test_account_token_bal_tbl",array('userID','smartContract'), array($_GET['userID'],$_GET['smartContract']), $insertRecord);
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

	public function futureSaveRiseFallPosition(){
		$income = $_GET["income"];
		$timeStamp = $_GET["timeStamp"];
		$amount = $_GET["amount"];
		$currentPrice = $_GET["currentPrice"];
		$buyType = $_GET["buyType"];
		$userID = $_GET["userID"];
		$tradePair = $_GET["tradePair"];
		$status = $_GET["status"];

		$insertRecord = array(
			'tradePair'=>$tradePair,
			'income'=>$income,
			'timeStamp'=>$timeStamp,
			'amount'=>$amount,
			'currentPrice'=>$currentPrice,
			'buyType'=>$buyType,
			'userID'=>$userID,
			'status'=>$status,
			'dateCreated'=>$this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_future_risefall_positions', $insertRecord);
		
		if ($saveQueryNotif) {
			echo $saveQueryNotif;
		}else{
			echo false;
		}
	}

	public function risefallGetPositionDetails(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_risefall_positions'),
	   		$fieldName = array('id'), $where = array($_GET['id']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function resolveRiseFallPosition(){
		$id = $_GET['id'];
		$resolvedPrice = $_GET['resolvedPrice'];
		$status = $_GET['status'];

		$tableName="test_account_future_risefall_positions";
		$fieldName='id';
		$where=$id;

		$insertRecord = array(
			'status'=>$status,
			'resolvedPrice'=>$resolvedPrice,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function checkIfRisefallSet(){
		$res = $this->_getRecordsData(
			$selectfields = array("test_account_future_risefall_positions.*,test_account_set_risefall_position.id AS setID"), 
	   		$tables = array('test_account_set_risefall_position','test_account_future_risefall_positions'),
	   		$fieldName = array('test_account_set_risefall_position.position_id'), 
	   		$where = array($_GET['id']), 
	   		$join = array('test_account_set_risefall_position.position_id = test_account_future_risefall_positions.id'), 
	   		$joinType = array("inner"),
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		if (count($res)==0) {
			echo json_encode(false);
		}else{
			for ($i=0; $i < count($res); $i++) { 
				$deleteQuery = $this->_deleteRecords(
					$tableName = "test_account_set_risefall_position",
				 	$fieldName = array("id"),
				  	$where = array($res[$i]->setID)
				);
			}

			echo json_encode($res);
		}
	}

	public function futureGetClosedPositions(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_positions'),
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

	public function futureSavePosition(){
		$riskPrice = $_GET["riskPrice"];
		$timeStamp = $_GET["timeStamp"];
		$amount = $_GET["amount"];
		$currentPrice = $_GET["currentPrice"];
		$positionType = $_GET["positionType"];
		$userID = $_GET["userID"];
		$tradePair = $_GET["tradePair"];
		$status = $_GET["status"];

		$insertRecord = array(
			'tradePair'=>$tradePair,
			'riskPrice'=>$riskPrice,
			'timeStamp'=>$timeStamp,
			'amount'=>$amount,
			'currentPrice'=>$currentPrice,
			'positionType'=>$positionType,
			'userID'=>$userID,
			'status'=>$status,
			'dateCreated'=>$this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_future_positions', $insertRecord);
		
		if ($saveQueryNotif) {
			echo $saveQueryNotif;
		}else{
			echo false;
		}
	}	

	public function futureCheckIfSet(){
		$res = $this->_getRecordsData(
			$selectfields = array("test_account_future_positions.*,test_account_set_contract_position.id AS setID"), 
	   		$tables = array('test_account_set_contract_position','test_account_future_positions'),
	   		$fieldName = array('test_account_set_contract_position.position_id'), 
	   		$where = array($_GET['id']),
	   		$join = array('test_account_set_contract_position.position_id = test_account_future_positions.id'), 
	   		$joinType = array("inner"),
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		if (count($res)==0) {
			echo json_encode(false);
		}else{
			for ($i=0; $i < count($res); $i++) { 
				$deleteQuery = $this->_deleteRecords(
					$tableName = "test_account_set_contract_position",
				 	$fieldName = array("id"),
				  	$where = array($res[$i]->setID)
				);
			}

			echo json_encode($res);
		}
	}

	public function futureGetPositionDetails(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_positions'),
	   		$fieldName = array('id'), $where = array($_GET['id']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getNewNotifsToViewed(){
		$userID = $_GET['userID'];

		$notif = 
			$this->_getRecordsData($selectfields = array("*"), 
			$tables = array('test_account_notif_center'), 
			$fieldName = array('userID','isViewed'),  $where = array($userID,0), 
			$join = null, $joinType = null, $sortBy = array('id'), 
			$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		foreach ($notif as $key => $value) {
			$tableName="test_account_notif_center";
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

		$saveQueryNotifUserId = $this->_insertRecords($tableName = 'test_account_notif_center', $insertRecord);

		echo $saveQueryNotifUserId;
	}

	public function getAllSelectedTokens(){
		$test = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_accounts_token_selected'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		echo json_encode($test);
	}

	public function updateTokenManagement(){
		$tokenIDSelected = $_GET['tokenIDSelected'];
		$userID = $_GET['userID'];

		$tableName="test_accounts_token_selected";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'tokenIDSelected'=>$tokenIDSelected,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function getMyMiningEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array("test_account_mining_regular_entry.*"), 
	   		$tables = array('test_account_mining_regular_entry'),
	   		$fieldName = array("userID",'status'), 
	   		$where = array($_GET["userID"],'lock'), 
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

		echo json_encode($res);
	}

	public function saveDailyMiningEntry(){
		$balance = $_GET["balance"];
		$daysID = $_GET["daysID"];
		$mining_id = $_GET["mining_id"];
		$userID = $_GET["userID"];

		$insertRecord = array(
			'balance' => $balance,
			'daysID' => $daysID,
			'mining_id' => $mining_id,
			'userID' => $userID,
			'date_created' => $this->_getTimeStamp24Hours()
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_mining_daily_income_entry', $insertRecord);

		if ($saveQueryNotif) {
			echo true;	
		}else{
			echo false;
		}
	}

	public function claimLockTokensAndIncome(){
		$tableName="test_account_mining_regular_entry";
		$fieldName='id';
		$where=$_GET["entry_id"];

		$insertRecord = array(
			'status' => 'claimed',
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	public function getAllMiningEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array("test_account_mining_regular_entry.*,token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,network_reference.network,CONCAT(UPPER(token_reference.tokenName),' (',UPPER(network_reference.network),')') AS concatName"), 
	   		$tables = array('test_account_mining_regular_entry','test_account_mining_regular','token_reference','network_reference'),
	   		$fieldName = array("test_account_mining_regular_entry.userID"), 
	   		$where = array($_GET["userID"]), 
	   		$join = array("test_account_mining_regular_entry.mining_id = test_account_mining_regular.id","test_account_mining_regular.token_id = token_reference.id",'token_reference.networkId = network_reference.id'), 
	   		$joinType = array("inner","inner","inner"),
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getPurchasableLimit(){
		$tokenLimit = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_mining_daily_income'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = null,	 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = array('cycle_day LIKE "%'.$_GET['day'].'%"'), 
	   		$groupBy = null 
		);

		$totalBalanceContainer = 0;
		$totalLimitContainer = 0;

		foreach ($tokenLimit as $key => $value) {
			$tokenBalance = $this->_getRecordsData(
				$selectfields = array("COALESCE(SUM(balance),0) AS balance"), 
		   		$tables = array('test_account_mining_daily_income_entry'),
		   		$fieldName = array("mining_id","daysID",'status'), 
		   		$where = array($value->id,$_GET['day'],'lock'), 
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

			$totalBalanceContainer = (int)$tokenBalance[0]->balance + $totalBalanceContainer;
			$totalLimitContainer = (int)$value->purchasable_limit + $totalLimitContainer;
		}

		echo json_encode(array(
			"totalBalance"=>$totalBalanceContainer,
			"totalLimit"=>$totalLimitContainer
		));
		
	}

	public function getTokensToClaim(){
		$res = $this->_getRecordsData(
			$selectfields = array(
				"
					test_account_mining_daily_income_entry.*,FORMAT(test_account_mining_daily_income_entry.balance, token_reference.decimal) AS balance,
					CONCAT(token_reference.tokenName,' (',network_reference.network,')')AS tokenNameCombo,
					FORMAT (((test_account_mining_daily_income_entry.balance * (test_account_mining_daily_days_tbl.apy / 100))/365)*test_account_mining_daily_days_tbl.days, token_reference.decimal)  AS claimAmount,
					test_account_mining_daily_days_tbl.apy,
					DATE_ADD(test_account_mining_daily_income_entry.date_created, INTERVAL test_account_mining_daily_days_tbl.days DAY) AS date_release,
					test_account_mining_daily_days_tbl.days AS daysLock, token_reference.tokenImage, token_reference.smartAddress, token_reference.tokenName, token_reference.decimal, network_reference.network as networkName 

				"), 
	   		$tables = array(
	   			'test_account_mining_daily_income_entry',
	   			'test_accounts_tbl',
	   			'test_account_mining_daily_income',
	   			'token_reference',
	   			'network_reference',
	   			'test_account_mining_daily_days_tbl'
	   		),
	   		$fieldName = array("test_account_mining_daily_income_entry.userID","test_account_mining_daily_income_entry.status"), 
	   		$where = array($_GET['userID'],"lock"), 
	   		$join = array(
	   			'test_account_mining_daily_income_entry.userID = test_accounts_tbl.userID',
	   			'test_account_mining_daily_income_entry.mining_id = test_account_mining_daily_income.id',
	   			'test_account_mining_daily_income.token_id = token_reference.id',
	   			'token_reference.networkId = network_reference.id',
	   			'test_account_mining_daily_income_entry.daysID = test_account_mining_daily_days_tbl.id'
	   		), 
	   		$joinType = array('inner','inner','inner','inner','inner'),
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getAllEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array(
				"
					test_account_mining_daily_income_entry.*,FORMAT(test_account_mining_daily_income_entry.balance, token_reference.decimal) AS balance,
					CONCAT(token_reference.tokenName,' (',network_reference.network,')')AS tokenNameCombo,
					FORMAT (((test_account_mining_daily_income_entry.balance * (test_account_mining_daily_days_tbl.apy / 100))/365)*test_account_mining_daily_days_tbl.days, token_reference.decimal)  AS claimAmount,
					test_account_mining_daily_days_tbl.apy,
					DATE_ADD(test_account_mining_daily_income_entry.date_created, INTERVAL test_account_mining_daily_days_tbl.days DAY) AS date_release,
					test_account_mining_daily_days_tbl.days AS daysLock, token_reference.tokenImage, token_reference.smartAddress, token_reference.tokenName, token_reference.decimal, network_reference.network as networkName 

				"), 
	   		$tables = array(
	   			'test_account_mining_daily_income_entry',
	   			'test_accounts_tbl',
	   			'test_account_mining_daily_income',
	   			'token_reference',
	   			'network_reference',
	   			'test_account_mining_daily_days_tbl'
	   		),
	   		$fieldName = array("test_account_mining_daily_income_entry.userID"), 
	   		$where = array($_GET['userID']), 
	   		$join = array(
	   			'test_account_mining_daily_income_entry.userID = test_accounts_tbl.userID',
	   			'test_account_mining_daily_income_entry.mining_id = test_account_mining_daily_income.id',
	   			'test_account_mining_daily_income.token_id = token_reference.id',
	   			'token_reference.networkId = network_reference.id',
	   			'test_account_mining_daily_income_entry.daysID = test_account_mining_daily_days_tbl.id'
	   		), 
	   		$joinType = array('inner','inner','inner','inner','inner'),
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getDayTokens(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_mining_daily_income'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = null,	 
	   		$joinType = null,
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = array('cycle_day LIKE "%'.$_GET['day'].'%"'), 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getTokenBalanceLimit(){
		$tokenBalance = $this->_getRecordsData(
			$selectfields = array("COALESCE(SUM(balance),0) AS balance"), 
	   		$tables = array('test_account_mining_daily_income_entry'),
	   		$fieldName = array("mining_id","daysID",'status'), 
	   		$where = array($_GET['mining_id'],$_GET['day'],'lock'), 
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

		$tokenLimit = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_mining_daily_income'),
	   		$fieldName = array("id"), 
	   		$where = array($_GET['mining_id']), 
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

		echo json_encode(array(
			"totalBalance"=>$tokenBalance[0]->balance,
			"totalLimit"=>$tokenLimit[0]->purchasable_limit
		));
	}

	public function claimDailyIncome(){
	   	$tableName="test_account_mining_daily_income_entry";
	   	$fieldName='id';
	   	$where=$_GET["mining_id"];

	   	$insertRecord = array(
			'status' => 'claimed',
			'isClaimableAdmin' => '0',
	   	);

	   	$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if ($updateRecordsRes) {
			echo true;	
		}else{
			echo false;
		}		
	}

	

	
	//betting and mining test account

		//betting risefall longshort settings
			public function getAllRiseFall(){

				$res = $this->_getRecordsData(
					$selectfields = array("test_account_future_risefall_positions.*,test_accounts_tbl.username"), 
			   		$tables = array('test_account_future_risefall_positions','test_accounts_tbl'),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = array('test_account_future_risefall_positions.userID = test_accounts_tbl.userID'), 
			   		$joinType = array('inner'),
			   		$sortBy = array('test_account_future_risefall_positions.id'), 
			   		$sortOrder = array('desc'), 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				echo json_encode($res);
			}

			public function futureResolveRiseFallPosition(){
				$id = $_GET['id'];
				$resolvedPrice = $_GET['resolvedPrice'];
				$status = $_GET['status'];

				$tableName="test_account_future_risefall_positions";
				$fieldName='id';
				$where=$id;

				$insertRecord = array(
					'status'=>$status,
					'resolvedPrice'=>$resolvedPrice,
				);

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				echo $updateRecordsRes;

				//send USDT if win or lose
				// if win send USDT to userWallet TRC20 Network
				// if lose send USDT to mainDevWallet TRC20 Network
			}

			public function setRiseFallPosition(){
				$insertRecord = array(
					'position_id'=>$_GET['id'],
					'userID'=>$_GET['userID'],
					'dateCreated'=>$this->_getTimeStamp24Hours(),
				);

				$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_set_risefall_position', $insertRecord);

				echo $saveQueryNotif;
			}

			public function getAllContractPositions(){

				$res = $this->_getRecordsData(
					$selectfields = array("test_account_future_positions.*,test_accounts_tbl.username"), 
			   		$tables = array('test_account_future_positions','test_accounts_tbl'),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = array('test_account_future_positions.userID = test_accounts_tbl.userID'), 
			   		$joinType = array('inner'),
			   		$sortBy = array('test_account_future_positions.id'), 
			   		$sortOrder = array('desc'), 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				// testing
					// $json_pretty = json_encode($res, JSON_PRETTY_PRINT);
					// echo "<pre>" . $json_pretty . "<pre/>";
				// testing
				

				echo json_encode($res);
			}

			public function futureResolvePosition(){
				$id = $_GET['id'];
				$resolvedPrice = $_GET['resolvedPrice'];
				$status = $_GET['status'];

				$tableName="test_account_future_positions";
				$fieldName='id';
				$where=$id;

				$insertRecord = array(
					'status'=>$status,
					'resolvedPrice'=>$resolvedPrice,
				);

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				echo $updateRecordsRes;

				//send USDT if win or lose
				// if win send USDT to userWallet TRC20 Network
				// if lose send USDT to mainDevWallet TRC20 Network
			}

			public function setContractPosition(){
				$insertRecord = array(
					'position_id'=>$_GET['id'],
					'userID'=>$_GET['userID'],
					'dateCreated'=>$this->_getTimeStamp24Hours(),
				);

				$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_set_contract_position', $insertRecord);

				echo $saveQueryNotif;
			}

			public function saveBettingSettings(){
		   		$tableName="test_account_contract_settings_tbl";
		   		$fieldName='id';

		   		$where=1;
		   		$insertRecord = array(
		   			'value' => $_GET["risefall_minimum"]
		   		);
		   		$risefall_minimumRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		   		// _____________________________________________

		   		$where=2;
		   		$insertRecord = array(
		   			// 'risefall_minimum' => $_GET["risefall_minimum"]
		   			'value' => $_GET["contract_minimum"]
		   		);
		   		$contract_minimumRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		   		if ($risefall_minimumRes||$contract_minimumRes) {
		   			echo json_encode(true);
		   		}else{
		   			echo json_encode(false);
		   		}

			}

			public function deleteFutureRisefallOption(){
				$deleteQuery = $this->_deleteRecords(
					$tableName = "test_account_future_risefall_timings",
				 	$fieldName = array("id"),
				  	$where = array($_GET['id'])
				);
				echo json_encode($deleteQuery);
			}

			public function updateFutureRisefallOption(){

				$insertRecord = array(
					'timing' => $_GET['timing'],
					'income' => $_GET['income'],
				);

				$tableName="test_account_future_risefall_timings";
				$fieldName='id';
				$where= $_GET['id'];

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				if($updateRecordsRes){
					echo json_encode(true);
				}else{
					echo json_encode(false);
				}
			}

			public function addFutureRisefallOption(){
				$insertRecord = array(
					'timing' => $_GET["timing"],
					'income' => $_GET["income"],
					'dateCreated' => $this->_getTimeStamp24Hours(),
				);

				$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_future_risefall_timings', $insertRecord);

				if ($saveQueryNotif) {
					echo true;
				}else{
					echo false;
				}
				// echo json_encode($insertRecord);
			}
		//betting risefall longshort settings

		//mining regular/daily settings & regular/daily entry
			public function getRegularMiningSettings(){
				$res = $this->_getRecordsData(
					$selectfields = array("test_account_mining_regular.*,token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,network_reference.network"), 
			   		$tables = array('test_account_mining_regular','token_reference','network_reference'),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = array('test_account_mining_regular.token_id = token_reference.id','token_reference.networkId = network_reference.id'), 
			   		$joinType = array('inner','inner'),
			   		$sortBy = null, 
			   		$sortOrder = null, 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				echo json_encode($res);
			}

			public function getAllTokensV2(){
				$selectedTokens = $this->_getRecordsData(
					$selectfields = array("token_reference.*,network_reference.network as networkName"), 
			   		$tables = array('token_reference','network_reference'),
			   		$fieldName = null, $where = null, 
			   		$join = array('token_reference.networkID = network_reference.id'), $joinType = array('inner'),
			   		$sortBy = array('token_reference.networkID'), $sortOrder = array('desc'), 
			   		$limit = null, 
			   		$fieldNameLike = null, $like = null,
			   		$whereSpecial = null, $groupBy = null 
				);

				echo json_encode($selectedTokens);
			}

			public function saveNewToken(){

				$insertRecord = array(
					'token_id' => $_GET['token_name_container'],
					'apy' => $_GET["apy_container"],
					'cycle_day' => $_GET["cycle_day_container"],
					'minimum_entry' => $_GET["minimum_entry_container"],
					'date_created' => $this->_getTimeStamp24Hours(),
				);

				$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_mining_regular', $insertRecord);

				if ($saveQueryNotif) {
					echo true;
				}else{
					echo false;
				}
			}

			public function deleteRegularToken(){
				$deleteQuery = $this->_deleteRecords(
					$tableName = "test_account_mining_regular",
				 	$fieldName = array("id"),
				  	$where = array($_GET['id'])
				);

				if ($deleteQuery) {
					echo true;
				}else{
					echo false;
				}
			}

			public function saveEditToken(){

				$tableName="test_account_mining_regular";
				$fieldName='id';
				$where=$_GET["id"];

				$insertRecord = array(
					'token_id' => $_GET['token_name_container'],
					'apy' => $_GET["apy_container"],
					'cycle_day' => $_GET["cycle_day_container"],
					'minimum_entry' => $_GET["minimum_entry_container"],
				);

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				if ($updateRecordsRes) {
					echo true;
				}else{
					echo false;
				}
			}

			public function getAllRegularMiningEntries(){
				$res = $this->_getRecordsData(
					$selectfields = array(
						"
							test_account_mining_regular_entry.*,
							test_accounts_tbl.username,
							CONCAT(token_reference.tokenName,' (',network_reference.network,')')AS tokenNameCombo,
							((test_account_mining_regular_entry.balance * (test_account_mining_regular.apy / 100))/365)*test_account_mining_regular_entry.lock_period AS claimAmount,
							test_account_mining_regular.apy,
							DATE_ADD(test_account_mining_regular_entry.date_created, INTERVAL test_account_mining_regular_entry.lock_period DAY) AS date_release

						"), 
			   		$tables = array(
			   			'test_account_mining_regular_entry',
			   			'test_accounts_tbl',
			   			'test_account_mining_regular',
			   			'token_reference',
			   			'network_reference'),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = array(
			   			'test_account_mining_regular_entry.userID = test_accounts_tbl.userID',
			   			'test_account_mining_regular_entry.mining_id = test_account_mining_regular.id',
			   			'test_account_mining_regular.token_id = token_reference.id',
			   			'token_reference.networkId = network_reference.id'
			   		), 
			   		$joinType = array('inner','inner','inner','inner'),
			   		$sortBy = null, 
			   		$sortOrder = null, 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				echo json_encode($res);
			}

			public function editMiningEntry(){
				$tableName="test_account_mining_regular_entry";
				$fieldName='id';
				$where=$_GET["id"];

				$insertRecord = array(
					'balance' => $_GET["balance_container"],
					'isClaimableAdmin' => $_GET["setClaim_radio"],
				);

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				echo json_encode($updateRecordsRes);
			}

			public function getDailySettings(){
				$res = $this->_getRecordsData(
					$selectfields = array("test_account_mining_daily_income.*,token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,network_reference.network"), 
			   		$tables = array('test_account_mining_daily_income','token_reference','network_reference'),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = array('test_account_mining_daily_income.token_id = token_reference.id','token_reference.networkId = network_reference.id'), 
			   		$joinType = array('inner','inner'),
			   		$sortBy = null, 
			   		$sortOrder = null, 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				echo json_encode($res);
			}

			public function getAddDays(){
				$res = $this->_getRecordsData(
					$selectfields = array("*"), 
			   		$tables = array('test_account_mining_daily_days_tbl'),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = null,	 
			   		$joinType = null,
			   		$sortBy = array("id"), 
			   		$sortOrder = array('desc'), 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				echo json_encode($res);
			}

			public function saveNewDailyToken(){

				$insertRecord = array(
					'token_id' => $_GET['token_name_container'],
					'cycle_day' => $_GET["cycle_days"],
					'purchasable_limit' => $_GET["purchase_limit_container"],
					'minimum_entry' => $_GET["minimum_entry_container"],
					'date_created' => $this->_getTimeStamp24Hours(),
				);

				$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_mining_daily_income', $insertRecord);

				if ($saveQueryNotif) {
					echo true;
				}else{
					echo false;
				}
				// echo json_encode($insertRecord);
			}

			public function saveDays(){
				$insertRecord = array(
					'days' => $_GET["days"],
					'apy' => $_GET["apy"],
					'dateCreated' => $this->_getTimeStamp24Hours(),
				);

				$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_mining_daily_days_tbl', $insertRecord);

				if ($saveQueryNotif) {
					echo true;
				}else{
					echo false;
				}
				// echo json_encode($insertRecord);
			}

			public function deleteDailyToken(){
				$deleteQuery = $this->_deleteRecords(
					$tableName = "test_account_mining_daily_income",
				 	$fieldName = array("id"),
				  	$where = array($_GET['id'])
				);

				if ($deleteQuery) {
					echo true;
				}else{
					echo false;
				}
			}

			public function saveEditDailyToken(){
				$tableName="test_account_mining_daily_income";
				$fieldName='id';
				$where=$_GET["id"];

				$insertRecord = array(
					'token_id' => $_GET['token_name_container'],
					'cycle_day' => $_GET["cycle_days"],
					'purchasable_limit' => $_GET["purchase_limit_container"],
					'minimum_entry' => $_GET["minimum_entry_container"],

				);

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				if ($updateRecordsRes) {
					echo true;
				}else{
					echo false;
				}

				// echo json_encode($insertRecord);
			}

			public function updateDays(){

				$insertRecord = array(
					'days' => $_GET['days'],
					'apy' => $_GET['apy'],
				);

				$tableName="test_account_mining_daily_days_tbl";
				$fieldName='id';
				$where= $_GET['id'];

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				if($updateRecordsRes){
					echo json_encode(true);
				}else{
					echo json_encode(false);
				}
			}

			public function getAllDailyEntries(){
				$res = $this->_getRecordsData(
					$selectfields = array(
						"
							test_account_mining_daily_income_entry.*,FORMAT(test_account_mining_daily_income_entry.balance, token_reference.decimal) AS balance,
							test_accounts_tbl.username,
							CONCAT(token_reference.tokenName,' (',network_reference.network,')')AS tokenNameCombo,
							FORMAT (((test_account_mining_daily_income_entry.balance * (test_account_mining_daily_days_tbl.apy / 100))/365)*test_account_mining_daily_days_tbl.days, token_reference.decimal)  AS claimAmount,
							test_account_mining_daily_days_tbl.apy,
							DATE_ADD(test_account_mining_daily_income_entry.date_created, INTERVAL test_account_mining_daily_days_tbl.days DAY) AS date_release,
							test_account_mining_daily_days_tbl.days AS daysLock

						"), 
			   		$tables = array(
			   			'test_account_mining_daily_income_entry',
			   			'test_accounts_tbl',
			   			'test_account_mining_daily_income',
			   			'token_reference',
			   			'network_reference',
			   			'test_account_mining_daily_days_tbl'
			   		),
			   		$fieldName = null, 
			   		$where = null, 
			   		$join = array(
			   			'test_account_mining_daily_income_entry.userID = test_accounts_tbl.userID',
			   			'test_account_mining_daily_income_entry.mining_id = test_account_mining_daily_income.id',
			   			'test_account_mining_daily_income.token_id = token_reference.id',
			   			'token_reference.networkId = network_reference.id',
			   			'test_account_mining_daily_income_entry.daysID = test_account_mining_daily_days_tbl.id'
			   		), 
			   		$joinType = array('inner','inner','inner','inner','inner'),
			   		$sortBy = null, 
			   		$sortOrder = null, 
			   		$limit = null, 
			   		$fieldNameLike = null, 
			   		$like = null,
			   		$whereSpecial = null, 
			   		$groupBy = null 
				);

				echo json_encode($res);
			}

			public function editDailyMiningEntry(){
				$tableName="test_account_mining_daily_income_entry";
				$fieldName='id';
				$where=$_GET["id"];

				$insertRecord = array(
					'balance' => $_GET["balance_container"],
					'isClaimableAdmin' => $_GET["setClaim_radio"],
				);

				$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

				echo json_encode($updateRecordsRes);
			}

		//mining regular/daily settings & regular/daily entry

	//betting and mining test account

	public function saveMiningEntry(){
		$balance = $_GET["balance"];
		$lock_period = $_GET["lock_period"];
		$mining_id = $_GET["mining_id"];
		$userID = $_GET["userID"];

		$insertRecord = array(
			'balance' => $balance,
			'lock_period' => $lock_period,
			'mining_id' => $mining_id,
			'userID' => $userID,
			'date_created' => $this->_getTimeStamp24Hours()
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'test_account_mining_regular_entry', $insertRecord);

		if ($saveQueryNotif) {
			echo true;	
		}else{
			echo false;
		}
	}

	public function getTodayContractProfit(){
		$riseFall = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_risefall_positions'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = array('id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = array("timeStamp LIKE '%".$_GET['date']."%'"), 
	   		$groupBy = null 
		);

		$sumRiseFall = 0;

		foreach ($riseFall as $key => $value) {
			if ($value->status=="WIN") {
				$sumRiseFall = $sumRiseFall+floatval($value->income);
			}else{
				$sumRiseFall = $sumRiseFall-floatval($value->income);
			}
		}

		$longShort = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_positions'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = array('id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = array("timeStamp LIKE '%".$_GET['date']."%'"), 
	   		$groupBy = null 
		);

		$sumLongShort = 0;

		foreach ($longShort as $key => $value) {
			if ($value->status=="WIN") {
				$sumLongShort = $sumLongShort+floatval($value->amount);
			}else{
				$sumLongShort = $sumLongShort-floatval($value->amount);
			}
		}

		echo json_encode($sumRiseFall+$sumLongShort);
	}

	public function riseFallGetEarnings(){
		$riseFall = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_risefall_positions'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = array('id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		$sumRiseFall = 0;
		$sumTodayRiseFall = 0;

		foreach ($riseFall as $key => $value) {

			if ($value->status=="WIN") {
				$percentage = floatval($value->income)/100;

				if (strpos($value->timeStamp,$_GET['date'])!== false) {
					$sumTodayRiseFall = $sumTodayRiseFall+$percentage*floatVal($value->amount);
				}
				
				$sumRiseFall = $sumRiseFall+$percentage*floatVal($value->amount);
			}else{
				if (strpos($value->timeStamp,$_GET['date'])!== false) {
					$sumTodayRiseFall = $sumTodayRiseFall-floatval($value->amount);
				}

				$sumRiseFall = $sumRiseFall-floatval($value->amount);
			}
		}


		echo json_encode(array($sumRiseFall,$sumTodayRiseFall));
	}

	public function futureGetEarnings(){
		$longShort = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('test_account_future_positions'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = array('id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		$sumLongShort = 0;
		$sumTodayLongShort = 0;

		foreach ($longShort as $key => $value) {
			if ($value->status=="WIN") {
				if (strpos($value->timeStamp,$_GET['date'])!== false) {
					$sumTodayLongShort = $sumTodayLongShort+floatval($value->amount);
				}
				$sumLongShort = $sumLongShort+floatval($value->amount);
			}else{
				if (strpos($value->timeStamp,$_GET['date'])!== false) {
					$sumTodayLongShort = $sumTodayLongShort-floatval($value->amount);
				}

				$sumLongShort = $sumLongShort-floatval($value->amount);
			}
		}


		echo json_encode(array($sumLongShort,$sumTodayLongShort));
	}

	


	

	



}
