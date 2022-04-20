<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Pending Withdrawal Transactions</h1>
      <sub>Viewing of all stricted wallet transactions</sub>
    </div>

    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th width="10"></th>
                <th>Email</th>
                <th>Token</th>
                <th>Amount</th>
                <th>Network</th>
                <th>Receipient</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script type="text/javascript">

	var selectedData;

	$(document).ready(function() {
		loadDatatable('userWallet/loadPendingTransactions')
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();		 
	});

	function loadDatatable(url){
		var dataRes = ajaxShortLink(url);
		console.log(dataRes);

		$('#tableContainer').DataTable().destroy();

		var dt = $('#tableContainer').DataTable({
			data: dataRes,
			columns: [
				{ 
					"class":"details-control",
					"orderable":false,
					"data":null,
					'width':'5%',
					"defaultContent":
						 '<button type="button" class="btn btn-success rounded btn-sm" onClick="viewThis(this)">Approve</button>&nbsp;'
				},
				{ data:'email'},
				{ data:'token'},
				{ data:'amount'},
				{ data:'network'},
				{ data:'to'},

				
			],
			"order": [[1, 'asc']],
			"createdRow": function( row, data, dataIndex){
				// if (data['lastLoginDate'] == null) {
				// 	$(row).find("td:eq(4)").text("No data available");
				// }

				// if (data['isBlocked'] == 1) {
				// 	$(row).addClass('bg-danger text-light');
				// }
      },
	    autoWidth: false
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		$.confirm({
			icon: 'fa fa-thumbs-o-up',
		    title: 'Approving?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>approve</b> this transaction?',
		    buttons: {
		        confirm: function () {
		        	var res = ajaxPostLink('userWallet/strictMode/ApproveWithdrawal',
		        		{
		        			'id':selectedData.id,
		        		}
	        		);
		        	// bootbox.hideAll();

		        	console.log(res);

		        	if (res.ok ===true) {
			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successfully Approved Transaction!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })

		        		loadDatatable('userWallet/loadPendingTransactions')
		        	}else{
			        	$.toast({
	    			        heading: '<h6>ERROR!</h6>',
	    			        text: 'Please contact System Development Admin!',
	    			        showHideTransition: 'slide',
	    			        icon: 'error',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
		        	}

		        	
		        },
		        cancel: function () {

		        },
		    }
		});
	}
</script>
