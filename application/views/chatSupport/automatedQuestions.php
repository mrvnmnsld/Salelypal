<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Automated Questions</h1>
      <sub class="fw-bold">Automated Questions</sub>
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="add_btn">
        Add 
        <i class="fa fa-plus fa-sm" aria-hidden="true"></i>
      </button>
    </div>

    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th width="10"></th>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Created By</th>
                <th>Date Created</th>
            </tr>
        </thead>
    </table>
  </div>

</div>

<script type="text/javascript">
var selectedData;

$(document).ready(function() {
  loadDatatable('admin/getQuestions')
  $("#loading").toggle();
  $("#footer").toggle();
  $("#innerContainer").toggle();		 
});

function loadDatatable(url){
  var dataRes = ajaxShortLink(url);
  // console.log(dataRes);

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
           '<button type="button" class="btn btn-success rounded btn-sm" onClick="viewThis(this)">Edit</button>&nbsp;'
      },
      { data:'id'},
      { data:'question'},
      { data:'answer'},
      { data:'createdBy'},
      { data:'dateCreated'},
    ],
    "order": [[1, 'desc']],
    "createdRow": function( row, data, dataIndex){
      
      $(row).find("td:eq(2)").text(data['question'].substring(0,50)+'...');
      $(row).find("td:eq(3)").text(data['answer'].substring(0,50)+'...');

      if (data['dateCreated'] == null) {
        $(row).find("td:eq(5)").text("No data");
      }else{
        var y = data['dateCreated'].toString('dd/mm/yyyy HH:mm:ss GMT')
        $(row).find("td:eq(5)").text(y)
      }
    },
    autoWidth: false
  });
}

function viewThis(element){
  var table = $('#tableContainer').DataTable();
  selectedData = table.row($(element).closest('tr')).data();

  bootbox.alert({
      message: ajaxLoadPage('quickLoadPage',{'pagename':'chatSupport/questionsView'}),
      size: 'large',
      centerVertical: true,
      closeButton: false
  });
}

$('#add_btn').on('click', function(){
  bootbox.alert({
      message: ajaxLoadPage('quickLoadPage',{'pagename':'chatSupport/questionAdd'}),
      size: 'large',
      centerVertical: true,
      closeButton: false
  });
})
</script>
