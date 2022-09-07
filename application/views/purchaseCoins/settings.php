<style>
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
      <h1>Purchase Coins Settings</h1>
      <!-- <sub class="fw-bold">Settings for all bettings</sub> -->
    </div>

    <hr>

    <form id="purchase_settings_form">
	    <label class="fw-bold">PayPal</label>
			<div class="input-group row m-1 mb-3">
				<label class="switch">
				  <input id="isPaypalOn" class="toggle" name="isPaypalOn" type="checkbox">
				  <span class="slider round"></span>
				</label>
			</div>

			<label class="fw-bold">Wise</label>
			<div class="input-group row m-1 mb-3">
				<label class="switch">
				  <input id="isWiseOn" class="toggle" name="isWiseOn" type="checkbox">
				  <span class="slider round"></span>
				</label>
			</div>

	    <div class="row">
	    	<div class="col-6">
	    		<div class="form-group">
			      <label for="formGroupExampleInput">Email</label>
			      <input type="text" class="form-control" name="email_input" id="email_input" placeholder="">
			    </div>

			    <div class="form-group">
			      <label for="formGroupExampleInput">Full name of the account holder</label>
			      <input type="text" class="form-control" name="fullname_input" id="fullname_input" placeholder="">
			    </div>

			    <div class="form-group">
			      <label for="formGroupExampleInput">Bank Name</label>
			      <input type="text" class="form-control" name="bankname_input" id="bankname_input" placeholder="">
			    </div>

			    <div class="form-group">
			      <label for="formGroupExampleInput">Account Number</label>
			      <input type="text" class="form-control" name="accountnumber_input" id="accountnumber_input" placeholder="">
			    </div>
	    	</div>

	    	<div class="col-6">
	    		<div class="form-group">
			      <label for="formGroupExampleInput">Country</label>
			      <input type="text" class="form-control" name="country_input" id="country_input" placeholder="">
			    </div>

			    <div class="form-group">
			      <label for="formGroupExampleInput">City</label>
			      <input type="text" class="form-control" name="city_input" id="city_input" placeholder="">
			    </div>

			    <div class="form-group">
			      <label for="formGroupExampleInput">Address</label>
			      <input type="text" class="form-control" name="address_input" id="address_input" placeholder="">
			    </div>

			    <div class="form-group">
			      <label for="formGroupExampleInput">Post Code</label>
			      <input type="text" class="form-control" name="postcode_input" id="postcode_input" placeholder="">
			    </div>
	    	</div>
	    </div>
    </form>

    <div>
    	<button class="btn btn-success" id="save_edit_btn">Save Changes</button>
    </div>

  </div>
</div>

<script type="text/javascript">
	var settings = ajaxShortLink("admin/getPurchaseSettings");
	console.log(settings);

	if(settings[0].value == 1){
		$("#isPaypalOn").prop( "checked", true );
	}

	if(settings[1].value == 1){
		$("#isWiseOn").prop( "checked", true );
	}

	$("#email_input").val(settings[2].value);
	$("#fullname_input").val(settings[3].value);
	$("#bankname_input").val(settings[4].value);
	$("#accountnumber_input").val(settings[5].value);
	$("#country_input").val(settings[6].value);
	$("#city_input").val(settings[7].value);
	$("#address_input").val(settings[8].value);
	$("#postcode_input").val(settings[9].value);

	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});

		$("#save_edit_btn").on("click",function(){
			$("#purchase_settings_form").submit()
		})

		$("#purchase_settings_form").validate({
		  	errorClass: 'is-invalid text-danger',
		  	rules: {
					fullName: "required",
					email_input: "required",
					fullname_input: "required",
					bankname_input: "required",
					accountnumber_input: "required",
					country_input: "required",
					city_input: "required",
					address_input: "required",
					postcode_input: "required"
		  	},
		  	submitHandler: function(form){
			    var data = $('#purchase_settings_form').serializeArray();
			    console.log(data);

			    var res = ajaxShortLink("admin/buyCrypto/saveSettings",data);

			    if ($('#isPaypalOn').is(":checked")==true) {
			    	ajaxShortLink("admin/buyCrypto/updatePaypalStatus",{
			    		"value":1
			    	});
			    }else{
			    	ajaxShortLink("admin/buyCrypto/updatePaypalStatus",{
			    		"value":0
			    	});
			    }

			    if ($('#isWiseOn').is(":checked")==true) {
			    	ajaxShortLink("admin/buyCrypto/updateWiseStatus",{
			    		"value":1
			    	});
			    }else{
			    	ajaxShortLink("admin/buyCrypto/updateWiseStatus",{
			    		"value":0
			    	});
			    }

			    if(res!=false){
			    	$.toast({
			    	    heading: 'Success',
			    	    text: 'Successfully saved all changes',
			    	    icon: 'success',
			    	})
			    }else{
			    	$.toast({
			    	    heading: 'ERROR!!!',
			    	    text: 'System Error, Please Contact System Admin',
			    	    icon: 'error',
			    	})
			    }

		  	}
		});
	});

	
</script>
