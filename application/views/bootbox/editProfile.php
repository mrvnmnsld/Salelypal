<hr class="btn-dark h-25">

<form id="editProfileForm">
	<div class="form-group">
		<label for="exampleInputEmail1">Full Name</label>
		<input type="text" class="form-control" name="fullName" aria-describedby="emailHelp" placeholder="Enter Name">
	</div>

	<div class="form-group">
		<label for="exampleInputPassword1">Birthdate</label>
		<input type="date" class="form-control" name="birthday" placeholder="Birthdate">
	</div>

	<!-- <div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
		<small id="emailHelp" class="form-text text-primary">This will be used as your credentials</small>
	</div> -->

	<div class="form-group">
		<label for="exampleInputPassword1">New Password</label>
		<input type="password" class="form-control" name="newPassword" placeholder="New Password">
	</div>

	<div class="form-group">
		<label for="exampleInputPassword1">Confirm Old Password</label>
		<input type="password" class="form-control" name="oldPassword" placeholder="Confirm Password">
	</div>

	<hr class="btn-dark h-25">

	<div class="float-right">
		<button type="button" class="btn btn-danger ml-2" id="close_bootbox_btn">Cancel</button>
		<button type="submit" class="btn btn-success ml-2" id="save_btn">Save edits</button>
	</div>
</form>

<script type="text/javascript">
	jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	    return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
	}, "Email already taken");

	jQuery.validator.addMethod("checkPasswordMatch", function(value, element) {
	    return (ajaxShortLinkNoParse("checkPasswordMatch",{'matchingPassword':value,'oldPassword':currentUser['password']}))
	}, "Old password doesn't match");

	$("#editProfileForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			// email: {
			// 	checkEmailAvailability:true
			// },
			newPassword: {
				minlength: 6
			},
			oldPassword: {
				required:true,
				minlength: 6,
				checkPasswordMatch:true
			}
	  	},
	  	messages: {
	  		otp: ""
  	   	},
	  	submitHandler: function(form){
		    var data = $('#editProfileForm').serializeArray();
		    data.push({'name':'userID','value':currentUser['userID']});

		    console.log(data);

		    var res = ajaxShortLink("editProfile",data);

		    if (res == 1) {
		    	$.toast({
		    	    heading: '<h6>Profile updated</h6>',
		    	    text: 'You will be logged out for security purposes!',
		    	    showHideTransition: 'slide',
		    	    icon: 'success',
		    	    position: 'bottom-center'
		    	})

		    	setTimeout(function() {
		    	  logOutClearStorage();
		    	}, 2000);

		    }

		    console.log(res);
	  	}
	});

	$("#close_bootbox_btn").on('click',function(){
		bootbox.hideAll();
	})
</script>