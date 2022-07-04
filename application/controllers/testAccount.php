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

	

	

	


	

	



}
