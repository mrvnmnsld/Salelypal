<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>FAQ Settings</h1>
      <sub class="fw-bold">Edit FAQ both in safelypal.com and wallet.safelypal.com</sub>
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addBtn"><i class="bi bi-plus"></i> Add FAQ</button>
    </div>


    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th width="10"></th>
                <th>ID#</th>
                <th>FAQ</th>
                <th>Date Created</th>
                <th>Created By</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script type="text/javascript">

	var selectedData;

	$(document).ready(function() {
		loadDatatable('admin/loadFAQ')
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
						 '<button type="button" class="btn btn-success rounded btn-sm" onClick="viewThis(this)"><i class="bi bi-pencil-fill"></i></button>&nbsp;'
				},
				{ data:'id'},
				{ data:'faq'},
				{ data:'dateCreated'},
				{ data:'username'},
			],
			"order": [[1, 'asc']],
		    autoWidth: false
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'faq/editFAQ'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}

	$("#addBtn").on('click', function(){
		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'faq/addFaq'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	});
	
</script>
