<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<style type="text/css">
    table{
        overflow-x:auto;
    }
</style>

<div id="innerContainer" class="p-2">
    <div>
        <span id="token_pair_name_container" class="text-muted h5 d-none">ETH/USDT</span>
    </div>

    <label>Select Trade Pair:</label>

    <select id="token_pair_select">
        <option>ETH/USDT</option>
        <option>BTC/USDT</option>
        <option>XRP/USDT</option>
        <option>BNB/USDT</option>
        <option>DOGE/USDT</option>
        <option>TRX/USDT</option>
    </select>

    <div id="changeContainer">
        <span class="h5" id="token_pair_value_container"></span>

        <small id="token_pair_value_percentage_container"></small>
    </div>

    <small >24 Hour change</small>

    <div class="tradingview-widget-container">
      <div id="tradingview" style="height: 300px;"></div>
    </div>

    <div class="btn-group btn-group-toggle d-flex justify-content-center mt-2" data-toggle="buttons">
      <label class="btn btn-secondary active">
        <input type="radio" name="risk_option_radio" value="30/30" autocomplete="off" checked="checked"> 30 Sec <br>
        <small style="font-size: 12px;">30% Income</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="60/50" autocomplete="off"> 60 Sec <br>
        <small style="font-size: 12px;">50% Income</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="120/70" autocomplete="off"> 120 Sec <br>
        <small style="font-size: 12px;">70% Income</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="180/90" autocomplete="off"> 180 Sec <br>
        <small style="font-size: 12px;">90% Income</small>
      </label>
    </div>

    <div class="d-flex mt-1 flex-basis: fit-content;">
        <div>
            <label class="mt-1">Amount:</label>
        </div>

        <div style="flex-basis: 100%;">
            <input type="number" class="ml-1 form-control form-control-sm" id="amount_input_container">
        </div>      
    </div>

    <small>
        <div class="text-center text-success">
            <span>Availble Amount:</span>
            <span id="available_amount_container"></span>
        </div>
    </small>

    <div class="d-flex justify-content-center mt-2">
        <button class="btn btn-success col-md" id="buy_rise_btn">
            <img style="width:25px;" src="assets/imgs/icons/growth-graph.png">
            Buy Rise
        </button>

        <button class="btn btn-danger col-md ml-1" id="buy_fall_btn">
            <img style="width:25px;" src="assets/imgs/icons/graph.png">
            Buy Fall
        </button>
    </div>
</div>

<div class="mt-3 headers">
    <div class="h4 text-dark text-center">Positions</div>
</div class="text-success">

<div>
    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a class="nav-link text-dark active" aria-current="page" data-toggle="tab" href="#pending_tab_btn">Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" data-toggle="tab" href="#history_tab_btn">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" data-toggle="tab" href="#instructions_tab_btn">Instructions</a>
      </li>
    </ul>

    <div class="tab-content">
        <div id="pending_tab_btn" class="tab-pane active">
          <table class="table" style="font-size: 13px;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Buy Type & Timing</th>
                <th scope="col">Resolve Time</th>
                <th scope="col">Amount</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody id="positions_container">
              <tr class="text-center text-danger" id="no_position_flag_container">
                  <td colspan="5"><b>No positions opened</b></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="history_tab_btn" class="tab-pane fade">
          <table class="table" style="font-size: 12px;">
            <thead>
              <tr>
                <th scope="col">Type & Timing</th>
                <th scope="col">Resolve Time</th>
                <th scope="col">Amount</th>
                <th scope="col">Price</th>
                <th scope="col">Resolved</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody id="positions_closed_container">
                <tr class="text-center text-danger" id="no_history_position_flag_container">
                  <td colspan="5"><b>No positions opened</b></td>
                </tr>
            </tbody>
          </table>
        </div>

        <div id="instructions_tab_btn" class="tab-pane fade p-2">
          <span>
              1. Select token value prediction.<br>
              2. Select Time limit of prediction.<br>
              3. Input amount to be staked.<br>
              4. Wait for time prediction.<br>
              5. Check history if won or lost.<br>
              <br>

              <!-- *Additional<br>
              If the prediction is right but the token staked was not sent please report it as an appeal and wait for our admins to review what happened to your trade transaction -->
          </span>

          <!-- <br> -->
          <!-- <br> -->

          <div class="h6">FAQ:</div>
          <span>
              <b>1. How are the token predicted value being computed?</b><br>
              Your value predicted will check the timestamp of that minute's CLOSED value(based on binance OHLC data)

              <br>

              <b>2. Are my staked tokens will be liquidated if i lost, how about if i won?</b><br>
              The staked amount will be doubled if you have predicted the right amount but if you lose all your staked USDT will be liquidated. It's a high risk high reward kind of predictions
          </span>
        </div>
      </div>

