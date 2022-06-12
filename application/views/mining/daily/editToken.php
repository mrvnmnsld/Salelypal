<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align: center;
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
	#mainQuestionModal{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
	.col-md-2 {
    flex: 0 0 auto;
    width: 23%;
	}
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Edit Token (Daily Income Mining)</label>
</div>

<div id="mainQuestionModal">
	<form id="mainForm">

		<div class="row m-1">
			<div class="col-md-2 pl-3 mt-1"><b>Token:</b></div>	
			<select type="text" name="token_name_container" id="token_name_container" data-live-search="true" class="col-md form-control form-control-sm">
				<option value="">Please select...</option>
			</select>
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3 mt-1"><b>Network:</b></div>	
			<input type="text" name="network_container" id="network_container" class="col-md form-control form-control-sm" placeholder="Please select token first" readonly></input>
		</div>

		<!-- <div class="row m-1">
			<div class="col-md-2 pl-3"><b>APY:</b></div>	
			<input type="number" name="apy_container" id="apy_container" class="col-md form-control form-control-sm" placeholder="Contract address of the token in network"></input>	
		</div> -->

		<div class="row m-1">
			<div class="col-md-2 pl-3 mt-1"><b>Days:</b></div>
 			<select name="cycle_day_container" id="cycle_day_container" class="selectpicker col-md form-control form-control-sm" multiple>
			</select>
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3 mt-1"><b>Limit:</b></div>	
			<input type="text" name="purchase_limit_container" id="purchase_limit_container" class="col-md form-control form-control-sm" placeholder="Purchase Limit"></input>
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3 mt-1"><b>Minimum Entry:</b></div>	
			<input type="number" name="minimum_entry_container" id="minimum_entry_container" class="col-md form-control form-control-sm" placeholder="Minimum number of token"></input>
		</div>

		<hr>
	</form>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="ml-2 btn btn-danger" id="closeBtn">Close</button>
		<button type="button" class="ml-2 btn btn-warning" id="delete_btn">Delete</button>
		<button type="button" class="ml-2 btn btn-success" id="save_edit_btn">Save Token to Mine</button>
	</div>

</div>

<script type="text/javascript">
	var tokenListArray = ajaxShortLink('userWallet/getAllTokensV2');
	var daysContainer = ajaxShortLink('mining/daily/getAddDays');

	


	// select picker
		for (var i = 0; i < tokenListArray.length; i++) {
			$("#token_name_container").append("<option value='"+tokenListArray[i].id+"'>"+tokenListArray[i].description+" ("+tokenListArray[i].networkName.toUpperCase()+") </option>");
		}

		for (var i = 0; i < daysContainer.length; i++) {
			$("#cycle_day_container").append("<option value='"+daysContainer[i].id+"'>"+daysContainer[i].days+" </option>");
		}

		$('#token_name_container').selectpicker({
		    style: 'border',
		    size: 4
	  	});

		$('#cycle_day_container').selectpicker({
		    style: 'border',
		    size: 4,
	  	});

	  	var tempDaysContainer = [];

	  	for (const [key, value] of Object.entries(selectedData.cycle_day.split(","))) {
	  	  tempDaysContainer.push(parseInt(value))
	  	}

	  	// console.log(tempDaysContainer)

	  	$('#cycle_day_container').selectpicker("val",tempDaysContainer)
	  	$('#cycle_day_container').selectpicker('render');

	  	$('#token_name_container').selectpicker("val",selectedData.token_id)
	  	$('#token_name_container').selectpicker('render');
	// select picker

	$("#purchase_limit_container").val(selectedData.purchasable_limit);
	$("#minimum_entry_container").val(selectedData.minimum_entry);


  	$("#network_container").val(selectedData.network.toUpperCase());
  	// $('#apy_container').val(selectedData.apy)

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

	$("#delete_btn").on('click', function(){
		$.confirm({
			icon: 'bi bi-trash3',
		    title: 'Deleting?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>delete</b> this token? There may be entries for this mining token. if we delete this all their entries will be disolved',
		    buttons: {
		        confirm: function () {
    			    var data = {
    			    	'id':selectedData.id
    			    };

    	    		var res = ajaxShortLink('mining/daily/deleteToken',data);

    	      	if (res) {
    	        	$.toast({
    				        heading: '<h6>Success!</h6>',
    				        text: 'Successfully Saved Editing for Token Mining!',
    				        showHideTransition: 'slide',
    				        icon: 'success',
    				        position: 'bottom-left'
    				    })

    	      		bootbox.hideAll();
    	      		loadDatatable('mining/daily/getDailySettings');
    	      	}else{
    	        	$.toast({
    	        	    heading: '<h6>Cant Save!</h6>',
    	        	    text: 'Please contact system admin',
    	        	    showHideTransition: 'slide',
    	        	    icon: 'error',
    	        	    position: 'bottom-left'
    	        	})
    	      	}
		        },
		        cancel: function () {

		        },
		    }
		});
	});

	$("#save_edit_btn").on('click', function(){
		if ($("#mainForm").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this editing of token? Please ensure that these are the correct parameters',
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
				cycle_day_container: "required",
				network_container: "required",
				purchase_limit_container: "required",
				minimum_entry_container: "required",
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

		    data.push({
		    	'name':'id',
		    	'value':selectedData.id
		    });

		    data.push({
		    	'name':'cycle_days',
		    	'value':$("#cycle_day_container").val().toString()
		    });

    		var res = ajaxShortLink('mining/daily/saveEditDailyToken',data);

    		console.log(res)

	      	if (res) {
	        	$.toast({
				        heading: '<h6>Success!</h6>',
				        text: 'Successfully Saved Editing for Token Mining!',
				        showHideTransition: 'slide',
				        icon: 'success',
				        position: 'bottom-left'
				    })

	      		bootbox.hideAll();
	      		loadDatatable('mining/daily/getDailySettings');
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