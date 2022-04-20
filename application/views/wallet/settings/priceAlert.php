<style type="text/css">
	button:focus { outline-style: none; }
</style>

<style type="text/css">
	.material-switch > input[type="checkbox"] {
	    display: none;   
	}

	.material-switch > label {
	    cursor: pointer;
	    height: 0px;
	    position: relative; 
	    width: 40px;  
	}

	.material-switch > label::before {
	    background: rgb(0, 0, 0);
	    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
	    border-radius: 8px;
	    content: '';
	    height: 16px;
	    margin-top: -8px;
	    position:absolute;
	    opacity: 0.3;
	    transition: all 0.4s ease-in-out;
	    width: 40px;
	}
	.material-switch > label::after {
	    background: rgb(255, 255, 255);
	    border-radius: 16px;
	    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
	    content: '';
	    height: 24px;
	    left: -4px;
	    margin-top: -8px;
	    position: absolute;
	    top: -4px;
	    transition: all 0.3s ease-in-out;
	    width: 24px;
	}
	.material-switch > input[type="checkbox"]:checked + label::before {
	    background: inherit;
	    opacity: 0.5;
	}
	.material-switch > input[type="checkbox"]:checked + label::after {
	    background: inherit;
	    left: 20px;
	}

	input[type="checkbox"]:disabled {
	  background: white!important;
	}
</style>


<button class="btn text-primary" onclick="backPage()">
	<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
	Back
</button>

<div class="p-2">
	<div class="text-center mb-2 text-dark">*Note:Set Price alerts for each tokens, Trigger is 5% Change (Increase & Decrease)</div>

    <ul  class="list-group" >
    	<li class="d-flex justify-content-between">
    		<div class="p-2 mt-2 font-weight-bold">Price alerts</div>

    		<div class="ml-auto mt-2 p-2 material-switch pull-right">

				<input id="price_alert_all" name="someSwitchOption001" type="checkbox">

				<label for="price_alert_all" class="label-default bg-success">
					
				</label>
			</div>
		</li>
    </ul>

    <ul class="list-group" id="token_container">
    	
    </ul>

    <div class="d-flex justify-content-center">
    	<button class="btn col-md btn-success m-1" id="save_token_mngmt_btn">Save</button>
    </div>

</div>

<script type="text/javascript">
	// var tokens = ajaxShortLink('getAllTokens');
	var tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokensInfo',{'userID':currentUser['userID']});
	var priceAlert = ajaxShortLink('userWallet/getPriceAlert',{'userID':currentUser['userID']});
	var tokensAlert = priceAlert.tokens_id.split(',');
	// tokensSelected = tokensSelected[0].tokenIDSelected.split(",");

	console.log(priceAlert);
	console.log(tokensAlert);

	if (priceAlert.isOn == 1) {
		$("#token_container").css('display','block');
		$('#price_alert_all').attr('checked','checked')
	}else{
		$("#token_container").css('display','none');
	}

	for (var i = 0; i < tokensSelected.length; i++) {
		var isSelected = '';

		if (tokensAlert.includes(String(tokensSelected[i].id))) {
			isSelected = 'checked';
		}

		// console.log(String(tokens[i].id),tokensSelected,tokensSelected.includes(String(tokens[i].id)));

		$("#token_container").append(
		  	'<li class="d-flex justify-content-between border-bottom border-secondary">'+
		  		'<div class="p-2">'+
		  			'<img class="img-thumbnail border border-secondary" src="'+tokensSelected[i].tokenImage+'" style="width:40px;height: 40px;">'+
		  		'</div>'+

		  		'<div class="p-2 mt-2">'+tokensSelected[i].description+" ("+tokensSelected[i].network.toUpperCase()+")"+'</div>'+

		  		'<div class="ml-auto mt-2 p-2 material-switch pull-right">'+
		  	  	   	'<input id="'+tokensSelected[i].id+'" name="someSwitchOption001" type="checkbox" '+isSelected+'/>'+
	  	  	    	'<label for="'+tokensSelected[i].id+'" class="label-default bg-success"></label>'+
		  		'</div>'+
		  	'</li>'
		);
	}

	$("#save_token_mngmt_btn").on("click", function(){
		var container={};
		container.checked=[];
		container.unchecked=[];
		var isOn = $('#price_alert_all').is(':checked');
		if(isOn==true){
			isOn = 1;
		}else{
			isOn = 0;
		}

		$("#token_container input:checkbox").each(function(){
		    var $this = $(this);

		    if($this.is(":checked")){
		        container.checked.push($this.attr("id"));
		    }else{
		        container.unchecked.push($this.attr("id"));
		    }
		});

		console.log(container.checked.toString(),isOn);

		var res = ajaxShortLink("userWallet/updatePriceAlert",{
			'tokenIDSelected':container.checked.toString(),
			'userID':currentUser['userID'],
			'isOn':isOn
		})

		console.log(res);


		$.toast({
		    heading: '<h6>Success!</h6>',
		    text: 'Successfully added all changes!',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-left'
		})
	});

	$('#price_alert_all').change(function() {
		var isChecked = $(this).is(':checked');

		if (isChecked){
			$("#token_container").css('display','block');
		}else{
			$("#token_container").css('display','none');
		}
	});

	function backPage(){
		$("#tittle_container").text('Settings');

    	$.when(closeNav()).then(function() {
    		$('#topNavBar').toggle();
      		$("#container").fadeOut(animtionSpeed, function() {
    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
    	  			$("#container").empty();
    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings'}));

    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
    		  			$('#topNavBar').toggle();
    		  			$("#container").fadeIn(animtionSpeed);
    		  		});
    	    	});
    	  	});
    	});
	}
</script>