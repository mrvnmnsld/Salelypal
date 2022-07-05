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
	<label class="h2 mt-2 fw-bold">Edit Days</label>
</div>

<div id="mainQuestionModal">
	<form id="update_day_form">

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>Days:</b></div>
			<input name="days" id="days" class="col-md form-control form-control-sm" placeholder=""></input>
 			<!-- <select name="days" id="days" class="selectpicker col-md form-control form-control-sm" multiple data-live-search="true">
			  <option>10</option>
			  <option>20</option>
			  <option>30</option>
			</select> -->
		</div>

		<div class="row m-1">
			<div class="col-md-2 pl-3"><b>APY:</b></div>	
			<input type="number" name="apy" id="apy" class="col-md form-control form-control-sm" placeholder=""></input>	
		</div>

		<hr>
		
		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
			<button type="button" class="btn btn-success " id="save_day_btn">Save Days</button>
		</div>		
	</form>

</div>

<script type="text/javascript">
	$("#days").val(selectedData.days);
	$("#apy").val(selectedData.apy);

	$("#save_day_btn").on("click",function(){
		if ($("#update_day_form").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this changes? Please ensure that these are the correct parameters',
			    buttons: {
			        confirm: function () {
			        	$("#update_day_form").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#closeBtn").on("click", function(){
		bootbox.hideAll();
	});

	$("#update_day_form").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
				days: "required",
				apy: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#update_day_form').serializeArray();
		    data.push({
	    		"name":"id",
	    		"value":selectedData.id
		    });

		    var res = ajaxShortLink('test-account/daily/updateDays',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'Agent Successfully Updated',
		    	    icon: 'success',
		    	})

		    	bootbox.hideAll();
		    	loadDatatable2('test-account/daily/getAddDays');
		    }else{
		    	$.toast({
		    	    heading: 'Error!!!',
		    	    text: 'System Error, Please Contact System Admin',
		    	    icon: 'error',
		    	})
		    }

	  	}
	});
</script>