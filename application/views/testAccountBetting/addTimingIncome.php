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
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Add Timing and Income Option</label>
</div>

<div id="mainQuestionModal">
	<form id="add_option_form">

		<div class="row">
			<div class="col-md-6 input-group mb-3">
				<label class="col-md-2 font-weight-bold mt-1">Timing:</label>
				<input type="number" name="timing" id="timing" class="form-control" placeholder="Add Timing">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">seconds</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 input-group mb-3">
				<label class="col-md-2 font-weight-bold mt-1">Income:</label>
				<input type="number" name="income" id="income" class="form-control" placeholder="Add Income">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">%</span>
				</div>
			</div>
		</div>

		<hr>
		
		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
			<button type="button" class="btn btn-success " id="add_btn">Save</button>
		</div>		
	</form>
</div>

<script type="text/javascript">

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#add_btn").on('click', function(){
		if ($("#add_option_form").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this new days cycle? Please ensure that these are the correct parameters',
			    buttons: {
			        confirm: function () {
			        	$("#add_option_form").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#add_option_form").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
				timing: "required",
				income: "required",
	  	},
	  	errorPlacement: function (error, element) {
	  	    if ($(element).is('select')) {
	  	        element.next().after(error); // special placement for select elements
	  	    } else {
	  	        error.insertAfter(element);  // default placement for everything else
	  	    }
	  	},
	  	submitHandler: function(form){
		    var data = $('#add_option_form').serializeArray();
      		var res = ajaxShortLink('admin/addFutureRisefallOption',data);
		    console.log(res);

      	if (res) {
        	$.toast({
			        heading: '<h6>Success!</h6>',
			        text: 'Successfully Saved Option!',
			        showHideTransition: 'slide',
			        icon: 'success',
			        position: 'bottom-left'
			        // position: 'bottom-center'
			    })

      		bootbox.hideAll();
      		loadDatatable('test-account/getFutureRisefallTimings');
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