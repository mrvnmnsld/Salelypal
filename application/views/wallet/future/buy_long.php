<style type="text/css">
    .modal-footer{
        display: none;
    }
</style>

<!-- <div class="pagetitle text-center text-primary">
  <h4>Buy Long</h4>
  <small>Opening Position</small>

  <hr>
</div> -->

<div id="main_modal_container" style="display:block">
	<small>
	    <div class="text-success">
	        <span>Availble Amount:</span>
	        <span id="available_amount_container">20 USDT</span>
	    </div>

	    <div class="text-success">
	        <span>Availble Gas:</span>
	        <span id="available_gas_container"></span>
	    </div>
	</small>

	<div class="d-flex mt-1 flex-basis: fit-content;">
	    <div>
	        <label class="mt-1">Amount:</label>
	    </div>

	    <div style="flex-basis: 100%;">
	        <input type="number" class="ml-1 form-control form-control-sm" id="amount_input_container">
	    </div>      
	</div>

    <div class="">
        <div>
            <span>Value Predicted:</span>
            <span id="risk_value_predicted"></span>
        </div>

        <div>
            <span>Timestamp Trigger:</span>
            <span id="risk_timestamp_predicted" class="notranslate"></span>
        </div>
    </div>

	<div class="btn-group btn-group-toggle d-flex justify-content-center mt-2" data-toggle="buttons">
	  <label style="font-size: 13px;" class="btn btn-secondary active">
	    <input type="radio" name="risk_option_radio" value="1Min" id="1Min" autocomplete="off"> 1 Minute <br>
	    <small>5% Change</small>
	  </label>

	  <label style="font-size: 13px;" class="btn btn-secondary">
	    <input type="radio" name="risk_option_radio" value="3Min" id="3Min" autocomplete="off"> 3 Minutes <br>
	    <small>10% Change</small>
	  </label>

	  <label style="font-size: 13px;" class="btn btn-secondary">
	    <input type="radio" name="risk_option_radio" value="5Min" id="5Min" autocomplete="off"> 5 Minutes <br>
	    <small>15% Change</small>
	  </label>

	  <label class="btn btn-primary" id="customRisk_btn">
	    <input type="radio" name="risk_option_radio" value="customRisk" id="customRisk" autocomplete="off"> Custom Risk <br> 
	    <span><small>Click to Input</small></span>
	  </label>
	</div>

	<hr>

    <small class="">Note: Please make sure you have enough gas(estimated is more or less 5 TRX per opening position)</small>

	<button class="btn btn-success btn-block btn-sm" id="open_position_btn">Open</button>
	<button class="btn btn-danger btn-block btn-sm" id="close_btn">Cancel</button>
</div>

<div id="sec_modal_container" style="display:none">
    <!-- <div class="text-center text-success h5">Successfully Opened Position</div> -->

    <div class="text-center mb-3" id="opened_position_display_container">
        <div>
            <span>Price Prediction:</span>
            <span id="price_predicted_container"></span> 
        </div>

        <div>
            <span>Amount Staked:</span>
            <span id="amount_staked_container"></span> 
        </div>

        <div>
            <span>Trade Pair:</span>
            <span id="trade_pair_container"></span> 
        </div>
    </div>

    <!-- <div class="text-center">Countdown to resolve</div> -->

    <div class="d-flex justify-content-center">
        <div class="text-center m-2">
            <div class="text-primary h4" id="count_inner_minutes" data-countdown=""></div>
            <small>Minutes</small>
        </div>

        <div class="text-center m-2">
            <div class="text-primary h4" id="count_inner_second" data-countdown=""></div>
            <small>Seconds</small>
        </div>
    </div>

    <div class="text-danger text-center mb-2">
        <small>Note: Please wait for the position to be resolve</small>
        <small>Closing this means forfeit and assets staked will be liquidated</small>
    </div>

    <div>
        <button class="btn btn-block btn-sm btn-warning modalMinimize">Toggle chart view</button>
        <button class="btn btn-block btn-sm btn-danger mt-2" id="forfeit_btn">Forfeit</button>
    </div>
