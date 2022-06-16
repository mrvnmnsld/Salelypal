<link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
	.modal-footer{
		display: none;
	}

	label.is-invalid{
		text-align: center;
		color: red;
	}

	.icon-size{
		font-size: 1.4em;
		max-width: 2em;
	}
	.form-control { /* seems working on other ui bugs, no changes on current ui screens */
		height: 2.7em; 
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
	}
	#main_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="text-center">
	<label class="h2 mt-2 fw-bold">Update Agent Information</label>
</div>

<div id="main_modal_container">

	<form id="update_agent_form">

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
		  <input type="password" class="form-control" id="password" name="password" placeholder="*Note: Only enter value if changing">
		</div>

		<label class="fw-bold">Confirm Password</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
		  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
		</div>

		<hr>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger mr-1" id="back_btn">Back</button>
			<button type="button" class="btn btn-warning mr-1" id="delete_btn">Delete</button>
			<button type="button" class="btn btn-success mr-1" id="save_btn">Save Changes</button>
		</div>

	</form>
</div>

<script type="text/javascript">

	$("#fullname").val(selectedData.fullname);
	$("#country").val(selectedData.country);
	$("#username").val(selectedData.username);
	// $("#password").val(selectedData.password);

	// console.log(selectedData.email)

	$("#save_btn").on("click",function(){
		$("#update_agent_form").submit();
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



	jQuery.validator.addMethod("checkUserNameAvailability", function(value, element) {
		if (selectedData.username == value) {
			return true
		}else{
	    	return (ajaxShortLinkNoParse("agent/checkUserNameAvailability",{'username':value}))
		}
	}, "Username already taken");

	jQuery.validator.addMethod("confirmPassword", function(value, element) {
		if (value == $("#password").val()) return true
	}, "Password Doesn't Match");

	$("#update_agent_form").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
			fullname: {
				required:true,
				minlength:2,
			},
			country: "required",
			username: {
				required:true,
				minlength:8,
				checkUserNameAvailability:true,
			},
			password: {
				minlength:8,
			},
			confirm_password:{
				confirmPassword: true
			}
	  	},
	  	submitHandler: function(form){
		    var data = $('#update_agent_form').serializeArray();
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