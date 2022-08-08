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

    .dark-mode .page-link {
        color: #007bff!important;
    }

    /* .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
        background-color: rgba(0, 0, 0, .10);
    } */



    .make_me_dark{
        background-color: rgba(0, 0, 0, .05);
    }

    .dataTables_filter input {
        width: 70%!important; 
    }

    .apexcharts-tooltip.apexcharts-active {
        opacity: 1;
        display: none;
        transition: 0.15s ease all;
    }
</style>

<!-- <div class="text-danger p-2" id="testNotes">
    <b>Testing Mode:</b>
    <br>
    USDT Won/lose wont be sent until testing mode is turned on.
    To reset available amount, go to home and redirect to this page again.
    <br><br>
    Other USDT Token Pair will be added once testing mode is completed
</div>
 -->

<div id="innerContainer">

    <div class="main-color-text p-1">

        <div class="p-2">
            <label>Select Token Pair: </label>
            <select id="token_pair_select" class="p-2 form-control main-card-ui main-color-text">
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
          <div id="chart" style="height: 300px;"></div>
        </div>

        <div class="d-flex justify-content-center pt-1 mb-2 mt-2">
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
</div>

<style>
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
		font-size:2em;
		opacity: 1 !important;
		-webkit-transition: color 1s, font-size .25s;
		-moz-transition: color 1s, font-size .25s;
		-o-transition: color 1s, font-size .25s;
		transition: color 1s, font-size .25s;

		border-color: transparent;
		background-color:transparent;

		padding-bottom: 5px;
		position: relative;
	}

	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active:before{
		content: "";
		position: absolute;
		width: 50%;
		height: 1px;
		bottom: 0;
		left: 25%;
		border-bottom: .2rem solid var(--minetab-color);
	}

    #risefall_history_container a{
        /* color: #94abef; */
        opacity: .5;
        -webkit-transition: color 2s, font-size .25s;
        -moz-transition: color 2s, font-size .25s;
        -o-transition: color 2s, font-size .25s;
        transition: color 2s, font-size .25s;
    }
</style>

<div id="risefall_history_container" class="my-2"> 
    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a id="history_tab_link" class="nav-link active main-color-link" aria-current="page" data-toggle="tab" href="#history_tab_btn">History</a>
      </li>
      <li class="nav-item">
        <a id="instructions_tab_link" class="nav-link main-color-link" data-toggle="tab" href="#instructions_tab_btn">Instructions</a>
      </li>
    </ul>

    <div class="tab-content">
        <div id="history_tab_btn" class=" tab-pane active text-muted my-3">
            <div class="card main-card-ui p-2 rounded shadow-lg">

                <div class="d-flex">
                    <div class="text-center p-2 mt-2">
                        <div class="flex-fill p-2">
                            <h5>Today's Earnings:</h5>
                            <span id="todaysEarningRiseFall">
                                0 USD
                            </span>
                        </div>
                    </div>

                    <div class="text-center p-2 mt-2">
                        <div class="flex-fill p-2">
                            <h5>All Time Earnings:</h5>
                            <span id="allTimeEarningsRiseFall">
                                0 USD
                            </span>
                        </div>
                    </div>
                </div>
                

                <table id="tableContainer" class="" style="font-size: 11px;width: 100%;" cellpadding="0"> 
                    <thead>
                        <tr>
                            <th scope="col">Resolve Time</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Price/Resolved</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div id="instructions_tab_btn" class="tab-pane fade p-2 main-color-text">
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


