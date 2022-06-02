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
	#main_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Add New User</label>
</div>

<div id="main_modal_container">
	<form id="add_user_form">

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

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger mr-1" id="back_btn">Back</button>
			<button type="button" class="btn btn-success mr-1" id="save_btn">Save</button>
		</div>
	</form>

</div>

<script type="text/javascript">
	$("#birthday").val(getCurrentDateV3());
	
	$("#save_btn").on("click",function(){
		$("#add_user_form").submit();
	});

	$("#back_btn").on("click", function(){
		bootbox.hideAll();
	});

	jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	    return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
	}, "Email Already Taken");

	$("#add_user_form").validate({
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
		    var data = $('#add_user_form').serializeArray();
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