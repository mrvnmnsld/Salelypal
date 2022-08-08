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

<div id="pagetitle_background" class="text-center">
	<label class="h2 mt-2 fw-bold">Admin User Details</label>
</div>

<div id="mainQuestionModal">
	<div class="row">
		<div class="col-6">
			<div class="row text-center">
				<div class="col-md">
					<b>Authenticator QR:</b><br>
					<img id="authQRLink" src="https://api.qrserver.com/v1/create-qr-code/?data=otpauth%3A%2F%2Ftotp%2FSafelyPal+Admin%3Fsecret%3DIHEWOT7HL5AXF2GD&size=200x200&ecc=M/"><br>
					<span>Note: Scan this QR via authenticator (or authy)</span>
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="row">
				<div class="col-md-5"><b>Username:</b></div>	
				<div class="col-md-7" id="userNameContainer"></div>	
			</div>

			<div class="row mt-1">
				<div class="col-md-5"><b>User Type:</b></div>	
				<div class="col-md-7" id="userTypeContainer"></div>	
			</div>

			<div class="row mt-1">
				<div class="col-md-5"><b>Block:</b></div>	
				<div class="col-md-7" id="blockContainer"></div>	
			</div>

			<div class="row mt-1">
				<div class="col-md-5"><b>Date Created:</b></div>	
				<div class="col-md-7" id="dateContainer"></div>	
			</div>
		</div>
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
	$("#authQRLink").attr("src",selectedData["authQRLink"]);

	console.log(selectedData);

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