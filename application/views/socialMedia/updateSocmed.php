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
	.switch {
	    position: relative;
	    display: inline-block;
	    width: 60px;
	    height: 34px;
    }
    .switch .toggle { 
	    opacity: 0;
	    width: 0;
	    height: 0;
    }
    .slider {
	    position: absolute;
	    cursor: pointer;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    background-color: #ccc;
	    -webkit-transition: .4s;
	    transition: .4s;
    }
    .slider:before {
	    position: absolute;
	    content: "";
	    height: 26px;
	    width: 26px;
	    left: 4px;
	    bottom: 4px;
	    background-color: white;
	    -webkit-transition: .4s;
	    transition: .4s;
    }
    .toggle:checked + .slider {
    	background-color: #5426de;
    }
    .toggle:focus + .slider {
    	box-shadow: 0 0 1px #5426de;
    }
    .toggle:checked + .slider:before {
	    -webkit-transform: translateX(26px);
	    -ms-transform: translateX(26px);
	    transform: translateX(26px);
    }
    /* Rounded sliders */
    .slider.round {
    	border-radius: 34px;
    }
    .slider.round:before {
    	border-radius: 50%;
    }
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Edit Social Media</label>
</div>

<div id="main_bootbox_cointainer">
	<form id="update_socmed">
		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Name:</b></div>	
			<input type="text" name="name_container" id="name_container" class="col-md form-control form-control-sm" placeholder=""></input>
		</div>

		<div class="row m-1">
			<div class="col-md-3 pl-3"><b>Link:</b></div>	
			<input type="text" name="link_container" id="link_container" class="col-md form-control form-control-sm" placeholder=""></input>
		</div>

		<div class="row m-1 mt-2">
			<div class="col-md-3 pl-3"><b>Social Medial Control:</b></div>	
			<label class="switch">
			  <input id="isShown" onclick="toggle_btn()" class="toggle" type="checkbox">
			  <span class="slider round"></span>
			</label>
		</div>

		<hr>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger" id="closeBtn">Close</button>
			<button type="button" class="btn btn-success mr-1" id="save_edit_btn">Save Changes</button>
		</div>

	</form>
	
</div>

<script type="text/javascript">
	$("#name_container").val(selectedData.name);
	$("#link_container").val(selectedData.link);

	if(selectedData["isShown"]==1){
		$("#save_edit_btn").attr('enable',true)
	}

	var isOn = selectedData.isShown;
	var isShownUpdate;

	if (isOn==1) {
		$('#isShown').prop('checked',true);

	}else{
		$('#isShown').prop('checked',false);
	}

	function toggle_btn(){
		if ($('#isShown').is(":checked")==true) {
			isShownUpdate = 1;
		}else{
			isShownUpdate = 0;
		}
		// console.log(isShownUpdate)
	}

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#save_edit_btn").on('click', function(){
		if ($("#update_socmed").valid()) {
			$.confirm({
				icon: 'bi bi-pencil',
			    title: 'Saving?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>save</b> this?',
			    buttons: {
			        confirm: function () {
			        	$("#update_socmed").submit();
			        },
			        cancel: function () {

			        },
			    }
			});
		}
	});

	$("#update_socmed").validate({
	  	submitHandler: function(form){
		    var data = $('#update_socmed').serializeArray();

		    data.push({
	    		"name":"id",
	    		"value":selectedData.id
		    });

		    data.push({
	    		"name":"name",
	    		"value":selectedData.name
		    });

		    data.push({
	    		"name":"link",
	    		"value":selectedData.link
		    });

		    data.push({
	    		"name":"isShownUpdate",
	    		"value": isShownUpdate
		    });

		    var res = ajaxShortLink('admin/updateSocmed',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    heading: 'Success!!!',
		    	    text: 'Social Media Successfully Updated',
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