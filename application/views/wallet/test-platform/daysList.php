<style type="text/css">
	.cardboxes{
		box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 29%);
		background-color: rgb(0, 0, 0, 0%)!important;
		color: black;
	}

	.flex-even{
		flex: 1 1 auto;
	}

	input[type=radio] {
	    visibility:hidden;
	}

	label {
	    cursor: pointer;
	}

	input:checked + label {
	    /*background: red;*/
	    background: #343a40;
	    color: white;
	}

	.btn-outline-dark{
		font-size: .7em;
	}
</style>

<div class="progress">
  <div class="progress-bar" style="width: 87%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">87%</div>
</div>

<div id="daysBtn_container" class="container text-center my-5" style="display:block;">			

</div>

<div id="daily_mining_token_containers" style="display:none;">
    <button onclick="goback_btn()" class="btn btn-dark" id="backbtn_container">
        <i class="fa fa-arrow-left fa-lg" style="" aria-hidden="true"></i> 
        Go back
    </button>  

    <div id="days_token_container">
        
    </div>
</div>


<script> 

var getDaysSettings = ajaxShortLink('mining/daily/getAddDays');
console.log(getDaysSettings);

for(var i = 0;i<getDaysSettings.length;i++){

    $("#daysBtn_container").append(
        '<div class="m-1 justify-content-center">'+
            '<button id="'+getDaysSettings[i].id+'_days_btn" apyC="'+getDaysSettings[i].apy+'" daysId="'+getDaysSettings[i].id+'" type="button" class="btn btn-dark" style="min-width:12em;">'+
                '<span style = "float:left;">'+
                    '<i class="fa fa-clock-o fa-lg" style="" aria-hidden="true"></i>'+
                '</span>'+
                    getDaysSettings[i].days+"Days , APY"+getDaysSettings[i].apy+
            '</button>'+
        '</div>'
    );
    

    $('#'+getDaysSettings[i].id+'_days_btn').on('click',function(){

        var getDayTokens = ajaxShortLink('mining/daily/getDayTokens',{
				'day': $(this).attr('daysId')
        });

        console.log(getDayTokens,'tokens with dayID:',$(this).attr('daysId'));
        console.log(getDayTokens,'APY of dayID:',$(this).attr('apyC'));
        

        $('#daily_mining_token_containers').toggle();
        $('#daysBtn_container').toggle();

        $("#days_token_container").empty()

        for(var x = 0;x<getDayTokens.length;x++){

            var tokenInformation = ajaxShortLink('main/getTokenInfoViaID',{
                    'tokenID': getDayTokens[x].token_id
            });

            var token_name_combo = tokenInformation.tokenName+' ('+tokenInformation.network.toUpperCase()+')';

            console.log(x,"TOKEN TEST");

            $("#days_token_container").append(
                '<div id="'+tokenInformation.tokenName+'_container" class="cardboxes p-2 mt-2">'+
					'<div class="d-flex justify-content-around">'+
						'<div class="flex-even text-left h4 text-success">'+
							'<img '+
								'style="width: 35px;"'+
								'src="'+tokenInformation.tokenImage+'"'+
							'> '+
							token_name_combo+
						'</div>'+

						'<div class="flex-even text-right h5 text-success">APY: '+$(this).attr('apyC')+'%</div>'+
					'</div>'+

					'<div class="text-muted" style="font-size:.7em">'+
						'Mining annualize rate of return'+
					'</div>'+

					'<div class="m-2">'+
						"<button type='button' class='btn btn-warning btn-block' onClick='"+
							'openEntryForm("")'+
						"'>Mine Now!</button>"+
					'</div>'+
				'</div>'
            );
        }

    });

}



function goback_btn(){
    $("#daysBtn_container").toggle()
    $("#daily_mining_token_containers").toggle()
    
//     $("#tittle_container").text('Daily Income Mining');
//         $("html, body").animate({ scrollTop: 0 }, "slow");
//         $.when(closeNav()).then(function() {
//             $('#assets_container').css("display","none");
//             $('#topNavBar').toggle();
//             $('#bottomNavBar').toggle();
//             $("#container").fadeOut(animtionSpeed, function() {
//                 $("#loadSpinner").fadeIn(animtionSpeed,function(){
//                     $("#container").empty();
//                     $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daysList'}));

//                     setTimeout(function(){
//                         $("#loadSpinner").fadeOut(animtionSpeed,function(){
//                             $('#topNavBar').toggle();
//                             $('#bottomNavBar').toggle();
//                             $("#container").fadeIn(animtionSpeed);
//                         });
//                     }, 120);
                    
//                 });
//             });
//         });
}

</script>