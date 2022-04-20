<style type="text/css">
	.modal-footer{
		display: none;
	}

	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
	}
</style>

<div class="h2 text-center">Post an Appeal</div>

<div id="successContainer" class="text-center" style="display: none;">
	<i style="font-size:150px" class="fa fa-check-circle-o text-success" aria-hidden="true"></i><br>
	<span style="font-size:30px" class="text-success">Success!</span>
	<br>

	<span>Appeal Have been posted</span>

	<span>Please wait for our side to reply and review your appeal. This pop up will automatically close in 3 seconds</span>
	
	<br>
</div>

<form id="mainForm">
	<div class="row m-1">
		<div class="col-md-12"><b>Reference ID: </b>
			<input type='text' class="form-control" id="reference_container" name="reference_container"></input>	
		</div>	
	</div>	

	<div class="row m-1">
		<div class="col-md-12"><b>Message: </b>
			<textarea type='text' class="form-control" id="msg_container" name="msg_container"></textarea>	
		</div>	
	</div>

	<hr>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="btn btn-danger m-1" id="cancel_btn">Cancel</button>
		<button type="submit" class="btn btn-success m-1" id="save_btn">Save</button>
	</div>
</form>

<script type="text/javascript">
	var referenceIDDetails = [];

	jQuery.validator.addMethod("checkReferenceIDIfExist", function(value, element) {
	    var found = datatableRows.find(e => e.referenceID === value);
	    
	    if (found === undefined) {
	    	var response = JSON.parse(
	    		ajaxShortLinkNoParse(
	    			"userWallet/checkReferenceIDIfExist",
	    			{'referenceID':value}
	    		)
	    	);

	    	if(response.length == 1){
	    		referenceIDDetails = response[0];
	    		return true;
	    	}else{
	    		return false;
	    	}
	    }else{
	    	return false;
	    }


		
	}, "Reference ID is not valid or you have pending appeal with this reference ID");

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			reference_container: {
				required:true,
				checkReferenceIDIfExist:true
			},
			msg_container: {
				required:true,
				maxlength:150
			},
	  	},
	  	submitHandler: function(form){
		    var data = $('#mainForm').serializeArray();

		    data.push({
		    	'name':'userID',
		    	'value':referenceIDDetails.userID
		    });

		    console.log(data);

		    var res = ajaxShortLink("userWallet/saveNewAppeal",data);
		    console.log(res);

		    if(res){
		    	loadDatatable('userWallet/getMyAppeals',{'userID':currentUser['userID']});
		    	$('#successContainer').toggle();
		    	$('#mainForm').toggle();

		    	setTimeout(function(){
					bootbox.hideAll();
		    	},3000)
		    }
	  	}
	});

	$("#cancel_btn").on('click',function(){
		bootbox.hideAll();
	});	
</script>