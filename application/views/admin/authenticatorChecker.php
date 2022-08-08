<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<div class="form-group">
	<div class="h3 text-center">Authenticator Code:</div>
	<input type="text" class="form-control" name="token" placeholder="Authenticator Code" id="token">
	<small>Please input authenticator code. If QR is not scanned yet message system admin for the QR</small>
</div>

<div id="auth_error_reporter" class="text-center h5 text-danger"></div>

<div class="row">
	<button type="button" class="btn btn-success btn m-2 col" id="auth_submit_btn">Submit</button>
	<button type="button" class="btn btn-danger btn m-2 col" id="auth_cancel_btn">Cancel</button>
</div>

<script type="text/javascript">
	console.log(loginRes.data.secret);

	$("#auth_cancel_btn").on("click",function(){
		bootbox.hideAll();
	});

	$("#auth_submit_btn").on("click",function(e){
		e.preventDefault();

		if ($("#token").val()!="") {
			var resAuth = ajaxShortLink("checkIfAuthenticatorIsCorrect",{
				"secret":loginRes.data.secret,
				"token":$("#token").val()
			})

			console.log(resAuth);

			if (resAuth) {
				bootbox.hideAll();

				$("#loginForm button").empty().append(
			      	'<span class="spinner-border" role="status">'+
			        	'<span class="sr-only">Loading...</span>'+
			  		'</span>'+
			      	"&nbsp Success Login"
			    ).attr('disabled',true);

			    setTimeout(function(){
					window.location.replace("admin-dashboard");
			    }, 1000);

			}else{
				$("#auth_error_reporter").text("Wrong Code. Try Again");
			}
		}else{
			$("#auth_error_reporter").text("Please input token code");
		}

		
	});

	// 
</script>