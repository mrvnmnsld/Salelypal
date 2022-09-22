<style type="text/css">
	
	.switch {
	    position: relative;
	    display: inline-block;
	    width: 60px;
	    height: 34px;
    }
    .switch .toggle { 
	    opacity: 0;
	    width: 0;
	    height: 0;
    }
    .slider {
	    position: absolute;
	    cursor: pointer;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    background-color: #ccc;
	    -webkit-transition: .4s;
	    transition: .4s;
    }
    .slider:before {
	    position: absolute;
	    content: "";
	    height: 26px;
	    width: 26px;
	    left: 4px;
	    bottom: 4px;
	    background-color: white;
	    -webkit-transition: .4s;
	    transition: .4s;
    }
    .toggle:checked + .slider {
    	background-color: #5426de;
    }
    .toggle:focus + .slider {
    	box-shadow: 0 0 1px #5426de;
    }
    .toggle:checked + .slider:before {
	    -webkit-transform: translateX(26px);
	    -ms-transform: translateX(26px);
	    transform: translateX(26px);
    }
    /* Rounded sliders */
    .slider.round {
    	border-radius: 34px;
    }
    .slider.round:before {
    	border-radius: 50%;
    }
</style>

<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Application Settings</h1>
      <sub class="fw-bold">Main Settings for Safelypal Application (Mobile/Web)</sub>
    </div>

    <hr>

	<div class="row">
		<div class="col-md-3"><b>System Maintenance:</b></div>	
		<label class="switch">
			<input id="isMaintained" onclick="toggleMaintenance();" class="toggle" type="checkbox">
			<span class="slider round"></span>
		</label>
	</div>

	<hr>

	<div><b>Address: </b><span id="address_container"></span></div>
	<div><b>PrivateKey: </b><span id="privateKey_container"></span></div>
	<small>Copy this to export wallet. NEVER SHARE IT</small>
	<hr>
		
	<div>
		<b>IMPORTANT NOTES: </b>
		<br>
		<b>1.</b> Please Export (to tronlink app) your wallet first and send all assets manually to the new address that will be generated. if the admin wont do this all assets in the previous wallet will not be usable in the new wallet.
		<br>
		<b>2.</b> This action is irreversable so make sure no mistakes will be made
	</div>

	<button class="btn btn-success btn-block" id="change_main_wallet_btn">Change Main Address</button>


	<div class="">
		Last changed: 
		<span id="last_changed_timestamp">3 days ago</span>
	</div>

  </div>

</div>

<script type="text/javascript">
	var isMaintained = 0;
	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
	});

	var appSettings = ajaxShortLink("admin/appSet/getAppSettings");
	var getCurrentAddress = ajaxShortLink("mainWallet/getCurrentAddress");

	console.log(getCurrentAddress)

	$("#last_changed_timestamp").text(appSettings[1].value);
	
	if (appSettings[0].value == 1) {
		$("#isMaintained").prop( "checked", true );
	}

	$("#address_container").text(getCurrentAddress.address);
	$("#privateKey_container").text(getCurrentAddress.privateKey);

	

	function toggleMaintenance(){
		if ($('#isMaintained').is(":checked")==true) {
			isMaintained = 1;
		}else{
			isMaintained = 0;
		}

		var res = ajaxShortLink("admin/appSet/setMaintenance",{
			"isMaintained":isMaintained
		});
	}

	$("#change_main_wallet_btn").on("click", function(){
		$(this).attr('disabled','disabled').html("Loading Please Wait.....");

		var balanceTron;

		setTimeout(function(){
			$.confirm({
			    title: 'Moving?',
			    content: 'Are you sure you want to change the main wallet address? Please make sure that you have exported the wallet first or else all assets will be lost',
			    buttons: {
			        confirm: function () {
						var resGenerate = ajaxShortLink("generateNewMainWallet");

						var resChangeMainWallet = ajaxShortLink("admin/appSet/changeMainWallet",{
							'address':resGenerate.address,
							'hexAddress':resGenerate.hexaddress,
							'privateKey':resGenerate.privatekey,
						});

						var getCurrentAddress = ajaxShortLink("mainWallet/getCurrentAddress");
						$("#address_container").text(getCurrentAddress.address);
						$("#privateKey_container").text(getCurrentAddress.privateKey);

						$.toast({
						    heading: 'Success!',
						    text: 'Successfully genereted a new main wallet',
						    icon: 'success',
						})
			        },
			        cancel: function () {

			        },
			    }
			});

			$("#change_main_wallet_btn").removeAttr('disabled').html("Change Main Address");
		},100)

		

	})
</script>
