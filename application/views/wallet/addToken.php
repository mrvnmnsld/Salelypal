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

<div class="m-1">
	<div class="text-center mb-2 text-dark">*Note:Toogle which tokens to add to your wallet</div>

    <ul class="list-group" id="token_container">
    	
    </ul>

    <!-- <button class="btn col-md btn-link" id="add_custom_btn">Dont See Your Token? Add Custom Token</button> -->

    <div class="d-flex justify-content-center">
    	<button class="btn col-md btn-success m-1" id="save_token_mngmt_btn">Save</button>
    	<button class="btn col-md btn-danger m-1" onclick="backButton()">Cancel</button>
    </div>

</div>

<script type="text/javascript">
	var tokens = ajaxShortLink('getAllTokens');
	var tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokens',{'userID':currentUser['userID']});
	tokensSelected = tokensSelected[0].tokenIDSelected.split(",");

	for (var i = 0; i < tokens.length; i++) {
		var isSelected = '';

		if (tokensSelected.includes(String(tokens[i].id))) {
			isSelected = 'checked';
		}

		// console.log(String(tokens[i].id),tokensSelected,tokensSelected.includes(String(tokens[i].id)));

		$("#token_container").append(
		  	'<li class="d-flex justify-content-between border-bottom border-secondary">'+
		  		'<div class="p-2">'+
		  			'<img class="img-thumbnail border border-secondary" src="'+tokens[i].tokenImage+'" style="width:40px;height: 40px;">'+
		  		'</div>'+

		  		'<div class="p-2 mt-2">'+tokens[i].description+" ("+tokens[i].network.toUpperCase()+")"+'</div>'+

		  		'<div class="ml-auto mt-2 p-2 material-switch pull-right">'+
		  	  	   	'<input id="'+tokens[i].id+'" name="someSwitchOption001" type="checkbox" '+isSelected+'/>'+
	  	  	    	'<label for="'+tokens[i].id+'" class="label-default bg-success"></label>'+
		  		'</div>'+
		  	'</li>'
		);
	}

	$("#save_token_mngmt_btn").on("click", function(){
		var container={};
		container.checked=[];
		container.unchecked=[];

		$("input:checkbox").each(function(){
		    var $this = $(this);

		    if($this.is(":checked")){
		        container.checked.push($this.attr("id"));
		    }else{
		        container.unchecked.push($this.attr("id"));
		    }
		});

		var res = ajaxShortLink("userWallet/updateTokenManagement",{'tokenIDSelected':container.checked.toString(),'userID':currentUser['userID']})

		$.toast({
		    heading: '<h6>Success!</h6>',
		    text: 'Successfully added all changes!',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-left'
		})
	});

	$("#add_custom_btn").on("click", function(){
		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/addToken/addCustomToken'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	});

	

	console.log(tokensSelected);
</script>
