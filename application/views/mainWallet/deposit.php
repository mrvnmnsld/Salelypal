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

<form id="mainForm">
	<div class="h2 text-center">Deposit</div>
	<div>		
		<div class="text-center text-primary">Scan this qr code to deposit to your wallet</div>

		<div class="thumbnail d-flex justify-content-center m-3 pt-3 pb-3 img-thumbnail">
			<div id="qrcode"></div>
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

			<span class="font-weight-bold" id="importantNotes">This wallet supports Tron Mainet, TRC10, TRC20: USDT & TRX</span><br><br>
			<span class="text-danger">To view other tokens in wallet, export this wallet to a capable wallet link. </span>
		</div>
	</div>

	<hr>

	<div class="d-flex flex-row float-right">
		<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
	</div>
</form>

<script type="text/javascript">
	var address;
	var importantNotes;

	$(document).ready(function(){
		if (selectedData.network == 'trx' || selectedData.network == 'trc20') {
			address = 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS';
			importantNotes = 'This wallet supports Tron Mainet & TRC20 Tokens';
			$("#importantNotes").text();

		}else if (selectedData.network == 'bsc' || selectedData.network == 'bep20'){
			address = '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312';
			importantNotes = 'This wallet supports BEP20 Tokens';
		}else if (selectedData.network == 'erc20'){
			address = '0xaccef84f39a21ce8f04e9ca31c215359af0ad030';
			importantNotes = 'This wallet supports ERC20 Tokens';
		}

		new QRCode(document.getElementById("qrcode"),address);
		$("#importantNotes").text(importantNotes);
		$("#addressContainer").val(address);
	})


	$("#closeBtn").on('click',function(){
    	bootbox.hideAll();	
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