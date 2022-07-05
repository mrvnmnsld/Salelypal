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
	<form id="update_option_form">

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
			<button type="button" class="btn btn-warning ml-2" id="delete_btn">Delete</button>
			<button type="button" class="btn btn-success" id="save_option_btn">Save Changes</button>
		</div>		
	</form>

</div>

<script type="text/javascript">
	$("#timing").val(selectedData.timing);
	$("#income").val(selectedData.income);

	$("#save_option_btn").on("click",function(){
		if ($("#update_option_form").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this changes? Please ensure that these are the correct parameters',
			    buttons: {
			        confirm: function () {
			        	$("#update_option_form").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#delete_btn").on("click",function(){
		// $("#addUserForm").submit();
		$.confirm({
	    title: 'Delete?',
	    content: 'Are you sure you want to delete?',
	    buttons: {
	        confirm: function () {
	            var res = ajaxShortLink('test-account/deleteFutureRisefallOption',{
	            	"id":selectedData.id
	            });


	            if(res == 1){
	            	$.toast({
	            	    heading: 'Success!!!',
	            	    text: 'Option has been Deleted',
	            	    icon: 'success',
	            	})

	            	bootbox.hideAll();
	            	loadDatatable('test-account/getFutureRisefallTimings');
	            }else{
	            	$.toast({
	            	    heading: 'Error!!!',
	            	    text: 'System Error, Please Contact System Admin',
	            	    icon: 'error',
	            	})
	            }

	            // console.log(res);
	        },
	        cancel: function () {

	        },
	    }
		});
      
	});

	$("#closeBtn").on("click", function(){
		bootbox.hideAll();
	});

	$("#update_option_form").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
				timing: "required",
				income: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#update_option_form').serializeArray();
		    data.push({
	    		"name":"id",
	    		"value":selectedData.id
		    });

		    var res = ajaxShortLink('test-account/updateFutureRisefallOption',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'Agent Successfully Updated',
		    	    icon: 'success',
		    	})

		    	bootbox.hideAll();
		    	loadDatatable('test-account/getFutureRisefallTimings');
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