</div>

<!-- TradingView Widget BEGIN -->
<script type="text/javascript">
    var pendingPositionChecker;
    var tokenPriceInterval;

    var tokenPriceBinanceLastPrice;
    var totalAmountPending = 0;
    var tokenPairArray = {
        'tokenPairID':'ETHUSDT',
        'tokenPairDescription':'ETH/USDT'
    };

    setTimeout(function() {
        new TradingView.widget({
            "autosize": true,
            "symbol": "BINANCE:"+tokenPairArray.tokenPairID,
            // "symbol": "BINANCE:BTCUSDT",
            "interval": "1",
            "timezone": Intl.DateTimeFormat().resolvedOptions().timeZone,
            "theme": "dark",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "save_image": false,
            "container_id": "tradingview"
        });

        //continous
            tokenPriceInterval = setInterval(function() {
                tokenPriceBinanceLastPrice = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).lastPrice).toFixed(4);
                var tokenPriceBinancePriceChangePercent = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).priceChangePercent).toFixed(4);
                var signContainer;

                if(tokenPriceBinancePriceChangePercent.includes("-")){
                    $("#changeContainer").removeClass('text-success');
                    $("#changeContainer").addClass('text-danger');
                    signContainer = "";

                }else{
                    $("#changeContainer").addClass('text-success');
                    $("#changeContainer").removeClass('text-danger');
                    signContainer = "+";
                }

                $("#token_pair_value_container").html(tokenPriceBinanceLastPrice);
                $("#token_pair_value_percentage_container").html(signContainer+tokenPriceBinancePriceChangePercent);
            }, 1000);

            pendingPositionChecker = setInterval(function() {

                positionsOpened = ajaxShortLink(
                    "userWallet/future/getPendingRiseFallPositions",
                    {
                        'userID':15,
                        'tradePair':tokenPairArray.tokenPairDescription,
                    }
                );
                
                for (var i = 0; i < positionsOpened.length; i++) {
                    var timeNow = Date.parse(getTimeDateNonFormated());
                    var positionOpenedTimeStamp = Date.parse(positionsOpened[i].timeStamp);
                    var currentPrice = positionsOpened[i].currentPrice;
                    var buyType = positionsOpened[i].buyType;
                    var statusClass = "";


                    if(timeNow>=positionOpenedTimeStamp){

                        var timing = '';

                        if (positionsOpened[i].income == 30) {
                            timing = '30/30'
                        }else if(positionsOpened[i].income == 50){
                            timing = '60/50'
                        }else if(positionsOpened[i].income == 70){
                            timing = '120/70'
                        }else if(positionsOpened[i].income == 90){
                            timing = '180/90'
                        }

                        var ohlcTimeStamp = ajaxShortLinkNoParse("https://api.binance.com/api/v3/klines?symbol="+tokenPairArray.tokenPairID+"&interval=1m&limit=1&startTime="+(positionOpenedTimeStamp-60000)+"&endTime="+Date.parse(getTimeDateNonFormated()));
                        var closeTokenValue = ohlcTimeStamp[0][4];
                        var status = '';
                        var newIncome = ((positionsOpened[i].income/100)*positionsOpened[i].amount).toFixed(4);
                        var balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                        console.log(currentPrice,closeTokenValue);

                        if(buyType=='rise'){
                            console.log();
                            if (parseFloat(currentPrice)<parseFloat(closeTokenValue)) {
                                status = "WIN";
                                statusClass = 'text-success';

                                $.toast({
                                    heading: '<h6>WON!</h6>',
                                    text: 'You have won '+newIncome+' USDT',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    position: 'bottom-center'
                                })

                                ajaxShortLink('test-platform/risefall/winPosition',{
                                    'newIncome':newIncome,
                                    'amountStaked':positionsOpened[i].amount,
                                    'amountUsdt':balanceUsdtInner,
                                });

                                addToAmountAvailable(parseFloat(newIncome)+parseFloat(positionsOpened[i].amount))

                                pushNewNotif("Position Won!(TESTING)","You have won "+newIncome+" USDT",15)
                            }else{
                                status = "LOSE";
                                statusClass = 'text-danger';

                                $.toast({
                                    heading: '<h6>LOST!</h6>',
                                    text: 'You have lost '+positionsOpened[i].amount+' USDT',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    position: 'bottom-center'
                                })
                            }
                        }else if (buyType=='fall'){
                            if (parseFloat(currentPrice)>parseFloat(closeTokenValue)) {
                                status = "WIN";
                                statusClass = 'text-success';

                                $.toast({
                                    heading: '<h6>WON!</h6>',
                                    text: 'You have won '+newIncome+' USDT',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    position: 'bottom-center'
                                })

                                ajaxShortLink('test-platform/risefall/winPosition',{
                                    'newIncome':newIncome,
                                    'amountStaked':positionsOpened[i].amount,
                                    'amountUsdt':balanceUsdtInner,
                                });

                                addToAmountAvailable(parseFloat(newIncome)+parseFloat(positionsOpened[i].amount))

                                pushNewNotif("Position Won!(TESTING)","You have won "+newIncome+" USDT",15)
                                
                            }else{
                                status = "LOSE";
                                statusClass = 'text-danger';

                                $.toast({
                                    heading: '<h6>LOST!</h6>',
                                    text: 'You have lost '+positionsOpened[i].amount+' USDT',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    position: 'bottom-center'
                                })
                            }
                        }

                        console.log("Remove Index #"+i,positionsOpened[i]);

                        // resolve here
                            ajaxShortLink("userWallet/future/resolveRiseFallPosition",{
                                'id':positionsOpened[i].id,
                                'resolvedPrice':closeTokenValue,
                                'status':status,
                            });

                            innerPositionsOpened = ajaxShortLink(
                                "userWallet/future/getPendingRiseFallPositions",
                                {
                                    'userID':15,
                                    'tradePair':tokenPairArray.tokenPairDescription,
                                }
                            );

                            $("#positions_container").empty();

                            if (innerPositionsOpened.length == 0) {
                                $("#positions_container").append(
                                    '<tr class="text-center text-danger" id="no_position_flag_container">'+
                                       '<td colspan="5"><b>No positions opened</b></td>'+
                                    '</tr>'
                                ); 
                            }else{
                                for (var x = 1; x < positionsOpened.length; x++) {
                                    $("#positions_container").append(
                                        '<tr>'+
                                            '<td class="font-weight-bold">'+($('#positions_container tr').length+1)+'. </td>'+
                                            '<td>'+positionsOpened[x].buyType+' @ '+timing+'</td>'+
                                            '<td>'+positionsOpened[x].timeStamp+'</td>'+
                                            '<td>'+positionsOpened[x].amount+'</td>'+
                                            '<td>'+positionsOpened[x].currentPrice+'</td>'+
                                            '<td><button onclick="cancelPosition('+positionsOpened[x].id+',this,'+positionsOpened[x].amount+')" class="btn btn-danger btn-sm">X</button></td>'+
                                        '</tr>'
                                    );
                                } 
                            }

                            if($("#no_history_position_flag_container").length!=0){
                                $("#positions_closed_container").empty()
                            }
                            
                            $("#positions_closed_container").prepend(
                                '<tr class="'+statusClass+'">'+
                                    '<td class="">'+positionsOpened[i].buyType+' @ '+timing+'</td>'+
                                    '<td class="">'+positionsOpened[i].amount+'</td>'+
                                    '<td class="">'+positionsOpened[i].currentPrice+'</td>'+
                                    '<td class="">'+parseFloat(closeTokenValue).toFixed(4)+'</td>'+
                                    '<td class="">'+status+' </td>'+
                                '</tr>'
                            );  

                        // resolve here                   
                
                    }
                }



                

                console.log("No logs")
            }, 5000);
        //continous
    }, 2000);

    //callBackEnd
        balanceUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
            // 'trc20Address':currentUser['trc20_wallet'],
            'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
        })['balance'];

        $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(4)+" USDT");

        var positionsOpened = ajaxShortLink(
            "userWallet/future/getPendingRiseFallPositions",
            {
                'userID':15,
                'tradePair':tokenPairArray.tokenPairDescription
            }
        );

        if (positionsOpened.length>=1) {
            $("#positions_container").empty();

            for (var i = 0; i < positionsOpened.length; i++) {
                var timing = '';

                if (positionsOpened[i].income == 30) {
                    timing = '30/30'
                }else if(positionsOpened[i].income == 50){
                    timing = '60/50'
                }else if(positionsOpened[i].income == 70){
                    timing = '120/70'
                }else if(positionsOpened[i].income == 90){
                    timing = '180/90'
                }
                
                $("#positions_container").append(
                    '<tr>'+
                        '<td class="font-weight-bold">'+(i+1)+'. </td>'+
                        '<td>'+positionsOpened[i].buyType+' @ '+timing+'</td>'+
                        '<td>'+positionsOpened[i].timeStamp+'</td>'+
                        '<td>'+positionsOpened[i].amount+'</td>'+
                        '<td>'+positionsOpened[i].currentPrice+'</td>'+
                        '<td><button onclick="cancelPosition('+positionsOpened[i].id+',this,'+positionsOpened[i].amount+')" class="btn btn-danger btn-sm">X</button></td>'+
                    '</tr>'
                );

                totalAmountPending = totalAmountPending+parseFloat(positionsOpened[i].amount);
            }

            minusToAmountAvailable(totalAmountPending)
        }   

        var positionsClosed = ajaxShortLink(
            "userWallet/future/getClosedRiseFallPositions",
            {
                'userID':15,
                'tradePair':tokenPairArray.tokenPairDescription
            }
        );

        if (positionsClosed.length>=1) {
            $("#positions_closed_container").empty();            

            for (var i = 0; i < positionsClosed.length; i++) {
                var timing = '';

                if (positionsClosed[i].income == 30) {
                    timing = '30/30';
                }else if(positionsClosed[i].income == 50){
                    timing = '60/50';
                }else if(positionsClosed[i].income == 70){
                    timing = '120/70';
                }else if(positionsClosed[i].income == 90){
                    timing = '180/90';
                }

                if(positionsClosed[i].status=="WIN"){
                    statusClass = 'text-success';
                }else{
                    statusClass = 'text-danger';
                }

                $("#positions_closed_container").append(
                    '<tr class="'+statusClass+'">'+
                        '<td class="">'+positionsClosed[i].buyType+" @ "+timing+'</td>'+
                        '<td class="">'+positionsClosed[i].timeStamp+'</td>'+
                            '<td class="">'+positionsClosed[i].amount+'</td>'+
                            '<td class="">'+positionsClosed[i].currentPrice+'</td>'+
                            '<td class="">'+parseFloat(positionsClosed[i].resolvedPrice).toFixed(4)+'</td>'+
                            '<td class="">'+positionsClosed[i].status+' </td>'+
                    '</tr>'
                );  
            }        
        }   
    //callBackEnd

    //buy
        $("#buy_rise_btn").on("click", function(){
            var riskOptionVal = $('input[name="risk_option_radio"]:checked').val().split('/');
            var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
            var buyType = 'rise';
            var currentPrice = float2DecimalPoints(tokenPriceBinanceLastPrice);
            var amountInput = $('#amount_input_container').val();
            var timer = riskOptionVal[0];
            var income = riskOptionVal[1];
            var date = getEpochCurrentTime13Digit()
            var timeStamp = formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))

            if(amountInput!=""&&amountInput<=availableAmount){
                $.confirm({
                    title: 'Buy Rise?',
                    content: 'Are you sure you want to proceed with these risks?',
                    buttons: {
                        confirm: function () {
                            var res = ajaxShortLink("userWallet/future/saveRiseFallPosition",{
                                'currentPrice':currentPrice,
                                'buyType':buyType,
                                'income':income,
                                'timeStamp':timeStamp,
                                'amount':amountInput,
                                'userID':15,
                                'status':'PENDING',
                                'tradePair':tokenPairArray.tokenPairDescription,
                            });

                            if($("#no_position_flag_container").length){
                                $("#positions_container").empty();

                                $("#positions_container").append(
                                    '<tr>'+
                                        '<td class="font-weight-bold">'+($('#positions_container tr').length+1)+'. </td>'+
                                        '<td>'+buyType+' @ '+timer+'/'+income+'</td>'+
                                        '<td>'+timeStamp+'</td>'+
                                        '<td>'+amountInput+'</td>'+
                                        '<td>'+currentPrice+'</td>'+
                                        '<td><button onclick="cancelPosition('+res+',this,'+amountInput+')" class="btn btn-danger btn-sm">X</button></td>'+
                                    '</tr>'
                                );  
                            }else{
                                $("#positions_container").append(
                                   '<tr>'+
                                       '<td class="font-weight-bold">'+($('#positions_container tr').length+1)+'. </td>'+
                                       '<td>'+buyType+' @ '+timer+'/'+income+'</td>'+
                                       '<td>'+timeStamp+'</td>'+
                                       '<td>'+amountInput+'</td>'+
                                       '<td>'+currentPrice+'</td>'+
                                       '<td><button onclick="cancelPosition('+res+',this,'+amountInput+')" class="btn btn-danger btn-sm">X</button></td>'+
                                   '</tr>'
                                );  
                            }

                            balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                            ajaxShortLink('test-platform/risefall/openPosition',{
                                'amountStaked':amountInput,
                                'totalAvailAmount':balanceUsdtInner,
                            });

                            minusToAmountAvailable(amountInput)

                            $.toast({
                                heading: '<h6>Success</h6>',
                                text: 'Position Opened',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-center'
                            })
                            
                            console.log(res);
                        },
                        cancel: function () {

                        },
                    }
                });

                // console.log(amountInput,buyType,timer,income,currentPrice,timeStamp);
            }else{
                $.alert("Please Input Enough USDT to be Staked");
            }
        });

        $("#buy_fall_btn").on("click", function(){
            var riskOptionVal = $('input[name="risk_option_radio"]:checked').val().split('/');
            var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
            var buyType = 'fall';
            var currentPrice = float2DecimalPoints(tokenPriceBinanceLastPrice);
            var amountInput = $('#amount_input_container').val();
            var timer = riskOptionVal[0];
            var income = riskOptionVal[1];
            var date = getEpochCurrentTime13Digit()
            var timeStamp = formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))

            if(amountInput!=""&&amountInput<=availableAmount){
                $.confirm({
                    title: 'Buy Fall?',
                    content: 'Are you sure you want to proceed with these risks?',
                    buttons: {
                        confirm: function () {
                            var res = ajaxShortLink("userWallet/future/saveRiseFallPosition",{
                                'currentPrice':currentPrice,
                                'buyType':buyType,
                                'income':income,
                                'timeStamp':timeStamp,
                                'amount':amountInput,
                                'userID':15,
                                'status':'PENDING',
                                'tradePair':tokenPairArray.tokenPairDescription
                            });

                            if($("#no_position_flag_container").length){
                                $("#positions_container").empty();

                                $("#positions_container").append(
                                    '<tr>'+
                                        '<td class="font-weight-bold">'+($('#positions_container tr').length+1)+'. </td>'+
                                        '<td>'+buyType+' @ '+timer+'/'+income+'</td>'+
                                        '<td>'+timeStamp+'</td>'+
                                        '<td>'+amountInput+'</td>'+
                                        '<td>'+currentPrice+'</td>'+
                                        '<td><button onclick="cancelPosition('+res+',this,'+amountInput+')" class="btn btn-danger btn-sm">X</button></td>'+
                                    '</tr>'
                                );  
                            }else{
                                $("#positions_container").append(
                                   '<tr>'+
                                       '<td class="font-weight-bold">'+($('#positions_container tr').length+1)+'. </td>'+
                                       '<td>'+buyType+' @ '+timer+'/'+income+'</td>'+
                                       '<td>'+timeStamp+'</td>'+
                                       '<td>'+amountInput+'</td>'+
                                       '<td>'+currentPrice+'</td>'+
                                       '<td><button onclick="cancelPosition('+res+',this,'+amountInput+')" class="btn btn-danger btn-sm">X</button></td>'+
                                   '</tr>'
                                );  
                            }

                            balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                            ajaxShortLink('test-platform/risefall/openPosition',{
                                'amountStaked':amountInput,
                                'totalAvailAmount':balanceUsdtInner,
                            });

                            minusToAmountAvailable(amountInput)

                            $.toast({
                                heading: '<h6>Success</h6>',
                                text: 'Position Opened',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-center'
                            })
                            
                            console.log(res);
                        },
                        cancel: function () {

                        },
                    }
                });

                // console.log(amountInput,buyType,timer,income,currentPrice,timeStamp);
            }else{
                $.alert("Please Input Enough USDT to be Staked");
            }
        });
    //buy

    $('#token_pair_select').selectpicker({search : true});

    $('#token_pair_select').change(function(){
        var selectedPair = $(this).val();
        var location;

        if(selectedPair=='BTC/USDT'){
            location = 'btcusdt_risefall';
        }

        if(selectedPair=='ETH/USDT'){
            location = 'ethusdt_risefall';
        }

        if(selectedPair=='XRP/USDT'){
            location = 'xrpusdt_risefall';
        }

        if(selectedPair=='BNB/USDT'){
            location = 'bnbusdt_risefall';
        }

        if(selectedPair=='DOGE/USDT'){
            location = 'dogeusdt_risefall';
        }

        if(selectedPair=='TRX/USDT'){
            location = 'trxusdt_risefall';
        }

        clearInterval(tokenPriceInterval);
        clearInterval(pendingPositionChecker);


        $.when(closeNav()).then(function() {
            $('#topNavBar').toggle();
            $("#container").fadeOut(animtionSpeed, function() {
                $("#loadSpinner").fadeIn(animtionSpeed,function(){
                    $("#container").empty();
                    $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/risefall_trade_pairs/'+location}));

                    console.log('wallet/test-platform/risefall_trade_pairs/'+location);

                    setTimeout(function(){
                        $("#loadSpinner").fadeOut(animtionSpeed,function(){
                            $('#topNavBar').toggle();
                            $("#container").fadeIn(animtionSpeed);
                        });
                    }, 2000);
                    
                });
            });
        });
    });

    function minusToAmountAvailable(amountToMinus){
        balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        amountToMinus = float2DecimalPoints(amountToMinus)
        // console.log(typeof balanceUsdtInner, balanceUsdtInner);
        // console.log(typeof amountToMinus, amountToMinus);

        var newAmountAvail = balanceUsdtInner-amountToMinus;

        // console.log(typeof newAmountAvail, newAmountAvail);

        $("#available_amount_container").html(newAmountAvail+" USDT");
    }

    function addToAmountAvailable(amountToAdd){
        balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        amountToAdd = float2DecimalPoints(amountToAdd)
        // console.log(typeof balanceUsdtInner, balanceUsdtInner);
        // console.log(typeof amountToMinus, amountToMinus);

        var newAmountAvail = balanceUsdtInner+amountToAdd;

        // console.log(typeof newAmountAvail, newAmountAvail);

        $("#available_amount_container").html(newAmountAvail+" USDT");
    }

    function cancelPosition(id,element,amount){
        var res = ajaxPostLink('userWallet/future/cancelRiseFallPosition',{
            'id':id
        });

        addToAmountAvailable(amount)

        $(element).parent('td').parent('tr').remove();

        if ($("#positions_container tr").length == 0) {
            $("#positions_container").append(
                '<tr class="text-center text-danger" id="no_position_flag_container">'+
                   '<td colspan="5"><b>No positions opened</b></td>'+
                '</tr>'
            ); 
        }

        $.toast({
            heading: '<h6>Success</h6>',
            text: 'Canceled Position',
            showHideTransition: 'slide',
            icon: 'success',
            position: 'bottom-center'
        })
    }
</script>
