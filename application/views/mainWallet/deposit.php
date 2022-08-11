<style type="text/css">
	.modal-footer{
		display: none;
	}
	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
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
	#deposit_form_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

	<div id="pagetitle_background" class="pagetitle">
		<label class="h2 mt-2 fw-bold">Deposit</label>
		<p style="font-size: 0.9em;">Scan this qr code to deposit to your wallet</p>
	</div>

	<div id="deposit_form_container">
		<form id="mainForm">
			<div class="thumbnail d-flex justify-content-center m-3 pt-3 pb-3">
				<div id="qrcode"></div>
			</div>

			<label class="fw-bold">Address</label>
			<div class="input-group mb-3">
				<i class="input-group-text fa fa-address-book-o icon-size" aria-hidden="true"></i>
				<input type="text" class="form-control" id="addressContainer" aria-describedby="emailHelp" placeholder="">
				<div class="input-group-prepend">
			  		<button class="btn btn-secondary" id="copyBtn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Copy link</button>
				</div>
			</div>

			<hr>

			<div class="text-center">
				<div class="h5 ">NOTE:
					<span class="font-weight-bold" id="importantNotes">This wallet supports Tron Mainet, TRC10, TRC20: USDT & TRX</span>
				</div>
				<span class="text-danger">To view other tokens in wallet, export this wallet to a capable wallet link. </span>
			</div>

			<div class="d-flex flex-row-reverse">
				<button type="button" class="btn btn-danger" id="closeBtn">Close</button>
			</div>
		</form>
	</div>
	

<script type="text/javascript">
	var address;
	var importantNotes;

	$(document).ready(function(){

		// console.log(selectedData)
		if (selectedData.network == 'trx' || selectedData.network == 'trc20') {
			address = 'TJwxuryQQPKrE5pVisRkpDmY1X5hRCucpL';
			importantNotes = 'This wallet supports Tron Mainet & TRC20 Tokens';
			$("#importantNotes").text();

		}
		else if (selectedData.network == 'bsc' || selectedData.network == 'bep20'){
			address = '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312';
			importantNotes = 'This wallet supports BEP20 Tokens';
		}
		else if (selectedData.network == 'erc20'){
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