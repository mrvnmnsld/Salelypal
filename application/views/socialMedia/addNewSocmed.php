<link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
	.modal-footer{
		display: none;
	}
	label.is-invalid{
		text-align: center;
		color: red;
	}
	.error{
		color: red;
	}
	.icon-size{
		font-size: 1.4em;
		max-width: 2em;
		padding-top: 10px;
	}
	 .form-control { /* seems working on other ui bugs, no changes on current ui screens */
		height: 2.7em; 
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
	}
	#main_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="text-center">
	<label class="h2 mt-2 fw-bold">Add New Socila Media</label>
</div>

<div id="main_modal_container">

	<form id="add_socmed_form">

		<label class="fw-bold">Name</label>
		<div class="input-group row m-1 mb-3">
			
			<i class="input-group-text fa fa-user-circle icon-size" aria-hidden="true"></i>	
			<input type="text" class="form-control" id="name" name="name" placeholder="Example: Facebook">	
		</div>

		<label class="fw-bold">Link</label>
		<div class="input-group row m-1 mb-3">
			<i class="input-group-text fa fa-link icon-size" aria-hidden="true"></i>
		  <input type="text" class="form-control" id="link" name="link" placeholder="https://www.facebook.com">
		</div>

		<hr>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger mr-1" id="back_btn">Back</button>
			<button type="button" class="btn btn-success mr-1" id="save_btn">Save</button>
		</div>

	</form>

</div>

<script type="text/javascript">
	$("#save_btn").on("click",function(){
		$("#add_socmed_form").submit();
	});

	$("#back_btn").on("click", function(){
		bootbox.hideAll();
	});

	$("#add_socmed_form").validate({
	  	submitHandler: function(form){
		    var data = $('#add_socmed_form').serializeArray();

		    var res = ajaxShortLink('admin/saveNewSocmed',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'Social Media Successfully Added',
		    	    icon: 'success',
		    	})

		    	bootbox.hideAll();
		    	loadDatatable('admin/getAllSocmed');
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