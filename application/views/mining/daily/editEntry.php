<style type="text/css">
	.modal-footer{
		display: none;
	}

	.is-invalid{
		text-align: center;
	}
</style>

<div class="pagetitle">
  <h1>Manipulate Entry</h1>
</div>

<hr>

<div id="main_bootbox_cointainer">
	<form id="mainForm">
		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Balance:</b></div>	
			<input type="number" name="balance_container" id="balance_container" class="col-md form-control form-control-sm" placeholder=""></input>
		</div>

		<!-- <div class="row m-1">
			<div class="col-md-3 pl-3"><b>Set Claimable:</b></div>	
			<div class="col-md mt-1">
				<div class="form-check-inline">
				  <label class="form-check-label">
				    <input type="radio" value="1" class="form-check-input mt-1" name="setClaim_radio">Yes
				  </label>
				</div>
				<div class="form-check-inline">
				  <label class="form-check-label">
				    <input type="radio" value="0" class="form-check-input mt-1" name="setClaim_radio" checked>No
				  </label>
				</div>
			</div>
		</div> -->
	</form>
</div>

<div class="d-flex flex-row-reverse">
	<button class="btn btn-danger ml-2" id="closeBtn">Close</button>
	<button class="btn btn-success" id="save_edit_btn">Save Changes</button>
</div>

<script type="text/javascript">
	$("#balance_container").val(parseFloat(selectedData.balance.replace(',','')));
	$('[name="setClaim_radio"]').removeAttr('checked');
	$("input[name=setClaim_radio][value=" + selectedData.isClaimableAdmin + "]").attr('checked', 'checked');

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#save_edit_btn").on('click', function(){
		if ($("#mainForm").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this?',
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
				balance_container: "required",
				setClaim_radio: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#mainForm').serializeArray();

		    data.push({
		    	'name':'id',
		    	'value':selectedData.id
		    })

		    var res = ajaxShortLink('mining/daily/editMiningEntry',data);

		    console.log(data);

	      	if (res) {
	        	$.toast({
				        heading: '<h6>Success!</h6>',
				        text: 'Successfully Saved Edits!',
				        showHideTransition: 'slide',
				        icon: 'success',
				        position: 'bottom-left'
				        // position: 'bottom-center'
				    })

	      		bootbox.hideAll();
	      		loadDatatable('mining/daily/getAllDailyEntries');
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