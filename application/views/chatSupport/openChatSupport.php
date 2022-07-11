<style type="text/css">
	.modal-footer{
		display: none;
	}

	.modal-content{
		background: transparent;
		border: 0;
	}

	#pagetitle_background{
		background: #293038;
		color: white;
		padding: 15px;
		border-radius: 20px 20px 0px 0px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		text-align: center;
	}

	.modal-container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}

</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Chat Support Details</label>
</div>

<div class="modal-container" id="initial_modal" style="display: ;">
	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Chat Ticket#:</b></div>	
		<div class="col-md" id="chat_id_container"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>User ID#:</b></div>	
		<div class="col-md" id="chat_userID_container"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>User Email:</b></div>	
		<div class="col-md" id="chat_email_container"></div>	
	</div>

	<hr>

	<div class="d-flex flex-row-reverse">
		<button class="btn btn-danger ml-2 closeBtn">Close</button>
		<button class="btn btn-success ml-2" id="accept_ticket_btn">Accept Ticket</button>
		<button class="btn btn-success ml-2" id="view_history_btn">View Chat History</button>
	</div>
</div>

<div class="modal-container" id="accepted_ticket_modal" style="display: none;">
	<div class="card p-2">
		<div class="text-center text-muted">
			Chat Started hit send to start chatting...
		</div>

		<hr>

		<div id="chat_msgs_container"></div>

		<div class="input-group">
		    <input id="msg_send_container" type="text" class="form-control custom-control" rows="2" style="resize:none" value="Hello, This is Anna from SafelyPal Customer Service. How may i help you?"> 

		    <button id="send_msg_btn" class="input-group-addon btn btn-primary align-middle" style="font-size:; vertical-align: middle;">
		    	<i class="fa fa-paper-plane" aria-hidden="true"></i>
		    	Send
		    </button>
		</div>
	</div>
	

	<hr>

	<div class="d-flex flex-row-reverse">
		<button class="btn btn-success ml-2" id="close_ticket_btn">Close Ticket</button>
	</div>
</div>

<script type="text/javascript">
	$("#chat_id_container").text(selectedData.id);
	$("#chat_userID_container").text(selectedData.userID);
	$("#chat_email_container").text(selectedData.email);

	if (selectedData.status == "CLOSED") {
		$("#accept_ticket_btn").css("display",'none');
	}else{
		if (selectedData.adminID==currentUser.id) {
			$("#accepted_ticket_modal").toggle();
			$("#initial_modal").toggle();

			loadChatHistory()

			setInterval(function(){
				updateChatHistory();
			},1000)
		}

		$("#view_history_btn").css("display",'none');
	}

	$("#view_history_btn").on('click', function(){
		loadChatHistory()
		$("#accepted_ticket_modal").toggle();
		$("#initial_modal").toggle();
		$('#msg_send_container').toggle();
		$("#send_msg_btn").toggle();
	});

	$("#accept_ticket_btn").on('click', function(){
		var chatDetails = ajaxShortLink('admin/getChatDetails',{
			'id':selectedData.id
		});

		if (chatDetails.adminID!=currentUser.id&&chatDetails.adminID!=null) {
			$.alert({
			    title: 'Ticket already taken!',
			    content: 'Please select another ticket since this ticket was already taken by other admin!',
			    buttons: {
		           	confirm: function () {
		           		loadDatatable('admin/getAllChatSupport');
		           		bootbox.hideAll();
		           	},
	       		}
			});
		}else{
			var updateChatTicket = ajaxShortLink('admin/updateChatTicket',{
				'id':selectedData.id,
				'adminID':currentUser.id
			});

			loadChatHistory()

			var updateInterval = setInterval(function(){
				var chatDetailsUpdated = ajaxShortLink('admin/getChatDetails',{
					'id':selectedData.id,
				});

				console.log(chatDetailsUpdated[0].status)
				console.log(chatDetailsUpdated)

				if (chatDetailsUpdated[0].status == "CLOSED") {
					$("#chat_msgs_container").append(
						'<div class="text-center text-danger font-weight-bold">'+
							'<span>'+
								'USER DISCONNECTS'+
							'</span><br>'+
						'</div>'
					);					

					$('#msg_send_container').toggle();
					$("#send_msg_btn").toggle();

					clearInterval(updateInterval)
				}

				updateChatHistory();
			},1000)

			

			$("#accepted_ticket_modal").toggle();
			$("#initial_modal").toggle();
		}
	});

	$('#msg_send_container').keyup(function(e){
		if(e.keyCode == 13){
	        $("#send_msg_btn").click();
	    }	   
	});

	$("#send_msg_btn").on('click',function(){
		var msg = $("#msg_send_container").val()

		var sendMSGRes = ajaxShortLink("admin/chatSupport/sendMsg",{
			'msg':msg,
			'msgBy':"admin",
			'chatTicketID':selectedData.id
		})

	   	$('#msg_send_container').val("");
	})

	$("#close_ticket_btn").on('click', function(){
		var updateChatTicket = ajaxShortLink('admin/updateChatTicket',{
			'id':selectedData.id,
			'status':'CLOSED'
		});

		if (typeof updateInterval!='undefined') {
			clearInterval(updateInterval);
		}

		console.log(updateChatTicket);

		loadDatatable('admin/getAllChatSupport');
		bootbox.hideAll();
	});

	$(".closeBtn").on('click', function(){
		loadDatatable('admin/getAllChatSupport');
		bootbox.hideAll();
	});

	function loadChatHistory(){
		$("#chat_msgs_container").empty();

		var getChatTicketMsgs = ajaxShortLink("admin/chatSupport/getChatTicketMsgs",{
			'chatTicketID':selectedData.id
		})

		if(getChatTicketMsgs.length>=1){
			for (var i = 0; i < getChatTicketMsgs.length; i++) {
				if (getChatTicketMsgs[i].msgBy == "admin") {
					$("#chat_msgs_container").append(
						'<div class="text-right">'+
							'<b>Admin/Support</b><br>'+
							'<span>'+
								getChatTicketMsgs[i].msg+
							'</span><br>'+
							'<small class="text-muted">'+getChatTicketMsgs[i].dateCreated+'</small>'+
						'</div>'+

						'<br>'
					);
				}else{
					$("#chat_msgs_container").append(
						'<div class="text-left">'+
							'<b>'+selectedData.fullname+'</b><br>'+
							'<span>'+
								getChatTicketMsgs[i].msg+
							'</span><br>'+
							'<small class="text-muted">'+getChatTicketMsgs[i].dateCreated+'</small>'+
						'</div>'+

						'<br>'
					);
				}
			}
		}
	}

	function updateChatHistory(){
		var getChatTicketMsgs = ajaxShortLink("admin/chatSupport/getChatTicketMsgs",{
			'chatTicketID':selectedData.id
		})

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
								'<b>'+selectedData.fullname+'</b><br>'+
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
