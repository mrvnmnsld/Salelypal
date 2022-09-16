<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');

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

  .upload_button{
      width: 100%;
      height: 50px;
      border: none;
      color: #fff;
      font-size: 1rem;
      font-weight: 900;
      letter-spacing: 3px;
      background-color: #5426de;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top:10px;
      border-radius: 0.25rem;
  }

  .upload_button:hover{
      background-color: #9e68e8;
  }

  label{
    color: #5426de;
  }
</style>

<div class="text-center">
  <label class="h3 mt-2 fw-bold main-color-text">Buy using Wise</label>
</div>

<div>
	<b>Notes on usage:</b><br>
	<ol style="margin-left: -24px">
		<li>Login/Sign up with wise and get verified(If no wise account)</li>
		<li>Click transfer</li>
		<li>Fill up form using the details below (You can click copy and paste it in wise to avoid errors)</li>
		<li>Continue transfer</li>
		<li>Upload proof of transfer via "Upload receipt" button</li>
		<li>Wait 1-3 Days for the confirmation of the transaction</li>
		<li>Receive purchased tokens and earn!</li>
	</ol>
	
</div>

<div class="form-group mt-2">
    <label class="text-muted">Amount to be sent: </label>
    <label id="amountToBeSent">100 USD</label>
</div>

<div class="text-center m-2">Personal Details</div>


<label class="text-muted">Email</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="email_container" value="test@123123123 123123">


	<div class="input-group-prepend">
  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyEmail" type="button">Copy</button>
	</div>
</div>

<div class="text-center m-2">Bank Details</div>


<label class="text-muted">Full name of the account holder</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="fullName_container" value="test@123123123 123123">


	<div class="input-group-prepend">
  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyFullname" type="button">Copy</button>
	</div>
</div>

<label class="text-muted">Bank Name</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="bankName_container" value="test@123123123 123123">


	<div class="input-group-prepend">
  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyBankName" type="button">Copy</button>
	</div>
</div>

<label class="text-muted">Account Number</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="accountNumber_container" value="test@123123123 123123">


	<div class="input-group-prepend">
  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyAccountNumber" type="button">Copy</button>
	</div>
</div>

<div class="text-center m-2">Address</div>

<label class="text-muted">Country</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="country_container" disabled value="test@123123123 123123">
</div>

<label class="text-muted">City</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="city_container" disabled value="test@123123123 123123">
</div>

<label class="text-muted">Address</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="address_container" value="test@123123123 123123">


	<div class="input-group-prepend">
  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyAddress" type="button">Copy</button>
	</div>
</div>

<label class="text-muted">Post Code</label>

<div class="input-group mb-3">
	<input type="text" class="form-control" readonly id="postCode_container" value="test@123123123 123123">


	<div class="input-group-prepend">
  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyPostCode" type="button">Copy</button>
	</div>
</div>


<div >
    <button id="receipt_photo_btn" class="upload_button face_upload_btn" type="button">
        <span><i class="fa fa-picture-o fa-inverse"></i></span>
        <span  class="">Upload Receipt</span>
    </button>

    <input class="form-control d-none" type="file" name="receipt_photo_input" id="receipt_photo_input" accept="image/*" >

    <button id="cancel_btn" class="upload_button face_upload_btn" type="button">
    	<span><i class="fa fa-times" aria-hidden="true"></i></span>
        <span  class="">Cancel</span>
    </button>

</div>

