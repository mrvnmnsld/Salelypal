<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<style type="text/css">
    table{
        overflow-x:auto;
    }

    .btn-group-vertical>.btn.active, .btn-group-vertical>.btn:active, .btn-group-vertical>.btn:focus, .btn-group>.btn.active, .btn-group>.btn:active, .btn-group>.btn:focus {
        z-index: 0;
    }

    /*.bootstrap-select.btn-group .dropdown-menu li a:hover {
         color: whitesmoke !important;
         background: #bf5279 !important;
     }*/

     .btn .dropdown-toggle .btn-light{
        color: whitesmoke !important;
        background: #bf5279 !important;
     }

</style>
<!-- 
<div class="text-danger p-2" id="testNotes">
    <b>Testing Mode:</b>
    <br>
    USDT Won/lose wont be sent until testing mode is turned on.
    To reset available amount, go to home and redirect to this page again.
    <br><br>
    Other USDT Token Pair will be added once testing mode is completed
</div> -->

<div id="innerContainer">
    <div class="main-color-text p-1" style="">

        <div class="p-2 main-color-text">
            <label>Select Token Pair: </label>
            <select id="token_pair_select" style=";" class="p-2 form-control main-card-ui main-color-text">
                <option>BTC/USDT</option>
                <option>ETH/USDT</option>
                <option>XRP/USDT</option>
                <option>BNB/USDT</option>
                <option>DOGE/USDT</option>
                <option>TRX/USDT</option>
            </select>

            <div id="changeContainer">
                <span class="h5" id="token_pair_value_container"></span>

                <small id="token_pair_value_percentage_container"></small>
                <small>24 Hour change</small>
            </div>
        </div>

        <div class="tradingview-widget-container">
          <div id="tradingview" style="height: 400px;"></div>
        </div>

        <div class="d-flex justify-content-center pt-1 mb-2 mt-2">
            <button class="btn btn-success col-md" id="buy_long_btn">
                <img style="width:25px;" src="assets/imgs/icons/growth-graph.png">
                Buy Long
            </button>

            <button class="btn btn-danger col-md ml-1" id="buy_short_btn">
                <img style="width:25px;" src="assets/imgs/icons/graph.png">
                Buy Short
            </button>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        font-size:1.5em;
        opacity: 1 !important;
        -webkit-transition: color 1s, font-size .25s;
        -moz-transition: color 1s, font-size .25s;
        -o-transition: color 1s, font-size .25s;
        transition: color 1s, font-size .25s;

        border-color: transparent;
        background-color:transparent;
        /* LIGHTMODE_ */
        /* color: #3a189f!important;  */
        /* DARKMODE_ */
        /* color: white !important;  */
    }

    #future_history_container a{
        /* color: #94abef; */
        opacity: .5;
        -webkit-transition: color 2s, font-size .25s;
        -moz-transition: color 2s, font-size .25s;
        -o-transition: color 2s, font-size .25s;
        transition: color 2s, font-size .25s;
    }
</style>

