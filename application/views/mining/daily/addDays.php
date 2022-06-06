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
	<label class="h2 mt-2 fw-bold">Add Days</label>
</div>

<div id="mainQuestionModal">
	<form id="add_day_form">

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>Days:</b></div>
			<input name="days" id="days" class="col-md form-control form-control-sm" placeholder="DAYS"></input>
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>APY:</b></div>	
			<input type="number" name="apy" id="apy" class="col-md form-control form-control-sm" placeholder="APY"></input>	
		</div>

		<hr>
		
		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
			<button type="button" class="btn btn-success " id="save_day_btn">Save Days</button>
		</div>		
	</form>
</div>

<script type="text/javascript">

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#save_day_btn").on('click', function(){
		if ($("#add_day_form").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this new days cycle? Please ensure that these are the correct parameters',
			    buttons: {
			        confirm: function () {
			        	$("#add_day_form").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#add_day_form").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
				days: "required",
				apy: "required",
	  	},
	  	errorPlacement: function (error, element) {
	  	    if ($(element).is('select')) {
	  	        element.next().after(error); // special placement for select elements
	  	    } else {
	  	        error.insertAfter(element);  // default placement for everything else
	  	    }
	  	},
	  	submitHandler: function(form){
		    var data = $('#add_day_form').serializeArray();
      		var res = ajaxShortLink('mining/daily/saveDays',data);
		    console.log(res);

      	if (res) {
        	$.toast({
			        heading: '<h6>Success!</h6>',
			        text: 'Successfully Saved Days Cycle!',
			        showHideTransition: 'slide',
			        icon: 'success',
			        position: 'bottom-left'
			        // position: 'bottom-center'
			    })

      		bootbox.hideAll();
      		loadDatatable2('mining/daily/getAddDays');
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