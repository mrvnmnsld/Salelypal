<style type="text/css">
	.float{
		position:fixed;
		width:40px;
		height:40px;
		top:15px;
		left:15px;
		background-color:white;
		color:red;
		border-radius:50px;
		text-align:center;
		/*box-shadow: 2px 2px 3px #999;*/
	}

	.my-float{
		margin-top:11px;
	}

	.cardboxes{
		background-color: rgba(0,0,0,0.3);
	}
</style>

<a href="#" id="backToLogin" class="float">
	<i class="fa fa-times my-float"></i>
</a>

<div class="h2 text-center" style="font-family: 'Roboto Condensed', sans-serif;">
	<img style="margin-top: 10%;width:60%;" src="assets/imgs/logo_main.png"><br><br>
	<div class="h1 text-center ml-2 mr-2">Registration Form</div>
</div>

<hr style="width:70%;height: 1.5px;" class="bg-dark">

<div class="card p-3 m-2 mb-5">
	<div class="text-center" style="display: block;" id="thankYou">
		<span class="h3">
			Signing up successfully! 
		</span>

		<div>
			You can verify your KYC now or do it later. Verifiying KYC will give you full access to all trade functions without any withdrawal limits
		</div>

		<br>

		<div class="d-flex">
			<button class="flex-fill btn btn-success" id="verify_kyc_btn">Verify Now</button>
			<button class="flex-fill ml-1 btn btn-warning" onclick="$('#backToLogin').click()">Go to Login</button>
		</div>
	</div>

	<!-- KYC upload -->
		<div class="text-center" style="display: none;" id="verify_kyc_container">
			<div>
				<div class="">
					<div id="process_instruction_container" class="text-justify mt-3 main-color-text">
						<span>Note before uploading face image</span>
						<ul>
							<li>Make sure..</li>
							<li>Lighting...</li>
							<li>Clear...</li>
						</ul>
						<span><i id="faceCheckUpload_kyc" class="fa fa-picture-o my-2"></i></span>
						<span id="faceUpload_btn" class=""><small>Upload Face Image <i id="" class="fa fa-edit my-2"></i></small></span>
						<input class="form-control d-none" type="file" name="faceUpload" id="faceUpload" accept="image/png, image/gif, image/jpeg" >
					</div>
				</div>
				<hr>
				<div class="">
					<div id="process_instruction_container" class="text-justify mt-3 main-color-text">
						<span>Note before uploading ID image</span>
						<ul>
							<li>Make sure..</li>
							<li>Lighting...</li>
							<li>Clear...</li>
						</ul>
						<span><i id="IDCheckUpload_kyc" class="fa fa-picture-o my-2"></i></span>
						<span id="IDUpload_btn" class=""><small>Upload ID <i id="" class="fa fa-edit my-2"></i></small></span>
						<input class="form-control d-none" type="file" name="IDUpload" id="IDUpload" accept="image/png, image/gif, image/jpeg" >
					</div>
				</div>
			</div>
		</div>
	<!-- KYC upload -->

	<form id="signUpForm" style="display:none;">
		<div class="form-group">
			<label for="exampleInputEmail1">Full Name</label>
			<input type="text" class="form-control" name="fullName" aria-describedby="emailHelp" placeholder="Enter Name">
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Birthdate</label>
			<input type="date" class="form-control" name="birthdate" placeholder="Birthdate">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Mobile </label>
			<input type="number" class="form-control" name="mobileNumber" aria-describedby="emailHelp" placeholder="Enter Mobile Number with country code">
			<small id="emailHelp" class="form-text text-light">Please indicate dialing code ex. (+)01954558879</small>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-light">This will be used as your credentials</small>
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>

	  <button type="submit" class="btn btn-success btn-block">Sign up</button>
	</form>
</div>

<script type="text/javascript">
	// var currentUserID='32';

	var generatedOtp = generateOTP();
	console.log(generatedOtp,referalCode);

	$("#backToLogin").on("click", function(){
		var res = ajaxLoadPage('quickLoadPage',{'pagename':'loginform'});

		$("#container").empty();
		$("#container").append(res);
	})

	$("#verify_kyc_btn").on("click", function(){
		$("#thankYou").toggle();
		$("#verify_kyc_container").toggle();
	})

	jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	    return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
	}, "Email already taken");

	$("#signUpForm").validate({
	  	errorClass: 'is-invalid text-danger',
/*	  	rules: {
			fullName: "required",
			birthdate: "required",
			mobileNumber: "required",
			email: {
				required:true,
				checkEmailAvailability:true
			},
			password: {
				required:true,
				minlength: 6
			}
	  	},*/
	  	messages: {
	  		otp: ""
  	   	},
	  	submitHandler: function(form){
		    var data = $('#signUpForm').serializeArray();
		    console.log(data);

		    var res = ajaxShortLink("saveSignUpForm",data);
			currentUserID = res;
		    console.log(res);

		    if(res!=false){
		    	console.log("test");
		    	$("#thankYou").toggle();
		    	$("#signUpForm").toggle();


	    		// var timeleft = 3;

	    		// var timer = setInterval(function(){
	    		// 	if(timeleft <= 0){
	    		// 		$("#container").empty();
	    		// 		$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'loginform'}));

	    		// 		clearInterval(timer);
	    		// 	}
	    	 //  		timeleft -= 1;
	    		// }, 1000);
		    }else{
		    	alert("error in signing up: please contact system admin !errorCode 3322!");
		    }

	  	}
	});

    $("#faceUpload_btn").on("click", function(){
        $('#faceUpload').click();
    });

	$("#IDUpload_btn").on("click", function(){
        $('#IDUpload').click();
    });

    $('#faceUpload').change(function(){
		$.confirm({
		    title: 'KYC - Face upload',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to upload image?',
		    buttons: {
		        confirm: function () {
		        	var imageUploadFormData = new FormData();

		        	imageUploadFormData.append(currentUserID+"_faceImage", $('#faceUpload')[0].files[0],currentUserID+"_faceImage");
					imageUploadFormData.append('userID', currentUserID);
			     	backendHandleFormData('saveFaceImageKyc',imageUploadFormData);

    			    $.toast({
    			        heading: '<h6>Face Image Uploaded</h6>',
    			        text: 'Successfull!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-center'
    			    })
		        },
		        cancel: function () {
		        	
		        },
		    }
		});
	});

	$('#IDUpload').change(function(){
		$.confirm({
		    title: 'KYC - ID upload',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to upload image?',
		    buttons: {
		        confirm: function () {
		        	var imageUploadFormData = new FormData();

		        	imageUploadFormData.append(currentUserID+"_IDImage", $('#IDUpload')[0].files[0],currentUserID+"_IDImage");
					imageUploadFormData.append('userID', currentUserID);
			     	backendHandleFormData('saveIDImageKyc',imageUploadFormData);

    			    $.toast({
    			        heading: '<h6>Face Image Uploaded</h6>',
    			        text: 'Successfull!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-center'
    			    })
		        },
		        cancel: function () {
		        	
		        },
		    }
		});
	});


</script>