<script defer src="assets/lib/faceapi/face-api.min.js"></script>
<!-- <script defer src="assets/lib/faceapi/script.js"></script> -->

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
	#main_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
	
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Account Details</label>
</div>

<div id="main_modal_container">

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>User ID:</b></div>	
		<div class="col-md" id="userID"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Username:</b></div>	
		<div class="col-md" id="username"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Date Created:</b></div>	
		<div class="col-md" id="dateCreated"></div>	
	</div>

	<hr>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="btn btn-sm btn-danger" id="close_btn">Close</button>
		<button type="button" class="btn btn-success mr-1" id="update_btn">Update Account</button>
	</div>

</div>


<script type="text/javascript">

	$("#userID").append(selectedData["userID"]);
	$("#username").append(selectedData["username"]);
	$("#dateCreated").append(selectedData["dateCreated"]);

	$("#close_btn").on('click', function(){
		bootbox.hideAll();
	});

	$("#update_btn").on('click',function(){
		bootbox.alert({
			message: ajaxLoadPage('quickLoadPage',{'pagename':'users/testAccount/updateAccount'}),
			size: 'large',
			centerVertical: true,
			closeButton: false
		});
	});
	
</script>