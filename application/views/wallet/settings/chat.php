<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
	/*#chat_msgs_container > div{
		border-bottom: solid #5426DE .1px;
	}*/
	.btn-faq {
	  appearance: button;
	  background-color: #4D4AE8;
	  background-image: linear-gradient(180deg, rgba(255, 255, 255, .15), rgba(255, 255, 255, 0));
	  border: 1px solid #4D4AE8;
	  border-radius: 1rem;
	  box-shadow: rgba(255, 255, 255, 0.15) 0 1px 0 inset,rgba(46, 54, 80, 0.075) 0 1px 1px;
	  box-sizing: border-box;
	  color: #FFFFFF;
	  cursor: pointer;
	  display: inline-block;
	  font-size: 1rem;
	  font-weight: 500;
	  line-height: 1.5;
	  margin: 0;
	  padding: .5rem 1rem;
	  text-align: center;
	  text-transform: none;
	  transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	  user-select: none;
	  -webkit-user-select: none;
	  touch-action: manipulation;
	  width: 70%;
	}
	.btn-faq:focus:not(:focus-visible),
	.btn-faq:focus {
	  outline: 0;
	}
	.btn-faq:hover {
	  background-color: #3733E5;
	  border-color: #3733E5;
	}
	.btn-faq:focus {
	  background-color: #413FC5;
	  border-color: #3E3BBA;
	  box-shadow: rgba(255, 255, 255, 0.15) 0 1px 0 inset, rgba(46, 54, 80, 0.075) 0 1px 1px, rgba(104, 101, 235, 0.5) 0 0 0 .2rem;
	}
	.btn-faq:active {
	  background-color: #3E3BBA;
	  background-image: none;
	  border-color: #3A38AE;
	  box-shadow: rgba(46, 54, 80, 0.125) 0 3px 5px inset;
	}
	.btn-faq:active:focus {
	  box-shadow: rgba(46, 54, 80, 0.125) 0 3px 5px inset, rgba(104, 101, 235, 0.5) 0 0 0 .2rem;
	}
	.btn-faq:disabled {
	  background-image: none;
	  box-shadow: none;
	  opacity: .65;
	  pointer-events: none;
	}
	.fixed-bottom{
		bottom: 0;
	}

	#top_btn {
		display: none;
		position: fixed;
		bottom: 50px;
		right: 8px;
		z-index: 99;
		font-size: 15px;
		border: none;
		outline: none;
		background-color: #5a57ea;
		color: white;
		cursor: pointer;
		padding: 10px;
		border-radius: 4px;
	}
</style>

	<div id="inner_container" class="main-color-text">

		<div class="text-left mt-2 m-2">
			<b>CSR</b><br>
			<span>Hi <span id="name_container"></span>! Please let us know how we can help you.</span><br>
			<small class="text-muted"> <span id="time"></span> </small>
		</div>

		<div id="chat-container"></div>

		<div class="m-2">
			<div class="text-center text-success animate__bounceIn" id="chat_has_started_container" style="display: none;">
				Connected to a CSR. Start sending messages to initiate the conversation
			</div>

			<div id="chat_msgs_container" class=""></div>
		</div>

		<!-- <div class="p-1">
			<button class="btn btn-success btn-block" id="close_ticket_btn">Close Ticket</button>
			<button class="btn btn-success btn-block" id="create_ticket_btn">Create New Ticket</button>
		</div> -->

	</div>

	<div class="fixed-bottom input-group mb-1">
	    <input id="msg_send_container" type="text" class="form-control custom-control ml-1" disabled rows="2" style="resize:none"> 

	    <button id="send_msg_btn" class="input-group-addon btn btn-primary mr-1" disabled>
	    	<i class="fa fa-paper-plane" aria-hidden="true"></i>
	    	Send
	    </button>
	</div>

	<button onclick="window.scrollTo(0, 0);" id="top_btn" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>

