<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class walletTesting extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	    // $_SESSION['networkId'] = $res['networkId'];
	    // session_destroy();
	}

    //arl tron wallet {"ok":true,"privatekey":"bed3b67b0ad9c4de7fa419beab446100b238e638733412f7daeae00bbcd3a2d0","address":"TDbujCiFRKBk3dYe4PVANaihPeZNXxKVht","hexaddress":"4127d9594dc30c1fb8344a76f1f263003f7b77cb8f"}

	public function createWallet(){
		
        $apikey = "gsc5pmkn94wowo0c8wcwks08wgg484soogkw0occs8cskgggokoggg8gcg4ww0w0"; 

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/newAddress");

		$payload = json_encode(
			array(
				// "tronddress" => 'TDbujCiFRKBk3dYe4PVANaihPeZNXxKVht',
				// "contractaddress" => $_GET['contractaddress'],
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

        $apikey = "gsc5pmkn94wowo0c8wcwks08wgg484soogkw0occs8cskgggokoggg8gcg4ww0w0"; 

		$ch = curl_init("https://eu.trx.chaingateway.io/v1/getTronBalance");

		$payload = json_encode(
			array(
				"tronaddress" => 'TDbujCiFRKBk3dYe4PVANaihPeZNXxKVht',
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

