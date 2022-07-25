<style type="text/css">
	button:focus { outline-style: none; }
</style>

<!-- <button class="btn text-dark font-weight-bold" onclick="backPage()">
	<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
	Back
</button> -->

<div id="innerContainer" class="p-3">
	<form>
		<div class="form-group">
			<label class="text-dark font-weight-bold" for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" name="email_container" id="email_container" aria-describedby="emailHelp" placeholder="Enter email">
		</div>

		<div class="form-group">
			<label class="text-dark font-weight-bold" for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" name="password_container" id="password_container" placeholder="Password">
		</div>

		<div class="form-group">
			<label class="text-dark font-weight-bold" for="exampleInputPassword1">Old Password</label>
			<input type="password" class="form-control" name="old_password_container" id="old_password_container" placeholder="Password">
		</div>

		<small class="text-dark font-weight-bold">Change your login credentials, just input new values and make sure your old password is correct. After changing you will be logged out</small>

		<br><br>

		<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
	</form>
</div>


<script type="text/javascript">
	$('#email_container').val(currentUser.email);

	$.validator.addMethod("isPasswordCorrect",function(value, element) {
			var md5Value = ajaxShortLinkNoParse("makeMeMd5",{
				'string':value
			});

			return md5Value==currentUser.password;
		},
		"Password doesn't match"
	);

	$("form").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
			email_container: "required",
			password_container: {
				required: true,
				minlength: 6
			},
			old_password_container: {
				required: true,
				isPasswordCorrect: true
			}
	  	},
	  	submitHandler: function(form){
		    var data = $('form').serializeArray();
	    	data.push({
	    		"name":'userID',
	    		"value":currentUser.userID
	    	});

		    $.confirm({
		        title: 'Changing credentials?',
		        content: 'Are you sure you want to save these changes',
		        buttons: {
		            confirm: function () {
	            		$(".jconfirm-buttons").css("display","none")
		            	var res = ajaxShortLink('saveCredentialEdit',data);

		            	if(res==1){
		            		pushNewNotif("Security changes","Login credentials recently changed, if this is not you please contact our admins",currentUser.userID)
		            		$(".jconfirm-buttons").remove()

		            		setTimeout(function(){
		            			deleteLocalStorageByKey('currentUser');
		            			window.location.href = 'index';//local
		            		}, 2000)
		            		
		            	}else{
		            		$.alert("Error 3320: Please contact admin | Error in saving security changes");
		            	}
		            },
		            cancel: function () {

		            },
		        }
		    });
	  	}
	});



</script>
