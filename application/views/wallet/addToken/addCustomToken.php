<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<div class="pagetitle">
  <h2>Add custom token</h2>
</div>

<hr>

<form id="mainForm" class="">
	<div class="row m-1 mb-3">
		<div class="col-md-3 pl-3"><b>Token Symbol:</b></div>	
		<input type="text" name="token_name_container" id="token_name_container" class="col-md form-control form-control-sm" placeholder="Shows below the balance of token"></input>
	</div>

	<div class="row m-1 mb-3">
		<div class="col-md-3 pl-3"><b>Description:</b></div>	
		<input type="text" name="description_container" id="description_container" class="col-md form-control form-control-sm" placeholder="Token Description beside the token icon"></input>
	</div>

	<div class="row m-1 mb-3">
		<div class="col-md-3 pl-3"><b>Network:</b></div>	
		<select type="text" name="network_container" id="network_container" class="col-md form-control form-control-sm">
			<option value="">Select Network...</option>
			<option value="1">TRC20/Tron Mainet</option>
			<option value="3">BSC/BEP20</option>
			<option value="4">ERC20/Ethereum Mainet</option>
		</select>
	</div>

	<div class="row m-1 mb-3">
		<div class="col-md-3 pl-3"><b>Contract Address:</b></div>	
		<input type="text" name="contract_address_container" id="contract_address_container" class="col-md form-control form-control-sm" placeholder="Contract address of the token in network"></input>	
	</div>

	<div class="row m-1 mb-3">
		<div class="col-md-3 pl-3"><b>Coingecko Token ID:</b></div>	
		<input type="text" name="coingecko_token_id_container" id="coingecko_token_id_container" class="col-md form-control form-control-sm" placeholder="Contract address of the token in network"></input>
		<small class="text-center text-muted">Search Token API ID in <a href="https://www.coingecko.com/" target="_blank">Coingecko.com</a></small>
	</div>

	<div class="row m-1 mb-3">
		<div class="col-md-3 pl-3"><b>Token Logo:</b></div>	
		<input type="text" name="token_image_container_container" id="token_image_container" class="col-md form-control form-control-sm" placeholder="Token logo url"></input>
		<small class="text-center text-muted">Search URL in <a href="https://cryptologos.cc/" target="_blank">Cryptologos.cc</a></small>
	</div>
</form>

<hr>

<div class="d-flex flex-row-reverse">
	<button class="ml-1 col-md btn btn-danger" id="closeBtn">Close</button>
	<button class="ml-1 col-md btn btn-success" id="saveBtn" disabled>Save Token</button>
</div>

<script type="text/javascript">

	var userTypes = ajaxShortLink('admin/getAllUserTypes');

	for (var i = 0; i < userTypes.length; i++) {
		$("#usertype").append('<option value="'+userTypes[i].userType+'">'+userTypes[i].userType+'</option>');
	}

	$("#showPassword").on('click',function(){
		if ($("#passwordContainer").attr('type')=="password") {
			$("#passwordContainer").attr('type','text');
		}else{
			$("#passwordContainer").attr('type','password');
		}
	});

	$("#saveBtn").on('click',function(){
		if ($("#mainForm").valid()) {
			$.confirm({
				icon: 'fa fa-plus-circle',
			    title: 'Adding?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want add this new user?',
			    buttons: {
			        confirm: function () {
			        	$("#mainForm").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#closeBtn").on('click',function(){
    	bootbox.hideAll();
		
	});

	$("#generatePassword").on('click',function(){
		$("#passwordContainer").val(generatePassword());
	});

	jQuery.validator.addMethod("alphanumeric", function(value, element) {
	    return this.optional(element) || /^\w+$/i.test(value);
	}, "Letters, numbers, and underscores only please");

	jQuery.validator.addMethod("userNameChecker", function(value, element) {
	    return ajaxShortLink('admin/checkAdminUserNameValidity',{'username': value});
	}, "Username already used");

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			username: {
				alphanumeric: true,
				userNameChecker: true,
				required: true
			},
			password: "required",
			usertype: "required",
	  	},
	  	messages:{
	  		'password': ''
	  	},
	  	submitHandler: function(form){
		    ajaxShortLink(
        		url = 'admin/adminList/saveNewAdminUser',
        		data = {
        			'username': $('#username').val(),
        			'password': $('#passwordContainer').val(),
        			'usertype': $('#usertype').val(),
        			'createdBy': currentUser['id'],
        		}
        	);

		    $.toast({
		        heading: '<h6>Success!</h6>',
		        text: 'Successfully saved all changes!',
		        showHideTransition: 'slide',
		        icon: 'success',
		        position: 'bottom-left'
		    })

		    loadDatatable('admin/getAllAdmin');
		    bootbox.hideAll();
	  	}
	});
</script>