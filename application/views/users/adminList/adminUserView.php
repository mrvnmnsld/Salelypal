<style type="text/css">
	.modal-footer{
		display: none;
	}
	#pagetitle_background{
		background: #293038;
		color: white;
	}
	#mainQuestionModal{
		background: rgba(0, 0, 0, .1);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="text-center">
		<label class="h2 mt-2">Admin User Details</label>
</div>

<div id="mainQuestionModal">
	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Username:</b></div>	
		<div class="col-md" id="userNameContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>User Type:</b></div>	
		<div class="col-md" id="userTypeContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Block:</b></div>	
		<div class="col-md" id="blockContainer"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Date Created:</b></div>	
		<div class="col-md" id="dateContainer"></div>	
	</div>

	<hr>

	<div class="row">
		<button class="col-sm ml-1 btn btn-primary" id="blockBtn">Block Admin</button>
		<button class="col-sm ml-1 btn btn-primary" id="unblockBtn">Unblock Admin</button>
		<button class="col-sm ml-1 btn btn-success" id="resetBtn">Reset Password</button>
		<button class="col-sm ml-1 btn btn-danger" id="closeBtn">Close</button>
	</div>

</div>

<script type="text/javascript">
	$("#userNameContainer").append(selectedData["username"]);
	$("#userTypeContainer").append(selectedData["userType"]);
	$("#dateContainer").append(selectedData["dateCreated"]);

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

	$("#unblockBtn").on('click', function(){
		$.confirm({
			icon: 'fa fa-ban',
		    title: 'Blocking?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>UNBLOCK</b> this user?',
		    buttons: {
		        confirm: function () {
		        	ajaxShortLink('admin/adminList/unblockAdmin',{'userID':selectedData['id']});
		        	loadDatatable('admin/getAllAdmin');
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
		        	ajaxShortLink('admin/adminList/blockAdmin',{'userID':selectedData['id']});
		        	loadDatatable('admin/getAllAdmin');
		        	bootbox.hideAll();

		        	$.toast({
    			        heading: '<h6>Success!</h6>',
    			        text: 'Successfully Blocked the user!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-left'
    			        // position: 'bottom-center'
    			    });
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
		    content: "Are you sure you want to <b>Reset</b> this user's password? (Default: tronadmin@123)",
		    buttons: {
		        confirm: function () {
		        	ajaxShortLink('admin/adminList/resetAdminPassword',{'userID':selectedData['id']});
		        	loadDatatable('admin/getAllAdmin');
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