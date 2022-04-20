<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<h3 class="mb-3 display-4">Permission adding</h3>

<hr>

<form id="mainForm">
	<div class="p-2">
		<div class="form-group">
			<div class="col-md"><b>User Type:</b></div>	
			<label id="userTypeContainer"></label>
		</div>

		<div class="form-group">
			<div class="col-md"><b>Tasks:</b></div>	
			<small class="text-success">NOTE: TYPE | DESC | DESC CODE | PARENT - GRP Are dependents to its SYS. if sys parent is not added it will not show to the sidebar</small>
			<select class="form-control selectpicker" multiple id="permissionContainer">
			</select>
	  	</div>
	</div>

	<hr>

	<div class="row m-2">
		<button type="button" class="ml-1 col-md btn btn-success" id="saveBtn">Save Changes</button>
		<button type="button" class="ml-1 col-md btn btn-danger" id="closeBtn">Close</button>
	</div>
</form>

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