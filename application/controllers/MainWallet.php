<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mainWallet extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	    // $_SESSION['networkId'] = $res['networkId'];
	    // session_destroy();
	}

	public function generateNewMainWallet(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8"; // API Key in your account panel

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/newAddress");

		curl_setopt( $ch, CURLOPT_HTTPHEADER, 
			array(
				"Content-Type:application/json",
				"Authorization:".$apikey
			)
		);

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		$resultdecoded = json_decode($result, true);

		echo $resultdecoded['ok'];
	}	

	public function getBalance(){
		// # ----- REPLACE THE VARIABLES BELOW WITH YOUR DATA -----
		// $apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";
		// $tronaddress = "TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS"; // Tron address you want to get the balance of
		// $contractaddress = "CONTRACTADDRESS"; // Smart contract address of the Token
		// # -------------------------------------------------------


		// # Define function endpoint
		// $ch = curl_init("https://eu.trx.chaingateway.io/v1/getTronBalance");

		// # Setup request to send json via POST. This is where all parameters should be entered.
		// $payload = json_encode(
		// 	array(
		// 		"tronaddress" => $tronaddress,
		// 	) 
		// );

		// curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		// curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		// $result = curl_exec($ch);
		// curl_close($ch);

		// echo $result;

		$params =[
		  	'address' => 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS',
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

	public function sendTrx(){
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
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function viewAccountDetails(){

		$params =[
		  	'address' => 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS',
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

	public function getTokensByNetwork(){
		$networkId = $_GET['networkID'];
		// $networkId = '1,2';
		$networkId = explode(",", $networkId);
		$whereSpecialString = '';

		for ($i=0; $i < count($networkId); $i++) { 
			if ($whereSpecialString == '') {
				$whereSpecialString = 'networkId = '.$networkId[$i];
			}else{
				$whereSpecialString = $whereSpecialString.' OR networkId = '.$networkId[$i];
			}
		}

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('token_reference','network_reference'), 
	   		$fieldName = null, null, 
	   		$join = array('token_reference.networkId = network_reference.id'), $joinType = array('inner'), $sortBy = array('token_reference.id'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = array($whereSpecialString), $groupBy = null 
		);

		echo json_encode($res);
	}

	public function confirmPasswordAdmin(){
   		$password = md5($_GET['password']);
   		$userID = $_GET['currentUser'];

   		$userConfirmPassword = $this->_getRecordsData(
   			$selectfields = array("admin_users_tbl.*"), 
	   		$tables = array('admin_users_tbl'), 
	   		$fieldName = array('password','id'), $where = array($password,$userID), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode(count($userConfirmPassword)==1);
	}

	public function sendWithdrawal(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";
		// POST Varialbles
			$to = $_POST["addressToInput"];
			$amount = $_POST["amountInput"];
			// $tokenArray = explode('_', $_POST['tokenContainerSelect']);
			$network = $_POST['network'];
			$tokenName = $_POST['tokenName'];

			$smartAddress = $_POST['smartAddress'];
			$accountPassword = md5($_POST['accountPassword']);
			$userId = md5($_POST['userId']);


			// $to = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';
			// $amount = 1;
			// $tokenArray = explode('_', 'usdt_trc20_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
		// POST Varialbles

		if ($network == "trc20") {
			$privatekey = '283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c';
			$from = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';

			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTRC20");

			$payload = json_encode(
				array(
					"contractaddress" => $smartAddress,
					"from" => $from,
					"to" => $to,
					"privatekey" => $privatekey,
					"amount" => $amount,
				) 
			);
		}elseif ($network == "trx") {
			$privatekey = '283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c';
			$from = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';
					
			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

			$payload = json_encode(
				array(
					"to" => $to,
					"privatekey" => $privatekey,
					"amount" => $amount,
				) 
			);
		}elseif ($network == "bsc") {
			$fromBscNetwork = $_POST['fromBscNetwork'];

			if ($smartAddress == null) {
				$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendBinancecoin");

				$payload = json_encode(array(
					"from" => $fromBscNetwork,
					"to" => $to,
					"password" => 'kurusaki13',
					"amount" => $amount
				));
			}else{
				$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendToken");

				$payload = json_encode(array(
					"from" => $fromBscNetwork,
					"to" => $to,
					"password" => 'kurusaki13',
					"contractaddress" => $smartAddress,
					"amount" => $amount
				));
			}
		}elseif ($network == "erc20") {
			$erc20_address = $_POST['erc20_address'];

			if ($smartAddress == null) {
				$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendEthereum");

				$payload = json_encode(array(
					"from" => $erc20_address,
					"to" => $to,
					"password" => 'ceb6c970658f31504a901b89dcd3e461',
					"amount" => $amount
					// 'nonce' => '4'
				));
			}else{
				$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendToken");

				$payload = json_encode(array(
					"from" => $erc20_address,
					"to" => $to,
					"password" => 'ceb6c970658f31504a901b89dcd3e461',
					"contractaddress" => $smartAddress,
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
				'token' => $tokenName,
				'network' => $network,
				'txid' => $resultDecoded->txid,
				'amount' => $resultDecoded->amount,
				'toAddress' => $resultDecoded->to,
				'timestamp' => $this->_getTimeStamp24Hours(),
				'userID' => 'main'
			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'withdrawal_tbl', $insertRecord);
		}

		echo json_encode($resultDecoded);
		// echo json_encode($_POST);
		// var_dump($resultDecoded);
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

		$saveQueryNotif = $this->_insertRecords($tableName = 'buy_crypto_history_tbl', $insertRecord);

		// echo json_encode('will send token now');
		if ($saveQueryNotif) {
			$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

			$to = $postValues['userWalletAddress'];
			$privatekey = "283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c";
			$amount = $postValues['amountBought'];

			if ($tokenArray[1] == "trc20") {
				$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTRC20");

				$payload = json_encode(
					array(
						"contractaddress" => $tokenArray[2],
						"from" => 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS',
						"to" => $to,
						"privatekey" => '283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c',
						"amount" => $amount,
					) 
				);
			}elseif ($tokenArray[1] == "trx") {				
				$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

				$payload = json_encode(
					array(
						"to" => $to,
						"privatekey" => '283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c',
						"amount" => $amount,
					) 
				);
			}elseif ($tokenArray[1] == "bsc"){
				if ($tokenArray[0]=="bnb") {
					$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendBinancecoin");

					$payload = json_encode(array(
						"from" => "0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312",
						"to" => $to,
						"password" => 'kurusaki13',
						"amount" => $amount
					));
				}else{
					$ch = curl_init("https://eu.bsc.chaingateway.io/v1/sendToken");

					$payload = json_encode(array(
						"from" => "0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312",
						"to" => $to,
						"password" => 'kurusaki13',
						"contractaddress" => $tokenArray[2],
						"amount" => $amount
					));
				}
			}elseif ($tokenArray[1] == "erc20"){
				if ($tokenArray[0]=="ETH") {
					$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendEthereum");

					$payload = json_encode(array(
						"from" => "0xaccef84f39a21ce8f04e9ca31c215359af0ad030",
						"to" => $to,
						"password" => 'ceb6c970658f31504a901b89dcd3e461',
						"amount" => $amount
					));
				}else{
					$ch = curl_init("https://eu.eth.chaingateway.io/v1/sendToken");

					$payload = json_encode(array(
						"from" => '0xaccef84f39a21ce8f04e9ca31c215359af0ad030',
						"to" => $to,
						"password" => 'ceb6c970658f31504a901b89dcd3e461',
						"contractaddress" => $smartAddress,
						"amount" => $amount
					));
				}
			}

			curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			$result = curl_exec($ch);
			curl_close($ch);

			echo json_encode($result);
		}else{
			echo json_encode(false);
		} 
	}

	public function getTronBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/getTronBalance");

		$payload = json_encode(
			array(
				"tronaddress" => 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS'
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
				"tronaddress" => 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS',
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
				"binancecoinaddress" => '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312',
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getBscTokenBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.bsc.chaingateway.io/v1/getTokenBalance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"contractaddress" => $_GET['contractaddress'],
				"binancecoinaddress" => '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312',
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function createErc20Wallet(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.eth.chaingateway.io/v1/newAddress");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"password" => MD5($_GET['password'])
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
	}

	public function getEthereumBalance(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$ch = curl_init("https://eu.eth.chaingateway.io/v1/getEthereumBalance");

		# Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"ethereumaddress" => '0xaccef84f39a21ce8f04e9ca31c215359af0ad030'
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
				"ethereumaddress" => '0xaccef84f39a21ce8f04e9ca31c215359af0ad030',
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

	public function sendTRC20Token(){
		$apikey = "4h7896o0ujoskkwk84wo0848wo0o0w4wg8sw84wwcs80kwcg4kc8ogwg44s4ocw8";

		$privatekey = '283f71cfa9e4a008a4f618e9447e07c4c3c2a54f1230daaa4147e439001d438c';
		$from = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTRC20");

		$payload = json_encode(
			array(
				"contractaddress" => $_GET["contractaddress"],
				"from" => $from,
				"to" => $_GET["to"],
				"privatekey" => $privatekey,
				"amount" => $_GET["amount"],
			) 
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);
		echo $result;
	}


	

}
