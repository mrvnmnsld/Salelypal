<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userWallet extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    session_start();
	}

	public function getAllTokens(){
		$res = $this->_getRecordsData(
			$selectfields = array("token_reference.*,network_reference.network"), 
	   		$tables = array('token_reference','network_reference'), 
	   		$fieldName = null, null, 
	   		$join = array('token_reference.networkId = network_reference.id'), $joinType = array('inner'), $sortBy = array('token_reference.tokenName','token_reference.id'), 
	   		$sortOrder = array('asc','desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($res);
	}	

	public function sendWithdrawal(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";
		// POST Varialbles
			$to = $_POST["addressToInput"];
			$amount = $_POST["amountInput"];
			$tokenArray = explode('_', $_POST['tokenContainerSelect']);
			$accountPassword = md5($_POST['accountPassword']);
			$currentUserID = $_POST['currentUserID'];


			// $to = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';
			// $amount = 1;
			// $tokenArray = explode('_', 'usdt_trc20_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
		// POST Varialbles

		if ($tokenArray[1] == "trc20") {
			$privateKeyRes = $this->_getRecordsData(
				$selectfields = array("*"), 
		   		$tables = array('trc20_wallet'), 
		   		$fieldName = array('userOwner'), $where = array($currentUserID), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);

			$privatekey = $privateKeyRes[0]->privateKey;
			$from = $privateKeyRes[0]->address;

			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTRC20");

			$payload = json_encode(
				array(
					"contractaddress" => $tokenArray[2],
					"from" => $from,
					"to" => $to,
					"privatekey" => $privatekey,
					"amount" => $amount,
				) 
			);
		}elseif ($tokenArray[1] == "trx") {
			$privateKeyRes = $this->_getRecordsData(
				$selectfields = array("*"), 
		   		$tables = array('trc20_wallet'), 
		   		$fieldName = array('userOwner'), $where = array($currentUserID), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);

			$privatekey = $privateKeyRes[0]->privateKey;
			$from = $privateKeyRes[0]->address;
					
			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

			$payload = json_encode(
				array(
					"to" => $to,
					"privatekey" => $privatekey,
					"amount" => $amount,
				) 
			);
		}elseif ($tokenArray[1] == "bsc"){
			$fromBscNetwork = $_POST['fromBscNetwork'];

			if ($tokenArray[2] == null || $tokenArray[2] == "null") {
				$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendBinancecoin");

				$payload = json_encode(array(
					"from" => $fromBscNetwork,
					"to" => $to,
					"password" => $accountPassword,
					"amount" => $amount
				));
			}else{
				$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendToken");

				$payload = json_encode(array(
					"from" => $fromBscNetwork,
					"to" => $to,
					"password" => $accountPassword,
					"contractaddress" => $tokenArray[2],
					"amount" => $amount
				));
			}
		}elseif ($tokenArray[1] == "erc20") {
			$erc20_address = $_POST['erc20_address'];

			if ($tokenArray[2] == null || $tokenArray[2] == "null") {
				$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendEthereum");

				$payload = json_encode(array(
					"from" => $erc20_address,
					"to" => $to,
					"password" => $accountPassword,
					"amount" => $amount
					// 'nonce' => '4'
				));
			}else{
				$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendToken");

				$payload = json_encode(array(
					"from" => $erc20_address,
					"to" => $to,
					"password" => $accountPassword,
					"contractaddress" => $tokenArray[2],
					"amount" => $amount
				));
			}
		}

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		$resultDecoded = json_decode($result);

		if ($resultDecoded->ok) {
			$insertRecord = array(
				'txid' => $resultDecoded->txid,
				'amount' => $resultDecoded->amount,
				'toAddress' => $resultDecoded->to,
				'timestamp' => $this->_getTimeStamp24Hours(),
				'userID' => $currentUserID,
				'network' => $tokenArray[1],
				'token' => $tokenArray[0]
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'withdrawal_tbl', $insertRecord);
		}

		echo json_encode($resultDecoded);
		// var_dump($resultDecoded);
	}

	public function sendWithdrawalV2(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";
		// POST Varialbles
			$to = $_GET["addressToInput"];
			$amount = $_GET["amountInput"];
			$tokenArray = explode('_', $_GET['tokenContainerSelect']);
			$currentUserID = $_GET['currentUserID'];
			$userAddress = $_GET['userAddress'];
			$accountPassword = $_GET['accountPassword'];

			// $to = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';
			// $amount = 1;
			// $tokenArray = explode('_', 'usdt_trc20_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
		// POST Varialbles

		if ($tokenArray[1] == "trc20") {
			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTRC20");

			$payload = json_encode(
				array(
					"contractaddress" => $tokenArray[2],
					"from" => $userAddress,
					"to" => $to,
					"privatekey" => $accountPassword,
					"amount" => $amount,
				) 
			);
		}elseif ($tokenArray[1] == "trx") {		
			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

			$payload = json_encode(
				array(
					"to" => $to,
					"privatekey" => $accountPassword,
					"amount" => $amount,
				) 
			);
		}elseif ($tokenArray[1] == "bsc"){
			if ($tokenArray[2] == null || $tokenArray[2] == "null") {
				$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendBinancecoin");

				$payload = json_encode(array(
					"from" => $userAddress,
					"to" => $to,
					"password" => $accountPassword,
					"amount" => $amount
				));
			}else{
				$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendToken");

				$payload = json_encode(array(
					"from" => $userAddress,
					"to" => $to,
					"password" => $accountPassword,
					"contractaddress" => $tokenArray[2],
					"amount" => $amount
				));
			}
		}elseif ($tokenArray[1] == "erc20") {
			if ($tokenArray[2] == null || $tokenArray[2] == "null") {
				$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendEthereum");

				$payload = json_encode(array(
					"from" => $userAddress,
					"to" => $to,
					"password" => $accountPassword,
					"amount" => $amount
					// 'nonce' => '4'
				));
			}else{
				$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendToken");

				$payload = json_encode(array(
					"from" => $userAddress,
					"to" => $to,
					"password" => $accountPassword,
					"contractaddress" => $tokenArray[2],
					"amount" => $amount
				));
			}
		}

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);
		echo $result;

		// echo json_encode($_GET);

		// var_dump($resultDecoded);
	}

	public function getAddressDetails(){
		$params =[
		  	'address' => $_POST['address'],
		];

		$url = 'https://apilist.tronscan.org/api/account';


		$curl = curl_init();
	   	curl_setopt_array($curl, array(
	       CURLOPT_RETURNTRANSFER => 1,
	       CURLOPT_URL => $url.'?'.http_build_query($params),
	       CURLOPT_USERAGENT => 'TRON VIP address checker'
	   	));

	   	$resp = curl_exec($curl);
  	 	echo $resp;

	   	curl_close($curl);
	}

	public function getPrivateKey(){
   		$userID = $_POST['currentUser'];

   		$userWallet = $this->_getRecordsData(
   			$selectfields = array("trc20_wallet.privateKey"), 
	   		$tables = array('trc20_wallet'), 
	   		$fieldName = array('userOwner'), $where = array($userID), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($userWallet[0]->privateKey);
	}

	public function getAddressBSC(){
		$userID =  $_POST['currentUser'];

		$bscWallet = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('bsc_wallet'), 
	   		$fieldName = array('userOwner'), $where = array($userID), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($bscWallet);
	}

	public function getBscBalance(){
		$userAddress =  $_POST['currentUser'];

		$params =[
		  	'module' => 'account',
		  	'action' => 'balance',
		  	'address' => $userAddress,
		  	'apikey' => 'QFT8NW8IFPJ8QEHM8JI5MX1SJCUGZ2IY9H',
		];

		$endpoint = 'https://api.bscscan.com/api';

		$url = $endpoint . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		$resp = curl_exec($curl);
		// echo $resp;

		curl_close($curl);
	}

	public function getBscTokenBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.bsc.chaingateway.io/v1/getTokenBalance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"contractaddress" => $_GET['contractaddress'],
				"binancecoinaddress" => $_GET['bsc_wallet'],
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getTronBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/getTronBalance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"tronaddress" => $_GET['trc20Address'],
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getTRC20Balance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/getTRC20Balance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"tronaddress" => $_GET['trc20Address'],
				"contractaddress" => $_GET['contractaddress'],
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getBinancecoinBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.bsc.chaingateway.io/v1/getBinancecoinBalance");

		$payload = json_encode(
			array(
				"binancecoinaddress" => $_GET['bsc_wallet'],
				// "binancecoinaddress" => '0x719951c1ff1974fd3879606d08d20e43f03de275',
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getTokenDifference(){
		$id = $_GET['tokenName'];

		$params =[
		  	// 'fsyms' => $_GET['tokenName'],
		  	// 'fsyms' => 'trx',
		  	// 'tsyms' => 'usd',
		  	'market_data' => true

		];

		// $endpoint = 'https://min-api.cryptocompare.com/data/pricemultifull';
		$endpoint = 'https://api.coingecko.com/api/v3/coins/'.$id;

		// https://api.coingecko.com/api/v3/coins/tron?market_data=true

		$url = $endpoint . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		$resp = curl_exec($curl);
		// echo $resp;

		curl_close($curl);
	}

	public function getTokenValue(){
		$params =[
		  	'fsym' => $_GET['tokenName'],
		  	'tsyms' => 'usd',
		];

		$endpoint = 'https://min-api.cryptocompare.com/data/price';

		$url = $endpoint . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		$resp = curl_exec($curl);
		// echo $resp;

		curl_close($curl);
	}

	public function getBscWalletTransactions(){
		$userAddress =  $_POST['userAddress'];

		$params =[
		  	'module' => 'account',
		  	'action' => 'txlist',
		  	'address' => $userAddress,
		  	// 'address' => '0xA1fECDC43c1A5F7aCd387F2b709DAd69975d0Ca8',
		  	'startblock' => 0,
		  	'endblock' => 99999999,
		  	'page' => 1,
		  	'offset' => 10,
		  	'sort' => 'desc',
		  	'apikey' => 'QFT8NW8IFPJ8QEHM8JI5MX1SJCUGZ2IY9H',
		];

		$endpoint = 'https://api.bscscan.com/api';

		$url = $endpoint . '?' . http_build_query($params);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);

		$resp = curl_exec($curl);
		// echo $resp;

		curl_close($curl);
	}

	public function getBscWalletTransactionDetails(){
		$txhash =  $_POST['transactionHash'];
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$payload = json_encode(
			array(
				'txid' => $txhash,
			) 
		);

		$ch = curl_init('https://eu.bsc.chaingateway.io/v1/getTransaction');

	   	curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
	   	curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

	   	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	   	$result = curl_exec($ch);
	   	curl_close($ch);

	   	$resultDecoded = json_decode($result);

	   	echo json_encode($resultDecoded);
	}	

	public function getGasPriceBsc(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init('https://eu.bsc.chaingateway.io/v1/getTransaction');

	   	curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

	   	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	   	$result = curl_exec($ch);
	   	curl_close($ch);

	   	$resultDecoded = json_decode($result);

	   	echo json_encode($resultDecoded);
	}

	public function getUserPurchase(){
		$userID =  $_GET['userID'];

		$purchaseHistory = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('buy_crypto_history_tbl'), 
	   		$fieldName = array('userID'), $where = array($userID), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($purchaseHistory);
	}

	public function loadUserWallets(){
		$test = $this->_getRecordsData(
			$selectfields = array("user_tbl.*,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
	   		$tables = array('user_tbl','trc20_wallet','bsc_wallet','erc20_wallet'),
	   		$fieldName = null, $where = null, 
	   		$join = array('user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array('inner','left','left'),
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		echo json_encode($test);
	}

	public function loadAllWithdrawal(){
		$test = $this->_getRecordsData(
			$selectfields = array("withdrawal_tbl.*,user_tbl.fullname, user_tbl.email"), 
	   		$tables = array('withdrawal_tbl','user_tbl'),
	   		$fieldName = null, $where = null, 
	   		$join = array('withdrawal_tbl.userID = user_tbl.userID'), $joinType = array('inner'),
	   		$sortBy = array('withdrawal_tbl.id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		echo json_encode($test);
	}

	public function loadUserWithdrawal(){
		$test = $this->_getRecordsData(
			$selectfields = array("withdrawal_tbl.*,user_tbl.fullname, user_tbl.email"), 
	   		$tables = array('withdrawal_tbl','user_tbl'),
	   		$fieldName = array("withdrawal_tbl.userID"), $where = array($_GET['userID']), 
	   		$join = array('withdrawal_tbl.userID = user_tbl.userID'), $joinType = array('inner'),
	   		$sortBy = array('withdrawal_tbl.id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		echo json_encode(array_slice($test, 0, 10));
	}

	public function getAllSelectedTokens(){
		$test = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('token_selected'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		echo json_encode($test);
	}

	public function getProfileDetails(){
		$test = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('user_tbl'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		echo json_encode($test);
	}

	public function getAllSelectedTokensVer2(){
		$tokenSelectedTable = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('token_selected'),
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

	public function updateTokenManagement(){
		$tokenIDSelected = $_GET['tokenIDSelected'];
		$userID = $_GET['userID'];

		$tableName="token_selected";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'tokenIDSelected'=>$tokenIDSelected,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function getAllPurchase(){
		$res = $this->_getRecordsData(
			$selectfields = array("buy_crypto_history_tbl.*,user_tbl.email,user_tbl.fullname"), 
	   		$tables = array('buy_crypto_history_tbl','user_tbl'),
	   		$fieldName = null, $where = null, 
	   		$join = array('buy_crypto_history_tbl.userID = user_tbl.userID'), $joinType = array('inner'),
	   		$sortBy = array('buy_crypto_history_tbl.id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getAllAppeals(){
		$res = $this->_getRecordsData(
			$selectfields = array("buy_crypto_appeal_tbl.*,buy_crypto_history_tbl.token,buy_crypto_history_tbl.tokenValue,buy_crypto_history_tbl.amountPaid,buy_crypto_history_tbl.amountBought,buy_crypto_history_tbl.dateCreated,user_tbl.email,user_tbl.fullname",), 
	   		$tables = array('buy_crypto_appeal_tbl','buy_crypto_history_tbl','user_tbl',),
	   		$fieldName = null, $where = null, 
	   		$join = array('buy_crypto_appeal_tbl.referenceID = buy_crypto_history_tbl.referenceID','buy_crypto_history_tbl.userID = user_tbl.userID'), $joinType = array('inner','inner'),
	   		$sortBy = array('buy_crypto_appeal_tbl.id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function flagAppeal(){
		$appealID = $_GET['appealID'];
		$adminResponse = $_GET['adminResponse'];

		$tableName="buy_crypto_appeal_tbl";
		$fieldName='id';
		$where=$appealID;

		$insertRecord = array(
			'adminResponse'=>$adminResponse,
			'status'=>1,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function getMyAppeals(){
		$res = $this->_getRecordsData(
			$selectfields = array("buy_crypto_appeal_tbl.*,buy_crypto_history_tbl.token,buy_crypto_history_tbl.tokenValue,buy_crypto_history_tbl.amountPaid,buy_crypto_history_tbl.amountBought,buy_crypto_history_tbl.dateCreated,user_tbl.email,user_tbl.fullname",), 
	   		$tables = array('buy_crypto_appeal_tbl','buy_crypto_history_tbl','user_tbl',),
	   		$fieldName = array('buy_crypto_appeal_tbl.userID'), $where = array($_GET['userID']), 
	   		$join = array('buy_crypto_appeal_tbl.referenceID = buy_crypto_history_tbl.referenceID','buy_crypto_history_tbl.userID = user_tbl.userID'), $joinType = array('inner','inner'),
	   		$sortBy = array('buy_crypto_appeal_tbl.id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function checkReferenceIDIfExist(){
		$res = $this->_getRecordsData(
			$selectfields = array("buy_crypto_history_tbl.*,user_tbl.email,user_tbl.fullname"), 
	   		$tables = array('buy_crypto_history_tbl','user_tbl'),
	   		$fieldName = array('buy_crypto_history_tbl.referenceID'), $where = array($_GET['referenceID']), 
	   		$join = array('buy_crypto_history_tbl.userID = user_tbl.userID'), $joinType = array('inner'),
	   		$sortBy = array('buy_crypto_history_tbl.id'), $sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function saveNewAppeal(){
		$referenceID = $_GET['reference_container'];
		$msg = $_GET['msg_container'];
		$userID = $_GET['userID'];

		$insertRecord = array(
			'referenceID'=>$referenceID,
			'msg'=>$msg,
			'userID'=>$userID,
			'date'=>$this->_getTimeStamp24Hours(),
			'status'=>0,
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'buy_crypto_appeal_tbl', $insertRecord);

		echo $saveQueryNotif;
	}

	public function tokenSaveEdit(){
		$tokenID = $_GET['tokenID'];
		// $adminResponse = $_GET['adminResponse'];

		$tableName="token_reference";
		$fieldName='id';
		$where=$tokenID;

		$insertRecord = array(
			'smartAddress'=>$_GET['contract_address_container'],
			'description'=>$_GET['description_container'],
			'networkId'=>$_GET['network_container'],
			'tokenImage'=>$_GET['token_image_container_container'],
			'tokenName'=>$_GET['token_name_container'],
			'coingeckoTokenId'=>$_GET['coingecko_token_id_container'],

		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
		// echo json_encode($insertRecord)s;
	}

	public function tokenSaveNew(){
		$insertRecord = array(
			'smartAddress'=>$_GET['contract_address_container'],
			'description'=>$_GET['description_container'],
			'networkId'=>$_GET['network_container'],
			'tokenImage'=>$_GET['token_image_container_container'],
			'tokenName'=>$_GET['token_name_container'],
			'coingeckoTokenId'=>$_GET['coingecko_token_id_container'],
			'dateAdded'=>$this->_getTimeStamp24Hours()
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'token_reference', $insertRecord);

		echo $saveQueryNotif;
		// echo json_encode($insertRecord)s;
	}

	public function backupBSCJson(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.bsc.chaingateway.io/v1/exportAddress");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"binancecoinaddress" => $_GET['binancecoinaddress'],
				"password" => MD5($_GET['password']),
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		$jsonFormat = str_replace("'",'"',json_decode($result)->content);
		$filename = json_decode($result)->filename;
		
		file_put_contents("assets/user_files/bsc_backup/".MD5($_GET['password'])."_".$filename.".json", $jsonFormat);

		echo json_encode(
			array(
				'filename'=>MD5($_GET['password'])."_".$filename
			)
		);

	}

	public function getEthereumBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.eth.chaingateway.io/v1/getEthereumBalance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"ethereumaddress" => $_GET['erc20_address']
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getErc20TokenBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.eth.chaingateway.io/v1/getTokenBalance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"ethereumaddress" => $_GET['erc20_address'],
				"contractaddress" => $_GET['contractaddress'],
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getEthGasPrice(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.eth.chaingateway.io/v1/getGasPrice");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				// "ethereumaddress" => $_GET['erc20_address']
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		$resultDecoded = json_decode($result);

		if ($resultDecoded->ok==false) {
			echo json_encode(array(
				// 'gasprice'=>0.0056
				'gasprice'=>40
			));
		}else{
			echo $result;
		}
	}

	public function getBscGasPrice(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.bsc.chaingateway.io/v1/getGasPrice");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				// "ethereumaddress" => $_GET['erc20_address']
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		$resultDecoded = json_decode($result);

		if ($resultDecoded->ok==false) {
			echo json_encode(array(
				// 'gasprice'=>0.0010
				'gasprice'=>7.385
			));
		}else{
			echo $result;
		}
	}

	public function getErc20Transactions(){
		$params =[
		  	"module" => 'account',
		  	"action" => 'txlist',
		  	"address" => $_GET['erc20_wallet'],
		  	"startblock" => '0',
		  	"endblock" => '99999999',
		  	"page" => '1',
		  	"offset" => '10',
		  	"sort" => 'asc',
		  	"apikey" => '7AJHKDFIW1X4P795SGFNZPWH6XMW4TMCKH'
		];

		$url = 'https://api.etherscan.io/api';


		$curl = curl_init();
	   	curl_setopt_array($curl, array(
	       CURLOPT_RETURNTRANSFER => 1,
	       CURLOPT_URL => $url.'?'.http_build_query($params),
	       CURLOPT_USERAGENT => 'TRON VIP address checker'
	   	));

	   	$resp = curl_exec($curl);
  	 	echo $resp;

	   	curl_close($curl);
	}

	public function checkTokenByContractAddress(){
		$res = $this->_getRecordsData(
			$selectfields = array("token_reference.*"), 
	   		$tables = array('token_reference'),
	   		$fieldName = array('token_reference.smartAddress'), $where = array($_GET['smartAddress']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res[0]);
	}

	public function strictModeToggle(){
		$userID = $_GET['userID'];
		$isStrict = ($_GET['isStrict'] == '0') ? 1 : 0;

		$tableName="user_tbl";
		$fieldName='userID';
		$where=$userID;

		$insertRecord = array(
			'isStrict'=>$isStrict,
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo $updateRecordsRes;
	}

	public function getCurrentUserStrictStatus(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('user_tbl'),
	   		$fieldName = array('userID'), $where = array($_POST['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res[0]->isStrict);
	}

	public function saveWithdrawalStrict(){
		$to = $_POST["addressToInput"];
		$amount = $_POST["amountInput"];
		$tokenArray = explode('_', $_POST['tokenContainerSelect']);
		$accountPassword = md5($_POST['accountPassword']);
		$currentUserID = $_POST['currentUserID'];

		if ($tokenArray[1] == "trc20") {
			$privateKeyRes = $this->_getRecordsData(
				$selectfields = array("*"), 
		   		$tables = array('trc20_wallet'), 
		   		$fieldName = array('userOwner'), $where = array($currentUserID), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);


			$privatekey = $privateKeyRes[0]->privateKey;
			$from = $privateKeyRes[0]->address;

			$ch = "https://eu.trx.chaingateway.io/v1/sendTRC20";

			$payload = json_encode(
				array(
					"contractaddress" => $tokenArray[2],
					"from" => $from,
					"to" => $to,
					"privatekey" => $privatekey,
					"amount" => $amount,
				) 
			);

		}elseif ($tokenArray[1] == "trx") {
			$privateKeyRes = $this->_getRecordsData(
				$selectfields = array("*"), 
		   		$tables = array('trc20_wallet'), 
		   		$fieldName = array('userOwner'), $where = array($currentUserID), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);

			$privatekey = $privateKeyRes[0]->privateKey;
			$from = $privateKeyRes[0]->address;
					
			$ch = "https://eu.trx.chaingateway.io/v1/sendTron";

			$payload = json_encode(
				array(
					"to" => $to,
					"privatekey" => $privatekey,
					"amount" => $amount,
				) 
			);

			
		}elseif ($tokenArray[1] == "bsc"){
			$fromBscNetwork = $_POST['fromBscNetwork'];

			if ($tokenArray[0]=="bnb") {
				$ch = "https://eu.bsc.chaingateway.io/v1/sendBinancecoin";

				$payload = json_encode(array(
					"from" => $fromBscNetwork,
					"to" => $to,
					"password" => $accountPassword,
					"amount" => $amount
				));
			}else{
				$ch = "https://eu.bsc.chaingateway.io/v1/sendToken";

				$payload = json_encode(array(
					"from" => $fromBscNetwork,
					"to" => $to,
					"password" => $accountPassword,
					"contractaddress" => $tokenArray[2],
					"amount" => $amount
				));
			}

			
		}elseif ($network == "erc20") {
			$erc20_address = $_POST['erc20_address'];

			if ($smartAddress == null) {
				$ch = "https://eu.eth.chaingateway.io/v1/sendEthereum";

				$payload = json_encode(array(
					"from" => $erc20_address,
					"to" => $to,
					"password" => $accountPassword,
					"amount" => $amount
					// 'nonce' => '4'
				));
			}else{
				$ch = "https://eu.eth.chaingateway.io/v1/sendToken";

				$payload = json_encode(array(
					"from" => $erc20_address,
					"to" => $to,
					"password" => $accountPassword,
					"contractaddress" => $smartAddress,
					"amount" => $amount
				));
			}
		}

		$insertRecord = array(
			'to' => $to,
			'amount' => $amount,
			'userID' => $currentUserID,
			'network' => $tokenArray[1],
			'token' => $tokenArray[0],
			'timestamp' => $this->_getTimeStamp24Hours(),
			'payload' => $payload,
			'url' => $ch,

		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'strict_pending_withdrawal', $insertRecord);
		
		echo json_encode($saveQueryNotif);
	}

	public function loadPendingTransactions(){
		$res = $this->_getRecordsData(
			$selectfields = array("strict_pending_withdrawal.*,user_tbl.email,user_tbl.fullname"), 
	   		$tables = array('strict_pending_withdrawal','user_tbl'),
	   		$fieldName = null, $where = null, 
	   		$join = array('strict_pending_withdrawal.userID = user_tbl.userID'), $joinType = array('inner'),
	   		$sortBy = array('strict_pending_withdrawal.id'), $sortOrder = array(
	   			'desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function ApproveWithdrawal(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('strict_pending_withdrawal'),
	   		$fieldName = array('id'), $where = array($_POST['id']), 
	   		// $fieldName = array('id'), $where = array(2), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init($res[0]->url);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $res[0]->payload);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		$resultDecoded = json_decode($result);

		if ($resultDecoded->ok===true) {
			$deleteQuery = $this->_deleteRecords(
				$tableName = "strict_pending_withdrawal",
			 	$fieldName = array("id"),
			  	$where = array($_POST['id'])
			);
		}

		echo json_encode($resultDecoded);
	}

	public function declineWithdrawal(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "strict_pending_withdrawal",
		 	$fieldName = array("id"),
		  	$where = array($_POST['id'])
		);
		

		echo json_encode($deleteQuery);
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

		$saveQueryNotif = $this->_insertRecords($tableName = 'future_positions', $insertRecord);
		
		if ($saveQueryNotif) {
			echo $saveQueryNotif;
		}else{
			echo false;
		}
	}	

	public function futureGetPendingPositions(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_positions'),
	   		$fieldName = array('userID','status','tradePair'), $where = array($_GET['userID'],'PENDING',$_GET['tradePair']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}	

	public function futureResolvePosition(){
		$id = $_GET['id'];
		$resolvedPrice = $_GET['resolvedPrice'];
		$status = $_GET['status'];

		$tableName="future_positions";
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

	public function futureGetClosedPositions(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_positions'),
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

	public function futureCancelPosition(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "future_positions",
		 	$fieldName = array("id"),
		  	$where = array($_POST['id'])
		);

		echo $deleteQuery;
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

		$saveQueryNotif = $this->_insertRecords($tableName = 'future_risefall_positions', $insertRecord);
		
		if ($saveQueryNotif) {
			echo $saveQueryNotif;
		}else{
			echo false;
		}
	}

	public function futureGetPendingRiseFallPositions(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_risefall_positions'),
	   		$fieldName = array('userID','status','tradePair'), $where = array($_GET['userID'],'PENDING',$_GET['tradePair'],), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function futureCancelRiseFallPosition(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "future_risefall_positions",
		 	$fieldName = array("id"),
		  	$where = array($_POST['id'])
		);

		echo $deleteQuery;
	}

	public function futureResolveRiseFallPosition(){
		$id = $_GET['id'];
		$resolvedPrice = $_GET['resolvedPrice'];
		$status = $_GET['status'];

		$tableName="future_risefall_positions";
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

	public function futureGetClosedRiseFallPositions(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_risefall_positions'),
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

	public function getAllSelectedTokensInfo(){
		$test = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('token_selected'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null 
		);

		$tokenSelected = explode(",",$test[0]->tokenIDSelected);

		$selectfieldsString = '';

		foreach ($tokenSelected as $value) {
			if ($selectfieldsString == '') {
				$selectfieldsString = 'token_reference.id = "'.$value.'"';
			}else{
				$selectfieldsString = $selectfieldsString. ' OR token_reference.id = "'.$value.'"';
			}
		}

		$tokenReference = $this->_getRecordsData(
			$selectfields = array("token_reference.*,network_reference.network"), 
	   		$tables = array('token_reference','network_reference'), 
	   		$fieldName = null, null, 
	   		$join = array('token_reference.networkId = network_reference.id'), $joinType = array('inner'), $sortBy = array('token_reference.tokenName','token_reference.id'), 
	   		$sortOrder = array('asc','desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = array($selectfieldsString), $groupBy = null 
		);


		echo json_encode($tokenReference);
	}

	public function getPriceAlert(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('price_alerts'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res[0]);
	}

	public function updatePriceAlert(){
		$isOn = $_GET['isOn'];
		$tokenIDSelected = $_GET['tokenIDSelected'];
		$userID = $_GET['userID'];

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('price_alerts'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		if (count($res)<=0) {
			$insertRecord = array(
				'isOn' => $resultDecoded->txid,
				'tokenIDSelected' => $resultDecoded->amount,
				'userID' => $resultDecoded->to,
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'price_alerts', $insertRecord);

			echo $saveQueryNotif;

		}else{
			$tableName="price_alerts";
			$fieldName='userID';
			$where=$userID;

			$insertRecord = array(
				'tokens_id'=>$tokenIDSelected,
				'isOn'=>$isOn,
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

			echo $updateRecordsRes;
		}
	}

	public function triggerPriceAlerts(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('price_alerts'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

	  	$isAlert = 0;

		if (count($res)!=0) {
			$datetime1 = date_create($res[0]->lastAlerted);
		  	$datetime2 = date_create($this->_getTimeStamp24Hours());
		  	$interval = date_diff($datetime1, $datetime2);

	  		$tokens_id = explode(",", $res[0]->tokens_id);
	  		$tokensAlerted = explode(",", $res[0]->tokensAlerted);

		  	if($interval->days>=1&&$res[0]->isOn==1){
		  		$isAlert=1;
		  	}

			echo json_encode(array(
				'isAlert'=>$isAlert,
				'tokens'=>$res[0]->tokens_id,
				'tokensAlerted'=>$res[0]->tokensAlerted,
				'array_diff'=>array_diff($tokens_id, $tokensAlerted)
			));
		}else{
			echo json_encode(array(
				'isAlert'=>$isAlert,
			));
		}
		
	}

	public function setTokenPriceAlerted(){
		$tableName="price_alerts";
		$fieldName='userID';
		$where=$_GET['userID'];

		$insertRecord = array(
			'tokensAlerted'=>$_GET['tokenID'],
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	public function updateTokenManagementV2(){

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('token_selected'),
	   		$fieldName = array('userID'), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		$newTokenIDSelected = explode(",",$res[0]->tokenIDSelected);
		array_push($newTokenIDSelected,$_GET['tokenID']);
		
		$tableName="token_selected";
		$fieldName='userID';
		$where=$_GET['userID'];

		$insertRecord = array(
			'tokenIDSelected'=>implode(",",$newTokenIDSelected),
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($newTokenIDSelected);
	}

	public function getAllRiseFall(){

		$res = $this->_getRecordsData(
			$selectfields = array("future_risefall_positions.*,user_tbl.email"), 
	   		$tables = array('future_risefall_positions','user_tbl'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array('future_risefall_positions.userID = user_tbl.userID'), 
	   		$joinType = array('inner'),
	   		$sortBy = array('future_risefall_positions.id'), 
	   		$sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res);
	}

	public function getRiseFallDetailsByID(){

		$res = $this->_getRecordsData(
			$selectfields = array("future_risefall_positions.*,user_tbl.email"), 
	   		$tables = array('future_risefall_positions','user_tbl'),
	   		$fieldName = array('future_risefall_positions.id'), 
	   		$where = array($_GET['id']), 
	   		$join = array('future_risefall_positions.userID = user_tbl.userID'), 
	   		$joinType = array('inner'),
	   		$sortBy = array('future_risefall_positions.id'), 
	   		$sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res[0]);
	}

	public function getAllContractPositions(){

		$res = $this->_getRecordsData(
			$selectfields = array("future_positions.*,user_tbl.email"), 
	   		$tables = array('future_positions','user_tbl'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array('future_positions.userID = user_tbl.userID'), 
	   		$joinType = array('inner'),
	   		$sortBy = array('future_positions.id'), 
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

	public function getFuturePositionDetailsByID(){
		$res = $this->_getRecordsData(
			$selectfields = array("future_positions.*,user_tbl.email"), 
	   		$tables = array('future_positions','user_tbl'),
	   		$fieldName = array('future_positions.id'), 
	   		$where = array($_GET['id']), 
	   		$join = array('future_positions.userID = user_tbl.userID'), 
	   		$joinType = array('inner'),
	   		$sortBy = array('future_positions.id'), 
	   		$sortOrder = array('desc'), 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		echo json_encode($res[0]);
	}

	public function getRiseFallPositionSet(){
		$res = $this->_getRecordsData(
			$selectfields = array("future_risefall_positions.*,set_risefall_position.id AS setID"), 
	   		$tables = array('set_risefall_position','future_risefall_positions'),
	   		$fieldName = array('set_risefall_position.userID'), 
	   		$where = array($_GET['userID']), 
	   		$join = array('set_risefall_position.position_id = future_risefall_positions.id'), 
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
					$tableName = "set_risefall_position",
				 	$fieldName = array("id"),
				  	$where = array($res[$i]->setID)
				);
			}

			echo json_encode($res);
		}
	}

	public function setRiseFallPosition(){
		$insertRecord = array(
			'position_id'=>$_GET['id'],
			'userID'=>$_GET['userID'],
			'dateCreated'=>$this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'set_risefall_position', $insertRecord);
	}

	public function setContractPosition(){
		$insertRecord = array(
			'position_id'=>$_GET['id'],
			'userID'=>$_GET['userID'],
			'dateCreated'=>$this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'set_contract_position', $insertRecord);

		echo $saveQueryNotif;
	}

	public function getFuturePositionSet(){
		$res = $this->_getRecordsData(
			$selectfields = array("future_positions.*,set_contract_position.id AS setID"), 
	   		$tables = array('set_contract_position','future_positions'),
	   		$fieldName = array('set_contract_position.userID'), 
	   		$where = array($_GET['userID']), 
	   		$join = array('set_contract_position.position_id = future_positions.id'), 
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
					$tableName = "set_contract_position",
				 	$fieldName = array("id"),
				  	$where = array($res[$i]->setID)
				);
			}

			echo json_encode($res);
		}
	}

	public function checkIfRisefallSet(){
		$res = $this->_getRecordsData(
			$selectfields = array("future_risefall_positions.*,set_risefall_position.id AS setID"), 
	   		$tables = array('set_risefall_position','future_risefall_positions'),
	   		$fieldName = array('set_risefall_position.position_id'), 
	   		$where = array($_GET['id']), 
	   		$join = array('set_risefall_position.position_id = future_risefall_positions.id'), 
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
					$tableName = "set_risefall_position",
				 	$fieldName = array("id"),
				  	$where = array($res[$i]->setID)
				);
			}

			echo json_encode($res);
		}
	}

	public function risefallGetPositionDetails(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_risefall_positions'),
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

	public function futureCheckIfSet(){
		$res = $this->_getRecordsData(
			$selectfields = array("future_positions.*,set_contract_position.id AS setID"), 
	   		$tables = array('set_contract_position','future_positions'),
	   		$fieldName = array('set_contract_position.position_id'), 
	   		$where = array($_GET['id']),
	   		$join = array('set_contract_position.position_id = future_positions.id'), 
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
					$tableName = "set_contract_position",
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
	   		$tables = array('future_positions'),
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

	public function getToken24HourChange(){
		$container = array();
		$day1Container = 0;
		$day2Container = 0;
		$day3Container = 0;
		$day4Container = 0;
		$day5Container = 0;
		$day6Container = 0;
		$day6Container = 0;

		$day1ContainerArray = array();
		$day2ContainerArray = array();
		$day3ContainerArray = array();
		$day4ContainerArray = array();
		$day5ContainerArray = array();
		$day6ContainerArray = array();
		$day6ContainerArray = array();
		$day7ContainerArray = array();

		// $coinIds = ['binancecoin','tron','bitcoin'];
		$coinIds = explode(",", $_GET['coinIds']);

		foreach ($coinIds as $id) {
			$url = 'https://api.coingecko.com/api/v3/coins/'.$id.'/market_chart';
			$params =[
			  	'vs_currency' => 'usd',
			  	'days' => '8',
			];

			$curl = curl_init();
		   	curl_setopt_array($curl, array(
		       CURLOPT_RETURNTRANSFER => 1,
		       CURLOPT_URL => $url.'?'.http_build_query($params),
		       CURLOPT_USERAGENT => 'Get token PNL'
		   	));

		   	$resp = json_decode(curl_exec($curl));
		   	curl_close($curl);

		   	
		   	array_push($day1ContainerArray, round($this->_getPercentageChange($original = $resp->prices[0][1],$current = $resp->prices[24][1]),2));
		   	array_push($day2ContainerArray, round($this->_getPercentageChange($original = $resp->prices[24][1],$current = $resp->prices[48][1]),2));
		   	array_push($day3ContainerArray, round($this->_getPercentageChange($original = $resp->prices[48][1],$current = $resp->prices[72][1]),2));
		   	array_push($day4ContainerArray, round($this->_getPercentageChange($original = $resp->prices[72][1],$current = $resp->prices[96][1]),2));
		   	array_push($day5ContainerArray, round($this->_getPercentageChange($original = $resp->prices[120][1],$current = $resp->prices[144][1]),2));
		   	array_push($day6ContainerArray, round($this->_getPercentageChange($original = $resp->prices[144][1],$current = $resp->prices[168][1]),2));

		   	if (isset($resp->prices[192][1])) {
		   		array_push($day7ContainerArray, round($this->_getPercentageChange($original = $resp->prices[168][1],$current = $resp->prices[192][1]),2));
		   	}else{
		   		array_push($day7ContainerArray,0);
		   	}
		}

		$average = array_sum($day1ContainerArray)/count($day1ContainerArray);
		array_push($container,round($average,2));

		$average = array_sum($day2ContainerArray)/count($day2ContainerArray);
		array_push($container,round($average,2));


		$average = array_sum($day3ContainerArray)/count($day3ContainerArray);
		array_push($container,round($average,2));


		$average = array_sum($day4ContainerArray)/count($day4ContainerArray);
		array_push($container,round($average,2));


		$average = array_sum($day5ContainerArray)/count($day5ContainerArray);
		array_push($container,round($average,2));


		$average = array_sum($day6ContainerArray)/count($day6ContainerArray);
		array_push($container,round($average,2));


		$average = array_sum($day7ContainerArray)/count($day7ContainerArray);
		array_push($container,round($average,2));

		echo json_encode($container);

		
		

	}


}