<script type="text/javascript">
	var token_select = $("#token_select").val().split("_");
	var tokenMarketInfo = ajaxShortLink('userWallet/getTokenDifference',{'tokenName':token_select[3]});
	var tokenValue = tokenMarketInfo.market_data.current_price.usd;
	var amountTotal = parseFloat($("#amount").val());
	var amountTotalToBePaid = parseFloat((tokenValue*amountTotal).toFixed(2));

	var isAmountEnough = true;
	var userWalletAddress;

	var settings = ajaxShortLink("admin/getPurchaseSettings");
	console.log(settings);

	$("#email_container").val(settings[2].value);
	$("#fullName_container").val(settings[3].value);
	$("#bankName_container").val(settings[4].value);
	$("#accountNumber_container").val(settings[5].value);
	$("#country_container").val(settings[6].value);
	$("#city_container").val(settings[7].value);
	$("#address_container").val(settings[8].value);
	$("#postcode_input").val(settings[9].value);
	$("#amountToBeSent").text(amountTotalToBePaid+" USD");


	$("#cancel_btn").on("click",function(){
		bootbox.hideAll();
	})

	$("#receipt_photo_btn").on('click',function(){
		$('#receipt_photo_input').click();
	});

  $('#receipt_photo_input').change(function(){
  	if (token_select[1] === 'trc20' || token_select[1] === 'trx') {
  	    userWalletAddress = currentUser["trc20_wallet"];
  	}else if(token_select[1] === 'bsc'){
  	    userWalletAddress = currentUser["bsc_wallet"];        
  	}else if(token_select[1] === 'erc20'){
  	    userWalletAddress = currentUser["erc20_wallet"];        
  	}

		$.confirm({
			theme: "dark",
			icon: 'fa fa-plus-circle',
		    title: 'Are you sure?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Please make sure that this photo contains amount sent proof of the transfer to avoid irregularities in your future transaction',
		    buttons: {
		        confirm: function () {
		        	var formData = new FormData();
		        	var generatedString = generateOTP();

		        	formData.append(generatedString+"_wise_receipt", $('#receipt_photo_input')[0].files[0],generatedString+"_wise_receipt");
		        	formData.append('userID', currentUser['userID']);
		        	formData.append('amountPaid', amountTotalToBePaid);
		        	formData.append('token', token_select[0]);
		        	formData.append('tokenValue', tokenValue);
		        	formData.append('userWalletAddress', userWalletAddress);
		        	formData.append('amountBought', amountTotal);
		        	formData.append('tokenArray', token_select);
		        	formData.append('network', token_select[1]);
		        	formData.append('contractAddress', token_select[2]);

				     	backendHandleFormData('userWallet/buyCryptoUsingWise',formData);

				     	$("#success_container").toggle();
				      $("#mainForm").toggle();
				      $(".bootbox-close-button").toggle()

				      $("#amount_bought_container").text(amountTotal);
				      $("#amount_paid_container").text(amountTotalToBePaid);
				      $("#token_container").text(token_select[0]);
				      $("#token_amount_container").text(tokenValue);

				      $("#timestamp_container").text(getTimeDate());
							pushNewNotif("Bought Crypto","Crypto successfully bought please wait while we transfer the assets you bought!",currentUser.userID)

				     	bootbox.hideAll();
				     	loadDatatable('wallet/getUserPurchase',{'userID':currentUser['userID']});

    			    $.toast({
  			        text: 'Successfully uploaded receipt. Please Wait While we Check The transaction...',
  			        showHideTransition: 'slide',
								allowToastClose: false,
								hideAfter: 5000,
								stack: 5,
								position: 'bottom-center',
		    		    textAlign: 'center',
		    		    loader: true,
		    		    loaderBg: '#9EC600'
    			    })

		        },
		        cancel: function () {
		        	
		        },
		    }
		});
	});

	$("#copyEmail").on('click',function(){
    	$('#email_container').select();
    	document.execCommand("copy");
    	document.getSelection().removeAllRanges();

    	$.toast({
    	    heading: '<h6>Copied your Email</h6>',
    	    text: 'You can now paste your email',
    	    showHideTransition: 'slide',
    	    icon: 'success',
    	    position: 'bottom-center'
    	})
	});

	$("#copyFullname").on('click',function(){
    	$('#fullName_container').select();
    	document.execCommand("copy");
    	document.getSelection().removeAllRanges();

    	$.toast({
    	    heading: '<h6>Copied your Fullname</h6>',
    	    text: 'You can now paste your fullname',
    	    showHideTransition: 'slide',
    	    icon: 'success',
    	    position: 'bottom-center'
    	})
	});

	$("#copyBankName").on('click',function(){
    	$('#bankName_container').select();
    	document.execCommand("copy");
    	document.getSelection().removeAllRanges();

    	$.toast({
    	    heading: '<h6>Copied your Bank Name</h6>',
    	    text: 'You can now paste your bank name',
    	    showHideTransition: 'slide',
    	    icon: 'success',
    	    position: 'bottom-center'
    	})
	});

	$("#copyAccountNumber").on('click',function(){
    	$('#accountNumber_container').select();
    	document.execCommand("copy");
    	document.getSelection().removeAllRanges();

    	$.toast({
    	    heading: '<h6>Copied your Account Number</h6>',
    	    text: 'You can now paste your account number',
    	    showHideTransition: 'slide',
    	    icon: 'success',
    	    position: 'bottom-center'
    	})
	});

	$("#copyAddress").on('click',function(){
    	$('#address_container').select();
    	document.execCommand("copy");
    	document.getSelection().removeAllRanges();

    	$.toast({
    	    heading: '<h6>Copied your Address</h6>',
    	    text: 'You can now paste your address',
    	    showHideTransition: 'slide',
    	    icon: 'success',
    	    position: 'bottom-center'
    	})
	});

	$("#copyPostCode").on('click',function(){
    	$('#postCode_container').select();
    	document.execCommand("copy");
    	document.getSelection().removeAllRanges();

    	$.toast({
    	    heading: '<h6>Copied your Post Code</h6>',
    	    text: 'You can now paste your post code',
    	    showHideTransition: 'slide',
    	    icon: 'success',
    	    position: 'bottom-center'
    	})
	});



</script>



