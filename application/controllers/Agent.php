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
		

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
			$tables = array('user_tbl'), 
			$fieldName = array('referType','referred_user_id'), $where = array('agent',$_GET['agentID']), 
			$join = null, $joinType = null, $sortBy = null, 
			$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		echo json_encode($res);
	}

	//get data table
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

	//add agent
	public function saveNewAgent(){
		$insertRecord = array(
			'fullname' => $_GET['fullname'],
			'country' => $_GET['country'],
			'password' => MD5($_GET['password']),
			'username' => $_GET['username'],
			'timestamp' => $this->_getTimeStamp24Hours(),
			'userType' => 'agent',
			'createdBy' => $_GET["id"],
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'agent_profile_tbl', $insertRecord);

		if($saveQueryNotif){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}

	
	}
	//agent update
	public function updateAgentInfo(){
		$insertRecord = array(
			'fullname' => $_GET['fullname'],
			'country' => $_GET['country'],
			'username' => $_GET['username']
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
	}
	//agent delete
	public function deleteAgent(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "agent_profile_tbl",
		 	$fieldName = array("id"),
		  	$where = array($_GET['id'])
		);
		echo json_encode($deleteQuery);
	}

}

?>