</div>

<div id="resolve_modal_container" style="display:none" class="text-center">
    <!-- <div class="h3" id="resolve_text_container">Position Won!</div> -->
    <div>
        <span id="amount_won" class="h4"></span>
    </div>

    <div>
        <span>Trade Pair:</span>
        <span id="2_trade_pair_container"></span> 
    </div>

    <div>
        <span>Resolved Price:</span>
        <span id="resolved_price_container"></span> 
    </div>

    <button class="btn btn-danger btn-block close_btn btn-sm">Close</button>

</div>

<script type="text/javascript">
    isMinimized = 0;
    var idToResolve;
    var resolvedPriceCountdown;
    var bettingSettings = ajaxShortLink("admin/getBettingSettings");

    var balanceUsdt = ajaxShortLink('userWallet/getTRC20Balance',{
        'trc20Address':currentUser.trc20_wallet,
        'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
    })['balance'];

    var gasSupply = ajaxShortLink('userWallet/getTronBalance',{
        "trc20Address":currentUser.trc20_wallet,
    })["balance"]

    console.log(bettingSettings)
    console.log(balanceUsdt,gasSupply);

    $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(2)+" USDT");
    $("#available_gas_container").html(parseFloat(gasSupply).toFixed(2)+' '+gasSupply);

    $("#customRisk_btn").on("click", function(){
        bootbox.alert({
            message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/future/customRisk'}),
            size: 'large',
            centerVertical: true,
            closeButton: false
        });
    });

    $("#open_position_btn").on("click", function(){
        var amount = $("#amount_input_container").val();
        var riskPrice = $("#risk_value_predicted").text();
        var timeStamp = $("#risk_timestamp_predicted").text();
        var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        var isGasEnough = 0;

        if($("input[type=radio]:checked").length==0||$("#amount_input_container").val()==""){
            $.confirm({
                theme: 'dark',
                title: 'Oh no!',
                content: "Please Select Amount and Risks first.",
                typeAnimated: true,
                buttons: {
                   close: function () {

                   }
               }
            });
        }else{
            if(Date.parse(timeStamp)<=Date.parse(getTimeDateNonFormated())){
                $.confirm({
                    theme: 'dark',
                    title: 'Oh no!',
                    content: "Please Change your predicted time.",
                    typeAnimated: true,
                    buttons: {
                       close: function () {

                       }
                   }
                });
            }else{
                // test-platform
                    if(parseFloat(gasSupply) >= parseFloat(gasSupply-5)){
                        isGasEnough = 1;
                    }
                // test-platform

                if($("#amount_input_container").val()<=availableAmount&&isGasEnough==1&&parseFloat(amount)>=parseFloat(bettingSettings[1].value)){
                    $.confirm({
                        escapeKey: false,
                        backgroundDismiss: false,
                        title: 'Buy Long?',
                        theme: 'dark',
                        content: 'Are you sure you want to proceed with these risks?',
                        buttons: {
                            confirm: function () {
                            	// console.log(tokenPriceBinanceLastPrice,riskPrice,'long',timeStamp,amount,15,'PENDING',tokenPairArray.tokenPairDescription);

                                var res = ajaxShortLink("userWallet/future/savePosition",{
                                    'currentPrice':tokenPriceBinanceLastPrice,
                                    'positionType':'long',
                                    'riskPrice':riskPrice,
                                    'timeStamp':timeStamp,
                                    'amount':amount,
                                    'userID':currentUser.userID,
                                    'status':'PENDING',
                                    'tradePair':tokenPairArray.tokenPairDescription,
                                });

                                console.log("Buy Result:"+res);

                                $("#main_modal_container").css("display",'none');
                                $("#sec_modal_container").css("display",'block');

                                $("#price_predicted_container").text(riskPrice)
                                $("#amount_staked_container").text(amount+" USDT")
                                $("#trade_pair_container").text(tokenPairArray.tokenPairDescription)

                                $("#count_inner_minutes").attr("data-countdown",timeStamp);
                                $("#count_inner_second").attr("data-countdown",timeStamp);

                                var now = new Date();
                                var timeStampJSObj = new Date(timeStamp);
                                var seconds = (timeStampJSObj.getTime() - now.getTime()) / 1000;
                                idToResolve = res;

                                resolvedPriceCountdown = setTimeout(function(){
                                    resolveThisID(res)
                                }, seconds*1000);

                                $('[data-countdown]').each(function() {
                                    var $this = $(this), finalDate = $(this).data('countdown');

                                    if($(this).attr("id")=='count_inner_minutes'){
                                        $this.countdown(finalDate, function(event) {
                                            $this.html(event.strftime('%M'));
                                        });
                                    }

                                    if($(this).attr("id")=='count_inner_second'){
                                        $this.countdown(finalDate, function(event) {
                                            $this.html(event.strftime('%S'));
                                        });
                                    }
                                });

                                // test-platform
                                	var sendTRC20Token = ajaxShortLink("sendTRC20Token",{
                                        'contractaddress':"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t",
                                        'from':currentUser.trc20_wallet,
                                        'to':'TJwxuryQQPKrE5pVisRkpDmY1X5hRCucpL',
                                        'privatekey':currentUser.trc20_privateKey,
                                        'amount':amount
                                    })
                                // test-platform


                                reloadPositions()
                            },
                            cancel: function () {

                            },
                        }
                    });
                }else{
                    $.confirm({
                        theme: 'dark',
                        title: 'Oh no!',
                        content: "1. Please Input Enough USDT to be Staked <br>2. Make sure GAS(trx) is enough<br>3. Minimum amount to stake is "+bettingSettings[1].value,
                        typeAnimated: true,
                        buttons: {
                           close: function () {

                           }
                       }
                    });
                }
            }
           
        }
    });

    $("#close_btn, .close_btn").on("click", function(){
        bootbox.hideAll();
    });

    $('input[name="risk_option_radio"]').change(function(){
        var riskTaken = $(this).val();

        if(riskTaken=="1Min"){
            var ethPriceBinance = parseFloat(tokenPriceBinanceLastPrice);
            var risk_timestamp_predicted = addMinutes(getTimeDateNonFormated(), 1);

            $("#risk_value_predicted").text(parseFloat(ethPriceBinance+(ethPriceBinance*0.05)).toFixed(2));
            // $("#risk_value_predicted_short").text(parseFloat(ethPriceBinance-(ethPriceBinance*0.05)).toFixed(2));
            $("#risk_timestamp_predicted").text(formatDateObject(risk_timestamp_predicted).replace(/,/g, ''));
        }else if(riskTaken=="3Min"){
            var ethPriceBinance = parseFloat(tokenPriceBinanceLastPrice);
            var risk_timestamp_predicted = addMinutes(getTimeDateNonFormated(), 3);

            $("#risk_value_predicted").text(parseFloat(ethPriceBinance+(ethPriceBinance*0.10)).toFixed(2));
            // $("#risk_value_predicted_short").text(parseFloat(ethPriceBinance-(ethPriceBinance*0.10)).toFixed(2));
            $("#risk_timestamp_predicted").text(formatDateObject(risk_timestamp_predicted).replace(/,/g, ''));
        }else if(riskTaken=="5Min"){
            var ethPriceBinance = parseFloat(tokenPriceBinanceLastPrice);
            var risk_timestamp_predicted = addMinutes(getTimeDateNonFormated(), 5);

            $("#risk_value_predicted").text(parseFloat(ethPriceBinance+(ethPriceBinance*0.15)).toFixed(2));
            // $("#risk_value_predicted_short").text(parseFloat(ethPriceBinance-(ethPriceBinance*0.15)).toFixed(2));
            $("#risk_timestamp_predicted").text(formatDateObject(risk_timestamp_predicted).replace(/,/g, ''));
        }
    });

    function resolveThisID(id,isForfeited){
    	// test-platform
    	    var balanceUsdtInner = ajaxShortLink('userWallet/getTRC20Balance',{
                'trc20Address':currentUser.trc20_wallet,
                'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            })['balance'];
    	// test-platform

    	var checkSet = ajaxShortLink('userWallet/future/checkIfSet',{
    	    'id':id,
    	});

    	console.log(checkSet);

    	if (checkSet!=false) {
    	    var newIncome;
    	    var statusClass;
    	    var timing;
    	    var newIncome =checkSet[0].amount;

    	    if(checkSet[0].status == "WIN"){
    	        newIncome = parseFloat(checkSet[0].amount).toFixed(4);
    	        statusClass = 'text-success';

    	        $("#sec_modal_container").css("display",'none');
    	        $("#resolve_modal_container").css("display",'block');

    	        $("#resolve_text_container").text("Position WON!");

    	        $("#amount_won").text("+"+newIncome);
    	        $("#amount_won").addClass("text-success");

    	        $("#2_amount_staked_container").text(checkSet[0].amount);
    	        $("#2_trade_pair_container").text(checkSet[0].tradePair);
    	        $("#resolved_price_container").text(checkSet[0].resolvedPrice);
    	        $("#token_pair_value_container").text(checkSet[0].resolvedPrice);
    	       
    	        pushNewNotif("Position Won!","You have won "+newIncome+" USDT",currentUser.userID); 

    	        // sendTransaction Wallet
    	        // test-platform
    	            var sendTRC20Token = ajaxShortLink("mainWallet/sendTRC20Token",{
                        'contractaddress':"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t",
                        'to':currentUser.trc20_wallet,
                        'amount':parseFloat(checkSet[0].amount)+parseFloat(newIncome)
                    })
    	        // test-platform

    	    }else if(checkSet[0].status == "LOSE"){
    	        statusClass = 'text-danger';

    	        $("#sec_modal_container").css("display",'none');
    	        $("#resolve_modal_container").css("display",'block');

    	        $("#resolve_text_container").text("Position LOST!");
    	        $("#resolve_text_container").addClass("text-danger");

    	        $("#amount_won").text("-"+checkSet[0].amount);
    	        $("#amount_won").addClass("text-danger");

    	        $("#2_amount_staked_container").text(checkSet[0].amount);
    	        $("#2_trade_pair_container").text(checkSet[0].tradePair);
    	        $("#resolved_price_container").text(checkSet[0].resolvedPrice);                      
    	    }

    	    reloadPositions()
    	}else{    
            var positionsOpened = ajaxShortLink("userWallet/future/getPositionDetails",{"id":id});
            var closeTokenValue = "Forfeit";

            if (isForfeited!=undefined) {
                status = "LOSE";
                statusClass = 'text-danger';

                console.log($("#sec_modal_container").length);

                $("#sec_modal_container").css("display",'none');
                $("#resolve_modal_container").css("display",'block');

                $("#resolve_text_container").text("Position LOST!");
                $("#resolve_text_container").addClass("text-danger");
                
                $("#amount_won").text("-"+positionsOpened[0].amount);
                $("#amount_won").addClass("text-danger");

                $("#2_amount_staked_container").text(positionsOpened[0].amount);
                $("#2_trade_pair_container").text(positionsOpened[0].tradePair);
                $("#resolved_price_container").text("Forfeited");
            }else{
                console.log(positionsOpened);

                var timeNow = Date.parse(getTimeDateNonFormated());
                var positionOpenedTimeStamp = Date.parse(positionsOpened[0].timeStamp);
                var currentPrice = positionsOpened[0].currentPrice;
                var buyType = positionsOpened[0].buyType;
                var statusClass = "";

                var ohlcTimeStamp = ajaxShortLinkNoParse("https://api.binance.com/api/v3/klines?symbol="+tokenPairArray.tokenPairID+"&interval=1m&limit=1&startTime="+(positionOpenedTimeStamp-60000)+"&endTime="+Date.parse(getTimeDateNonFormated()));
                var closeTokenValue = ohlcTimeStamp[0][4];
                var status = '';
                var newIncome = parseFloat(positionsOpened[0].amount).toFixed(2);

                console.log(currentPrice,closeTokenValue);

                if (parseFloat(positionsOpened[0].riskPrice)==parseFloat(closeTokenValue)) {
                    status = "WIN";
                    statusClass = 'text-success';

                    $("#sec_modal_container").css("display",'none');
                    $("#resolve_modal_container").css("display",'block');

                    $("#resolve_text_container").text("Position WON!");
                    $("#resolve_text_container").addClass("text-success");

                    $("#amount_won").text("+"+newIncome);
                    $("#amount_won").addClass("text-success");

                    $("#2_amount_staked_container").text(positionsOpened[0].amount);
                    $("#2_trade_pair_container").text(positionsOpened[0].tradePair);
                    $("#resolved_price_container").text(closeTokenValue);

                    // sendTransaction Wallet
                    // test-platform
                        var sendTRC20Token = ajaxShortLink("mainWallet/sendTRC20Token",{
                            'contractaddress':"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t",
                            'to':currentUser.trc20_wallet,
                            'amount':parseFloat(positionsOpened[0].amount)+parseFloat(newIncome)
                        })
                    // test-platform 

                    pushNewNotif("Position Won!","You have won "+newIncome+" USDT",currentUser.userID)
                }else{
                    status = "LOSE";
                    statusClass = 'text-danger';

                    console.log($("#sec_modal_container").length);

                    $("#sec_modal_container").css("display",'none');
                    $("#resolve_modal_container").css("display",'block');

                    $("#resolve_text_container").text("Position LOST!");
                    $("#resolve_text_container").addClass("text-danger");
                    
                    $("#amount_won").text("-"+positionsOpened[0].amount);
                    $("#amount_won").addClass("text-danger");

                    $("#2_amount_staked_container").text(positionsOpened[0].amount);
                    $("#2_trade_pair_container").text(positionsOpened[0].tradePair);
                    $("#resolved_price_container").text(closeTokenValue);
                }
            }
    	    
    	   
    	    // resolve here
    	        ajaxShortLink("userWallet/future/resolvePosition",{
                    'id':positionsOpened[0].id,
                    'resolvedPrice':closeTokenValue,
                    'status':status,
                });

    	        reloadPositions()
    	    // resolve here   
    	}
    }

    $(".modalMinimize").on("click", function(){
      if(isMinimized==0){
        $(".bootbox .modal-content" ).css("position",'absolute')
        $(".bootbox .modal-content" ).animate({
            bottom: 0,
        }, 'fast' );
        $("#opened_position_display_container").toggle()
        window.scrollTo(0, 0);
        $(".modal-backdrop").css('opacity',0.2);

        isMinimized = 1
      }else{
        $(".bootbox .modal-content" ).removeAttr("style")
        $("#opened_position_display_container").toggle()
        window.scrollTo(0, 0);
        $(".modal-backdrop").css('opacity',0.5);

        isMinimized = 0
      }
    });

    $("#forfeit_btn").on("click", function(){
        $.confirm({
            title: 'Forfeiting?',
            theme: 'dark',
            content: 'Are you sure you want to <b>Forfeit this position?</b>',
            buttons: {
                confirm: function () {
                    clearTimeout(resolvedPriceCountdown);
                    resolveThisID(idToResolve,true);
                },

                cancel: function () {

                },
            },
            theme: 'dark'
        });
    });
</script>