<style type="text/css">
	#token_image_container{
		width: 50px;
	}
</style>

<div id="innerContainer" class="p-3">

	<!-- div id="widget_container">
		
	</div> -->

	<div class="m-2 text-left">
		<div class="m-2 text-left">
			<div class="h3 p-2 m-2 font-weight-bold text-center">
				<span class="h5">
					<img src="" id="token_image_container">
				</span> <br>
				<span class="h5 text-muted" id="token_name_container">TOKENNAME</span> <br>
				<span id="token_amount_container" class="font-weight-normal main-color-text">Loading...</span>
			</div>	
		</div>
	</div>

	<div id="btn_option_container" class="d-flex justify-content-center mt-1">
		<button id="deposit_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-arrow-circle-down fa-lg main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em" class="main-color-text"><b>Deposit</b></div>
		</button>

		<button id="withdraw_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-arrow-circle-up fa-lg main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em" class="main-color-text"><b>Withdraw</b></div>
		</button>

		<button id="buy_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-credit-card-alt fa-md main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em;" class="main-color-text"><b>Buy</b></div>
		</button>

		<button id="info_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-info-circle fa-lg main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em;" class="main-color-text"><b>Information</b></div>
		</button>
	</div>
</div>

<hr>

<style>
	th{
		font-weight: 300!important;
	}
</style>

<div class="p-1">
	<div class="text-center">
		<h4>Transaction History</h4>
	</div>

	<div id="table_container"  style="">
		<table class="table table-sm table-borderless text-center" >
		  <thead>
		    <tr class="text-muted">
		      <th scope="col">Token</th>
		      <th scope="col">Amount</th>
		      <th scope="col">Type</th>
		      <th scope="col">Date</th>
		    </tr>
		  </thead>
		  <tbody id="transactionContainer">
		  	<tr>
		  		<td colspan="4" class="text-center text-danger">Transaction History Not Available in Testing Mode</td>
		  	</tr>
		  </tbody>
		</table>

		<div class="text-center" style="margin-top:-5px">
			<small class="">Displaying 10 latest transactions</small><br>
		</div>
		
	</div>
	
</div>




<script type="text/javascript">

	console.log(clickContainer);

	$("#token_name_container").text(clickContainer.tokenName);
	$("#token_image_container").attr("src",clickContainer.tokenImage);

	//balance check
		if (clickContainer.networkName == 'trx'||clickContainer.networkName == 'trc20') {
			if (clickContainer.tokenName.toUpperCase() === 'trx'.toUpperCase()) {
				balanceInner = ajaxShortLink('test-platform/getTronBalance',{
					'trc20Address':currentUser['trc20_wallet']
				})['balance'];			
			}else{
				balanceInner = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
					'trc20Address':currentUser['trc20_wallet'],
					'contractaddress':clickContainer.smartAddress,
				})['balance'];
			}
		}else if(clickContainer.networkName =='bsc'){

			if(clickContainer.tokenName.toUpperCase() === 'bnb'.toUpperCase()){

				balanceInner = ajaxShortLink('test-platform//getBinancecoinBalance',{
					'bsc_wallet':currentUser['bsc_wallet']
				})['balance'];

			}else{
				balanceInner = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
					'bsc_wallet':currentUser['bsc_wallet'],
					'contractaddress':clickContainer.smartAddress
				})['balance'];
			}
		}else if(clickContainer.networkName =='erc20'){

			if(clickContainer.tokenName.toUpperCase() === 'eth'.toUpperCase()){

				balanceInner = ajaxShortLink('test-platform//getEthereumBalance',{
					'erc20_address':currentUser['erc20_wallet']
				})['balance'];

			}else{
				balanceInner = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
					'erc20_address':currentUser['erc20_wallet'],
					'contractaddress':clickContainer.smartAddress
				})['balance'];
			}
		}

		$("#token_amount_container").text(parseFloat(balanceInner).toFixed(clickContainer.decimal));
	//balance check

	$("#buy_btn_option_token_info").on('click',function(){
		$.confirm({
		    title: 'Testing Mode!',
		    content: 'This function is not available in testing mode',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        close: function () {
		        }
		    }
		});
	});

	$("#withdraw_btn_option_token_info").on('click',function(){
		$.confirm({
		    title: 'Testing Mode!',
		    content: 'This function is not available in testing mode',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        close: function () {
		        }
		    }
		});
	});

	$("#deposit_btn_option_token_info").on('click',function(){
		$.confirm({
		    title: 'Testing Mode!',
		    content: 'This function is not available in testing mode',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        close: function () {
		        }
		    }
		});
	});

	$("#info_btn_option_token_info").on('click',function(){
		$.confirm({
		    title: 'Testing Mode!',
		    content: 'This function is not available in testing mode',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        close: function () {
		        }
		    }
		});
	});
</script>
