<style>
  .modal-footer{
    display: none;
  }
  #main-container{
    width: 100%; 
    height: 500px; 
    overflow-y: scroll;
  }
  #close_btn{
    background-color: #5426de;
    color: white;
  }

  .bootbox{
  	z-index: 9999999999999;
  }


</style>

<div>
	<h5>Please input your email address and click the reset link on your </h5>
	<input type="text" name="email_recovery" class="form-control mt-2" placeholder="Enter your email address">
	<div id="errorTextRecovery" class="text-center"></div>

	<hr>

	<div class="">
		<button class="btn btn-success btn-block" id="submit_recovery_btn">Submit</button>
		<button class="btn btn-danger btn-block" id="cancel_recovery_btn">Cancel</button>
	</div>
</div>

<script type="text/javascript">
	
	

	$('input[name="email_recovery"]').keypress(function(event){
	  var keycode = (event.keyCode ? event.keyCode : event.which);
	  if(keycode == '13'){
	    $("#submit_recovery_btn").click();
	  }
	});

	$("#submit_recovery_btn").on("click", function(){
		$("#errorTextRecovery").removeClass("text-danger");
		$("#errorTextRecovery").removeClass("text-success");

		var emailRecovery = $('input[name="email_recovery"]').val();
		console.log(emailRecovery);

		if (emailRecovery=="") {
			$("#errorTextRecovery").text("Please Enter Valid Email Address");
			$("#errorTextRecovery").addClass("text-danger");

		}else{
			var res = ajaxShortLinkNoParse("checkEmailAvailability",{
				'email':emailRecovery
			})

			console.log(res);


			if (res==1) {
				$("#errorTextRecovery").text("Email Address Doesn't Exists");
				$("#errorTextRecovery").addClass("text-danger");
			}else{
				$("#errorTextRecovery").addClass("text-success");
				$("#errorTextRecovery").text("We have sent you an email with the recovery link. Recover it within 24 hours or it will expire");

				var res = ajaxShortLinkNoParse("sendRecoveryEmail",{
					'email':emailRecovery
				})

			}

		}
	})

	$("#cancel_recovery_btn").on("click", function(){
		bootbox.hideAll();
	})
</script>