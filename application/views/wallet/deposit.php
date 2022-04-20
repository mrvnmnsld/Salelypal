<style type="text/css">
	.modal-footer{
		display: none;
	}

	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
	}
</style>

<div id="innerContainer" class="p-3 mb-3">
	<form id="mainForm">
		<div>		
			<div class="text-center text-primary">Scan this qr code to deposit to your wallet</div>

			<div class="thumbnail d-flex justify-content-center m-3 pt-3 pb-3 img-thumbnail">
				<div id="qrcode"></div>
			</div>

			<div class="form-group">
				<label>Select which token to deposit</label>
				<select class="form-control" id="tokenSelection">
					<option value="tron">TRON/TRC20 Network</option>
					<option value="bsc">BSC/BEP20 (BSC)</option>
					<option value="erc20">ERC20 (Ether)</option>
				</select>
			</div>

			<label>Address</label>

			<div class="input-group mb-3">
				<input type="text" class="form-control" id="addressContainer" aria-describedby="emailHelp" placeholder="">


				<div class="input-group-prepend">
			  		<button class="btn btn-primary" id="copyBtn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Copy link</button>
				</div>
			</div>

			<div class="">
				<div class="h5 text-center">NOTE:</div>

				<span class="font-weight-bold" id="importantNotes">This wallet supports Tron Mainet and TRC20 Tokens but make sure you added the token contract to your wallet to show the balance</span>
				<!-- <span class="text-danger">To view other tokens in wallet, export this wallet to a capable wallet link. </span> -->
			</div>
		</div>
		<hr>
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

	

</script>