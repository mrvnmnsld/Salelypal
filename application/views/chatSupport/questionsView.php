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
	#main_bootbox_cointainer{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
  .dnone{
    display:none;
  }
  .dblock{
    display:block;
  }
  .red{
    color : red;
  }
  .border-red{
    border: solid red 1px;
  }
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Edit Question</label>
</div>

<div id="main_bootbox_cointainer">
	<form id="mainForm">
		<div class="row mb-3 mx-2">
			<div class="pb-1"><b>Question :</b></div>	
      <textarea class="form-control" name="question_input" id="question_input" rows="2"></textarea>
		</div>

    <div class="row mx-2">
			<div class="pb-1"><b>Answer :</b></div>	
      <textarea class="form-control" name="answer_textarea" id="answer_textarea" rows="3"></textarea>
    </div>

    <div id="code_empty" class="py-2 dnone"><code class="red float-end">Please fill out all blanks</code></div>
		<hr>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
			<button type="button" class="btn btn-warning ml-2" id="delete_btn">Delete</button>
			<button type="button" class="btn btn-success" id="save_edit_btn">Save Changes</button>
		</div>

	</form>
	
</div>





<script type="text/javascript">

  var question = $("#question_input").val()
  var answer = $("#answer_textarea").text()

	$("#question_input").val(selectedData.question);
	$("#answer_textarea").text(selectedData.answer);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#delete_btn").on('click', function(){
		$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Deleting?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>delete</b>? This action is irreversible',
			    buttons: {
			        confirm: function () {
								$("#loading_text").text('Deleting... Please wait')
								$("#loading").toggle();

								var res = ajaxShortLink('admin/deleteQuestion',{
									'id':selectedData.id
								});

								setTimeout(function(){
									$("#loading_text").text('Loading…')
									$("#loading").toggle();
								},500)


								if (res) {
									$.toast({
											heading: '<h6>Success!</h6>',
											text: 'Successfully Deleted!',
											showHideTransition: 'slide',
											icon: 'success',
											position: 'bottom-left'
											// position: 'bottom-center'
									})

									bootbox.hideAll();
									loadDatatable('admin/getQuestions')
								}else{
									$.toast({
											heading: '<h6>Cant Delete!</h6>',
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
				question_input: "required",
				answer_textarea: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#mainForm').serializeArray();

		    data.push({
		    	'name':'id',
		    	'value':selectedData.id
		    })

        data.push({
		    	'name':'createdBy',
		    	'value':currentUser.username
		    })

					$("#loading_text").text('Saving modified values... Please wait')
					$("#loading").toggle();

		    	var res = ajaxShortLink('admin/editQuestion',data);

					console.log(data);

					setTimeout(function(){
					$("#loading_text").text('Loading…')
					$("#loading").toggle();
					},500)


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
	      		loadDatatable('admin/getQuestions')
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