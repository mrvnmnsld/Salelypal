var requestIdGlobal;

function chatSupportButton(e){
	var choice = $(e).attr("id");
	console.log(choice);

	//firstPart 
		if (choice == 'consult_ChatBtn') {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important;'+
				        'border-radius: 20px">Yes. The Next Level CR offers free consultation. You can ask more in our <i>Consultation Page</i>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="consultPage_ChatBtn">'+
				                'Redirect to Consultation Page'+
				            '</button>'+
				        '</div>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="backToFirst_0_ChatBtn">'+
				                'Back to top'+
				            '</button>'+
				        '</div>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()
		}

		if (choice == 'package_ChatBtn') {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important;'+
				        'border-radius: 20px">'+
				        	'We offer 3 main packages readily available for anyone<br><br>'+
				        	'<b>Essential:<br><sub>Price: $139/MONTH</b></sub><br>'+
				        		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor'+
				        		'incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam.'+
			        		'<br><br>'+

				        	'<b>Platinum:<br><sub>Price: $149/MONTH</b></sub></br>'+
				        		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor'+
				        		'incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam.'+
			        		'<br><br>'+

				        	'<b>Executive:<br><sub>Price: *Varries based on consultation</b></sub><br>'+
				        		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor'+
				        		'incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam.'+
			        		'<br><br>'+

			        		'<div class="row m-2">'+
			        		    '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="pricingPage_ChatBtn">'+
			        		        'Read more about packages'+
			        		    '</button>'+
			        		'</div>'+

			        		'<div class="row m-2">'+
			        		    '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="backToFirst_1_ChatBtn">'+
			        		        'Back to top'+
			        		    '</button>'+
			        		'</div>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()
		}

		if (choice == 'about_ChatBtn') {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important;'+
				        'border-radius: 20px"><b>ABOUT THE COMPANY.</b><br>'+
				        'Lorem Ipsum is simply dummy text of the'+
				        'printing and typesetting industry has been'+
				        'Lorem Ipsum is simply the industrys<br><br>'+
				        'You can read more in our <i>About Us Page</i>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="aboutPage_ChatBtn">'+
				                'Redirect to About Page'+
				            '</button>'+
				        '</div>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="backToFirst_2_ChatBtn">'+
				                'Back to top'+
				            '</button>'+
				        '</div>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()
		}

		if (choice == 'faq_ChatBtn') {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important;'+
				        'border-radius: 20px">'+

				       	'<b>Please select which fits your needs</b><br>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="faqPage_ChatBtn">'+
				                'Here are the frequently ask questions (FAQ Page)'+
				            '</button>'+
				        '</div>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="connectToCustomerService_1_ChatBtn">'+
				                'Request Customer Support'+
				            '</button>'+
				        '</div>'+

				        '<div class="row m-2">'+
				            '<button class="col-md-12 btn btn-outline-secondary btn-sm chat-option" onclick="chatSupportButton(this)" id="backToFirst_3_ChatBtn">'+
				                'Back to top'+
				            '</button>'+
				        '</div>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()
		}

		if (choice == 'connectToCustomerService_0_ChatBtn') {
			var requestId = ajaxShortLink('chatSupport/generateRequestID');
			$("#chatHistoryContainer").empty();

			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important'+
				        'border-radius: 20px">'+
				        'Please wait while we try to connect you to one of our customer service assistance.<br><br>'+
				        'Refrain from refreshing the page since it will withdraw your request ticket for the customer service to accept. Thank you!<br><br>'+
				        '<b>Your request id is: <br> </b>'+ requestId[1] +'-'+requestId[0]+
				    '</div>'+
				'</div>'
			);


			var checkIfConnected = setInterval(function(){
				var res = ajaxShortLink('chatSupport/checkIfConnected',{'id':requestId[0]});

				if (res == 1) {
					clearInterval(checkIfConnected);

					redirectTobot();

					$("#chatHistoryContainer").append(
						'<div class="d-flex flex-row p-3 overflow-auto"> '+
						    '<div class="chat ml-5 text-center" style="'+
						        'border: none;'+
						        'background: #fff;'+
						        'font-size: 13px!important'+
						        'border-radius: 20px">'+
						        '<b class="text-success">You have been successfully connected to one of our Customer Service Support Representative</b><br><br>'+
						        'Feel free to ask anything to us!'+
						    '</div>'+
						'</div>'
					);

					$("#chatInput").removeAttr("disabled");
					$("#button-addon2").removeAttr("disabled");

					requestIdGlobal = requestId[0];


					startCheckingMsgsUpdate(requestId[0]);
				}

				console.log(res);
			},1000)
		}	
	//firstPart 

	// consult
		if (choice == 'backToFirst_0_ChatBtn') {
			var objDiv = document.getElementById("chat-main");
			objDiv.scrollTop = 0;
		}

		if (choice == "consultPage_ChatBtn") {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important'+
				        'border-radius: 20px">'+
				        'Please wait while we redirect you to that page. Thank you!</i>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()

			setTimeout(function(){
				window.location.href = "consultation";
			}, 2000)
		}
	// consult

	// pricing
		if (choice == 'backToFirst_1_ChatBtn') {
			var objDiv = document.getElementById("chat-main");
			objDiv.scrollTop = 0;
		}

		if (choice == "pricingPage_ChatBtn") {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important'+
				        'border-radius: 20px">'+
				        'Please wait while we redirect you to that page. Thank you!</i>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()

			setTimeout(function(){
				window.location.href = "pricing";
			}, 2000)
		}
	// pricing

	// about
		if (choice == 'backToFirst_2_ChatBtn') {
			var objDiv = document.getElementById("chat-main");
			objDiv.scrollTop = 0;
		}

		if (choice == "aboutPage_ChatBtn") {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important'+
				        'border-radius: 20px">'+
				        'Please wait while we redirect you to that page. Thank you!</i>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()

			setTimeout(function(){
				window.location.href = "about";
			}, 2000)
		}
	// about

	// faq
		if (choice == 'backToFirst_3_ChatBtn') {
			var objDiv = document.getElementById("chat-main");
			objDiv.scrollTop = 0;
		}

		if (choice == "faqPage_ChatBtn") {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important'+
				        'border-radius: 20px">'+
				        'Please wait while we redirect you to that page. Thank you!</i>'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()

			setTimeout(function(){
				window.location.href = "faq";
			}, 2000)
		}

		if (choice == "connectToCustomerService_1_ChatBtn") {
			$("#chatHistoryContainer").append(
				'<div class="d-flex flex-row p-3 overflow-auto"> '+
				    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

				    '<div class="chat ml-2 p-3" style="'+
				        'border: none;'+
				        'background: #E2FFE8;'+
				        'font-size: 13px!important'+
				        'border-radius: 20px">'+
				        'Please wait while we try to connect you to one of our customer service assistance.<br>'+
				        'Refrain from refreshing the page since it will withdraw your request ticket for the customer service to accept. Thank you!'+
				    '</div>'+
				'</div>'
			);

			redirectTobot()
		}
	// faq
}

