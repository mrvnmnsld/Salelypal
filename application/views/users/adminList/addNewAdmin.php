<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<h3 class="mb-3 display-4">Add New Admin User</h3>

<hr>

<form id="mainForm">
	<div class="form-group">
		<label for="exampleInputEmail1">Username</label>
		<input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter Username" id="username">
	</div>

	<div class="form-group">
		<label for="exampleInputEmail1">User type</label>
		<select type="text" class="form-control" name="usertype" aria-describedby="emailHelp" placeholder="Enter Username" id="usertype">
			<option value="">Select Usertype ...</option>
		</select>
	</div>

	<label for="exampleInputEmail1">Password</label><br>
	<div class="input-group mb-3">
		<input type="password" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" placeholder="Password" name="password" id="passwordContainer">

		<div class="input-group-prepend">
	  		<button class="btn btn-primary" id="showPassword" type="button">Toggle Visibility</button>
	  		<button class="btn btn-success" id="generatePassword" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Generate</button>
		</div>
	</div>
</form>

<hr>

<div class="row m-2">
	<button class="ml-1 col-md btn btn-success" id="saveBtn">Save New User</button>
	<button class="ml-1 col-md btn btn-danger" id="closeBtn">Close</button>
</div>

<script type="text/javascript">

	var userTypes = ajaxShortLink('admin/getAllUserTypes');

	for (var i = 0; i < userTypes.length; i++) {
		$("#usertype").append('<option value="'+userTypes[i].userType+'">'+userTypes[i].userType+'</option>');
	}

	$("#showPassword").on('click',function(){
		if ($("#passwordContainer").attr('type')=="password") {
			$("#passwordContainer").attr('type','text');
		}else{
			$("#passwordContainer").attr('type','password');
		}
	});

	$("#saveBtn").on('click',function(){
		if ($("#mainForm").valid()) {
			$.confirm({
				icon: 'fa fa-plus-circle',
			    title: 'Adding?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want add this new user?',
			    buttons: {
			        confirm: function () {
			        	$("#mainForm").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#closeBtn").on('click',function(){
    	bootbox.hideAll();
		
	});

	$("#generatePassword").on('click',function(){
		$("#passwordContainer").val(generatePassword());
	});

	jQuery.validator.addMethod("alphanumeric", function(value, element) {
	    return this.optional(element) || /^\w+$/i.test(value);
	}, "Letters, numbers, and underscores only please");

	jQuery.validator.addMethod("userNameChecker", function(value, element) {
	    return ajaxShortLink('admin/checkAdminUserNameValidity',{'username': value});
	}, "Username already used");

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			username: {
				alphanumeric: true,
				userNameChecker: true,
				required: true
			},
			password: "required",
			usertype: "required",
	  	},
	  	messages:{
	  		'password': ''
	  	},
	  	submitHandler: function(form){
		    ajaxShortLink(
        		url = 'admin/adminList/saveNewAdminUser',
        		data = {
        			'username': $('#username').val(),
        			'password': $('#passwordContainer').val(),
        			'usertype': $('#usertype').val(),
        			'createdBy': currentUser['id'],
        		}
        	);

		    $.toast({
		        heading: '<h6>Success!</h6>',
		        text: 'Successfully saved all changes!',
		        showHideTransition: 'slide',
		        icon: 'success',
		        position: 'bottom-left'
		    })

		    loadDatatable('admin/getAllAdmin');
		    bootbox.hideAll();
	  	}
	});
</script>