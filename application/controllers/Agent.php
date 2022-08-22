<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class agent extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	}

	public function agentLogin(){
		$this->load->view('agent/agentLogin');
	}

	public function checkLoginCredentials(){
   		$username = $_GET['username'];
   		$userPassInput = $_GET['password'];



   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('agent_profile_tbl'), 
	   		$fieldName = array('username'), $where = array($username), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);


   		$wrongFlag = 0;
   		$dataToSend = "";

   		if (count($test) == 1) {
	    	session_start();

   			if (md5($userPassInput) == $test[0]->password) {
   				
	   				$dataToSend = $test[0];
	   				$_SESSION["currentUser"] = $dataToSend;
					$wrongFlag = 0;	
   				
   			} else {
   				$wrongFlag = 2;
				//means wrong pass
   			}
   		}else{
   			$wrongFlag = 1;
   			//wrong user
   		}
   		
   		echo json_encode(array("errorCode" => '',"wrongFlag" => $wrongFlag,"data"=>$dataToSend,$username));
	}
	

	public function adminLogout(){
    	session_start();
		// session_destroy();
		session_unset();
		// echo json_encode($_SESSION['currentUser']);
	}

	public function getAgentInvites(){
		$referalCounter = array();
		$referalCounter2ndDegree = array();
		$referalCounter3rdDegree = array();
		$downlineInvites = [];

		$totalCount1st = 0;
		$totalCount2nd = 0;
		$totalCount3rd = 0;
		$totalIndirectPainInUSD = 0;
		$totalDirectPainInUSD = 0;

		// $res = $this->_getRecordsData(
		// 	$selectfields = array("user_tbl.*,CONCAT(COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) ,' USD') AS totalPaidInUSD,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSDNoFormat"), 
		// 	$tables = array('user_tbl','buy_crypto_history_tbl'), 
			
		// 	$join = array('user_tbl.userID = buy_crypto_history_tbl.userID'), $joinType = array("LEFT"), $sortBy = null, 
		// 	$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
		// );

		$res = $this->_getRecordsData(
			$selectfields = array("user_tbl.*,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password,CONCAT(COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) ,' USD') AS totalPaidInUSD,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSDNoFormat"), 
	   		$tables = array('user_tbl','trc20_wallet','bsc_wallet','erc20_wallet','buy_crypto_history_tbl'),
	   		$fieldName = array('referType','referred_user_id'), $where = array('agent',$_GET['agentID']), 
	   		$join = array('user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner','user_tbl.userID = buy_crypto_history_tbl.userID'), $joinType = array('inner','left','left',"LEFT"),
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = array("user_tbl.userID")
		);

		foreach ($res as $key => $value) {
			$userInvite = $this->_getRecordsData(
				$selectfields = array("user_tbl.*,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSD,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
				$tables = array('user_tbl','buy_crypto_history_tbl',"trc20_wallet","bsc_wallet","erc20_wallet"), 
				$fieldName = array('referType','referred_user_id'), $where = array('user',$value->userID), 
				$join = array('user_tbl.userID = buy_crypto_history_tbl.userID','user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array("LEFT","LEFT","LEFT","LEFT"), $sortBy = null, 
				$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
			);

			$value->degree = "Direct";
			$downlineInvites[] = $value;

			$totalDirectPainInUSD = $totalDirectPainInUSD+floatval($value->totalPaidInUSDNoFormat);

			$totalCount1st = $totalCount1st+count($userInvite);

			foreach ($userInvite as $userInviteKey => $userInviteValue) {
				$userInvite2ndDegree = $this->_getRecordsData(
					$selectfields = array("user_tbl.*,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSD,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
					$tables = array('user_tbl','buy_crypto_history_tbl',"trc20_wallet","bsc_wallet","erc20_wallet"), 
					$fieldName = array('referType','referred_user_id'), $where = array('user',$userInviteValue->userID), 
					$join = array('user_tbl.userID = buy_crypto_history_tbl.userID','user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array("LEFT","LEFT","LEFT","LEFT"), $sortBy = null, 
					$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
				);
				$userInviteValue->degree = "Downline (2nd Degree)";

				$downlineInvites[] = $userInviteValue;

				$totalIndirectPainInUSD = $totalIndirectPainInUSD+floatval($userInviteValue->totalPaidInUSD);

				$totalCount2nd = $totalCount2nd+count($userInvite2ndDegree);

				foreach ($userInvite2ndDegree as $userInvite2ndDegreeKey => $userInvite2ndDegreeValue) {
					$userInvite3rdDegree = $this->_getRecordsData(
						$selectfields = array("user_tbl.*,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSD,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
						$tables = array('user_tbl','buy_crypto_history_tbl',"trc20_wallet","bsc_wallet","erc20_wallet"), 
						$fieldName = array('referType','referred_user_id'), $where = array('user',$userInvite2ndDegreeValue->userID), 
						$join = array('user_tbl.userID = buy_crypto_history_tbl.userID','user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array("LEFT","LEFT","LEFT","LEFT"), $sortBy = null, 
						$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
					);

					$userInvite2ndDegreeValue->degree = "Downline (3rd Degree)";
					$downlineInvites[] = $userInvite2ndDegreeValue;

					$totalIndirectPainInUSD = $totalIndirectPainInUSD+floatval($userInvite2ndDegreeValue->totalPaidInUSD);

					foreach ($userInvite3rdDegree as $userInvite3rdDegreeKey => $userInvite3rdDegreeValue) {
						$totalIndirectPainInUSD = $totalIndirectPainInUSD+floatval($userInvite3rdDegreeValue->totalPaidInUSD);
						$userInvite3rdDegreeValue->degree = "Downline (4th Degree)";
						$downlineInvites[] = $userInvite3rdDegreeValue;
					}


					$totalCount3rd = $totalCount3rd+count($userInvite3rdDegree);
				}
			}
		}

		echo json_encode(array($res,$totalCount1st,$totalCount2nd,$totalCount3rd,$totalIndirectPainInUSD,$totalDirectPainInUSD,$downlineInvites));
	}

	public function getAgent(){
		$res = $this->_getRecordsData(
			$selectfields = array("agent_profile_tbl.*, admin_users_tbl.username AS createdBy"), 
	   		$tables = array('agent_profile_tbl','admin_users_tbl'),
	   		$fieldName = null, 
	   		$where = null, 
	   		$join = array("agent_profile_tbl.createdBy = admin_users_tbl.id"),	 
	   		$joinType = array('inner'),
	   		$sortBy = array("id"), 
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

	public function saveNewAgent(){
		$insertRecord = array(
			// 'email' => $_GET['email'],
			// 'fullname' => $_GET['fullname'],
			// 'country' => $_GET['country'],
			'password' => MD5($_GET['password']),
			'username' => $_GET['username'],
			'timestamp' => $this->_getTimeStamp24Hours(),
			'userType' => 'agent',
			'createdBy' => $_GET["id"],
			'isShareContract' => '0',
			'authQRLink' => $_GET['authQRLink'],
			'secret' => $_GET['secret'],
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'agent_profile_tbl', $insertRecord);

		if($saveQueryNotif){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}

		// echo json_encode($insertRecord);
	}

	public function updateAgentInfo(){
		$insertRecord = array(
			'isShareContract' => $_GET['isShareUpdate'],
			// 'email' => $_GET['email'],
			// 'fullname' => $_GET['fullname'],
			// 'country' => $_GET['country'],
			'username' => $_GET['username'],
		);

		if ($_GET['password']!="") {
			$insertRecord['password'] = MD5($_GET['password']);
		}

		$tableName="agent_profile_tbl";
		$fieldName='id';
		$where= $_GET['id'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
		// echo json_encode($insertRecord);
	}

	public function deleteAgent(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "agent_profile_tbl",
		 	$fieldName = array("id"),
		  	$where = array($_GET['id'])
		);
		echo json_encode($deleteQuery);
	}

	public function checkUserNameAvailability(){
   		$username = $_GET['username'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('agent_profile_tbl'), 
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

	public function getMonthlyInvites(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('referType','referred_user_id'), $where = array('agent',$_GET['agentID']), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = array('timestamp LIKE "%'.$_GET['monthYear'].'-%"'), $groupBy = null 
		);

		echo json_encode($res);
	}

	public function getYearlyInvites(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('referType','referred_user_id'), $where = array('agent',$_GET['agentID']), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = array('timestamp LIKE "%'.$_GET['year'].'-%"'), $groupBy = null 
		);

		echo json_encode($res);
	}

	public function getIndirectReferal1stDegree(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('referType','referred_user_id'), $where = array('agent',$_GET['agentID']), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = array('timestamp LIKE "%'.$_GET['year'].'-%"'), $groupBy = null 
		);

		echo json_encode($res);
	}	
	
	public function checkAgentEmailAvailability(){
   		$email = $_GET['email'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('agent_profile_tbl'), 
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

	public function getRanking(){
		$agent = $this->_getRecordsData(
			$selectfields = array("agent_profile_tbl.*"), 
	   		$tables = array('agent_profile_tbl'),
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null,
	   		$sortBy = null, $sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, $like = null,
	   		$whereSpecial = null, $groupBy = null
		);

		$response = [];

		foreach ($agent as $keyFirst => $valueFirst) {
			$referalCounter = array();
			$referalCounter2ndDegree = array();
			$referalCounter3rdDegree = array();
			$downlineInvites = [];

			$totalCount1st = 0;
			$totalCount2nd = 0;
			$totalCount3rd = 0;
			$totalIndirectPainInUSD = 0;
			$totalDirectPainInUSD = 0;

			$res = $this->_getRecordsData(
				$selectfields = array("user_tbl.*,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password,CONCAT(COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) ,' USD') AS totalPaidInUSD,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSDNoFormat"), 
		   		$tables = array('user_tbl','trc20_wallet','bsc_wallet','erc20_wallet','buy_crypto_history_tbl'),
		   		$fieldName = array('referType','referred_user_id'), $where = array('agent',$valueFirst->id), 
		   		$join = array('user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner','user_tbl.userID = buy_crypto_history_tbl.userID'), $joinType = array('inner','left','left',"LEFT"),
		   		$sortBy = null, $sortOrder = null, 
		   		$limit = null, 
		   		$fieldNameLike = null, $like = null,
		   		$whereSpecial = null, $groupBy = array("user_tbl.userID")
			);

			foreach ($res as $key => $value) {
				$userInvite = $this->_getRecordsData(
					$selectfields = array("user_tbl.*,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSD,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
					$tables = array('user_tbl','buy_crypto_history_tbl',"trc20_wallet","bsc_wallet","erc20_wallet"), 
					$fieldName = array('referType','referred_user_id'), $where = array('user',$value->userID), 
					$join = array('user_tbl.userID = buy_crypto_history_tbl.userID','user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array("LEFT","LEFT","LEFT","LEFT"), $sortBy = null, 
					$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
				);

				$value->degree = "Direct";
				$downlineInvites[] = $value;

				$totalDirectPainInUSD = $totalDirectPainInUSD+floatval($value->totalPaidInUSDNoFormat);

				$totalCount1st = $totalCount1st+count($userInvite);

				foreach ($userInvite as $userInviteKey => $userInviteValue) {
					$userInvite2ndDegree = $this->_getRecordsData(
						$selectfields = array("user_tbl.*,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSD,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
						$tables = array('user_tbl','buy_crypto_history_tbl',"trc20_wallet","bsc_wallet","erc20_wallet"), 
						$fieldName = array('referType','referred_user_id'), $where = array('user',$userInviteValue->userID), 
						$join = array('user_tbl.userID = buy_crypto_history_tbl.userID','user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array("LEFT","LEFT","LEFT","LEFT"), $sortBy = null, 
						$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
					);
					$userInviteValue->degree = "Downline (2nd Degree)";

					$downlineInvites[] = $userInviteValue;

					$totalIndirectPainInUSD = $totalIndirectPainInUSD+floatval($userInviteValue->totalPaidInUSD);

					$totalCount2nd = $totalCount2nd+count($userInvite2ndDegree);

					foreach ($userInvite2ndDegree as $userInvite2ndDegreeKey => $userInvite2ndDegreeValue) {
						$userInvite3rdDegree = $this->_getRecordsData(
							$selectfields = array("user_tbl.*,COALESCE(ROUND(SUM(buy_crypto_history_tbl.amountPaid), 2) ,0) AS totalPaidInUSD,trc20_wallet.address AS trc20_wallet,trc20_wallet.privateKey AS trc20_privateKey,bsc_wallet.address AS bsc_wallet,bsc_wallet.password AS bsc_password,erc20_wallet.address AS erc20_wallet,erc20_wallet.password AS erc20_password"), 
							$tables = array('user_tbl','buy_crypto_history_tbl',"trc20_wallet","bsc_wallet","erc20_wallet"), 
							$fieldName = array('referType','referred_user_id'), $where = array('user',$userInvite2ndDegreeValue->userID), 
							$join = array('user_tbl.userID = buy_crypto_history_tbl.userID','user_tbl.userID = trc20_wallet.userOwner','user_tbl.userID = bsc_wallet.userOwner','user_tbl.userID = erc20_wallet.userOwner'), $joinType = array("LEFT","LEFT","LEFT","LEFT"), $sortBy = null, 
							$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array("user_tbl.userID")
						);

						$userInvite2ndDegreeValue->degree = "Downline (3rd Degree)";
						$downlineInvites[] = $userInvite2ndDegreeValue;

						$totalIndirectPainInUSD = $totalIndirectPainInUSD+floatval($userInvite2ndDegreeValue->totalPaidInUSD);

						foreach ($userInvite3rdDegree as $userInvite3rdDegreeKey => $userInvite3rdDegreeValue) {
							$totalIndirectPainInUSD = $totalIndirectPainInUSD+floatval($userInvite3rdDegreeValue->totalPaidInUSD);
							$userInvite3rdDegreeValue->degree = "Downline (4th Degree)";
							$downlineInvites[] = $userInvite3rdDegreeValue;
						}


						$totalCount3rd = $totalCount3rd+count($userInvite3rdDegree);
					}
				}
			}

			$response[] = array(
				'username' => $valueFirst->username,
				'dateJoined' => $valueFirst->timestamp,
				'totalDirectPaidInUSD' => $totalDirectPainInUSD,
				'totalIndirectPaidInUSD' => $totalIndirectPainInUSD,
				'totalPaidInUSD' => floatval($totalIndirectPainInUSD)+floatval($totalDirectPainInUSD)
			);
		}

		usort($response, function($a, $b) { //Sort the array using a user defined function
		    return $a["totalPaidInUSD"] > $b['totalPaidInUSD'] ? -1 : 1; //Compare the scores
		});   

		echo json_encode($response);

		// pretty print JSON
            // $jsonData = json_encode(array(
            //         "test" => $response,
            //     ), JSON_PRETTY_PRINT
            // );
            // echo "<pre>" . $jsonData . "</pre>";
        // pretty print JSON
	}

}

?>
