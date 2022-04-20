<style type="text/css">
	button:focus { outline-style: none; }

	.box {
	  float: left;
	  height: 20px;
	  width: 20px;
	  margin-bottom: 15px;
	  border: 1px solid black;
	  clear: both;
	}

	.alert1{
		background-color: #FFC04C;
	}

	.alert2{
		background-color: #00b300;
	}

	.btn.dropdown-toggle{
		height: calc(1.5em + 0.75rem + 2px);
	    padding: 0.375rem 0.75rem;
	    font-size: 1rem;
	    font-weight: 400;
	    line-height: 1.5;
	    color: #495057;
	    background-color: #fff;
	    background-clip: padding-box;
	    border: 1px solid #ced4da;
	    border-radius: 0.25rem;
	}

</style>

<div class="text-center">
	<div class="display-3">Admin User Type Permission</div>
	<sub>Edit Admin Permissions</sub>
</div>

<button class="btn btn-success" id="addNewAdminType">Add New Admin Type</button>
<br>
<br>

<table id="tableContainer" class="table table-hover">
	<thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>User Type</th>
            <th>Date Created</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
	var consulatationArray = [];

	$(document).ready(function() {
		loadDatatable('admin/getAllUserTypes');

		$("#addNewAdminType").on('click',function(){
			$.confirm({
			    title: 'Adding New Admin type',
			    content: '' +
			    '<form action="" class="formName">' +
    				'<div class="form-group">' +
						'<labelPlease enter new admin type</label>' +
			    		'<input type="text" placeholder="Name for admin type" id="userTypeContainer" class="form-control" required rows="3"/>' +
			    	'</div>' +
			    '</form>',
			    buttons: {
			        formSubmit: {
			            text: 'Submit',
			            btnClass: 'btn-success',
			            action: function () {
			                var userType = this.$content.find('#userTypeContainer').val();
			                if(!userType){
			                    $.alert('provide a valid details');
			                    return false;
			                }else{
			                	ajaxShortLink(
			                		url = 'admin/addNewAdminType',
			                		data = {
			                			'userType': $("#userTypeContainer").val(),
			                		}
			                	);

			                	$.toast({
			                	    heading: '<h6>Success!</h6>',
			                	    text: 'Successfully added all changes!',
			                	    showHideTransition: 'slide',
			                	    icon: 'success',
			                	    position: 'bottom-left'
			                	})

			                	loadDatatable('admin/getAllUserTypes');
			                }

			            }
			        },
			        cancel: function () {
			            //close
			        },
			    },
			    onContentReady: function () {
			        // bind to events
			        var jc = this;
			        this.$content.find('form').on('submit', function (e) {
			            // if the user submits the form by pressing enter in the field.
			            e.preventDefault();
			            jc.$$formSubmit.trigger('click'); // reference the button and click it
			        });
			    }
			});
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
				{ data:''},
				{ data:'id'},
				{ data:'userType'},
				{ data:'dateCreated'},
	        ],
			"columnDefs": [
				{
					"targets": 0,
					"width": "1%",
	            	"data": null,
		            "defaultContent": '<button type="button" class="close edit" onClick="viewThis(this)"><i class="fa fa-pencil" aria-hidden="true"></i></button>',
	                "orderable": false,
	                "sortable": false
		        }
			],"createdRow": function( row, data, dataIndex){
				if (data['isBlocked'] == 1) {
					console.log($(row).addClass('bg-danger text-light'));
				}
	        }
			// "autoWidth": true,
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'users/permission/editPermissions'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>
