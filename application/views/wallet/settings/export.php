<style type="text/css">
	button:focus { outline-style: none; }

	.box {
	  float: left;
	  height: 20px;
	  width: 20px;
	  margin-bottom: 15px;
	  border: 1px solid black;
	  clear: both;
	}

	.alert1{
		background-color: #FFC04C;
	}

	.alert2{
		background-color: #00b300;
	}

	.btn-secondary {
		margin-left: 3px!important;
	}

	.input-group-append .btn, .input-group-prepend .btn {
	    position: relative;
	    z-index: 0;
	}

</style>

<button class="btn text-primary" onclick="backPage()">
	<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
	Back
</button>

<div id="innerContainer" class="p-3">


	

	<form>
	  <div class="form-group" id="trc20_container">
	  	<div class="h2 text-center">TRC20 Private Key</div>
	    <div class="input-group mb-3">
	      <input type="password" class="form-control" id="privateKey_input">

	      <div class="input-group-append">
	        <button class="btn btn-secondary" type="button" id="showPrivate">Visibility</button>
	        <button class="btn btn-secondary" type="button" id="copyPrivate">Copy</button>
	      </div>

	    </div>
	  	<small class="form-text text-danger text-center">Do not share your private key.</small>

  	  <div class="font-weight-bold">Note:</div>
  		<div id="note_container">
  			For linking and accessing your wallet, select import wallet to Tron Link and copy paste the private key above
  		</div>
 	 	</div>

 	 	<hr>

	  <div class="form-group mt-1" id="bsc_container">
	  	<div class="h2 text-center">BSC JSON backup</div>

	  	<div class="input-group mb-3">
	  	  <input type="password" class="form-control" id="password_container" placeholder="Please enter your password">

	  	  <div class="input-group-append">
	  	    <button class="btn btn-success" type="button" id="bsc_backup_btn">Download JSON</button>
	  	  </div>
	  	</div>

	  	<div class="text-danger text-center font-weight-bold" id="password_error_container" style=""></div>

	  	<a href="" class="d-none" id="download_link_container" download></a>

	  	<small class="form-text text-danger text-center">
	  		Do not share your JSON file.
	  	</small>

  	  <div class="font-weight-bold">Note:</div>
  		<div id="note_container">
  			You can use this JSON file by heading to other BSC compatible wallet. <br><br>

  			<b>Choose Import Account>Backup>Restore via JSON </b> or something similar then use the filename's string before the under score as the (temporary password).

  			<br><br>

  			<span>
  				<b>Sample: </b><br>
  				<u>Ae236c970658f31504a901b89dcd3e461</u>_UTC--2022-0.......
  			</span>

  			

				
  			

  		</div>


    </div>

 	</div>



	</form>
</div>


<script type="text/javascript">
	var privateKey = ajaxPostLink('getPrivateKey',{'currentUser':currentUser['userID']});
	$('#privateKey_input').val(privateKey);

	$('#showPrivate').on('click', function(){
		var type = $('#privateKey_input').attr('type'); 
		if (type == 'password') {
			$('#privateKey_input').attr('type','text');
		}else{
			$('#privateKey_input').attr('type','password')
		}
	});

	$('#copyPrivate').on('click', function(){
		var type = $('#privateKey_input').attr('type'); 

		if (type == 'password') {
			$('#privateKey_input').attr('type','text');
			$('#privateKey_input').select();
			document.execCommand("copy");
			document.getSelection().removeAllRanges();
			$('#privateKey_input').attr('type','password')
		}else{
			$('#privateKey_input').select();
			document.execCommand("copy");
			document.getSelection().removeAllRanges();
		}

		$.toast({
		    heading: '<h6>Copied!</h6>',
		    text: 'You can now paste your private key',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-center'
		})
	});

	$('#bsc_backup_btn').on('click', function(){
		var password_container = $("#password_container").val()

		if (password_container == "") {
			$("#password_error_container").text('Please input password');
			$("#password_error_container").css('dispaly','block');

			$("#password_error_container").addClass('animate__animated animate__shakeX');

			setTimeout(()=>{
			    $("#password_error_container").removeClass('animate__animated animate__shakeX');
			},500)
		}else{
			var checkPasswordRes = ajaxShortLink("confirmPassword",
				{
					'password':password_container,
					'currentUser':currentUser.userID,

				}
			);

			if (checkPasswordRes) {
				$("#password_error_container").css('dispaly','none');
				var backUpRes = ajaxShortLink(
					"userWallet/backupBSCJson",
					{
						'binancecoinaddress':currentUser.bsc_wallet,
						'password':password_container
					}
				);

				$("#download_link_container").attr('href','assets/user_files/bsc_backup/'+backUpRes.filename+'.json');

				$("#download_link_container")[0].click();

				// $("#bsc_json_container").val(JSON.stringify(backUpRes));

				console.log(backUpRes);

				console.log($("#download_link_container"));
			}else{
				$("#password_error_container").text('Password Incorrect');
				$("#password_error_container").css('dispaly','block');

				$("#password_error_container").addClass('animate__animated animate__shakeX');

				setTimeout(()=>{
				    $("#password_error_container").removeClass('animate__animated animate__shakeX');
				},500)
			}

		}
		

		

	});

	function backPage(){
		$("#tittle_container").text('Settings');

    	$.when(closeNav()).then(function() {
    		$('#topNavBar').toggle();
      		$("#container").fadeOut(animtionSpeed, function() {
    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
    	  			$("#container").empty();
    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings'}));

    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
    		  			$('#topNavBar').toggle();
    		  			$("#container").fadeIn(animtionSpeed);
    		  		});
    	    	});
    	  	});
    	});
	}

	


</script>
