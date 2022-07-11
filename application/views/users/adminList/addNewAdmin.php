<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align: center;
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
	#mainForm{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}
</style>

<div id="pagetitle_background" class="text-center">
		<label class="h2 mt-2 fw-bold">Add New Admin User</label>
</div>

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

	<hr>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
		<button type="button" class="btn btn-success" id="saveBtn">Save New User</button>
	</div>
</form>


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