<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Pending Withdrawal Transactions</h1>
      <sub class="fw-bold">Viewing of all stricted wallet transactions</sub>
    </div>

    <hr>

    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th width="10">Options</th>
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
						'<div class="d-flex">'+
					 		'<button type="button" class="btn btn-success rounded btn-sm" onClick="approveThis(this)">Approve</button>'+
					 		'<button type="button" class="btn btn-danger rounded btn-sm ml-2" onClick="declineThis(this)">Decline</button>'+
			 			'</div>'
				},
				{ data:'email'},
				{ data:'token'},
				{ data:'amount'},
				{ data:'network'},
				{ data:'to'},

				
			],
			"order": [[1, 'asc']],
	    autoWidth: false
		});
	}

	function approveThis(element){
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
		        			'currentUserID':selectedData.userID,
		        			'network':selectedData.network,
		        			'token':selectedData.token,
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

	function declineThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		$.confirm({
			icon: 'fa fa-thumbs-o-up',
		    title: 'Declining?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>decline</b> this transaction?',
		    buttons: {
		        confirm: function () {
		        	var res = ajaxPostLink('userWallet/strictMode/declineWithdrawal',{
		        			'id':selectedData.id,
		        		}
	        		);

		        	console.log(res);

		        	if (res==1) {
			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successfully Declined Transaction!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })

	    			    pushNewNotif("Withdrawal Declined","Unfortunately your "+selectedData.amount+" "+selectedData.token+" has been decline",selectedData.userID)

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
