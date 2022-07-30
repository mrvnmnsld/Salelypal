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
		padding-top: 10px;
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
	.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }
    .switch .toggle { 
    opacity: 0;
    width: 0;
    height: 0;
    }
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }
    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }
    .toggle:checked + .slider {
    background-color: #5426de;
    }
    .toggle:focus + .slider {
    box-shadow: 0 0 1px #5426de;
    }
    .toggle:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }
    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }
    .slider.round:before {
    border-radius: 50%;
    }
</style>

<div id="pagetitle_background" class="text-center">
	<label class="h2 mt-2 fw-bold">Update Login</label>
</div>

<div id="main_modal_container">

	<form id="update_login_form">


		<label class="fw-bold">Username</label>	
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-user-circle icon-size" aria-hidden="true"></i>
		  	<input type="text" class="form-control" id="username_input" name="username" placeholder="Username">
		</div>

		<label class="fw-bold">Old Password</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
		  	<input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
		</div>

		<label class="fw-bold">New Password</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
		  	<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
		</div>

		<hr>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger" id="close_btn">Close</button>
			<button type="button" class="btn btn-success mr-1" id="save_btn">Save Changes</button>
		</div>

	</form>
</div>

<script type="text/javascript">

	$("#username_input").val(currentUser.username);

	$("#save_btn").on("click",function(){
		$("#update_login_form").submit();
	});

	$("#close_btn").on("click", function(){
		bootbox.hideAll();
	});

	jQuery.validator.addMethod("checkAdminUserNameAvailability", function(value, element) {
		if (currentUser.username == value) {
			return true
		}else{
	    	return (ajaxShortLinkNoParse("admin/checkAdminUserNameAvailability",{'username':value}))
		}
	}, "Username already taken");


	jQuery.validator.addMethod("checkPasswordMatch", function(value, element) {
    	return (ajaxShortLinkNoParse("checkPasswordMatch",{
    		'oldPassword':currentUser.password,
    		'matchingPassword':value
    	}))
	}, "Old Password Doesn't match");

	$("#update_login_form").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
			username: {
				required:true,
				minlength:3,
				checkAdminUserNameAvailability:true,
			},
			newPassword: {
				minlength:6,
			},
			oldPassword: {
				checkPasswordMatch: true,
				minlength:6,
				required:true
			}
	  	},
	  	submitHandler: function(form){
		    var data = $('#update_login_form').serializeArray();

		    data.push({
	    		"name":"id",
	    		"value":currentUser.id
		    });


		    var res = ajaxShortLink('admin/updateLoginInfo',data);

		    // console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'Agent Successfully Updated',
		    	    icon: 'success',
		    	})

		    	bootbox.hideAll();
		    	// loadDatatable('agent/getAgent');
		    }else{
		    	$.toast({
		    	    heading: 'Error: System Error. Please contact admin if issue persist',
		    	    text: 'Please try again',
		    	    icon: 'error',
		    	})
		    }

	  	}
	});

		
</script>