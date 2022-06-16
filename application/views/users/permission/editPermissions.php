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
	}
	#main_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="text-center">
	<label class="h2 mt-2 fw-bold">Permission Adding</label>
	<p style="font-size: 0.9em;">Change permissions for user type selected</p>
</div>

<div id="main_modal_container">
	<form id="mainForm">
		<div class="p-2">
			<div class="form-group">
				<div class="col-md"><b>User Type:</b></div>	
				<div class="col-md" id="userTypeContainer"></div>	
			</div>

			<div class="form-group">
				<div class="col-md"><b>Tasks:</b></div>	
				<div class="col-md">NOTE: TYPE | DESC | DESC CODE | PARENT - GRP Are dependents to its SYS. if sys parent is not added it will not show to the sidebar</div>

				<br>
				<select class="form-control selectpicker" multiple id="permissionContainer">
				</select>
		  	</div>
		</div>

		<hr>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger mr-1" id="closeBtn">Close</button>
			<button type="button" class="btn btn-success mr-1" id="saveBtn">Save Changes</button>
		</div>

	</form>
</div>

<script type="text/javascript">
	$("#userTypeContainer").append(selectedData["userType"]);
	var allPermissions = ajaxShortLink('admin/getAllPermission');
	var allGrantedPermissions = ajaxShortLink('admin/getGrantedAllPermission',{
		'userType':selectedData["userType"]
	});

	console.log(allPermissions,allGrantedPermissions,selectedData["userType"]);

	for (var i = 0; i < allPermissions.length; i++) {
		if (allGrantedPermissions.includes(allPermissions[i].privilegesID)) {
			$("#permissionContainer").append('<option selected value="'+allPermissions[i]['privilegesID']+'">'+allPermissions[i]['type']+' | '+allPermissions[i]['desc']+' | '+allPermissions[i]['descCode']+' | '+allPermissions[i]['typeParent']+'</option>');
		}else{
			$("#permissionContainer").append('<option value="'+allPermissions[i]['privilegesID']+'">'+allPermissions[i]['type']+' | '+allPermissions[i]['desc']+'</option>');
		}
	}

	$("#permissionContainer").selectpicker();

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});


	$("#saveBtn").on('click',function(){
		if ($("#mainForm").valid()) {
			$.confirm({
				icon: 'fa fa-pencil',
			    title: 'Editing?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to save the changes?',
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

	$("#closeBtn").on('click',function(){
    	bootbox.hideAll();	
	});

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			permissionContainer: "required",
	  	},
	  	submitHandler: function(form){
		    ajaxShortLink(
		    	url = 'admin/saveEditPermissions',
		    	data = {
		    		'userType': selectedData['userType'],
		    		'permission': $("#permissionContainer").val(),
		    	}
		    );

		    $.toast({
		        heading: '<h6>Success!</h6>',
		        text: 'Successfully saved all changes!',
		        showHideTransition: 'slide',
		        icon: 'success',
		        position: 'bottom-left'
		    })

		    loadDatatable('admin/getAllUserTypes');
		    bootbox.hideAll();
	  	}
	});


</script>