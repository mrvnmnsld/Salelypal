<style type="text/css">
	/*#chat_msgs_container > div{
		border-bottom: solid #5426DE .1px;
	}*/
</style>
<div id="inner_container" class="main-color-text">
	<div class="text-center h5 mt-2" id="waiting_container">
		Please wait while we connect you to one of our Customer Service Representative
	</div>

	<div class="p-2">
		<div class="text-center text-success animate__bounceIn" id="chat_has_started_container" style="display: none;">
			Connected to a CSR. Start sending messages to initiate the conversation
		</div>

		<div id="chat_msgs_container" class="p-3"></div>

		<div class="input-group">
		    <input id="msg_send_container" type="text" class="form-control custom-control" disabled rows="2" style="resize:none"> 

		    <button id="send_msg_btn" class="input-group-addon btn btn-primary align-middle" disabled style="font-size:; vertical-align: middle;">
		    	<i class="fa fa-paper-plane" aria-hidden="true"></i>
		    	Send
		    </button>
		</div>
	</div>

	<div class="p-1">
		<!-- <button class="btn btn-success btn-block" id="close_ticket_btn">Close Ticket</button> -->
		<button class="btn btn-success btn-block" id="create_ticket_btn">Create New Ticket</button>
	</div>
</div>

<script type="text/javascript">
	$("#bottomNavBar").css("display","none");
	
	var createNewTicket = ajaxShortLink("admin/chatSupport/createNewTicket",{
		"userID":currentUser.userID
	});

	var chatDetails = ajaxShortLink('admin/getChatDetails',{
		'id':createNewTicket
	});

	console.log(createNewTicket,chatDetails);

	var chatDetailsChecker = setInterval(function(){
		chatDetails = ajaxShortLink('admin/getChatDetails',{
			'id':createNewTicket
		});

		console.log(chatDetails[0].adminID)

		if (chatDetails[0].adminID != null) {
			$("#msg_send_container").removeAttr("disabled");
			$("#send_msg_btn").removeAttr("disabled");
			$("#chat_has_started_container").toggle();
			$("#waiting_container").toggle();

			clearInterval(chatDetailsChecker);
			var updateChatHistoryInterval = setInterval(function(){
				updateChatHistory();
			},1000)
		}
	
	},1000);

	$('#msg_send_container').keyup(function(e){
		if(e.keyCode == 13){
	        $("#send_msg_btn").click();
	    }	   
	});

	$('#create_ticket_btn').on("click",function(){
		$.confirm({
			theme:'dark',
			icon: 'fa fa-sign-out',
			title: 'Disconnecting?',
			columnClass: 'col-md-6 col-md-offset-6',
			content: 'Are you sure you want to <b>create a new ticket</b>? This will disconnect you with the current representative and put you back on queue',
			buttons: {
				confirm: function () {
					if (typeof chatDetailsChecker  != 'undefined') {
						clearInterval(chatDetailsChecker);
					}

					if (typeof updateChatHistoryInterval  != 'undefined') {
						clearInterval(updateChatHistoryInterval);
					}
					
					$("html, body").animate({ scrollTop: 0}, "slow");

					var updateChatTicket = ajaxShortLink('admin/updateChatTicket',{
						'id':createNewTicket,
						'status':"CLOSED"
					});

		  			$("#container_main").empty();
		  			$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/chat'}));
				},
				cancel: function () {

				},
			}
		});
	});

	$("#send_msg_btn").on('click',function(){
		var msg = $("#msg_send_container").val()

		var sendMSGRes = ajaxShortLink("admin/chatSupport/sendMsg",{
			'msg':msg,
			'msgBy':"user",
			'chatTicketID':createNewTicket
		})

	   	$('#msg_send_container').val("");
	})

	// loadChatHistory()

	function updateChatHistory(){
		var getChatTicketMsgs = ajaxShortLink("admin/chatSupport/getChatTicketMsgs",{
			'chatTicketID':createNewTicket
		})

		console.log(getChatTicketMsgs);

		if(getChatTicketMsgs.length>=1){
			console.log(getChatTicketMsgs.length>$("#chat_msgs_container div").length);
			console.log(getChatTicketMsgs.length,$("#chat_msgs_container div").length);

			if (getChatTicketMsgs.length>$("#chat_msgs_container div").length) {
				var spliced = getChatTicketMsgs.splice($("#chat_msgs_container div").length-getChatTicketMsgs.length, getChatTicketMsgs.length);

				for (var i = 0; i <= spliced.length-1; i++) {
					if (spliced[i].msgBy == "admin") {
						$("#chat_msgs_container").append(
							'<div class="text-right">'+
								'<b>Admin/Support</b><br>'+
								'<span>'+
									spliced[i].msg+
								'</span><br>'+
								'<small class="text-muted">'+spliced[i].dateCreated+'</small>'+
							'</div>'+

							'<br>'
						);
					}else{
						$("#chat_msgs_container").append(
							'<div class="text-left">'+
								'<b>You</b><br>'+
								'<span>'+
									spliced[i].msg+
								'</span><br>'+
								'<small class="text-muted">'+spliced[i].dateCreated+'</small>'+
							'</div>'+

							'<br>'
						);
					}
				}			
			}
		}
	}
</script>



