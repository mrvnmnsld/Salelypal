<style type="text/css">
	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
		margin:auto;
	}

	.qr-container {
		width:100%;
		/* outline:thin solid black; */
		/* border-color:var(--dark-color)!important; */
		position:relative;
		background:white;
		/* border-radius:2px; */
		padding-bottom:20px;
		border : none !important;
		outline: 0px solid transparent;
	}
	.qr-container::after, .qr-container::before {
		height:100%;
		content:'';
		position: absolute;
		top: 0;
		width: 10%;
		
		/* border:2px solid var(--dark-color); */
	}
	.qr-container::after {
		right: 0;
		/* background-color: var(--dark-color); */
	}
	.qr-container::before {
		left: 0;
		/* background-color: var(--dark-color); */
	}

</style>

<div id="innerContainer" class="p-3 mb-3">
	<form id="mainForm">
		<div>		
			<div class="text-center mb-3 main-color-text display-4">DEPOSIT</div>
			<div class="text-center text-muted">Scan this qr code to deposit to your wallet</div>

			<div class="qr-container mt-3 mb-5 py-2 text-center">
				<div class="py-1"id="qrcode"></div>
			</div>

			<div class="form-group mt-4">
				<small class="form-check-label">By depositing, you agree with the <u><a href="#" onclick='termsCondition()'>Terms and Conditions</a></u></small>
			</div>

			<div class="form-group">
				<label class="text-muted">Select which token to deposit</label>
				<select class="form-control" id="tokenSelection">
					<option value="tron">TRON/TRC20 Network</option>
					<option value="bsc">BSC/BEP20 (BSC)</option>
					<option value="erc20">ERC20 (Ether)</option>
				</select>
			</div>

			<label class="text-muted">Address</label>

			<div class="input-group mb-3">
				<input type="text" class="form-control" id="addressContainer" aria-describedby="emailHelp" placeholder="">


				<div class="input-group-prepend">
			  		<button class="btn secondary-color-bg" style="color:white; border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" id="copyBtn" type="button">Copy</button>
					  <!-- style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;"  -->
				</div>
			</div>

			
			<hr>
			<div class="">
				<div class="h5 text-start mt-3 main-color-text"><b>NOTE :</b></div>
				<span class="font-weight-normal main-color-text" id="importantNotes">This wallet supports Tron Mainet and TRC20 Tokens but make sure you added the token contract to your wallet to show the balance</span>
				<!-- <span class="text-danger">To view other tokens in wallet, export this wallet to a capable wallet link. </span> -->
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	new QRCode(document.getElementById("qrcode"),currentUser['trc20_wallet']);
	$("#addressContainer").val(currentUser['trc20_wallet']);

	$("#closeBtn").on('click',function(){
    	bootbox.hideAll();	
	});

	$("#tokenSelection").on('change',function(){
		var selectedToken = $(this).val(); 

		if (selectedToken=="bsc") {
			$("#addressContainer").val(currentUser['bsc_wallet']);
			$("#qrcode").empty();
			$("#importantNotes").text('This wallet supports BSC, BEP20 Tokens but make sure you added the token contract to your wallet to show the balance');

			new QRCode(document.getElementById("qrcode"),currentUser['bsc_wallet']);
		}else if (selectedToken=="tron"){
			$("#addressContainer").val(currentUser['trc20_wallet']);
			$("#qrcode").empty();
			$("#importantNotes").text('This wallet supports Tron Mainet and TRC20 Tokens but make sure you added the token contract to your wallet to show the balance');

			new QRCode(document.getElementById("qrcode"),currentUser['trc20_wallet']);
		}else if (selectedToken=="erc20"){
			$("#addressContainer").val(currentUser['erc20_wallet']);
			$("#qrcode").empty();
			$("#importantNotes").text('This wallet supports ERC20 Tokens but make sure you added the token contract to your wallet to show the balance');

			new QRCode(document.getElementById("qrcode"),currentUser['erc20_wallet']);
		}

	});

	$("#copyBtn").on('click',function(){
    	$('#addressContainer').select();
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


   	function termsCondition(){
		bootbox.alert({
	    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/termsConditions'}),
	    size: 'large',
	    centerVertical: true,
			closeButton: false
		});
	}

</script>