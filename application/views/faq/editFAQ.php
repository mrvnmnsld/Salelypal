<script defer src="assets/lib/faceapi/face-api.min.js"></script>
<!-- <script defer src="assets/lib/faceapi/script.js"></script> -->

<style type="text/css">
	.modal-footer{
		display: none;
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

	#main_modal_container, #wallet_transactions_modal_container, #contract_transactions_modal_container, #topup_transactions_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}

</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">FAQ EDIT</label>
</div>

<div id="main_modal_container">
	<div class="text-center mt-2">Note: This supports HTML 5 tags for design</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>FAQ:</b></div>	
		<div class="col-md">
			<textarea class="form-control" id="faq_container" rows="3"></textarea>
		</div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Answer:</b></div>	
		<div class="col-md">
			<textarea class="form-control" id="answer_container" rows="3"></textarea>
		</div>	
	</div>

	<div class="text-center text-danger mt-2" id="error_reporter"></div>

	<hr>

	<div class="text-right">
		<button class="btn btn-warning" id="deleteBtn">Delete</button>
		<button class="btn btn-success" id="saveBtn">Save</button>
		<button class="btn btn-danger" id="closeBtn">Close</button>
	</div>

</div>




<script type="text/javascript">
	console.log(selectedData);

	$("#faq_container").append(selectedData["faq"]);
	$("#answer_container").append(selectedData["answer"]);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#deleteBtn").on('click', function(){
		$.confirm({
			theme:'dark',
			icon: 'bi bi-trash3-fill',
			title: 'Deleting?',
			columnClass: 'col-md-6 col-md-offset-6',
			content: 'Are you sure you want to <b>delete this</b>? This action is irreversible',
			buttons: {
				confirm: function () {
					ajaxShortLink("admin/faq/deleteFaq",{
						'id':selectedData.id,
					})

					loadDatatable('admin/loadFAQ');
					bootbox.hideAll();
				},
				cancel: function () {

				},
			}
		});
	});


	$("#saveBtn").on('click', function(){

		var faq = $("#faq_container").val();
		var answer = $("#answer_container").val();

		console.log(faq,answer);

		if (faq == "" || answer == "") {
			$("#error_reporter").text("Please Fill Empty Fields");
		}else{
			$("#error_reporter").text("");

			$.confirm({
				theme:'dark',
				icon: 'bi bi-pencil-fill',
				title: 'Saving?',
				columnClass: 'col-md-6 col-md-offset-6',
				content: 'Are you sure you want to <b>save the changes</b>? This action is irreversible',
				buttons: {
					confirm: function () {
						ajaxShortLink("admin/faq/editFaqSave",{
							'id':selectedData.id,
							'faq':faq,
							'answer':answer,
						})

						loadDatatable('admin/loadFAQ');
						bootbox.hideAll();
					},
					cancel: function () {

					},
				}
			});
		}
	});


	

	

	
</script>