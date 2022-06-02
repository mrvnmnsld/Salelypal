<style type="text/css">
	.modal-footer{
		display: none;
	}
	.modal-content{
		background: transparent;
		border: 0;
	}
	#pagetitle_background{
		background: #293038;
		color: white;
		padding: 15px;
		border-radius: 20px 20px 0px 0px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		text-align: center;
	}
	#mainQuestionModal{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">User Details</label>
</div>

<div id="mainQuestionModal">

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Email:</b></div>	
		<div class="col-md" id="emailContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Name:</b></div>	
		<div class="col-md" id="fullnameContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Date Joined:</b></div>	
		<div class="col-md" id="dateContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Birthday:</b></div>	
		<div class="col-md" id="birthdayContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Mobile:</b></div>	
		<div class="col-md" id="mobileNumberContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>VIP Plan:</b></div>	
		<div class="col-md" id="vipContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Block:</b></div>	
		<div class="col-md" id="blockContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-2 pl-3"><b>Last login:</b></div>	
		<div class="col-md" id="lastLoginContainer"></div>	
	</div>

	<hr>

	<div class="row">
		<button class="col-sm ml-1 btn btn-primary" id="blockBtn">Block User</button>
		<button class="col-sm ml-1 btn btn-primary" id="unblockBtn">Unblock User</button>
		<button class="col-sm ml-1 btn btn-success" id="resetBtn">Reset Password</button>
		<button class="col-sm ml-1 btn btn-danger" id="closeBtn">Close</button>
	</div>

</div>

<script type="text/javascript">
	$("#emailContainer").append(selectedData["email"]);
	$("#fullnameContainer").append(selectedData["fullname"]);
	$("#dateContainer").append(selectedData["timestamp"]);
	$("#birthdayContainer").append(selectedData["birthday"]);
	$("#mobileNumberContainer").append(selectedData["mobileNumber"]);
	// $("#ipContainer").append(selectedData["ip_lastLogin"]);
	$("#vipContainer").append("VIP "+selectedData["vip_id"]);
	$("#lastLoginContainer").append(selectedData["lastLoginDate"]+" IP: "+selectedData["ip_lastLogin"]);

	console.log(selectedData["isBlocked"]);

	if (selectedData["isBlocked"] == 1) {
		$('#blockBtn').addClass('disabled');
		$('#blockContainer').addClass('text-danger font-weight-bold');
		$('#blockContainer').text('Yes');
	}else{
		$('#blockContainer').text('No');
		$('#unblockBtn').addClass('disabled');
	}

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#topUpBtn").on('click', function(){
		bootbox.hideAll();
		
		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'topUp/addTopUp'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	});

	$("#unblockBtn").on('click', function(){
		$.confirm({
			icon: 'fa fa-ban',
		    title: 'Blocking?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>UNBLOCK</b> this user?',
		    buttons: {
		        confirm: function () {
		        	ajaxShortLink('admin/userlist/unblockuser',{'userID':selectedData['userID']});
		        	loadDatatable('admin/getAllUsers');
		        	bootbox.hideAll();

		        	$.toast({
    			        heading: '<h6>Success!</h6>',
    			        text: 'Successfully unblocked the user!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-left'
    			        // position: 'bottom-center'
    			    })
		        },
		        cancel: function () {

		        },
		    }
		});
	});

	$("#blockBtn").on('click', function(){
		$.confirm({
			icon: 'fa fa-ban',
		    title: 'Blocking?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to block this user?',
		    buttons: {
		        confirm: function () {
		        	ajaxShortLink('admin/userlist/blockuser',{'userID':selectedData['userID']});
		        	loadDatatable('admin/getAllUsers');
		        	bootbox.hideAll();

		        	$.toast({
    			        heading: '<h6>Success!</h6>',
    			        text: 'Successfully Blocked the user!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-left'
    			        // position: 'bottom-center'
    			    })
		        },
		        cancel: function () {

		        },
		    }
		});
	});

	$("#resetBtn").on('click', function(){
		$.confirm({
			icon: 'fa fa-window-restore',
		    title: 'Resetting?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: "Are you sure you want to <b>Reset</b> this user's password? (Default: tronpassword123)",
		    buttons: {
		        confirm: function () {
		        	ajaxShortLink('admin/userlist/resetPassword',{'userID':selectedData['userID']});
		        	loadDatatable('admin/getAllUsers');
		        	bootbox.hideAll();

		        	$.toast({
    			        heading: '<h6>Success!</h6>',
    			        text: 'Successful reset of password of the user!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-left'
    			        // position: 'bottom-center'
    			    })
		        },
		        cancel: function () {

		        },
		    }
		});
	});
</script>