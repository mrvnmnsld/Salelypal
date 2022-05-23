<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Invitation List</h1>
      <sub>List of invited users</sub>
    </div>

	<div class="h3">Total invited : <span id="total_invited_container"></span></div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Date Joined</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('agent/getAgentInvites',{

			'agentID' : currentUser.id

		});
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: callDataViaURLVal,
			columns: [
				{ data:'userID'},
				{ data:'fullname'},
				{ data:'email'},
				{ data:'timestamp'},
			],
			order: [[0, 'desc']],
			autoWidth: false,
		});

		var table = $('#tableContainer').DataTable();
		$('#total_invited_container').text(table.rows().count());
		// console.log( table.rows().count());
	}
</script>