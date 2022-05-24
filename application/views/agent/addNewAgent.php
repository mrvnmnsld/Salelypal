<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align:center;
	}
	.error{
		color: red;
	}
	.icon-size{
		font-size: 1.35em;
		max-width: 2em;
		max-height: 2em;
	}

	 .form-control { /* seems working on other ui bugs, no changes on current ui screens */
		height: 2.7em; 
	}

</style>

<div class="pagetitle">
  <h1>Add New User</h1> 
</div>

<hr>

<div id="main_modal_container">

	<form id="addAgentForm">

		<label class="fw-bold">Fullname</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-user-o icon-size" aria-hidden="true"></i>
		  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
		</div>

		<label class="fw-bold">Country</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-globe icon-size" aria-hidden="true"></i>			
				<select id="country" name="country" class="form-select">
				  <option value="" selected>Choose Country</option>
				  <option value="PHL">Philippines</option>
				  <option value="IND">India</option>
				  <option value="SA">Saudi Arabia</option>
				</select>
		</div>

		<label class="fw-bold">Username</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-user-circle icon-size" aria-hidden="true"></i>	
			<input type="text" class="form-control" id="username" name="username" placeholder="Username">	
		</div>


		<label class="fw-bold">Password</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
		  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>

		<div class="float-right">
			<button type="button" class="btn btn-success" id="save_btn">Save</button>
			<button type="button" class="btn btn-danger" id="back_btn">Back</button>
		</div>
		
	</form>

</div>

<script type="text/javascript">
	$("#save_btn").on("click",function(){
		$("#addAgentForm").submit();
	});

	$("#back_btn").on("click", function(){
		bootbox.hideAll();
	});

	// jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	//     return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
	// }, "Email already taken");

	$("#addAgentForm").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
				fullname: "required",
				country: "required",
				username: "required",
				password: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#addAgentForm').serializeArray();

		    data.push({
		    		"name":"id",
		    		"value":currentUser.id
		    });

		    var res = ajaxShortLink('agent/saveNewAgent',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'User Successfully Added',
		    	    icon: 'success',
		    	})

		    	bootbox.hideAll();
		    	loadDatatable('agent/getAgent');
		    }else{
		    	$.toast({
		    	    heading: 'Error!!!',
		    	    text: 'System Error, Please Contact System Admin',
		    	    icon: 'error',
		    	})
		    }

	  	}
	});
</script>