<div id="future_history_container">
    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a class="nav-link active main-color-link" aria-current="page" data-toggle="tab" href="#future_history_tab_btn">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link main-color-link" data-toggle="tab" href="#future_instructions_tab_btn">Instructions</a>
      </li>
    </ul>

    <div class="tab-content">
        <div id="future_history_tab_btn" class="tab-pane active text-muted">
            <div class="card main-card-ui p-2 rounded shadow-lg">
                <div class="d-flex">
                    <div class="text-center p-2 mt-2">
                        <div class="flex-fill p-2">
                            <h5>Today's Earnings:</h5>
                            <span id="todaysEarningLongShort">
                                0 USD
                            </span>
                        </div>
                    </div>

                    <div class="text-center p-2 mt-2">
                        <div class="flex-fill p-2">
                            <h5>All Time Earnings:</h5>
                            <span id="allTimeEarningsLongShort">
                                0 USD
                            </span>
                        </div>
                    </div>
                </div>
                
                <table id="tableContainer" class="" style="font-size: 11px;width: 100%;" cellpadding="0"> 
                    <thead>
                        <tr>
                            <th scope="col">Risk Taken</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Risk Price</th>
                            <th scope="col">Resolved Price</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>

        <div id="future_instructions_tab_btn" class="tab-pane fade p-2 main-color-text">
          <span>
              1. Select token value prediction.<br>
              2. Select Time limit of prediction.<br>
              3. Input amount to be staked.<br>
              4. Wait for time to be resolved.<br>
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
    $('#token_pair_select').val(tokenPairArray.tokenPairDescription);

    //setChart
        setTimeout(function() {
            if($("#tradingview").length == 1){
                new TradingView.widget({
                    "autosize": true,
                    // "symbol": "BINANCE:ETHUSDT",
                    "symbol": tokenPairArray.tokenPairID,
                    "interval": "1",
                    "timezone": Intl.DateTimeFormat().resolvedOptions().timeZone,
                    "theme": chartTheme,
                    "style": "1",
                    "locale": "en",
                    "toolbar_bg": "#f1f3f6",
                    "enable_publishing": false,
                    "save_image": false,
                    "container_id": "tradingview"
                });
            }

            // continuous
                tokenPriceInterval = setInterval(function() {
                    tokenPriceBinanceLastPrice = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).lastPrice).toFixed(2);
                    var ethPriceBinancePriceChangePercent = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).priceChangePercent).toFixed(2);
                    var signContainer;

                    if(ethPriceBinancePriceChangePercent.includes("-")){
                        $("#changeContainer").removeClass('text-success');
                        $("#changeContainer").addClass('text-danger');
                        signContainer = "";

                    }else{
                        $("#changeContainer").addClass('text-success');
                        $("#changeContainer").removeClass('text-danger');
                        signContainer = "+";
                    }

                    $("#token_pair_value_container").html(tokenPriceBinanceLastPrice);
                    $("#token_pair_value_percentage_container").html(signContainer+ethPriceBinancePriceChangePercent);
                }, 1000);
            // continuous

        }, 2000);
    //setChart

    var customRiskArray = [];

    //callBackEnd
        reloadPositions()
    //callBackEnd

    // buy
        $("#buy_long_btn").on("click", function(){
            bootbox.alert({
                message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/future/buy_long'}),
                size: 'large',
                centerVertical: true,
                closeButton: false
            });
        });

        $("#buy_short_btn").on("click", function(){
            bootbox.alert({
                message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/future/buy_short'}),
                size: 'large',
                centerVertical: true,
                closeButton: false
            });
        });
    // buy

    $('#token_pair_select').change(function(){
        var selectedPair = $(this).val();
        var location;

        if(selectedPair=='BTC/USDT'){
            tokenPairArray = {
                'tokenPairID':'BTCUSDT',
                'tokenPairDescription':'BTC/USDT'
            }
        }

        if(selectedPair=='ETH/USDT'){

            tokenPairArray = {
                'tokenPairID':'ETHUSDT',
                'tokenPairDescription':'ETH/USDT'
            }
        }

        if(selectedPair=='XRP/USDT'){
            tokenPairArray = {
                'tokenPairID':'XRPUSDT',
                'tokenPairDescription':'XRP/USDT'
            }
        }

        if(selectedPair=='BNB/USDT'){
            tokenPairArray = {
                'tokenPairID':'BNBUSDT',
                'tokenPairDescription':'BNB/USDT'
            }
        }

        if(selectedPair=='DOGE/USDT'){
            tokenPairArray = {
                'tokenPairID':'DOGEUSDT',
                'tokenPairDescription':'DOGE/USDT'
            }
        }

        if(selectedPair=='TRX/USDT'){
            tokenPairArray = {
                'tokenPairID':'TRXUSDT',
                'tokenPairDescription':'TRX/USDT'
            }
        }

        clearInterval(tokenPriceInterval);

        $("#container").empty();
        $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/future'}));
    });

    function reloadPositions(){
        // closed

            $("#positions_closed_container").empty();

            var positionsClosed = ajaxShortLink(
                "test-account/future/getClosedPositions",
                {
                    'userID':currentUser.userID,
                    'tradePair':tokenPairArray.tokenPairDescription
                }
            );

            loadDatatable('',positionsClosed);

            var date = new Date();

            var year = date.getFullYear();
            var month = String(date.getMonth() + 1);
            var day = String(date.getDate());
            var joined = [month,day,year,].join('/');

            var earnings = ajaxShortLink("test-account/future/getEarnings",{
                'userID':currentUser.userID,
                'date':joined
            });

            console.log(earnings[0],parseFloat(earnings[0])>=1);

            if (parseFloat(earnings[0])>=1) {
                console.log("HERE");
                $("#todaysEarningLongShort").addClass("text-success").removeClass("text-danger").text("+"+earnings[0]+" USD");
            }else{
                $("#todaysEarningLongShort").addClass("text-danger").removeClass("text-success").text(earnings[0]+" USD");
            }

            if (parseFloat(earnings[1])>=1) {
                $("#allTimeEarningsLongShort").addClass("text-success").removeClass("text-danger").text("+"+earnings[1]+" USD");
            }else{
                $("#allTimeEarningsLongShort").addClass("text-danger").removeClass("text-success").text(earnings[1]+" USD");
            }
        // closed
    }

    function loadDatatable(url,data){
        $('#tableContainer').DataTable().destroy();

        $('#tableContainer').DataTable({
            data: data,
            // "ordering": false,
            "bLengthChange": false,
            "bFilter": true,
            columns: [
                { data:'riskPrice'},
                { data:'amount',},
                { data:'riskPrice'},
                { data:'resolvedPrice'},
            ],
            "columnDefs": [
                // { "width": "50%", "targets": 0 },
                // { "width": "5%", "targets": 2 },
                // { "width": "5%", "targets": 3 },
                // { "width": "5%", "targets": 1 },
                // {"className": "text-center", "targets": 2}
            ],
            "autoWidth": true,
            "order": [[ 0, "desc" ]],
            // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'
        });
    }
</script>
