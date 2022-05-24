<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class testPlatform extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	    // $_SESSION['networkId'] = $res['networkId'];
	    // session_destroy();
	}

	public function indexView(){
		$this->load->view('wallet/test-platform/index');
	}	

	//arl_05-19-22

		public function indexV2View(){
			$this->load->view('wallet/test-platform/indexV2');
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


	

}
