<style type="text/css">
	.modal-footer{
		display: none;
	}

	.is-invalid{
		text-align: center;
	}
</style>

<div class="pagetitle">
  <h1>Add New Token(Daily Income Mining)</h1>
</div>

<hr>

<div id="mainQuestionModal">
	<form id="mainForm">

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>Token:</b></div>	
			<select type="text" name="token_name_container" id="token_name_container" data-live-search="true" class="col-md form-control form-control-sm">
				<option value="">Please select...</option>
			</select>
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>Network:</b></div>	
			<input type="text" name="network_container" id="network_container" class="col-md form-control form-control-sm" placeholder="Please select token first" readonly></input>
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>APY:</b></div>	
			<input type="number" name="apy_container" id="apy_container" class="col-md form-control form-control-sm" placeholder="Contract address of the token in network"></input>	
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>Cycle days:</b></div>	
			<input type="text" name="cycle_day_container" id="cycle_day_container" class="col-md form-control form-control-sm" placeholder="Add comma to separate cycles days ex. 1,3,7"></input>	
		</div>
	</form>

	<hr>

	<button class="col-md-12 btn btn-success btn-block" id="save_edit_btn">Save Token to Mine</button>
	<button class="col-md-12 btn btn-danger btn-block" id="closeBtn">Close</button>

</div>

<script type="text/javascript">
	var tokenListArray = ajaxShortLink('userWallet/getAllTokensV2');

	for (var i = 0; i < tokenListArray.length; i++) {
		$("#token_name_container").append("<option value='"+tokenListArray[i].id+"'>"+tokenListArray[i].description+" ("+tokenListArray[i].networkName.toUpperCase()+") </option>");
	}

	$('#token_name_container').selectpicker({
    style: 'border',
    size: 4
  });

	$('#token_name_container').on('change',function(){
		
		var data = ajaxShortLink('mining/daily/getDailySettings');

		if(data.find(e => e.id === $(this).val()) == null){
			$("#network_container").val(tokenListArray[$(this)[0].selectedIndex].networkName.toUpperCase());
		}else{
			$("#network_container").val('');
			$("#token_name_container").val('');
			$('#token_name_container').selectpicker('refresh');

			$.toast({
			    heading: '<h6>Token Already Exist!</h6>',
			    text: 'Select a different token',
			    showHideTransition: 'slide',
			    icon: 'error',
			    position: 'bottom-left'
			})
		}
	})

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#save_edit_btn").on('click', function(){
		if ($("#mainForm").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this new token? Please ensure that these are the correct parameters',
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

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
				token_name_container: "required",
				apy_container: "required",
				cycle_day_container: "required",
				network_container: "required",
	  	},
	  	errorPlacement: function (error, element) {
	  	    if ($(element).is('select')) {
	  	        element.next().after(error); // special placement for select elements
	  	    } else {
	  	        error.insertAfter(element);  // default placement for everything else
	  	    }
	  	},
	  	submitHandler: function(form){
		    var data = $('#mainForm').serializeArray();
      	var res = ajaxShortLink('mining/daily/saveNewToken',data);
		    console.log(res);

      	if (res) {
        	$.toast({
			        heading: '<h6>Success!</h6>',
			        text: 'Successfully Saved New Token Mining!',
			        showHideTransition: 'slide',
			        icon: 'success',
			        position: 'bottom-left'
			        // position: 'bottom-center'
			    })

      		bootbox.hideAll();
      		ajaxShortLink('mining/daily/getDailySettings');
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