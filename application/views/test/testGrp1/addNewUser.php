<style type="text/css">
	.modal-footer{
		display: none;
	}

	.error{
		color: red;
	}
</style>

<div class="pagetitle">
  <h1>Add New User</h1> 
</div>

<hr>

<div id="main_modal_container">
	<form id="addUserForm">
		<div class="mb-3">
		  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
		</div>

		<div class="mb-3">
		  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
		</div>

		<div class="mb-3">
		  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>

		<div class="mb-3">
		  <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Birthday">
		</div>

		<div class="mb-3">
		  <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number">
		</div>
	</form>

	<div class="float-right">
		<button type="button" class="btn btn-success" id="save_btn">Save</button>
		<button type="button" class="btn btn-danger" id="back_btn">Back</button>
	</div>
</div>

<script type="text/javascript">
	$("#birthday").val(getCurrentDateV3());
	
	$("#save_btn").on("click",function(){
		$("#addUserForm").submit();
	});

	$("#back_btn").on("click", function(){
		bootbox.hideAll();
	});

	jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	    return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
	}, "Email already taken");

	$("#addUserForm").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
				email: {
					required:true,
					checkEmailAvailability:true
				},
				fullname: "required",
				password: "required",
				birthday: "required",
				mobilenumber: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#addUserForm').serializeArray();
		    var res = ajaxShortLink('saveNewUser',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'User Successfully Added',
		    	    icon: 'success',
		    	})

		    	bootbox.hideAll();
		    	loadDatatable('getUsers');
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