<head>
	<link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>

<style type="text/css">
	.modal-footer{
		display: none;
	}

	.error{
		color: red;
	}
	.icon-size{
		font-size: 1.4em;
		max-width: 2em;
	}
</style>

<div class="pagetitle">
  <h1>Update Agent Information</h1>    
</div>

<hr>

<div id="main_modal_container">

	<form id="updateAgentForm">

		<label class="fw-bold">Fullname</label>
		<div class="input-group mb-3">
			<i class="input-group-text fa fa-user-o icon-size" aria-hidden="true"></i>
		  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
		</div>

		<label class="fw-bold">Country</label>			
		<div class="input-group mb-3">
			<i class="input-group-text fa fa-globe icon-size" aria-hidden="true"></i>
			<select id="country" name="country" class="form-select">
			  <option value="" selected>Choose Country</option>
			  <option value="PHL">Philippines</option>
			  <option value="IND">India</option>
			  <option value="SA">Saudi Arabia</option>
			</select>
		</div>

		<label class="fw-bold">Username</label>	
		<div class="input-group mb-3">
			<i class="input-group-text fa fa-user-circle icon-size" aria-hidden="true"></i>
		  <input type="text" class="form-control" id="username" name="username" placeholder="Username">
		</div>

		<label class="fw-bold">Password</label>
		<div class="input-group mb-3">
			<i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
		  <input type="password" class="form-control" id="password" name="password" placeholder="*Note: Only enter value if changing">
		</div>

	</form>

	<div class="float-right">
		<button type="button" class="btn btn-success" id="save_btn">Save Changes</button>
		<button type="button" class="btn btn-warning" id="delete_btn">Delete</button>
		<button type="button" class="btn btn-danger" id="back_btn">Back</button>
	</div>
</div>

<script type="text/javascript">

	$("#fullname").val(selectedData.fullname);
	$("#country").val(selectedData.country);
	$("#username").val(selectedData.username);
	// $("#password").val(selectedData.password);

	// console.log(selectedData.email)

	$("#save_btn").on("click",function(){
		$("#updateAgentForm").submit();
	});

	$("#delete_btn").on("click",function(){
		// $("#addUserForm").submit();
		$.confirm({
	    title: 'Delete?',
	    content: 'Are you sure you want to delete?',
	    buttons: {
	        confirm: function () {
	            var res = ajaxShortLink('agent/deleteAgent',{
	            	"id":selectedData.id
	            });


	            if(res == 1){
	            	$.toast({
	            	    heading: 'Success!!!',
	            	    text: 'Agent has been Deleted',
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

	            // console.log(res);
	        },
	        cancel: function () {

	        },
	    }
		});
      
	});

	$("#back_btn").on("click", function(){
		bootbox.hideAll();
	});



	// jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	//     return (ajaxShortLinkNoParse("compareEmailUpdate",{'email':value, "currentEmail": selectedData.email}))
	// }, "Email already taken");

	$("#updateAgentForm").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
				fullname: "required",
				country: "required",
				username: "required",
				// password: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#updateAgentForm').serializeArray();
		    data.push({
		    		"name":"id",
		    		"value":selectedData.id
		    });

		    var res = ajaxShortLink('agent/updateAgentInfo',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'Agent Successfully Updated',
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