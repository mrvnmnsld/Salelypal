<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mining extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	    // $_SESSION['networkId'] = $res['networkId'];
	    // session_destroy();
	}

	public function getRegularMiningSettings(){
		$res = $this->_getRecordsData(
			$selectfields = array("mining_regular.*,token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,,network_reference.network"), 
	   		$tables = array('mining_regular','token_reference','network_reference'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array('mining_regular.token_id = token_reference.id','token_reference.networkId = network_reference.id'), 
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

	public function saveNewToken(){

		$insertRecord = array(
			'token_id' => $_GET['token_name_container'],
			'apy' => $_GET["apy_container"],
			'cycle_day' => $_GET["cycle_day_container"],
			'date_created' => $this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'mining_regular', $insertRecord);

		if ($saveQueryNotif) {
			echo true;
		}else{
			echo false;
		}
	}	

	public function saveEditToken(){

		$tableName="mining_regular";
		$fieldName='id';
		$where=$_GET["id"];

		$insertRecord = array(
			'token_id' => $_GET['token_name_container'],
			'apy' => $_GET["apy_container"],
			'cycle_day' => $_GET["cycle_day_container"],
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if ($updateRecordsRes) {
			echo true;
		}else{
			echo false;
		}
	}	

	public function getMyMiningEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array("mining_regular_entry.*"), 
	   		$tables = array('mining_regular_entry'),
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

		$saveQueryNotif = $this->_insertRecords($tableName = 'mining_regular_entry', $insertRecord);

		if ($saveQueryNotif) {
			echo true;	
		}else{
			echo false;
		}
	}

	public function claimLockTokensAndIncome(){
		$tableName="mining_regular_entry";
		$fieldName='id';
		$where=$_GET["entry_id"];

		$insertRecord = array(
			'status' => 'claimed',
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	public function getAllRegularMiningEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array(
				"
					mining_regular_entry.*,
					user_tbl.email,
					CONCAT(token_reference.tokenName,' (',network_reference.network,')')AS tokenNameCombo,
					((mining_regular_entry.balance * (mining_regular.apy / 100))/365)*mining_regular_entry.lock_period AS claimAmount,
					mining_regular.apy,
					DATE_ADD(mining_regular_entry.date_created, INTERVAL mining_regular_entry.lock_period DAY) AS date_release

				"), 
	   		$tables = array(
	   			'mining_regular_entry',
	   			'user_tbl',
	   			'mining_regular',
	   			'token_reference',
	   			'network_reference'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array(
	   			'mining_regular_entry.userID = user_tbl.userID',
	   			'mining_regular_entry.mining_id = mining_regular.id',
	   			'mining_regular.token_id = token_reference.id',
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
		$tableName="mining_regular_entry";
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
			$selectfields = array("mining_daily_income.*,token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,,network_reference.network"), 
	   		$tables = array('mining_daily_income','token_reference','network_reference'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array('mining_daily_income.token_id = token_reference.id','token_reference.networkId = network_reference.id'), 
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

	public function saveNewDailyToken(){

		$insertRecord = array(
			'token_id' => $_GET['token_name_container'],
			'apy' => $_GET["apy_container"],
			'cycle_day' => $_GET["cycle_day_container"],
			'date_created' => $this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'mining_daily_income', $insertRecord);

		if ($saveQueryNotif) {
			echo true;
		}else{
			echo false;
		}
	}


	public function saveEditDailyToken(){
		$tableName="mining_daily_income";
		$fieldName='id';
		$where=$_GET["id"];

		$insertRecord = array(
			'token_id' => $_GET['token_name_container'],
			'apy' => $_GET["apy_container"],
			'cycle_day' => $_GET["cycle_day_container"],
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if ($updateRecordsRes) {
			echo true;
		}else{
			echo false;
		}
	}	

	public function deleteDailyToken(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "mining_daily_income",
		 	$fieldName = array("id"),
		  	$where = array($_GET['id'])
		);

		if ($deleteQuery) {
			echo true;
		}else{
			echo false;
		}
	}	

	public function deleteRegularToken(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "mining_regular",
		 	$fieldName = array("id"),
		  	$where = array($_GET['id'])
		);

		if ($deleteQuery) {
			echo true;
		}else{
			echo false;
		}
	}	

	public function getDailyEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array("mining_daily_income_entry.*"), 
	   		$tables = array('mining_daily_income_entry'),
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

		$saveQueryNotif = $this->_insertRecords($tableName = 'mining_daily_income_entry', $insertRecord);

		if ($saveQueryNotif) {
			echo true;	
		}else{
			echo false;
		}
	}

	public function getClaimEntriesByEntryID(){
		$res = $this->_getRecordsData(
			$selectfields = array("mining_daily_income_entry_claims.*"), 
	   		$tables = array('mining_daily_income_entry_claims'),
	   		$fieldName = array("entry_id"), 
	   		$where = array($_GET["entry_id"]), 
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

	public function claimDailyIncome(){
		$res = $this->_getRecordsData(
			$selectfields = array("mining_daily_income_entry.*,DATE_ADD(date_created, INTERVAL lock_period DAY) AS date_release"), 
	   		$tables = array('mining_daily_income_entry'),
	   		$fieldName = array("id"), 
	   		$where = array($_GET["entry_id"]), 
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

		if(date('Y-m-d',strtotime($res[0]->date_release)) == date("Y-m-d")){
		   $tableName="mining_daily_income_entry";
		   $fieldName='id';
		   $where=$_GET["entry_id"];

		   $insertRecord = array(
   			'status' => 'claimed',
   			'isClaimableAdmin' => '0',
		   );

		   $updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
		}

		$insertRecord = array(
			'type' => 'pocket',
			'entry_id' => $_GET['entry_id'],
			'claimed_amount' => $_GET['income'],
			'date_claimed' => $this->_getTimeStamp24Hours()
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'mining_daily_income_entry_claims', $insertRecord);

		if ($saveQueryNotif) {
			echo true;	
		}else{
			echo false;
		}		
	}

	public function compoundDailyIncome(){
		$res = $this->_getRecordsData(
			$selectfields = array("mining_daily_income_entry.*,DATE_ADD(date_created, INTERVAL lock_period DAY) AS date_release"), 
	   		$tables = array('mining_daily_income_entry'),
	   		$fieldName = array("id"), 
	   		$where = array($_GET["entry_id"]), 
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

		if(date('Y-m-d',strtotime($res[0]->date_release)) == date("Y-m-d")){
		   $tableName="mining_daily_income_entry";
		   $fieldName='id';
		   $where=$_GET["entry_id"];

		   $insertRecord = array(
   			'status' => 'claimed',
		   );

		   $updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
		}

		$tableName="mining_daily_income_entry";
		$fieldName='id';
		$where=$_GET["entry_id"];

		$insertRecord = array(
			'balance' => floatval($_GET["income"])+floatval($res[0]->balance),
			'isClaimableAdmin' => '0',
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		// echo json_encode(array())

		$insertRecord = array(
			'type' => 'compound',
			'entry_id' => $_GET['entry_id'],
			'claimed_amount' => $_GET['income'],
			'date_claimed' => $this->_getTimeStamp24Hours()
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'mining_daily_income_entry_claims', $insertRecord);

		if ($saveQueryNotif) {
			echo true;	
		}else{
			echo false;
		}		
	}

	public function getAllDailyEntries(){
		$res = $this->_getRecordsData(
			$selectfields = array(
				"
					mining_daily_income_entry.*,FORMAT(mining_daily_income_entry.balance, token_reference.decimal) AS balance,
					user_tbl.email,
					CONCAT(token_reference.tokenName,' (',network_reference.network,')')AS tokenNameCombo,
					FORMAT (((mining_daily_income_entry.balance * (mining_regular.apy / 100))/365)*mining_daily_income_entry.lock_period, token_reference.decimal)  AS claimAmount,
					mining_regular.apy,
					DATE_ADD(mining_daily_income_entry.date_created, INTERVAL mining_daily_income_entry.lock_period DAY) AS date_release

				"), 
	   		$tables = array(
	   			'mining_daily_income_entry',
	   			'user_tbl',
	   			'mining_regular',
	   			'token_reference',
	   			'network_reference'
	   		),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array(
	   			'mining_daily_income_entry.userID = user_tbl.userID',
	   			'mining_daily_income_entry.mining_id = mining_regular.id',
	   			'mining_regular.token_id = token_reference.id',
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

	public function editDailyMiningEntry(){
		$tableName="mining_daily_income_entry";
		$fieldName='id';
		$where=$_GET["id"];

		$insertRecord = array(
			'balance' => $_GET["balance_container"],
			// 'isClaimableAdmin' => $_GET["setClaim_radio"],
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	

	


	

	

	

	

	

	


	

	

	


	
}
