<link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align: center;
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
  <h1>Update User Information</h1>    
</div>

<hr>

<div id="main_modal_container">
	<form id="addUserForm">

		<label class="fw-bold">Email</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-envelope icon-size" aria-hidden="true"></i>
		  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
		</div>

		<label class="fw-bold">Fullname</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-user icon-size" aria-hidden="true"></i>
		  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
		</div>

		<label class="fw-bold">Password</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
		  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>

		<label class="fw-bold">Birthday</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-calendar icon-size" aria-hidden="true"></i>
		  <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Birthday">
		</div>

		<label class="fw-bold">Mobile Number</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-phone icon-size" aria-hidden="true"></i>
		  <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number">
		</div>

	</form>

	<div class="float-right">
		<button type="button" class="btn btn-success" id="save_btn">Save Changes</button>
		<button type="button" class="btn btn-warning" id="delete_btn">Delete</button>
		<button type="button" class="btn btn-danger" id="back_btn">Back</button>
	</div>
</div>

<script type="text/javascript">

	$("#email").val(selectedData.email);
	$("#fullname").val(selectedData.fullname);
	$("#password").val(selectedData.password);
	$("#birthday").val(selectedData.birthday);
	$("#mobilenumber").val(selectedData.mobileNumber);

	console.log(selectedData.email)

	$("#save_btn").on("click",function(){
		$("#addUserForm").submit();
	});

	$("#delete_btn").on("click",function(){
		// $("#addUserForm").submit();
		$.confirm({
	    title: 'Delete?',
	    content: 'Are you sure you want to delete?',
	    buttons: {
	        confirm: function () {
	            var res = ajaxShortLink('deleteUser',{
	            	"userID":selectedData.userID
	            });


	            if(res == 1){
	            	$.toast({
	            	    heading: 'Success!!!',
	            	    text: 'User has been Deleted',
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



	jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	    return (ajaxShortLinkNoParse("compareEmailUpdate",{'email':value, "currentEmail": selectedData.email}))
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
		    data.push({
		    		"name":"userID",
		    		"value":selectedData.userID
		    });

		    var res = ajaxShortLink('updateUserInfo',data);

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