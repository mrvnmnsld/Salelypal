<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends MY_Controller {

	public function __construct(){
	    parent::__construct();
	    // session_start();
	}

	public function adminLogin(){
		$this->load->view('admin/adminLogin');
	}	

	public function dashboard(){
		$this->load->view('admin/dashboard');
	}	

	public function checkLoginCredentials(){
   		$username = $_GET['username'];
   		$userPassInput = $_GET['password'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('admin_users_tbl'), 
	   		$fieldName = array('username'), $where = array($username), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		$wrongFlag = 0;
   		$dataToSend = "";

   		if (count($test) == 1) {
	    	session_start();

   			if (md5($userPassInput) == $test[0]->password) {
   				if ($test[0]->isBlocked != 0) {
					$wrongFlag = 3;	
					//frozen 
   				}else{
	   				$dataToSend = $test[0];
	   				$_SESSION["currentUser"] = $dataToSend;
					$wrongFlag = 0;	
					// correct sila
   				}
   				
   			} else {
   				$wrongFlag = 2;
				//means wrong pass
   			}
   		}else{
   			$wrongFlag = 1;
   			//wrong user
   		}
   		
   		echo json_encode(array("errorCode" => '',"wrongFlag" => $wrongFlag,"data"=>$dataToSend));
	}

	public function adminLogout(){
    	session_start();
		// session_destroy();
		session_unset();
		// echo json_encode($_SESSION['currentUser']);
	}	

	public function getAllUsers(){
   		$users = $this->_getRecordsData(
   			$selectfields = array("user_tbl.*,DATE_FORMAT(user_tbl.timestamp, '%d-%m-%Y') AS timestamp,kyc_image_tbl.IDImagePath,kyc_image_tbl.FaceImagePath"), 
	   		$tables = array('user_tbl',"kyc_image_tbl"), 
	   		$fieldName = null, $where = null, 
	   		$join = array("user_tbl.userID = kyc_image_tbl.userID"), $joinType = array('left'), $sortBy = array('userID'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);
   		$res = NULL;

   		foreach ($users as $key => $value) {
   			if ($value->referType!=null&&$value->referType!=null) {
	   			if ($value->referType == "agent") {
			   		$res = $this->_getRecordsData(
			   			$selectfields = array("agent_profile_tbl.*"), 
				   		$tables = array('agent_profile_tbl'), 
				   		$fieldName = array("id"), $where = array($value->referred_user_id), 
				   		$join = null, $joinType = null, $sortBy = null, 
				   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			   		);
	   			}else{
	   				$res = $this->_getRecordsData(
			   			$selectfields = array("user_tbl.*"), 
				   		$tables = array('user_tbl'), 
				   		$fieldName = array("userID"), $where = array($value->referred_user_id), 
				   		$join = null, $joinType = null, $sortBy = null, 
				   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			   		);
	   			}
	   			if (count($res)>=1) {
	   				$users[$key]->referedConcat = ucfirst($value->referType).": ".$res[0]->email;
	   			}else{
					$users[$key]->referedConcat = "No User/Agent ";

	   			}
   				// echo json_encode($res);
   			}else{
				$users[$key]->referedConcat = "No referral";
   			}

   		}

   		echo json_encode($users);
    }

	public function blockuser(){
   		$tableName="user_tbl";
   		$fieldName='userID';
   		$where=$_GET['userID'];

   		$insertRecord = array(
   			'isBlocked' => 1
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
    }

	public function unblockuser(){
   		$tableName="user_tbl";
   		$fieldName='userID';
   		$where=$_GET['userID'];

   		$insertRecord = array(
   			'isBlocked' => 0
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
    }

    public function resetPassword(){
   		$tableName="user_tbl";
   		$fieldName='userID';
   		$where=$_GET['userID'];

   		$insertRecord = array(
   			'password' => 'b3cfec2253156129d9acc316487b86f2'
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
    }

	public function getAllAdmin(){
   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('admin_users_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = array('id'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($test);
    }

	public function blockAdmin(){
   		$tableName="admin_users_tbl";
   		$fieldName='id';
   		$where=$_GET['userID'];

   		$insertRecord = array(
   			'isBlocked' => 1
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
    }

	public function unblockAdmin(){
   		$tableName="admin_users_tbl";
   		$fieldName='id';
   		$where=$_GET['userID'];

   		$insertRecord = array(
   			'isBlocked' => 0
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
    }

	public function resetAdminPassword(){
		$tableName="admin_users_tbl";
		$fieldName='id';
		$where=$_GET['userID'];

		$insertRecord = array(
			'password' => '61dc0730216329bfa3d811318b765138'
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		echo json_encode($updateRecordsRes);
	}

	public function saveNewAdminUser(){
		$data = $_GET;

		$insertRecord = array(
			'username' => $data['username'],
			'createdBy' => $data['createdBy'],
			'userType' => $data['usertype'],
			'password' => md5($data['password']),
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'admin_users_tbl', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		} 
	}

	public function loadAllAnnouncement(){
   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('announcement_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($test);
	}

	public function saveEditAnnouncement(){
   		$tableName="announcement_tbl";
   		$fieldName='id';
   		$where=$_GET['id'];

   		$insertRecord = array(
   			'announcements' => $_GET['announcements']
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function loadAllVIPPlans(){
   		$vipPlans = $this->_getRecordsData(
   			$selectfields = array("*,CONCAT(minimumPoints,' | ',minimumReferals) AS pointsCombo"), 
	   		$tables = array('vip_reference'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		for ($i=0; $i < count($vipPlans); $i++) { 
   			$vipPlans[$i]->dailyTasksCount = count(explode(",", $vipPlans[$i]->dailyTasks));
   		}

   		echo json_encode($vipPlans);
	}

	public function addNewVipPlan(){
		$data = $_GET;

		$insertRecord = array(
			'vipdegree' => $data['vipdegree'],	
			'minimumPoints' => $data['minimumPoints'],	
			'minimumReferals' => $data['minimumReferals'],			
			'dailyTasks' => $data['dailyTasks'],			
			'timestamp' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'vip_reference', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		} 
	}

	public function getAllTasks(){
   		$tasks = $this->_getRecordsData(
   			$selectfields = array("task_reference.*,admin_users_tbl.username as createdBy"), 
	   		$tables = array('task_reference','admin_users_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = array('task_reference.createdBy = admin_users_tbl.id'), $joinType = array('inner'), $sortBy = array('task_reference.id'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($tasks);
	}

	public function saveEditVipPlan(){
   		$data=$_GET;

   		$tableName="vip_reference";
   		$fieldName='vipdegree';
   		$where=$data['vipdegree'];

   		$insertRecord = array(
   			'vipdegree' => $data['vipdegree'],	
   			'minimumPoints' => $data['minimumPoints'],	
   			'minimumReferals' => $data['minimumReferals'],			
   			'dailyTasks' => $data['dailyTasks'],			
   			'timestamp' => $this->_getTimeStamp(),
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function minusLastPlan(){
   		$data=$_GET;

		$users = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('user_tbl'), 
	   		$fieldName = array('vip_id'), $where = array($data['vipdegree']), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
		);

		for ($i=0; $i < count($users); $i++) { 
			$tableName="user_tbl";
			$fieldName='userID';
			$where=$users[$i]->userID;

			$insertRecord = array(
				'vip_id' => intval($data['vipdegree'])-1
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);
		}


		$deleteQuery = $this->_deleteRecords(
			$tableName = "vip_reference",
		 	$fieldName = array("vipdegree"),
		  	$where = array($data['vipdegree'])
		);

		

   		echo json_encode(array($deleteQuery));
	}

	public function editVipPlan(){
   		$data=$_GET;

   		$tableName="user_tbl";
   		$fieldName='userID';
   		$where=$data['userID'];

   		$insertRecord = array(
   			'vip_id' => $data['vip_id'],	
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function getAllTopUp(){
   		$topUp = $this->_getRecordsData(
   			$selectfields = array("top_up.*,email,fullname,admin_users_tbl.username as createdBy"), 
	   		$tables = array('top_up','user_tbl','admin_users_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = array('top_up.user_id = user_tbl.userID','top_up.createdBy = admin_users_tbl.createdBy'), $joinType = array('inner','left'), $sortBy = array('top_up.id'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = array('top_up.id') 
   		);

   		echo json_encode($topUp);
	}

	public function deleteTopUp(){
   		$data=$_GET;

   		$deleteQuery = $this->_deleteRecords(
   			$tableName = "top_up",
   		 	$fieldName = array("id"),
   		  	$where = array($data['id'])
   		);

   		echo json_encode($deleteQuery);
	}

	public function addTopUp(){
		$data = $_GET;

		$insertRecord = array(
			'user_id' => $data['user_id'],	
			'amount' => $data['amount'],		
			'date' => $this->_getTimeStamp(),
			'createdBy' => $data['createdBy'],
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'top_up', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		} 
	}

	public function saveEditTask(){
   		$data=$_GET;

   		$tableName="task_reference";
   		$fieldName='id';
   		$where=$data['id'];

   		$insertRecord = array(
   			'details' => $data['details'],	
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function saveNewTask(){
		$data = $_GET;

		$insertRecord = array(
			'details' => $data['details'],	
			'createdBy' => $data['createdBy'],		
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'task_reference', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		} 
	}

	public function checkIfForVIPUpgrade(){
		$data = $_GET;

   		$vipPlans = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('vip_reference'), 
	   		$fieldName = array('vipdegree'), $where = array($data['vipdegree']), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		if ($data['totalPoints'] >= $vipPlans[0]->minimumPoints || $data['totalReferals'] >= $vipPlans[0]->minimumReferals) {
	   		echo json_encode(true);
   		}else{
	   		echo json_encode(false);
   		}
	}

	public function saveEditFaq(){
   		$data=$_GET;

   		$tableName="faq_tbl";
   		$fieldName='id';
   		$where=$data['id'];

   		$insertRecord = array(
   			'question' => $data['question'],	
   			'answer' => $data['answer'],	
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function addNewFaq(){
		$data = $_GET;

		$insertRecord = array(
			'question' => $data['question'],	
			'answer' => $data['answer'],		
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'faq_tbl', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		} 
	}

	public function deleteFaq(){
   		$data=$_GET;

   		$deleteQuery = $this->_deleteRecords(
   			$tableName = "faq_tbl",
   		 	$fieldName = array("id"),
   		  	$where = array($data['id'])
   		);

   		echo json_encode($deleteQuery);
	}

	public function addNewTerm(){
		$data = $_GET;

		$insertRecord = array(
			'terms_details' => $data['terms_details'],	
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'terms_tbl', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		} 
	}

	public function saveEditTerm(){
   		$data=$_GET;

   		$tableName="terms_tbl";
   		$fieldName='id';
   		$where=$data['id'];

   		$insertRecord = array(
   			'terms_details' => $data['terms_details'],	
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function deleteTerm(){
   		$data=$_GET;

   		$deleteQuery = $this->_deleteRecords(
   			$tableName = "terms_tbl",
   		 	$fieldName = array("id"),
   		  	$where = array($data['id'])
   		);

   		echo json_encode($deleteQuery);
	}

	public function deleteUser(){
   		$deleteQuery = $this->_deleteRecords(
   			$tableName = "user_tbl",
   		 	$fieldName = array("userID"),
   		  	$where = array($_GET['userID'])
   		);

   		if ($deleteQuery) {
   			echo true;
   		}else{
   			echo false;
   		}
	}

	

	public function getAllTaskCompleted(){
   		$test = $this->_getRecordsData(
   			$selectfields = array("task_completed.*,CONCAT('USER#',user_tbl.userID,' - ',user_tbl.fullname,' | ',user_tbl.email) AS userInfo,task_reference.details AS taskDetails"), 
	   		$tables = array('task_completed','user_tbl','task_reference'), 
	   		$fieldName = null, $where = null, 
	   		$join = array('task_completed.userID = user_tbl.userID','task_completed.task_id = task_reference.id'), $joinType = array('inner','inner'), $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($test);
	}

	public function validateTaskCompleted(){
   		$data=$_GET;

   		$tableName="task_completed";
   		$fieldName='id';
   		$where=$data['id'];

   		$insertRecord = array(
   			'validatedBy' => $data['validatedBy'],	
   			'points' => $data['points'],	
   			'isValidated' => 1,	
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function getAllAds(){
   		$response = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('ad_images_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($response);
	}

	public function imageUploadForm(){
		$response = array();

		foreach ($_FILES as $key => $value) {
			$config['upload_path'] = 'assets/imgs/home';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES[$key]['name'].'.'.strval(explode("/",$_FILES[$key]['type'])[1]);
			unlink($_POST['oldName']);

   			$this->load->library('upload', $config);
   			$this->load->helper("file");

			if(!$this->upload->do_upload($_FILES[$key]['name'])){
				array_push($response, array('ERROR'=>'1','Reason'=>'Cant upload to server, please contact admin','MORE'=>$this->upload->display_errors(),$exif));
            }else{  
				$data = $this->upload->data();
			}

			$tableName="ad_images_tbl";
			$fieldName='id';
			$where=$_POST['id'];

			$insertRecord = array(
				'url_path'=>'assets/imgs/home/'.$config['file_name'],
			);

			$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

			echo json_encode(array($response,$config['file_name']));
		}			
	}

	public function getAllLinks(){
   		$response = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('link_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($response);
	}

	public function saveEditLink(){
   		$data=$_GET;

   		$tableName="link_tbl";
   		$fieldName='id';
   		$where=$data['id'];

   		$insertRecord = array(
   			'link' => $data['link'],
   		);

   		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

   		echo json_encode($updateRecordsRes);
	}

	public function getTopUpChartData(){
   		$currentDate = date("Y-m-31 H:i:s");
	    $subtractedDate =  date('Y-m-1 H:i:s', strtotime($currentDate. ' -4 months'));

	    $labelArray = array();
	    $dataArray = array();

   		$totalTopUpArray = $this->_getRecordsData(
   			$selectfields = array("top_up.*,MONTHNAME(date) AS monthName"), 
	   		$tables = array('top_up'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = array('date'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = array("date BETWEEN '".$subtractedDate."' AND '".$currentDate."'"), $groupBy = null 
   		);

		$dt = strtotime(date('Y-m-01'));

		$amount1Container = array();

		for ($j = 0; $j <= 3; $j++) {
			$monthNameContainer = date("F", strtotime(" -$j month", $dt));
	    	array_push($labelArray, $monthNameContainer);

	    	$item = null;
	    	foreach($totalTopUpArray as $struct) {
	    	    if ($monthNameContainer == $struct->monthName) {
	    	        $item = $struct;
	    	    }

    	    	if ($item != null) {
    	    		if (isset($amount1Container[$monthNameContainer])) {
    	    			$amount1Container[$monthNameContainer] = intval($amount1Container[$monthNameContainer])+intval($item->amount);
    	    		}else{
        		 		$amount1Container[$monthNameContainer] = intval($item->amount);
    	    		}
    	    	}
	    	}

			

	  //  		echo json_encode(array(array_reverse($dataArray),array_reverse($labelArray)));

		}

		foreach ($amount1Container as $key => $value) {
			array_push($dataArray,$value);
		}

		foreach ($labelArray as $key => $value) {
			if (!array_key_exists($value, $amount1Container)) {
			    array_splice($dataArray, $key, 0, 0);
			}
		}

		

		

   		echo json_encode(array(array_reverse($dataArray),array_reverse($labelArray)));
   		// echo json_encode($totalTopUpArray);
	}

	public function getAllUserTypes(){
   		$response = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('user_type_reference'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($response);
	}

	public function getAllPermission(){
   		$response = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('priviledge_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = array('typeParent','privilegesID'), 
	   		$sortOrder = array('desc','asc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($response);
	}

	public function getGrantedAllPermission(){
   		$response = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('usertypepriv_tbl'), 
	   		// $fieldName = array('userType'), $where = array('superAdmin'), 
	   		$fieldName = array('userType'), $where = array($_GET['userType']), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		$responseOuter = array();

   		foreach ($response as $key => $value) {
   			array_push($responseOuter, $value->priviledgesID);
   		}

   		echo json_encode($responseOuter);
	}

	public function saveEditPermissions(){
		$data=$_GET;

		$deleteQuery = $this->_deleteRecords(
   			$tableName = "usertypepriv_tbl",
   		 	$fieldName = array("userType"),
   		  	$where = array($data['userType'])
   		);

		for ($i=0; $i < count($data['permission']); $i++) { 
   			$insertRecord = array(
   				'priviledgesID' => $data['permission'][$i],
   				'usertype' => $data['userType'],
   			);

			$saveQueryNotif = $this->_insertRecords($tableName = 'usertypepriv_tbl', $insertRecord);
		}
	}

	public function addNewAdminType(){
		$data=$_GET;

		$insertRecord = array(
			'userType' => $data['userType'],
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'user_type_reference', $insertRecord);
	}

	public function checkAdminUserNameValidity(){
   		$username = $_GET['username'];

   		$test = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('admin_users_tbl'), 
	   		$fieldName = array('username'), $where = array($username), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		if (count($test) == 1) {
	    	echo false;
   		}else{
   			echo true;
   		}
	}

	public function getAllVipPoints(){
   		$users = $this->_getRecordsData(
   			$selectfields = array("user_tbl.*"), 
	   		$tables = array('user_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = array('userID'), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		for ($i=0; $i < count($users); $i++) { 
	   		$totalReferals = $this->_getRecordsData(
	   			$selectfields = array("count(*) AS totalReferals"), 
		   		$tables = array('user_tbl'), 
		   		$fieldName = array('referred_user_id'), $where = array($users[$i]->userID), 
		   		$join = null, $joinType = null, $sortBy = array('userID'), 
		   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
	   		);

	   		$totalTopUpArray = $this->_getRecordsData(
	   			$selectfields = array("top_up.*"), 
		   		$tables = array('top_up'), 
		   		$fieldName = array('user_id'), $where = array($users[$i]->userID), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
	   		);

	   		$totalTopUpPoints = 0;

	   		foreach ($totalTopUpArray as $key => $value) {
	   			$totalTopUpPoints = $totalTopUpPoints+intval($value->amount);
	   		}

			$tasksPoints = $this->_getRecordsData(
				$selectfields = array("*"), 
		   		$tables = array('task_completed'), 
		   		$fieldName = array('userID','isValidated'), $where = array($users[$i]->userID,1), 
		   		$join = null, $joinType = null, $sortBy = null, 
		   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
			);

			foreach ($tasksPoints as $key => $value) {
				$totalTopUpPoints = $totalTopUpPoints+intval($value->points);
			}

	   		$users[$i]->totalReferals = $totalReferals[0]->totalReferals;
	   		$users[$i]->totalPoints = $totalTopUpPoints;
   		}

   		echo json_encode($users);
	}

	public function getBettingSettings(){
   		$res = $this->_getRecordsData(
   			$selectfields = array("*"), 
	   		$tables = array('contract_settings_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($res);
	}

	public function saveBettingSettings(){
   		$tableName="contract_settings_tbl";
   		$fieldName='id';

   		$where=1;
   		$insertRecord = array(
   			'value' => $_GET["risefall_minimum"]
   		);
   		$risefall_minimumRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

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

	public function verifyUser(){
		$tableName="user_tbl";
		$fieldName='userID';
		$where=$_GET['userID'];

		$insertRecord = array(
			'verified' => 1
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		// email send
			$email = $_GET['email'];
			require APPPATH.'third_party/phpmailer/src/exemption.php';
			require APPPATH.'third_party/phpmailer/src/phpmailer.php';
			require APPPATH.'third_party/phpmailer/src/smtp.php';
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			
	        $mail->IsSMTP();
			$mail->SMTPAuth=false;
			$mail->SMTPSecure = 'tls'; 
			$mail->SMTPDebug = 2;
	        $mail->Host = 'localhost';
	        $mail->Port = '587';
	        $mail->Username='marvin.developer@waweb.online';
			$mail->Password='kurusaki13';
			
			$mail->setFrom('marvin.developer@waweb.online','SafetyPal Mailer');
			$mail->addAddress($email);
			// $mail->addReplyTo($email,'marvin.developer@waweb.online');
			
			$mail->SMTPOptions = array(
	            'ssl' => array(
	                'verify_peer' => false,
	                'verify_peer_name' => false,
	                'allow_self_signed' => true
	            )
	        );
	        
	        $mail->isHTML(true);
			$mail->Subject='SafetyPal - Mailer';
	    
			$mail->Body=
			'<html>'.
				'<head>'.
				'</head>'.
				'<body>'.
					'<div>'.
						'<div style="background-color: #aea9b3; padding: 10px">'.

							'<div style="width: 550px; border-radius:20px 20px 0px 0px ; background-color: #9327f8; margin:auto; padding: 20px">'.
								'<div style="color: #fff; text-align: center;">'.
									'<div style="font-weight: bold; font-size: 3em;">Welcome to SafetyPal!</div>'.
								'</div>'.
							'</div>'.

							'<div style="height: 350px; width: 550px; background-color: #fff; border-radius: 0px 0px 20px 20px; margin:auto; padding: 20px">'.
								'<div style="text-align: center;">'.
									'<img src="http://testingcenter.xyz/assets/imgs/Email_OTP.png" style="height:100px; width: 100px;margin-top: 50px;">'.
									'<h1 style="color: #9327f8; font-family: Poppins, sans-serif;">'.
									    'Verify your Account'.
									'</h1>'.
									'<h3 style="color: #aea9b3;">Here is your One Time Password '.
					                'to validate your account</h3>'.
									'<p style="font-size: 2em; letter-spacing: 5px; font-weight: bold; border: 1px solid #9327f8; width: 50%; margin:auto; border-radius: 20px;">'.$_GET["otp"].'</p>'.
								'</div>'.
							'</div>'.

						'</div>'.
					'</div>'.
				'</body>'.
			'</html>';
			

			$resultsArray = array();
			

			if(!$mail->send()){
			  	$resultsArray['successEmail'] = false;
			}else{
			  	$resultsArray['successEmail'] = true;
			}
		// email send

		echo json_encode($resultsArray);
	}

	public function rejectedKyc(){
		$tableName="user_tbl";
		$fieldName='userID';
		$where=$_GET['userID'];

		$insertRecord = array(
			'verified' => 2
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		$tableName="kyc_image_tbl";
		$fieldName='userID';
		$where=$_GET['userID'];

		$insertRecord = array(
			'FaceImagePath' => null,
			'IDImagePath' => null
		);

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);


		if (file_exists('assets/imgs/kyc-imgs/face-imgs/'.$_GET['faceFileName'])) {
		    unlink('assets/imgs/kyc-imgs/face-imgs/'.$_GET['faceFileName']);
		}

		if (file_exists('assets/imgs/kyc-imgs/id-imgs/'.$_GET['IdFileName'])) {
		    unlink('assets/imgs/kyc-imgs/id-imgs/'.$_GET['IdFileName']);
		}

		// email send
			$email = $_GET['email'];
			require APPPATH.'third_party/phpmailer/src/exemption.php';
			require APPPATH.'third_party/phpmailer/src/phpmailer.php';
			require APPPATH.'third_party/phpmailer/src/smtp.php';
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			
	        $mail->IsSMTP();
			$mail->SMTPAuth=false;
			$mail->SMTPSecure = 'tls'; 
			$mail->SMTPDebug = 2;
	        $mail->Host = 'localhost';
	        $mail->Port = '587';
	        $mail->Username='marvin.developer@waweb.online';
			$mail->Password='kurusaki13';
			
			$mail->setFrom('marvin.developer@waweb.online','SafetyPal Mailer');
			$mail->addAddress($email);
			// $mail->addReplyTo($email,'marvin.developer@waweb.online');
			
			$mail->SMTPOptions = array(
	            'ssl' => array(
	                'verify_peer' => false,
	                'verify_peer_name' => false,
	                'allow_self_signed' => true
	            )
	        );
	        
	        $mail->isHTML(true);
			$mail->Subject='SafetyPal - Mailer';
	    
			$mail->Body=
			'<html>'.
				'<head>'.
				'</head>'.
				'<body>'.
					'<div>'.
						'<div style="background-color: #aea9b3; padding: 10px">'.

							'<div style="width: 550px; border-radius:20px 20px 0px 0px ; background-color: #9327f8; margin:auto; padding: 20px">'.
								'<div style="color: #fff; text-align: center;">'.
									'<div style="font-weight: bold; font-size: 3em;">Welcome to SafetyPal!</div>'.
								'</div>'.
							'</div>'.

							'<div style="height: 350px; width: 550px; background-color: #fff; border-radius: 0px 0px 20px 20px; margin:auto; padding: 20px">'.
								'<div style="text-align: center;">'.
									'<img src="http://testingcenter.xyz/assets/imgs/Email_OTP.png" style="height:100px; width: 100px;margin-top: 50px;">'.
									'<h1 style="color: #9327f8; font-family: Poppins, sans-serif;">'.
									    'Verify your Account'.
									'</h1>'.
									'<h3 style="color: #aea9b3;">Here is your One Time Password '.
					                'to validate your account</h3>'.
									'<p style="font-size: 2em; letter-spacing: 5px; font-weight: bold; border: 1px solid #9327f8; width: 50%; margin:auto; border-radius: 20px;">'.$_GET["otp"].'</p>'.
								'</div>'.
							'</div>'.

						'</div>'.
					'</div>'.
				'</body>'.
			'</html>';
			

			$resultsArray = array();
			

			if(!$mail->send()){
			  	$resultsArray['successEmail'] = false;
			}else{
			  	$resultsArray['successEmail'] = true;
			}
		// email send

		echo json_encode($updateRecordsRes);
	}

	public function getKYCImages(){
   		$getKYCImages = $this->_getRecordsData(
   			$selectfields = array("kyc_image_tbl.*"), 
	   		$tables = array('kyc_image_tbl'), 
	   		$fieldName = array("userID"), $where = array($_GET['userID']), 
	   		$join = null, $joinType = null, $sortBy = null, 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		if (count($getKYCImages)>=1&&($getKYCImages[0]->IDImagePath!=null||$getKYCImages[0]->FaceImagePath!=null)) {
   			echo json_encode($getKYCImages[0]);
   		}else{
   			echo json_encode(false);
   		}
	}

	public function getFutureRisefallTimings(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_risefall_timings'),
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

	public function addFutureRisefallOption(){
		$insertRecord = array(
			'timing' => $_GET["timing"],
			'income' => $_GET["income"],
			'dateCreated' => $this->_getTimeStamp24Hours(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'future_risefall_timings', $insertRecord);

		if ($saveQueryNotif) {
			echo true;
		}else{
			echo false;
		}
		// echo json_encode($insertRecord);
	}

	public function updateFutureRisefallOption(){

		$insertRecord = array(
			'timing' => $_GET['timing'],
			'income' => $_GET['income'],
		);

		$tableName="future_risefall_timings";
		$fieldName='id';
		$where= $_GET['id'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	public function deleteFutureRisefallOption(){
		$deleteQuery = $this->_deleteRecords(
			$tableName = "future_risefall_timings",
		 	$fieldName = array("id"),
		  	$where = array($_GET['id'])
		);
		echo json_encode($deleteQuery);
	}

	public function faceRecog(){
		$this->load->view('faceRecog/index');
	}

	public function volumeControl(){
		$this->load->view('volumeControl/index');
	}

	public function updateVolumeControl(){
		$insertRecord = array();

		if (isset($_GET['isOn'])) {
			$insertRecord['isOn'] = $_GET['isOn'];
		}

		if (isset($_GET['percentage'])) {
			$insertRecord['percentage'] = $_GET['percentage'];
		}

		$tableName="volume_control_tbl";
		$fieldName='id';
		$where= 1;

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	public function getVolumeControl(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('volume_control_tbl'),
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

	public function getTotalTopUpAndTotalContractBets(){
		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('buy_crypto_history_tbl'),
	   		$fieldName = array("userID"), 
	   		$where = array($_GET['userID']), 
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

		$totalCryptoBuy=0;

		foreach ($res as $key => $value) {
			$totalCryptoBuy =  $totalCryptoBuy+$value->amountPaid;
		}

		$totalContractBetsUsdt = 0;

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_risefall_positions'),
	   		$fieldName = array("userID"), 
	   		$where = array($_GET['userID']), 
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

		foreach ($res as $key => $value) {
			$totalContractBetsUsdt =  $totalContractBetsUsdt+$value->amount;
		}

		$res = $this->_getRecordsData(
			$selectfields = array("*"), 
	   		$tables = array('future_positions'),
	   		$fieldName = array("userID"), 
	   		$where = array($_GET['userID']), 
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

		foreach ($res as $key => $value) {
			$totalContractBetsUsdt =  $totalContractBetsUsdt+$value->amount;
		}

		$res = $this->_getRecordsData(
			$selectfields = array("mining_regular_entry.*,token_reference.tokenName,token_reference.tokenImage,token_reference.smartAddress,token_reference.decimal,network_reference.network,CONCAT(UPPER(token_reference.tokenName),' (',UPPER(network_reference.network),')') AS concatName"), 
	   		$tables = array('mining_regular_entry','mining_regular','token_reference','network_reference'),
	   		$fieldName = array("mining_regular_entry.userID"), 
	   		$where = array($_GET["userID"]), 
	   		$join = array("mining_regular_entry.mining_id = mining_regular.id","mining_regular.token_id = token_reference.id",'token_reference.networkId = network_reference.id'), 
	   		$joinType = array("inner","inner","inner"),
	   		$sortBy = null, 
	   		$sortOrder = null, 
	   		$limit = null, 
	   		$fieldNameLike = null, 
	   		$like = null,
	   		$whereSpecial = null, 
	   		$groupBy = null 
		);

		foreach ($res as $key => $value) {
			if ($value->tokenName == "USDT") {
				$totalContractBetsUsdt =  $totalContractBetsUsdt+$value->balance;
			}
		}

		echo json_encode(array($totalCryptoBuy,$totalContractBetsUsdt));
	}

	public function updateProStatus(){
		$insertRecord = array(
			'isPro' => $_GET['isPro'],
		);

		$tableName="user_tbl";
		$fieldName='userID';
		$where= $_GET['userID'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
		// echo json_encode($insertRecord);
	}

	public function getAllChatSupport(){
   		$getAllChatSupport = $this->_getRecordsData(
   			$selectfields = array("chat_support_tbl.*,user_tbl.fullname,user_tbl.email,admin_users_tbl.username"), 
	   		$tables = array('chat_support_tbl',"user_tbl",'admin_users_tbl'), 
	   		$fieldName = null, $where = null, 
	   		$join = array('chat_support_tbl.userID = user_tbl.userID','chat_support_tbl.adminID = admin_users_tbl.id'), $joinType = array("inner",'left'), $sortBy = array("chat_support_tbl.id"), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($getAllChatSupport);
	}

	public function getChatDetails(){
   		$getAllChatSupport = $this->_getRecordsData(
   			$selectfields = array("chat_support_tbl.*,user_tbl.fullname,user_tbl.email,admin_users_tbl.username"), 
	   		$tables = array('chat_support_tbl',"user_tbl",'admin_users_tbl'), 
	   		$fieldName = array('chat_support_tbl.id'), $where = array($_GET['id']), 
	   		$join = array('chat_support_tbl.userID = user_tbl.userID','chat_support_tbl.adminID = admin_users_tbl.id'), $joinType = array("inner",'left'), $sortBy = array("chat_support_tbl.id"), 
	   		$sortOrder = array('desc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($getAllChatSupport);
	}

	public function updateChatTicket(){
		$insertRecord = array();

		if (isset($_GET['status'])) {
			$insertRecord['status'] = $_GET['status'];
		}

		if (isset($_GET['adminID'])) {
			$insertRecord['adminID'] = $_GET['adminID'];
		}

		$tableName="chat_support_tbl";
		$fieldName='id';
		$where= $_GET['id'];

		$updateRecordsRes = $this->_updateRecords($tableName,array($fieldName), array($where), $insertRecord);

		if($updateRecordsRes){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	public function chatSupportSendMsg(){
		$data = $_GET;

		$insertRecord = array(
			'msg' => $data['msg'],	
			'msgBy' => $data['msgBy'],		
			'chatTicketID' => $data['chatTicketID'],		
			'dateCreated' => $this->_getTimeStamp()
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'chat_support_msgs_tbl', $insertRecord);

		echo json_encode($saveQueryNotif);
	}

	public function getChatTicketMsgs(){
   		$getChatTicketMsgs = $this->_getRecordsData(
   			$selectfields = array("chat_support_msgs_tbl.*"), 
	   		$tables = array('chat_support_msgs_tbl'), 
	   		$fieldName = array('chatTicketID'), $where = array($_GET['chatTicketID']), 
	   		$join = null, $joinType = null, $sortBy = array("chat_support_msgs_tbl.id"), 
	   		$sortOrder = array('asc'), $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null 
   		);

   		echo json_encode($getChatTicketMsgs);
	}

	public function createNewTicket(){
		$data = $_GET;

		$insertRecord = array(
			'userID' => $data['userID'],
			'dateCreated' => $this->_getTimeStamp(),
		);

		$saveQueryNotif = $this->_insertRecords($tableName = 'chat_support_tbl', $insertRecord);

		if ($saveQueryNotif) {
			echo json_encode($saveQueryNotif);
		}else{
			echo json_encode(false);
		} 
	}

	public function deleteChatSupportHistory(){
		$data = $_GET;

		$deleteQuery = $this->_deleteRecords(
			$tableName = "chat_support_tbl",
		 	$fieldName = array("id"),
		  	$where = array($data['id'])
		);

		$deleteQuery = $this->_deleteRecords(
			$tableName = "chat_support_msgs_tbl",
		 	$fieldName = array("chatTicketID"),
		  	$where = array($data['id'])
		);

		echo true;
	}

	



	

	

	

	

	


}
