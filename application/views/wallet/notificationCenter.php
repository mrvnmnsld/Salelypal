<style type="text/css">
	.alert-simple.alert-custom{
	  background-color: rgba(52, 55, 67, 0.5);
	  color: white;
	  transition:0.5s;
	  cursor:pointer;
	}
	.alert-custom{
		border-color: #000000;
	}
	.alert-custom:hover{
	  background-color: rgba(52, 55, 67, 0.8);
	  transition:0.5s;
	}
	.alert-info:hover{
	  background-color: rgba(7, 73, 149, 0.35);
	  transition:0.5s;
	}
	.notif{
		font-size: 13px;
	}
	.notif-header{
		font-size: 18px;
	}
</style> 

<div class="p-2">
	<div class="text-center h5 text-dark font-weight-bold" id="notification_counter_string_container"></div>

	<div id="new_notification_container"></div>

	<div class="text-center text-dark font-weight-bold"> Nothing follows</div>
</div>

		<div id="" class="new-notif notif border-bottom border-dark m-3">
			<!-- <span class="text-dark notif-header">
				Tittle Testing
			</span><br>

			<span>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit.
			</span><br>

			<small>1 Hour ago</small> -->
<script type="text/javascript">
	var notifList = ajaxShortLink("getNewNotifsToViewed",{
		'userID':currentUser.userID
	});

	$("#new_notif_counter").text("0")

	if(notifList.length>=1){
		$("#notification_counter_string_container").text("You have "+(notifList.length)+" New Notifications");
		
		for (var i = 0; i < notifList.length; i++) {
			var tittle = notifList[i].tittle;
			var content = notifList[i].content;
			var dateCreated = notifList[i].dateCreated.split(/[- :]/);

			var endDate = new Date(dateCreated[0], dateCreated[1]-1, dateCreated[2], dateCreated[3], dateCreated[4], dateCreated[5]);;

			console.log();
			

			$("#new_notification_container").append(
				// '<div id="" class="new-notif notif border-bottom border-dark m-2">'+
				// 	'<span class="text-dark notif-header">'+
				// 		tittle+
				// 	'</span><br>'+

				// 	'<span>'+
				// 		content+
				// 	'</span><br>'+

				// 	'<div class="text-center"><small>'+formatDateObject(endDate)+'</small></div>'+
				// '</div>'

		//pancho 05-24-2022
				'<div class="row">'+
			      '<div class="col-sm-12">'+
			        '<div class="alert fade alert-simple alert-custom alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">'+
			          '<button type="button" class="close font__size-18" data-dismiss="alert">'+
												'<span class="sr-only">Close</span>'+
											'</button>'+
			          '<strong class="font__weight-semibold">'+

			          tittle+

			          '</strong><br>'+

			          content+

			          '<div class="text-center"><small>'+formatDateObject(endDate)+'</small></div>'+
			        '</div>'+
			      '</div>'+
			    '</div>'
			);
		//pancho 05-24-2022	
		}
	}else{
		$("#notification_counter_string_container").text("You have No New Notifications");
	}

	
</script>