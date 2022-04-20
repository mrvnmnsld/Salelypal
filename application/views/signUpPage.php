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

<div class="cardboxes p-3 m-2 mb-5">
	<div class="text-center d-none" id="thankYou">
		<span class="h3">
			Thank you for signing up.
		</span>

		<br><br>

		<span>
			We'll be redirecting you back to the login page in a few seconds
		</span> 
	</div>

	<form id="signUpForm">
		<div class="form-group">
			<label for="exampleInputEmail1">Full Name</label>
			<input type="text" class="form-control" name="fullName" aria-describedby="emailHelp" placeholder="Enter Name">
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Birthdate</label>
			<input type="date" class="form-control" name="birthdate" placeholder="Birthdate">
		</div>

		<!-- <div class="form-group">
			<label for="exampleInputEmail1">Mobile Number & OTP</label>
			<input type="number" class="form-control" name="mobileNumber" aria-describedby="emailHelp" placeholder="Enter Mobile Number with country code">
			<small id="emailHelp" class="form-text text-light">Please indicate dialing code ex. (+)01954558879</small>
		</div>

		<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" placeholder="Enter SMS OTP" name="otp">

			<div class="input-group-prepend">
		  		<button class="btn btn-success" id="sendOtp" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Send OTP</button>
			</div>
		</div> -->

		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-light">This will be used as your credentials</small>
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>

		<!-- <div class="form-group">
			<label >Network</label>
			<div class="text-center">
				<select id="network" name="network" class="form-control" multiple>
					<option value="trx" selected disabled data-content="<img style='width:30px;' src='assets/imgs/icons/tron-trx-logo.png'><span class='ml-2 mr-2'>Tron</span>"></option>
					<option value="bsc" data-content="<img style='width:30px;' src='assets/imgs/icons/bsc_logo.png'><span class='ml-2 mr-2'>BSC</span>"></option>
				</select>
			</div>

			<small id="emailHelp" class="form-text text-light">Tron network will be our main network</small>
		</div> -->

		
	  <button type="submit" class="btn btn-success btn-block">Sign up</button>
	</form>
</div>

<script type="text/javascript">
	var generatedOtp = generateOTP();
	console.log(generatedOtp,referalCode);

	$("#backToLogin").on("click", function(){
		var res = ajaxLoadPage('quickLoadPage',{'pagename':'loginform'});

		$("#container").empty();
		$("#container").append(res);
	})

	// $("#network").selectpicker();

	// jQuery.validator.addMethod("matchOTP", function(value, element) {
	//     return (value==generatedOtp);
	// }, "");

	jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
	    return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
	}, "Email already taken");

	// $("#sendOtp").on("click", function(){
	// 	if ($('input[name="mobileNumber"]').valid()) {
	// 		var timeleft = 29;

	// 		ajaxShortLink("sendOtp",{'generatedOtp':generatedOtp,'destination':$('input[name="mobileNumber"]').val()});
	// 		$("#sendOtp").attr("disabled",true);
	// 		$("#sendOtp").text("Resend in 30 Seconds");

	// 		var timer = setInterval(function(){
	// 	 		$("#sendOtp").text("Resend in "+timeleft+" Seconds");

	// 			if(timeleft <= 0){
	// 				$("#sendOtp").attr("disabled",false);
	// 	 			$("#sendOtp").text("Resend");

	// 				clearInterval(timer);
	// 			}
	// 	  		timeleft -= 1;
	// 		}, 1000);
	// 	}
	// });

	$("#signUpForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			fullName: "required",
			birthdate: "required",
			// mobileNumber: "required",
			// otp: {
			// 	required:true,
			// 	matchOTP:true
			// },
			email: {
				required:true,
				checkEmailAvailability:true
			},
			password: {
				required:true,
				minlength: 6
			}
	  	},
	  	messages: {
	  		otp: ""
  	   	},
	  	submitHandler: function(form){
		    var data = $('#signUpForm').serializeArray();
		    console.log(data);

		    var res = ajaxShortLink("saveSignUpForm",data);

		    console.log(res);

		    if(res==true){
		    	$("#thankYou").removeClass('d-none');
		    	$("#signUpForm").addClass('d-none');

	    		var timeleft = 3;

	    		var timer = setInterval(function(){
	    			if(timeleft <= 0){
	    				var res = ajaxLoadPage('quickLoadPage',{'pagename':'loginform'});

	    				$("#container").empty();
	    				$("#container").append(res);

	    				clearInterval(timer);
	    			}
	    	  		timeleft -= 1;
	    		}, 1000);
		    }else{
		    	alert("error in signing up: pleasse contact system admin !errorCode 3322!");
		    }

	  	}
	});
</script>