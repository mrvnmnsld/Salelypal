<style type="text/css">
    .modal-footer{
        display: none;
    }
</style>

<div class="pagetitle text-center text-primary" style="display:none">
    <h4>Buy Rise</h4>
    <small>Opening Position</small>

    <hr>
</div>


<div id="main_modal_container" style="display:block">
    <div class="btn-group btn-group-toggle d-flex justify-content-center mt-2" data-toggle="buttons" id="timings_container"></div>

    <div class="d-flex mt-1 flex-basis: fit-content;">
        <div>
            <label class="mt-1">Amount:</label>
        </div>

        <div style="flex-basis: 100%;">
            <input type="number" class="ml-1 form-control form-control-sm" id="amount_input_container">
        </div>      
    </div>

    <small>
        <div class="text-center">
            <span>Availble Amount:</span>
            <span id="available_amount_container"></span>
        </div>

        <div class="text-center">
            <span>Availble Gas:</span>
            <span id="available_gas_container"></span>
        </div>
    </small>

    <hr>

    <div class="mt-3">
        <button class="btn btn-success btn-block" id="buy_rise_submit_btn">Submit Position</button>
        <button class="btn btn-danger btn-block close_btn">Close</button>
    </div>
</div>

<div id="sec_modal_container" style="display:none">
    <!-- <div class="text-center text-success h5">Successfully Opened Position</div> -->

    <div class="text-center" id="opened_position_display_container">
        <div>
            <span>Price Started:</span>
            <span id="currentPrice_container"></span> 
        </div>

        <div>
            <span>Posible Income:</span>
            <span id="income_container"></span> 
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

    <div class="text-danger text-center">
        <small>Note: Please wait for the position to be resolve</small>
        <small>Closing this means forfeit and assets staked will be liquidated</small>
    </div>

    <div>
        <button class="btn btn-block btn-sm btn-warning modalMinimize mt-2">Toggle chart view</button>
        <button class="btn btn-block btn-sm btn-danger mt-2" id="forfeit_btn">Forfeit</button>
    </div>
</div>

<div id="resolve_modal_container" style="display:none" class="text-center">
    <!-- <div class="h3" id="resolve_text_container">Position Won!</div> -->

    <div>
        <span id="amount_won" class="h4">+ 100 USDT</span>
    </div>

    <div>
        <span>Amount Staked:</span>
        <span id="2_amount_staked_container">100</span> 
    </div>

    <div>
        <span>Trade Pair:</span>
        <span id="2_trade_pair_container">BTC/USDT</span> 
    </div>

    <div>
        <span>Resolved Price:</span>
        <span id="resolved_price_container"></span> 
    </div>

    <br>

    <button class="btn btn-danger btn-block close_btn btn-sm">Close</button>
</div>

