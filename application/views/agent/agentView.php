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
	<label class="h2 mt-2 fw-bold">Agent Details</label>
</div>

<div id="main_modal_container">

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Email:</b></div>	
		<div class="col-md" id="email"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Fullname:</b></div>	
		<div class="col-md" id="fullname"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Country:</b></div>	
		<div class="col-md" id="country"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Username:</b></div>	
		<div class="col-md" id="username"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Direct Invited:</b></div>	
		<div class="col-md" id="totalinvited"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-3 pl-3"><b>Direct Paid:</b></div>	
		<div class="col-md" id="total_direct_paid_container"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-3 pl-3"><b>Indirect Invited:</b></div>	
		<div class="col-md" id="indirect_invites"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-3 pl-3"><b>Indirect Paid:</b></div>	
		<div class="col-md" id="total_indirect_paid_container"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Monthly Invited:</b></div>	
		<div class="col-md" id="getMonthlyInvites"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-3 pl-3"><b>Yearly Invited:</b></div>	
		<div class="col-md" id="getYearlyInvites"></div>	
	</div>


	<hr>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="btn btn-sm btn-danger" id="closeBtn">Close</button>
		<button type="button" class="btn btn-success mr-1" id="update_btn">Update Information</button>
	</div>

</div>


<script type="text/javascript">

	var d = new Date();
	var month = String(d.getMonth() + 1).padStart(2, '0');
	var year = d.getFullYear();

	var getMonthlyInvites = ajaxShortLink("agent/getMonthlyInvites",{
	'agentID':selectedData.id,
	'monthYear':year+"-"+month
	});

	var getYearlyInvites = ajaxShortLink("agent/getYearlyInvites",{
	'agentID':selectedData.id,
	'year':year
	});

	var getTotalInvites = ajaxShortLink("agent/getAgentInvites",{
	'agentID':selectedData.id,
	});

	console.log(getMonthlyInvites,getYearlyInvites,getTotalInvites);

	$("#email").append(selectedData["email"]);
	$("#fullname").append(selectedData["fullname"]);
	$("#country").append(selectedData["country"]);
	$("#username").append(selectedData["username"]);
	$("#totalinvited").append(getTotalInvites[0].length);
	$("#indirect_invites").text(parseInt(getTotalInvites[1])+parseInt(getTotalInvites[2])+parseInt(getTotalInvites[3]))

	$('#total_indirect_paid_container').text(getTotalInvites[4]+" USD");
	$('#total_direct_paid_container').text(getTotalInvites[5]+" USD");

	$("#getMonthlyInvites").append(getMonthlyInvites.length);
	$("#getYearlyInvites").append(getYearlyInvites.length);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#update_btn").on('click',function(){
		bootbox.alert({
			message: ajaxLoadPage('quickLoadPage',{'pagename':'agent/updateAgent'}),
			size: 'large',
			centerVertical: true,
			closeButton: false
		});
	});
	
</script>