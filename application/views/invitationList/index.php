<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
		<div class="pagetitle">
      	<h1>Invitation List</h1>
  			<sub class="fw-bold">List of all your invited users</sub>
    </div>

    <hr>


    <div class="row">
    	<div class="text-center h3 col-4">
    		Total invites:
    		<div class="">
    			<span id="total_invited_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h3 col-4">
    		Yearly invites:
    		<div class="">
    			<span id="yearly_invited_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h3 col-4">
    		Monthly invites:
    		<div class="">
    			<span id="monthly_invited_container">0</span>
    		</div>
    	</div>
    </div>

    <hr>

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

		var d = new Date();
		var month = String(d.getMonth() + 1).padStart(2, '0');
		var year = d.getFullYear();


		var getMonthlyInvites = ajaxShortLink("agent/getMonthlyInvites",{
			'agentID':currentUser.id,
			'monthYear':year+"-"+month
		});

		var getYearlyInvites = ajaxShortLink("agent/getYearlyInvites",{
			'agentID':currentUser.id,
			'year':year
		});

		$('#yearly_invited_container').text(getYearlyInvites.length);
		$('#monthly_invited_container').text(getMonthlyInvites.length);

		console.log(month,year,getMonthlyInvites,getYearlyInvites);

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