function redirectTobot(){
	var objDiv = document.getElementById("chat-main");
	objDiv.scrollTop = objDiv.scrollHeight;
}

function startCheckingMsgsUpdate(id){
  chatInterval = setInterval(function(){
      var msgsTrail = $(".msgTrail");
      var data = {};

      if (msgsTrail.length >= 1) {
        var lastMsgId = $(msgsTrail[msgsTrail.length-1]).attr('class').split(' ')[2].split("_")[1];

        data = {
          "id":id,
          "lastMsgId":lastMsgId,
        }
      }else{
        data = {
          "id":id,
        }
      }

      console.log(data);

      var res = ajaxShortLink('chatSupport/getChatUpdate',data);

      if(res.length >= 1){
        for (var i = 0; i < res.length; i++) {
        	if (res[i].userId != null) {
        		$("#chatHistoryContainer").append(
        			'<div class="d-flex flex-row msgId_'+res[i].id+' msgTrail p-3 overflow-auto" style="justify-content: space-between;"> '+
        			    '<img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">'+

        			    '<div class="chat ml-2 p-3" style="'+
        			        'border: none;'+
        			        'width:100%;'+
        			        'background: #E2FFE8;'+
        			        'font-size: 13px!important'+
        			        'border-radius: 20px">'+
        			        res[i].chatMsg+
        			    '</div>'+
        			'</div>'
        		);

        	}else if(res[i].userId == null){
        		$("#chatHistoryContainer").append(
        			'<div class="d-flex flex-row msgId_'+res[i].id+' msgTrail p-3 float-right" style="justify-content: space-between;">'+
        			    '<div class="bg-white mr-2 p-3" style="width:100%;border: 1px solid #E7E7E9;font-size: 13px!important;border-radius: 20px">'+
        			        '<span class="text-primary">'+res[i].chatMsg+'</span>'+
        			    '</div>'+

        			    '<img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" width="30" height="30">'+
        			'</div>'
        		);
        	}

        	redirectTobot();
        }
      }
    }, 250
  );
}

$("#button-addon2").on("click",function(){
	var chatInput = $("#chatInput").val();

	var res = ajaxShortLink(
	  'chatSupport/sendChat',
	  {
	    "id":requestIdGlobal,
	    "chatMsg":chatInput,
	  }
	);

	$("#chatInput").val("");
	$("#chatInput").focus();
});