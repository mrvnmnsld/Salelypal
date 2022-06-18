<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Betting Settings</h1>
      <sub class="fw-bold">Settings for all bettings</sub>
    </div>

    <hr>

    <div class="form-group">
      <label for="formGroupExampleInput">Rise-Fall Minimum: </label>
      <input type="number" class="form-control" id="risefall_minimum_input" placeholder="">
      <small class="text-muted">NOTE: USDT Minimum to bet</small>
    </div>

    <div class="form-group">
      <label for="formGroupExampleInput">Long-Short Minimum: </label>
      <input type="number" class="form-control" id="contract_minimum_input" placeholder="">
      <small class="text-muted">NOTE: USDT Minimum to bet</small>
    </div>

    <div>
    	<button class="btn btn-success" id="save_edit_btn">Save Changes</button>
    </div>

  </div>

  <div class="card-body">
    <div class="pagetitle">
      <h1>Timing and Income Settings</h1>
      <sub class="fw-bold">Configure Timing and Income</sub>
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addToken_btn"><i class="bi bi-plus"></i> Add Token to Mine</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Timing</th>
                <th>Income</th>
                <th>Date Created</th>
            </tr>
        </thead>
    </table>
  </div>

</div>

<script type="text/javascript">
	var consulatationArray = [];
	var bettingSettings = ajaxShortLink("admin/getBettingSettings");

	console.log(bettingSettings)

	$("#risefall_minimum_input").val(bettingSettings[0].value);
	$("#contract_minimum_input").val(bettingSettings[1].value);

	$(document).ready(function() {
		loadDatatable('admin/getFutureRisefallTimings');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});

		$("#save_edit_btn").on("click", function() {
			var risefall_minimum = $("#risefall_minimum_input").val();
			var contract_minimum = $("#contract_minimum_input").val();

			if(risefall_minimum == ""||contract_minimum == ""){
				$.alert("Please input valid number")
			}else{
				var res = ajaxShortLink("admin/saveBettingSettings",{
					"risefall_minimum":risefall_minimum,
					"contract_minimum":contract_minimum
				});

				console.log(res)

				if(res==true){
					$.toast({
					    text: "Successfully saved changes", // Text that is to be shown in the toast
					    heading: 'Success!', // Optional heading to be shown on the toast
					    icon: 'success', // Type of toast icon
					    showHideTransition: 'plain', // fade, slide or plain
					    allowToastClose: true, // Boolean value true or false
					    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
					    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
					    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
					    textAlign: 'left',  // Text alignment i.e. left, right or center
					    loader: true,  // Whether to show loader or not. True by default
					    loaderBg: '#9EC600',  // Background color of the toast loader
					});
					             
				}else{
					$.toast({
					    text: "Error in saving. Please contact system admin", // Text that is to be shown in the toast
					    heading: 'Error!', // Optional heading to be shown on the toast
					    icon: 'error', // Type of toast icon
					    showHideTransition: 'plain', // fade, slide or plain
					    allowToastClose: true, // Boolean value true or false
					    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
					    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
					    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
					    textAlign: 'left',  // Text alignment i.e. left, right or center
					    loader: true,  // Whether to show loader or not. True by default
					    loaderBg: '#9EC600',  // Background color of the toast loader
					});
				}
			}
			});	
		});

	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'mining/daily/editToken'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			dom: 'Bfrtip',
	        buttons: [
            	'copyHtml5',
            {
              extend: 'excelHtml5',
              title: 'data_export'
            },
            {
              extend: 'csvHtml5',
              title: 'data_export'
            },
            {
              extend: 'pdfHtml5',
              title: 'data_export'
            }
	        ],
			data: callDataViaURLVal,
			columns: [
				{ data:'id'},
				{ data:'timing'},
				{ data:'income'},
				{ data:'dateCreated'},

      		],"createdRow": function( row, data, dataIndex){

    		},
    		order: [[0, 'desc']],
    		autoWidth: false,
		});
	}
</script>
