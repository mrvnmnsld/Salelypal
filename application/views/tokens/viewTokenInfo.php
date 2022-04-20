<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<div class="pagetitle">
  <h1>Token Details (edit)</h1>
</div>

<hr>

<div id="mainQuestionModal">
	<form id="mainForm">
		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Token Symbol:</b></div>	
			<input type="text" name="token_name_container" id="token_name_container" class="col-md form-control form-control-sm" placeholder="Shows below the balance of token"></input>
		</div>

		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Description:</b></div>	
			<input type="text" name="description_container" id="description_container" class="col-md form-control form-control-sm" placeholder="Token Description beside the token icon"></input>
		</div>

		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Network:</b></div>	
			<select type="text" name="network_container" id="network_container" class="col-md form-control form-control-sm">
				<option value="">Select Network...</option>
				<option value="1">TRC20</option>
				<option value="3">BSC</option>
				<option value="4">ERC20/Ethereum Mainet</option>
			</select>
		</div>

		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Contract Address:</b></div>	
			<input type="text" name="contract_address_container" id="contract_address_container" class="col-md form-control form-control-sm" placeholder="Contract address of the token in network"></input>	
		</div>

		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Coingecko Token ID:</b></div>	
			<input type="text" name="coingecko_token_id_container" id="coingecko_token_id_container" class="col-md form-control form-control-sm" placeholder="Contract address of the token in network"></input>
			<small class="text-center text-muted">Search Token API ID in <a href="https://www.coingecko.com/" target="_blank">Coingecko.com</a></small>
		</div>

		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Token Logo:</b></div>	
			<input type="text" name="token_image_container_container" id="token_image_container" class="col-md form-control form-control-sm" placeholder="Token logo url"></input>
			<small class="text-center text-muted">Search URL in <a href="https://cryptologos.cc/" target="_blank">Cryptologos.cc</a></small>
		</div>
	</form>


	<hr>

	<button class="col-md-12 btn btn-success btn-block" id="save_edit_btn">Save Edit</button>
	<button class="col-md-12 btn btn-danger btn-block" id="closeBtn">Close</button>

</div>

<script type="text/javascript">
	$("#token_name_container").val(selectedData["tokenName"]);
	$("#description_container").val(selectedData["description"]);
	$("#network_container").val(selectedData["networkId"]);
	$("#contract_address_container").val(selectedData["smartAddress"]);
	$("#token_image_container").val(selectedData["tokenImage"]);
	$("#coingecko_token_id_container").val(selectedData["coingeckoTokenId"]);

	console.log(selectedData);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#save_edit_btn").on('click', function(){
		$.confirm({
			icon: 'bi bi-pencil',
		    title: 'Saving?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>save</b> this edit? Please ensure that these are correct parameters',
		    buttons: {
		        confirm: function () {
		        	$("#mainForm").submit();
		        },
		        cancel: function () {

		        },
		    }
		});
	});

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
				token_name_container: "required",
				description_container: "required",
				network_container: "required",
				contract_address_container: "required",
				token_image_container_container: "required",
				coingecko_token_id_container: "required"
	  	},
	  	messages: {
	  		otp: ""
	   	},
	  	submitHandler: function(form){
		    var data = $('#mainForm').serializeArray();

		    data.push(
			    {
			   		'name':'tokenID', 	
			   		'value':selectedData.id, 	
			    }
		    )
      	var res = ajaxShortLink('userWallet/tokenListing/saveEdit',data);
		    console.log(res);

      	if (res==1) {
        	$.toast({
			        heading: '<h6>Success!</h6>',
			        text: 'Successfully Saved All edits!',
			        showHideTransition: 'slide',
			        icon: 'success',
			        position: 'bottom-left'
			        // position: 'bottom-center'
			    })

      		bootbox.hideAll();
      		loadDatatable('getAllTokens');
      	}else{
        	$.toast({
        	    heading: '<h6>Cant Save!</h6>',
        	    text: 'Please contact system admin',
        	    showHideTransition: 'slide',
        	    icon: 'error',
        	    position: 'bottom-left'
        	})
      	}
	  	}
	});
</script>