<script type="text/javascript">
    var tokenPriceBinanceLastPrice;
    var totalAmountPending = 0;
    var pendingPositionChecker;
    var tokenPriceInterval;
    var color;
    var dataBinanceOHLC = ajaxShortLinkNoParse("https://api.binance.com/api/v1/klines?symbol="+tokenPairArray.tokenPairID+"&interval=1m&limit=30")
    var dataChart = [];

    for (var i = 0; i < dataBinanceOHLC.length; i++) {
        dataChart.push({
            x:dataBinanceOHLC[i][0],
            y:[dataBinanceOHLC[i][1], dataBinanceOHLC[i][2], dataBinanceOHLC[i][3], dataBinanceOHLC[i][4]]
        });
    }

    if (chartTheme == "dark") {
        color = "#fff"
    }else{
        color = "#000"
    }

    console.log(dataChart);

    $('#token_pair_select').val(tokenPairArray.tokenPairDescription);

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
        clearInterval(chartUpdater);

        $("#container_main").empty();
        $("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/riseFall'}));
    });

    var chartUpdater = setInterval(function(){
        var dataBinanceOHLC = ajaxShortLinkNoParse("https://api.binance.com/api/v1/klines?symbol="+tokenPairArray.tokenPairID+"&interval=1m&limit=30")
        var dataChart = [];

        for (var i = 0; i < dataBinanceOHLC.length; i++) {
            dataChart.push({
                x:dataBinanceOHLC[i][0],
                y:[dataBinanceOHLC[i][1], dataBinanceOHLC[i][2], dataBinanceOHLC[i][3], dataBinanceOHLC[i][4]]
            });
        }

        console.log(dataChart);

        chart.updateOptions({
            series: [{
                data: dataChart
            }]
        })
    },60000)

    var options = {
        series: [{
            data: dataChart
        }],
        chart: {
            type: 'candlestick',
            height: 300,
            toolbar: {
                show: false
            },
            foreColor: color
        },
        title: {
            text: '',
            align: 'center'
        },
        xaxis: {
            type: 'datetime',
            show: false,
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            tooltip: {
            enabled: true,
          }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

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
        //continous

    //callBackEnd
        balanceUsdt = ajaxShortLink('userWallet/getTRC20Balance',{
            'trc20Address':currentUser.trc20_wallet,
            'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
        })['balance'];

        reloadPositions();
    //callBackEnd

    //buy
        $("#buy_rise_btn").on("click", function(){

            bootbox.alert({
                message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/riseFall/buyrise'}),
                size: 'large',
                centerVertical: true,
                closeButton: false
            });
            
        });

        $("#buy_fall_btn").on("click", function(){

            bootbox.alert({
                message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/riseFall/buyfall'}),
                size: 'large',
                centerVertical: true,
                closeButton: false
            });

        });
    //buy

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
            text: 'Canceled Position',
            showHideTransition: 'slide',
            allowToastClose: false,
            hideAfter: 5000,
            stack: 5,
            position: 'bottom-center',
            textAlign: 'center',
            loader: true,
            loaderBg: '#9EC600'
        })
    }

    function reloadPositions(){
        var timing = '';

        // closed
            var closedPositions = ajaxShortLink(
                "userWallet/future/getClosedRiseFallPositions",
                {
                    'userID':currentUser.userID,
                    'tradePair':tokenPairArray.tokenPairDescription,
                }
            );

            console.log(closedPositions);

            loadDatatable('',closedPositions);

            var date = new Date();

            var year = date.getFullYear();
            var month = String(date.getMonth() + 1);
            var day = String(date.getDate());
            var joined = [month,day,year,].join('/');


            var earnings = ajaxShortLink("userWallet/riseFall/getEarnings",{
                'userID':currentUser.userID,
                'date':joined
            });

            console.log(earnings);

            if (parseFloat(earnings[0])>0) {
                console.log("HERE");
                $("#todaysEarningRiseFall").addClass("text-success").removeClass("text-danger").text("+"+parseFloat(earnings[0]).toFixed(2)+" USD");
            }else{
                $("#todaysEarningRiseFall").addClass("text-danger").removeClass("text-success").text(parseFloat(earnings[0]).toFixed(2)+" USD");
            }

            if (parseFloat(earnings[1])>0) {
                $("#allTimeEarningsRiseFall").addClass("text-success").removeClass("text-danger").text("+"+parseFloat(earnings[1]).toFixed(2)+" USD");
            }else{
                $("#allTimeEarningsRiseFall").addClass("text-danger").removeClass("text-success").text(parseFloat(earnings[1]).toFixed(2)+" USD");
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
                { data:'timeStamp'},
                { data:'buyType',},
                { data:'amount'},
                { data:'currentPrice'},
            ],
            "columnDefs": [
                { "width": "50%", "targets": 0 },
                { "width": "5%", "targets": 2 },
                { "width": "5%", "targets": 3 },
                { "width": "5%", "targets": 1 },
                // {"className": "text-center", "targets": 2}
            ],
            "autoWidth": false,
            "order": [[ 0, "desc" ]],
            "createdRow": function( row, data, dataIndex){
                if (data['status'] == "WIN") {
                    $(row)
                    .addClass('bg-success');
                }else if (data['status'] == "LOSE"){
                    $(row).
                    addClass('bg-danger');
                }
            },
            // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'
        });
    }

var history_tab_btn = document.getElementById('history_tab_btn');
swipedetect(history_tab_btn, function(history_tab_btn_swipe){
    if (history_tab_btn_swipe =='left'){
        $('#history_tab_link').removeClass('active');
        $('#history_tab_btn').removeClass('active');
        $('#history_tab_btn').addClass('hide');

        $('#instructions_tab_link').addClass('active');
        $('#instructions_tab_btn').addClass('active');
        $('#instructions_tab_btn').addClass('show'); 
    }
});

var instructions_tab_btn = document.getElementById('instructions_tab_btn');
swipedetect(instructions_tab_btn, function(instruction_tab_btn_swipe){
if (instruction_tab_btn_swipe =='right'){
    $('#instructions_tab_link').removeClass('active');
    $('#instructions_tab_btn').removeClass('active');
    $('#instructions_tab_btn').addClass('hide');

    $('#history_tab_btn').addClass('active');
    $('#history_tab_link').addClass('active');
    $('#history_tab_btn').addClass('show'); 
}
});

</script>