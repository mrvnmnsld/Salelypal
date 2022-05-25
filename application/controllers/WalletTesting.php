<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class walletTesting extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	    // $_SESSION['networkId'] = $res['networkId'];
	    // session_destroy();
	}

    public function walletView(){
		$this->load->view('walletTesting/index');
	}	
	
	public function deposit(){
		$this->load->view('walletTesting/depositView');
	}

	public function withdraw(){
		$this->load->view('walletTesting/withdrawView');
	}

	//Pancho tron wallet

	// {"ok":true,"privatekey":"ff5b8a1134c4f3ddf3665676a736734eb3a5093716cb6e078bb7a509c39c4493","address":"TVi4BkKdcPxcdjkcMfxY5NfUZ2F3krU4C6","hexaddress":"41d884ead1c5d07a59dd8540f84fcb4d730bed9815"}
	public function createWallet(){
		$apikey = "alsyd4j39c4cc0sssogs04k4swcw04k4skksswc00sccs4kgg0sw0w44sw0w84og";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/newAddress");

		// Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				// "ethereumaddress" => '0xaccef84f39a21ce8f04e9ca31c215359af0ad030',
				// "contractaddress" => $_GET['contractaddress'],
			) 	
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;

		// echo "create wallet";
	}

	public function getTronBalance(){
		$apikey = "xxi5par7y80ssgck40wgsgsoso8s4c0wscgso0wk0ok44sk0c0c0gcocwcocgckc";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/getTronBalance");

		// Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"tronaddress" => $_GET["address"],
			) 	
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;

		// echo "create wallet";
	}

	public function sendTron(){
		$apikey = "xxi5par7y80ssgck40wgsgsoso8s4c0wscgso0wk0ok44sk0c0c0gcocwcocgckc	";

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

		// Setup request to send json via POST. This is where all parameters should be entered.
		$payload = json_encode(
			array(
				"to" => $_GET['toAddress'],
				"privatekey" => $_GET['privateKey'],
				"amount" => $_GET['amount']
			) 	
		);

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;

		// echo "create wallet";
	}

	public function sendTron(){
		$apikey = "xxi5par7y80ssgck40wgsgsoso8s4c0wscgso0wk0ok44sk0c0c0gcocwcocgckc	";

		

		if (tokenName == "ETH") {
			$ch = curl_init("https://eu.trx.chaingateway.io/v1/sendTron");

			// Setup request to send json via POST. This is where all parameters should be entered.
			$payload = json_encode(
				array(
					"to" => $_GET['toAddress'],
					"privatekey" => $_GET['privateKey'],
					"amount" => $_GET['amount']
				) 	
			);
		}else{
			
		}

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Authorization: " . $apikey));

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;

		// echo "create wallet";
	}

}

