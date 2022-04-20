<style type="text/css">
	.notif{
		font-size: 13px;
	}

	.notif-header{
		font-size: 18px;
	}
</style>

<div class="p-2">
	<div class="text-center h5 text-success" id="notification_counter_string_container"></div>

	<div id="new_notification_container"></div>

	<div class="text-center text-muted"> Nothing follows </div>
</div>

<!-- <div id="" class="new-notif notif border-bottom border-dark m-3">
			<span class="text-dark notif-header">
				Tittle Testing
			</span><br>

			<span>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit.
			</span><br>

			<small>1 Hour ago</small>
		</div> -->

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
				'<div id="" class="new-notif notif border-bottom border-dark m-2">'+
					'<span class="text-dark notif-header">'+
						tittle+
					'</span><br>'+

					'<span>'+
						content+
					'</span><br>'+

					'<div class="text-center"><small>'+formatDateObject(endDate)+'</small></div>'+
				'</div>'
			);
		}
	}else{
		$("#notification_counter_string_container").text("You have No New Notifications");
	}

	
</script>