<script type="text/javascript">
    isMinimized = 1;

    var idToResolve;
    var resolvedPriceCountdown;
    var bettingSettings = ajaxShortLink("test-account/getBettingSettings");
    var riseFallTimings = ajaxShortLink("test-account/getFutureRisefallTimings");
    var balanceOpen = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
    	"userID":currentUser.userID,
        'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
    })['balance'];

    var gasSupply = ajaxShortLink('test-account/getTronBalance',{
    	"userID":currentUser.userID,
    })["balance"]

    for (var i = 0; i < riseFallTimings.length; i++) {
        if (i==0) {
            $("#timings_container").append('<label checked class="btn btn-secondary active" id="timing_'+riseFallTimings[i].id+'">')
        }else{
            $("#timings_container").append('<label class="btn btn-secondary" id="timing_'+riseFallTimings[i].id+'">')
        }

        if (i==0) {
            $("#timing_"+riseFallTimings[i].id).append('<input type="radio" name="risk_option_radio" value="'+riseFallTimings[i].timing+'/'+riseFallTimings[i].income+'" autocomplete="off" checked="checked"> '+riseFallTimings[i].timing+' Sec <br>')
        }else{
            $("#timing_"+riseFallTimings[i].id).append('<input type="radio" name="risk_option_radio" value="'+riseFallTimings[i].timing+'/'+riseFallTimings[i].income+'" autocomplete="off" > '+riseFallTimings[i].timing+' Sec <br>')
        }

        $("#timing_"+riseFallTimings[i].id).append('<small style="font-size: 12px;">'+riseFallTimings[i].income+'% Income</small>')
        $("#timings_container").append("</label>")
    }

    console.log(parseFloat(balanceOpen).toFixed(2),riseFallTimings,bettingSettings,parseFloat(gasSupply).toFixed(2));

    $("#available_amount_container").html(parseFloat(balanceOpen).toFixed(2)+" USDT");
    $("#available_gas_container").html(parseFloat(gasSupply).toFixed(2)+' TRX');

    $(".close_btn").on("click",function(){
        bootbox.hideAll();

        if ($("#resolve_modal_container").css("display")!="none") {
            var indexToken = tokensSelected.findIndex(x => x.smartAddress ==="TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t");
            console.log(indexToken);
            console.log(tokenBalance[indexToken]);
            console.log(totalInUsd);

            totalInUsd = totalInUsd-parseFloat(tokenBalance[indexToken])
            console.log(totalInUsd);

            loadTokenInfo(tokensSelected[indexToken]);
            console.log(totalInUsd);

            $("#totalInUsdContainer").html(numberWithCommas(totalInUsd.toFixed(2)));
            $("#totalInUsdContainer").append(" "+displayCurrency.toUpperCase());
        }

    })

    $("#buy_rise_submit_btn").on("click",function(){
        

        var riskOptionVal = $('input[name="risk_option_radio"]:checked').val().split('/');
        var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        var buyType = 'rise';
        var currentPrice = $("#token_pair_value_container").text();
        var amountInput = $('#amount_input_container').val();
        var timer = riskOptionVal[0];
        var income = riskOptionVal[1];
        var date = getEpochCurrentTime13Digit()
        var timeStamp = formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))
        var isGasEnough = 0;

        // // test-platform
        //     gasSupply = getGasSupplyTestPlatform('trx')

            if(parseFloat(gasSupply) >= parseFloat(gasSupply-5)){
                isGasEnough = 1;
           	}
        // // test-platform

        if(amountInput!=""&&amountInput<=availableAmount&&isGasEnough==1&&parseFloat(amountInput)>=parseFloat(bettingSettings[0].value)){
           $.confirm({
                escapeKey: false,
                backgroundDismiss: false,
               title: 'Buy Rise?',
               theme: 'dark',
               content: 'Are you sure you want to proceed with these risks?',
               buttons: {
                   confirm: function () {
                        $("#buy_rise_submit_btn").attr("disabled",true);

                        var res = ajaxShortLink("test-account/future/saveRiseFallPosition",{
                           'currentPrice':currentPrice,
                           'buyType':buyType,
                           'income':income,
                           'timeStamp':timeStamp,
                           'amount':amountInput,
                           'userID':currentUser.userID,
                           'status':'PENDING',
                           'tradePair':tokenPairArray.tokenPairDescription,
                        });

                        idToResolve = res;

                        $("#main_modal_container").css("display",'none');
                        $("#sec_modal_container").css("display",'block');

                        $("#currentPrice_container").text(currentPrice)
                        $("#income_container").text(((income/100)*amountInput).toFixed(2)+" USDT");
                        $("#amount_staked_container").text(amountInput+" USDT")
                        $("#trade_pair_container").text(tokenPairArray.tokenPairDescription)

                        $("#count_inner_minutes").attr("data-countdown",timeStamp);
                        $("#count_inner_second").attr("data-countdown",timeStamp);

                        var now = new Date();
                        var timeStampJSObj = new Date(timeStamp);
                        var seconds = (timeStampJSObj.getTime() - now.getTime()) / 1000;

                        console.log(idToResolve,seconds-3);

                        console.log(
                            unixTimeToDate13CharNonFormated(date+(timer*1000)),
                            formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))
                        )

                        resolvedPriceCountdown = setTimeout(function(){
                            resolveThisID(idToResolve)
                        }, seconds*1000);

                        setTimeout(function(){
                            console.log("IM HERE");
                            if ($(".jconfirm-box").length==1) {
                                jconfirm.instances[0].close();
                                $("#forfeit_btn").attr("disabled",true);
                            }
                        }, (seconds-3)*1000);

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

                       var balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                       // test-platfrom
                           var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
                              'userID':currentUser.userID,
                              'tokenName':'trx',
                              'smartContract':null,
                              'balance':parseFloat(gasSupply)-5,
                           })

                           var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
                              'userID':currentUser.userID,
                              'tokenName':null,
                              'smartContract':"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t",
                              'balance':parseFloat(balanceOpen)-amountInput,
                           })
                       // test-platfrom

                       // minusToAmountAvailable(amountInput)
                       // reloadPositions();
                   },
                   cancel: function () {
                    
                   },
               },
               theme: 'dark'
           });
        }else{
            $.confirm({
                theme: 'dark',
                title: 'Testing Mode!',
                content: "1. Please Input Enough USDT to be Staked <br>2. Make sure GAS(trx) is enough<br>3. Minimum amount to stake is "+bettingSettings[0].value,
                typeAnimated: true,
                buttons: {
                   close: function () {

                   }
               }
            });
        }
    })

    function resolveThisID(id,isForfeited){

        $(".modalMinimize").click();

        // test-platform
            var balanceUsdtInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
            	"userID":currentUser.userID,
                'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            })['balance'];
        // test-platform

        console.log(balanceUsdtInner);
        console.log(isForfeited);

        var checkSet = ajaxShortLink('test-account/riseFall/checkIfSet',{'id':id});
        console.log(checkSet);

        if (checkSet!=false) {
            var newIncome;
            var statusClass;
            var timing;
            var newIncome = (checkSet[0].income/100)*checkSet[0].amount;

            if(checkSet[0].status == "WIN"){
                newIncome = ((checkSet[0].income/100)*checkSet[0].amount).toFixed(4);
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
               
                pushNewNotifTestAccount("Position Won!(TESTING)","You have won "+newIncome+" USDT",currentUser.userID); 

                // test-platform
                    var newBalanceRes = ajaxShortLink("test-account/updateNewBalance",{
                       'userID':currentUser.userID,
                       'token':null,
                       'smartContract':"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t",
                       'balance':parseFloat(balanceUsdtInner)+parseFloat(newIncome)+parseFloat(checkSet[0].amount),
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
            var positionsOpened = ajaxShortLink("test-account/riseFall/getPositionDetails",{"id":id});
            console.log(positionsOpened);

            var timeNow = Date.parse(getTimeDateNonFormated());
            var positionOpenedTimeStamp = Date.parse(positionsOpened[0].timeStamp);
            var currentPrice = positionsOpened[0].currentPrice;
            var buyType = positionsOpened[0].buyType;
            var statusClass = "";
            var closeTokenValue = $("#token_pair_value_container").text();
            var status = '';
            var newIncome = ((positionsOpened[0].income/100)*positionsOpened[0].amount).toFixed(2);

            console.log(currentPrice,closeTokenValue);

            if (isForfeited!=undefined) {
                console.log("Forfeit");
                status = "LOSE";
                statusClass = 'text-danger';

                console.log($("#sec_modal_container").length);

                $("#sec_modal_container").css("display",'none');
                $("#resolve_modal_container").css("display",'block');

                $("#resolve_text_container").text("Position Forfeited!");
                $("#resolve_text_container").addClass("text-danger");

                $("#amount_won").text("-"+positionsOpened[0].amount);
                $("#amount_won").addClass("text-danger");

                $("#2_amount_staked_container").text(positionsOpened[0].amount);
                $("#2_trade_pair_container").text(positionsOpened[0].tradePair);
                $("#resolved_price_container").text("Forfeited");
            }else{
                if (parseFloat(currentPrice)<parseFloat(closeTokenValue)) {
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
                        var newBalanceRes = ajaxShortLink("test-account/updateNewBalance",{
                           'userID':currentUser.userID,
                           'tokenName':null,
                           'smartContract':"TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t",
                           'balance':parseFloat(balanceUsdtInner)+parseFloat(newIncome)+parseFloat(positionsOpened[0].amount),
                        })  
                    // test-platform 

                    pushNewNotifTestAccount("Position Won!(TESTING)","You have won "+newIncome+" USDT",currentUser.userID)
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
                ajaxShortLink("test-account/future/resolveRiseFallPosition",{
                    'id':positionsOpened[0].id,
                    'resolvedPrice':closeTokenValue,
                    'status':status,
                });

                reloadPositions()
            // resolve here   
        }
    }

    $(".modalMinimize").on("click", function(){
        console.log(isMinimized);
        if(isMinimized==1){
            $(".bootbox .modal-content" ).css("position",'absolute')
            $(".bootbox .modal-content" ).animate({
                bottom: 0,
            }, 'fast' );
            $("#opened_position_display_container").toggle()
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $(".modal-backdrop").css('opacity',0.2);

            isMinimized = 0
        }else{
            $(".bootbox .modal-content" ).removeAttr("style")
            $("#opened_position_display_container").toggle()
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $(".modal-backdrop").css('opacity',0.5);

            isMinimized = 1
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