<script type="text/javascript">

	var dt = new Date();
	var hours = String(dt.getHours()% 12).padStart(2, '0');
	var minutes = String(dt.getMinutes()).padStart(2, '0');
	var seconds = String(dt.getSeconds()).padStart(2, '0');
	var time = hours + ":" + minutes + ":" + seconds;
	
	$('#time').text(time)


	var getAnsQues = ajaxShortLink("admin/getQuestions");
	var chatDetailsChecker,createNewTicket,chatDetails,updateChatHistoryInterval;

	loadQuestionsAndAppend()
	// console.log(getAnsQues)
	var $window = $(window),$document = $(document);

	$window.on('scroll', function () {
	    if (($window.scrollTop() + $window.height()) == $document.height()) {
   	        $("#top_btn").css("display","block")
	    } else {
	        $("#top_btn").css("display","none")
	    }
	});

	function loadQuestionsAndAppend(){
		for (var i = 0; i < getAnsQues.length; i++) {


			if (getAnsQues[i]) {
				$("#chat-container").append(
					'<div style="display:none" class="text-right m-2 autoQuestions">'+
						'<button class="btn btn-primary btn-sm mt-2 btn-faq custom_question" index="'+i+'">'+getAnsQues[i].question+'</button>'+
						'<br>'+
					'</div>'
				);


			}

		}

		$("#chat-container").append(
			'<div style="display:none" class="text-right m-2 autoQuestions">'+
				'<button class="btn btn-primary btn-sm mt-2 btn-faq requestAssistance">Request hman assistance</button>'+

				'<br>'+
			'</div>'
		);

		$(".autoQuestions").fadeIn("slow");


		$('.custom_question').on("click", function(){
			$(".autoQuestions").remove();

			// console.log(getAnsQues[$(this).attr('index')].answer) 

			$("#chat-container").append(
				'<div class="text-right m-2">'+
					'<b>You</b><br>'+
					'<span>'+
						getAnsQues[$(this).attr('index')].question+
					'</span><br>'+
					'<small class="text-muted">'+time+'</small>'+
				'</div>'+
				'<br>'+
				'<div class="text-left m-2">'+
					'<b>CSR</b><br>'+
					'<span>'+
						getAnsQues[$(this).attr('index')].answer+
					'</span><br>'+
					'<small class="text-muted">'+time+'</small>'+
				'</div>'+
				'<br>' 
			);

			loadQuestionsAndAppend()
			window.scrollTo(0, document.body.scrollHeight);
		});

		$('.requestAssistance').on("click", function(){
			$(".autoQuestions").remove();

			$("#chat-container").append(
				'<div class="text-center h5 mt-2" id="waiting_container">'+
					'Please wait while we connect you to one of our Customer Service Representative'+
				'</div>'
			);

			createNewTicket = ajaxShortLink("admin/chatSupport/createNewTicket",{
				"userID":currentUser.userID
			});

			chatDetails = ajaxShortLink('admin/getChatDetails',{
				'id':createNewTicket
			});

			console.log(createNewTicket,chatDetails);

			chatDetailsChecker = setInterval(function(){
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
					updateChatHistoryInterval = setInterval(function(){
						updateChatHistory();
					},1500)
				}
			
			},1500);

			window.scrollTo(0, document.body.scrollHeight);
		});

	}


	$("#bottomNavBar").css("display","none");

	$('#msg_send_container').keyup(function(e){
		if(e.keyCode == 13){
	        $("#send_msg_btn").click();
	    }	   
	});

	// $('#create_ticket_btn').on("click",function(){
	// 	$.confirm({
	// 		theme:'dark',
	// 		icon: 'fa fa-sign-out',
	// 		title: 'Disconnecting?',
	// 		columnClass: 'col-md-6 col-md-offset-6',
	// 		content: 'Are you sure you want to <b>create a new ticket</b>? This will disconnect you with the current representative and put you back on queue',
	// 		buttons: {
	// 			confirm: function () {
	// 				if (typeof chatDetailsChecker  != 'undefined') {
	// 					clearInterval(chatDetailsChecker);
	// 				}

	// 				if (typeof updateChatHistoryInterval  != 'undefined') {
	// 					clearInterval(updateChatHistoryInterval);
	// 				}
					
	// 				$("html, body").animate({ scrollTop: 0}, "slow");

	// 				var updateChatTicket = ajaxShortLink('admin/updateChatTicket',{
	// 					'id':createNewTicket,
	// 					'status':"CLOSED"
	// 				});

	// 	  			$("#container_main").empty();
	// 	  			$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/chat'}));
	// 			},
	// 			cancel: function () {

	// 			},
	// 		}
	// 	});
	// });

	$("#send_msg_btn").on('click',function(){
		var msg = $("#msg_send_container").val()

		if(msg!=""){
			var sendMSGRes = ajaxShortLink("admin/chatSupport/sendMsg",{
				'msg':msg,
				'msgBy':"user",
				'chatTicketID':createNewTicket
			})

		   	$('#msg_send_container').val("");

		   	updateChatHistory();
		}
	})

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
							'<div class="text-left">'+
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
							'<div class="text-right">'+
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

			   	window.scrollTo(0, document.body.scrollHeight+1000);

			}
		}
	}

	$('#name_container').text(currentUser.fullname)
</script>