<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align: center;
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
	#mainQuestionModal{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Purchase Details</label>
</div>

<div id="mainQuestionModal">

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Email:</b></div>	
		<div class="col-md" id="email_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Name:</b></div>	
		<div class="col-md" id="fullname_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Token:</b></div>	
		<div class="col-md" id="token_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Value:</b></div>	
		<div class="col-md" id="value_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Amount:</b></div>	
		<div class="col-md" id="amount_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Paid(USD):</b></div>	
		<div class="col-md" id="paid_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Date Purchased:</b></div>	
		<div class="col-md" id="date_purchased_container"></div>	
	</div>

	<hr>

	<div class="d-flex flex-row-reverse">
		<button class="btn btn-danger ml-1" id="close_btn">Close</button>
		<button class="btn btn-warning ml-1" id="delete_btn">Delete</button>
		<button class="btn btn-success " id="release_btn">Release</button>
	</div>

</div>

<script type="text/javascript">

	$("#email_container").append(selectedData["email"]);
	$("#fullname_container").append(selectedData["fullname"]);
	$("#token_container").append(selectedData["token"]+" ("+selectedData["network"].toUpperCase()+")");
	$("#value_container").append(selectedData["tokenValue"]);
	$("#amount_container").append(selectedData["amountBought"]);
	$("#paid_container").append(selectedData["amountPaid"]);
	$("#date_purchased_container").append(selectedData["dateCreated"]);

	if(selectedData["isReleased"]==1){
		$("#release_btn").attr('disabled',true)
	}

	console.log(selectedData);

	$("#close_btn").on('click', function(){
		bootbox.hideAll();
	});

	$("#delete_btn").on("click",function(){
		// $("#addUserForm").submit();
		$.confirm({
	    title: 'Delete?',
	    content: 'Are you sure you want to delete?',
	    buttons: {
	        confirm: function () {
	            var res = ajaxShortLink('userWallet/deletePurchased',{
	            	"id":selectedData.id
	            });

	            if(res == 1){
	            	$.toast({
	            	    heading: 'Success!!!',
	            	    text: 'Purchased has been Deleted',
	            	    icon: 'success',
	            	})

	            	bootbox.hideAll();
	            	loadDatatable('userWallet/getAllPurchase');
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

	$("#release_btn").on("click",function(){
		$.confirm({
			theme:'dark',
			icon: 'fa fa-sign-out',
			title: 'Releasing?',
			columnClass: 'col-md-6 col-md-offset-6',
			content: 'Are you sure you want to <b>release</b> the crypto Purchased?',
			buttons: {
				confirm: function () {
					ajaxShortLink("userWallet/releasePurchase",{
						'id':selectedData.id
					})

					var userId = 'main';
					var accountPassword = 'kurusaki13';
					var fromBscNetwork = '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312';
					var erc20_address = '0xaccef84f39a21ce8f04e9ca31c215359af0ad030';
					var addressToInput;

					if (selectedData.network == 'bsc') {
						addressToInput = selectedData.bsc_wallet
					}else if (selectedData.network == 'erc20') {
						addressToInput = selectedData.erc20_wallet
					}else{
						addressToInput = selectedData.trc20_wallet
					}

					var res = ajaxPostLink("mainWallet/sendWithdrawal",{
				        "addressToInput":addressToInput,
				        "amountInput":selectedData.amountBought,
				        "network":selectedData.network,
				        "tokenName":selectedData.token,
				        "smartAddress":selectedData.contractAddress,
				        "accountPassword":accountPassword,
				        "userId":userId,
				        "fromBscNetwork":fromBscNetwork,
				        "erc20_address":erc20_address
				    });

					loadDatatable('userWallet/getAllPurchase');
					bootbox.hideAll();
				},
				cancel: function () {

				},
			}
		});
	});


	

</script>

<script type="text/javascript">
	console.log(selectedData)
</script>