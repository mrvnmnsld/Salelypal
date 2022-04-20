<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bitkeep</title>
    <link rel="icon" type="image/png" href="assets/imgs/logo_main_no_text.png"/>

    <script src="assets/js/common.js"></script>
    <script src="assets/js/admin/common.js"></script>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootbox/bootbox.min.js"></script>
    <script src="assets/vendor/jquery-confirm/confirm.js"></script>
    <link href="assets/vendor/jquery-confirm/confirm.css" rel="stylesheet">

    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/568e202d1f.js"></script>


    <link href="assets/vendor/clockpicker-gh-pages/src/clockpicker.css" rel="stylesheet">
    <script src="assets/vendor/clockpicker-gh-pages/src/clockpicker.js"></script>

    <script src=
    "https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js">
      </script>

</head>

<style type="text/css">
    html,body{margin: 0; height: 100%; overflow: hidden;position: relative;}

    .phone{
        margin-left: 27%;
        /*background-image: url('assets/imgs/Bitkeep page 1.jpg');*/
        -webkit-backface-visibility: hidden;
            -ms-transform: translateZ(0); /* IE 9 */
            -webkit-transform: translateZ(0); /* Chrome, Safari, Opera */
            transform: translateZ(0);
        /*background-repeat:no-repeat;*/
        /*background-attachment: fixed;*/
        /*background-size:cover;*/
        /*background: url('assets/imgs/phone_bg.png') no-repeat center center fixed; */
          /*-webkit-background-size: cover;*/
          /*-moz-background-size: cover;*/
          /*-o-background-size: cover;*/
          /*background-size: cover;*/
          background-size:100% 100%;
        height: 90%;
        width: 45%;
        /*border: 1px solid;*/
    }

    #backgroundContainer{
        image-rendering: -moz-crisp-edges; /* Firefox */
        image-rendering: -o-crisp-edges; /* Opera */
        image-rendering: -webkit-optimize-contrast; /* Webkit (non-standard naming) */
        image-rendering: crisp-edges;
        -ms-interpolation-mode: nearest-neighbor; /* IE (non-standard property) */
        -webkit-backface-visibility: hidden;
        -ms-transform: translateZ(0); /* IE 9 */
        -webkit-transform: translateZ(0); /* Chrome, Safari, Opera */
        transform: translateZ(0);
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 1;
    }


    #realtimeTransactionContainer{
        border-collapse:separate; 
        border-spacing: 0 0.5em;
        z-index: 9999;
        position: absolute;
        top: 145px;
        left: 13px;
        font-size: 15px;
        border-spacing: 0 0.5em
        border-collapse: separate;
    }

    .smalltext{
        font-size: 14px!important;
    }

    td div b{
        font-size: 15px!important;
    }


    #tokenContainer{
        position: absolute;
        top: 33px;
        left: 88px;
        margin-top: 5px;
        font-size: 17px;
        width: 58%;
        /*border: 1px solid;*/
        background: white;
        z-index: 9999888;
    }

    
    #bottomTokenValue{
        position: absolute;
        bottom: 10.7%;
        left: 0px;
        font-size: 13px;
        width: 98%;
        font-weight: bold;
        z-index: 9999;
        background-image: url('assets/imgs/testbg.png');
        /*background-repeat:no-repeat;*/
        /*background-attachment: fixed;*/
        background-size: 100% 100%;
    }

    .withdraw{
        font-size: 16px;
        /*position: absolute;*/
        top: 19px;
        margin-top: 5px;
    }

    .receive{
        font-size: 16px;
        margin-left: 0px;
        padding-top: -1px;
    }

    #transactionContainer{
        overflow-y: auto;
        min-height: 100%;
        margin-top: 15px;
        min-width: 102.2%;
        max-height: 640px
    }

    .text-muted{
        color: #9e9e9e!important;
    }

    .text-success{
        color: #25beb9!important;
    }

    #mainTimeContainer{
        color: black;
        position: absolute;
        top: 0.7%;
        z-index: 9999;
        left: 7%;
    }
</style>

<body>
    <div class="row" style="height: 100%!important;">
        <div class="bg-light col-md">
            <div>
                <div class="h1 text-center"> 
                    Edit Transactions
                </div>

                <div class="p-2 pt-1">
                    <form autocomplete="off">
                        <button class="btn btn-success" type="button" id="addTrasaction_btn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add Coin Type/添加交易
                        </button>

                        <button class="btn btn-warning" type="button" id="removeTrasaction_btn">
                            <i class="fa fa-times" aria-hidden="true"></i> Remove Last Transaction/删除最后添加交易
                        </button>

                        <button class="btn btn-primary" type="button" onClick="window.location.reload();">
                            <i class="fa fa-times" aria-hidden="true"></i> Reset/重设
                        </button>

                        <button class="btn btn-success m-1" type="button" onclick="doCapture();">
                            <i class="fa fa-camera-retro" aria-hidden="true"></i> Save image/保存图片
                        </button>

                        <a class="d-none" href="assets/bitkeep/Screencapture.jpeg" id="downloadPhone" download>Downlad</a>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group form-control-sm col-sm">
                                    <label for="exampleInputEmail1">Top Bar Time/手机时间</label>
                                    <input type="text" value="12:12" class="form-control form-control-sm" id="mainTime" name="mainTime" placeholder="Pick hour and minute">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group form-control-sm col-sm">
                                    <label for="exampleInputEmail1">Token/货币类型:</label>
                                    <select class="form-control form-control-sm" id="tokenSelect"> 
                                        <option>USDT(BSC)</option>
                                        <option>USDT(TRON)</option>
                                        <option>BNB(BSC)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm">
                                <div class="form-group form-control-sm col-sm">
                                    <label for="exampleInputEmail1">New exchange rate/bitkeep钱包汇率</label>
                                    <input type="number" value="1" min="1" class="form-control form-control-sm" id="conversionInput" name="conversionInput" placeholder="Input token conversion">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group form-control-sm col-sm">
                                    <label for="exampleInputEmail1">Change Percentage/涨跌%</label>
                                    <input type="number" class="form-control form-control-sm" value="0.00" id="changeInput" name="changeInput" placeholder="Input token value change ">
                                </div>
                            </div>
                        </div>
                    

                        <div id="transactionContainer" class="p-2">
                            <div id="transaction_1" class="rounded border border-dark pl-2 mt-1 pr-2">
                                <b>Transaction #1</b>

                                <div class="row pl-2 pr-2">
                                    <div class="form-group form-control-sm col-sm">
                                        <label for="exampleInputEmail1">Time/时间</label>
                                        <input type="text" value="18:55" class="form-control form-control-sm" id="time_1" name="time_1" placeholder="Pick hour and minute">
                                    </div>

                                    <div class="form-group form-control-sm col-sm">
                                        <label for="exampleInputEmail1">Date/日期</label>
                                        <input type="date" value="" class="form-control form-control-sm" id="date_1" name="date_1" placeholder="Pick hour and minute">
                                    </div>

                                    <div class="form-group form-control-sm col-sm">
                                        <label for="exampleInputPassword1">Wallet address/钱包地址</label>
                                        <input type="text" value="0x50DF58C920Bf916BeC6219F3a22965e31a1023DC" class="form-control form-control-sm" id="walletAddress_1" name="walletAddress_1" aria-describedby="emailHelp" placeholder="Enter address">
                                    </div>

                                    <div class="form-group form-control-sm col-sm">
                                        <label for="exampleInputPassword1">Type/转账类型</label>
                                        <select class="form-control form-control-sm" id="typeSelect_1"> 
                                            <option>Receive</option>
                                            <option>Withdraw</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row pl-2 pr-2" style="margin-top:15px;">
                                    <div class="form-group form-control-sm col-sm-2">
                                        <label for="exampleInputPassword1">Amount/金额</label>
                                        <input type="number" value="0" pattern="[0-9]+" class="form-control form-control-sm" id="amountInput_1" name="amountInput_1" placeholder="Enter amount">
                                    </div>

                                    <div class="form-group form-control-sm col-sm-4">
                                        <label for="exampleInputPassword1">Amount Decimal Point/金额小数点</label>
                                        <input type="number" min="0" value="0" pattern="[0-9]+" class="form-control form-control-sm" id="amountDecimalInput_1" name="amountDecimalInput_1" placeholder="Enter amount">
                                    </div>

                                    <div class="form-group form-control-sm col-sm">
                                        <label for="exampleInputEmail1">Dollar Amount Rate/当前bitkeep钱包汇率/$</label>
                                        <input type="number" value="1" class="form-control form-control-sm" id="conversionInput_1" name="conversionInput_1" placeholder="Input token conversion">
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                   

                        <button type="button" class="btn btn-primary btn-block" id="load_btn">Load</button>
                    </form>
                </div>
            </div>   
        </div>

        <div class="bg-warning col-md">
            <div class="h1 p-2 text-center"> 
                Transactions View
            </div>

            <div class="phone pt-2 pl-2" style="position: relative;" id="phone">
                <div id="mainTimeContainer" class="font-weight-bold">12:12</div>

                <div id="tokenContainer" class="font-weight-bold text-center">
                    <span id="tokenContainerInner" class="font-weight-bold">USDT(BSC)</span><br>
                    <span class="text-muted smalltext" id="tokenSimpleContainer">
                        USDT
                    </span>
                </div>

                <div id="bottomTokenValue" class="font-weight-bold">
                    <table cellpadding="4" border="0" width="93%">
                        <tr>
                            <td width="35%" id="bottomTokenContainer" class="pl-4">USDT</td>
                            <td width="40%"><div id="bottomTokenValueContainer" class="text-success text-center">$1.00</div></td>
                            <td width="" class="text-right">
                                <span id="changeContainer" class="ml-3 pb-1 text-success">+0%</span>
                            </td>
                        </tr>
                    </table>
                </div>


                <table id="realtimeTransactionContainer" width="93.5%%" cellpadding="5" border="0">
                    <tr class="mb-2">
                        <td style="width:5%;" class="text-primary" style="position: relative;"> 
                            <div class="receive" aria-hidden="true">
                                <img src="assets/imgs/icons/turquoise arrow.png" style="width:11px;margin-left: 2.5px;">
                            </div>
                        </td>

                        <td style="width:45%">
                            <div style="margin-left: 14px;">
                                <b style="font-size:14px;">Receive &nbsp;0x50...23DC</b>
                                <br><div class="text-muted smalltext" style="margin-top:-1px!important">0000-00-00 00:00</div>
                            </div>
                            
                        </td>

                        <td class="text-right" style="margin-top: 25px;">
                            <div class="font-weight-bold text-success mt-2" style="font-size:14px;">
                                - 0
                            </div>
                        
                            <div class="text-muted smalltext" style="margin-top:-1px!important">
                                ≈$0
                            </div>
                        </td>
                    </tr>                        
                </table>

                <div id="backgroundContainer">
                    <!-- <img src="assets/imgs/WhatsApp Image 2022-01-29 at 9.29.51 PM.jpeg" / style="width: 100%;height: 90%;"> -->
                    <img src="assets/imgs/Bitkeep page 2.png" / style="width: 100%;height: 100%;">

                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var hh = String(today.getHours());
    var min = String(today.getMinutes());
    var yyyy = today.getFullYear();

    // $("#date_1").val(yyyy + '-' + mm + '-' + dd)
    $("#time_1").val('00:00');
    $("#mainTime").val('00:00');
    $("#mainTimeContainer").text('00:00');

    console.log(hh+':'+min);

    $('body').css('height', '961px');
    $('body').css('width', '1935px');

    var transactionCounter = 1;
    $('#time_1').clockpicker({
        autoclose: true
    });

    $('#mainTime').clockpicker({
        autoclose: true
    });

    if ($(document).height()<=938) {
        $('#bottomTokenValue').css('bottom','5.5vh');
    }

    $('label').addClass('text-dark');


    $("#addTrasaction_btn").on('click',function(){
        transactionCounter = transactionCounter + 1;
        // console.log(transactionCounter);

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var hh = String(today.getHours());
        var min = String(today.getMinutes());

        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        if (transactionCounter<=9) {
            $("#transactionContainer").append(
                '<div id="transaction_'+transactionCounter+'" class="rounded border border-dark pl-2 mt-1 pr-2">'+
                    '<b>Transaction #'+transactionCounter+'</b>'+

                    '<div class="row pl-2 pr-2">'+
                        '<div class="form-group form-control-sm col-sm">'+
                            '<label for="exampleInputEmail1">Time/时间</label>'+
                            '<input type="text" value="00:00" class="form-control form-control-sm" id="time_'+transactionCounter+'" name="time_'+transactionCounter+'" placeholder="Pick hour and minute">'+
                        '</div>'+

                        '<div class="form-group form-control-sm col-sm">'+
                            '<label for="exampleInputEmail1">Date/日期</label>'+
                            '<input type="date" value="'+today+'" class="form-control form-control-sm" id="date_'+transactionCounter+'" name="date_'+transactionCounter+'" placeholder="Pick hour and minute">'+
                        '</div>'+

                        '<div class="form-group form-control-sm col-sm">'+
                            '<label for="exampleInputPassword1">Wallet address/钱包地址</label>'+
                            '<input type="text" value="TCPEpnfpEjX1k6y7190a8fa719632" class="form-control form-control-sm" id="walletAddress_'+transactionCounter+'" name="walletAddress_'+transactionCounter+'" aria-describedby="emailHelp" placeholder="Enter address">'+
                        '</div>'+

                        '<div class="form-group form-control-sm col-sm">'+
                            '<label for="exampleInputPassword1">Type/转账类型</label>'+
                            '<select class="form-control form-control-sm" id="typeSelect_'+transactionCounter+'"> '+
                                '<option>Receive</option>'+
                                '<option>Withdraw</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+

                    '<div class="row pl-2 pr-2" style="margin-top:15px;">'+
                        '<div class="form-group form-control-sm col-sm-2">'+
                            '<label for="exampleInputPassword1">Amount/金额</label>'+
                            '<input type="number" value="0" pattern="[0-9]+" class="form-control form-control-sm" id="amountInput_'+transactionCounter+'" name="amountInput_'+transactionCounter+'" placeholder="Enter amount">'+
                        '</div>'+

                        '<div class="form-group form-control-sm col-sm-4">'+
                            '<label for="exampleInputPassword1">Amount Decimal Point/金额小数点</label>'+
                            '<input type="number" min="0" value="0" pattern="[0-9]+" class="form-control form-control-sm" id="amountDecimalInput_'+transactionCounter+'" name="amountDecimalInput_'+transactionCounter+'" placeholder="Enter amount">'+
                        '</div>'+

                        '<div class="form-group form-control-sm col-sm">'+
                            '<label for="exampleInputEmail1">Dollar Amount Rate/当前bitkeep钱包汇率/$</label>'+
                            '<input type="number" value="1" class="form-control form-control-sm" id="conversionInput_'+transactionCounter+'" name="conversionInput_'+transactionCounter+'" placeholder="Input token conversion">'+
                        '</div>'+
                    '</div>'+
                    '<br>'+
                '</div>'
            );

            $('#time_'+transactionCounter).clockpicker({
                autoclose: true
            });
        }else{
            transactionCounter = transactionCounter - 1;
            alert("9 is the limit for transactions");
        }
    });

    $("#removeTrasaction_btn").on('click',function(){
        if (transactionCounter>=2) {
            $('#transaction_'+transactionCounter).remove();
            transactionCounter = transactionCounter - 1
        }else{
            alert("cant go lower than 1")
        }
    });

    $("#load_btn").on('click',function(){
        var tokenSimple = $('#tokenSelect').val().substr(0, $('#tokenSelect').val().indexOf('(')); 
        var conversionInput = $("#conversionInput").val();

        $("#realtimeTransactionContainer").empty();
        $('#mainTimeContainer').text($('#mainTime').val());
        $('#tokenSimpleContainer').text(tokenSimple);
        $('#tokenContainerInner').text($('#tokenSelect').val());
        
        $('#bottomTokenContainer').text(tokenSimple);

        if(countDecimals(parseFloat(conversionInput))>=1){
            $('#bottomTokenValueContainer').text('$'+parseFloat(conversionInput).toFixed(2));
        }else{
            $('#bottomTokenValueContainer').text('$'+conversionInput);
        }

        // console.log(checkDecimalIfZero(parseFloat(conversionInput).toFixed(2)));
        

        if (parseFloat($("#changeInput").val()) <= -1) {
            $('#bottomTokenValueContainer').addClass('text-danger')
            $('#changeContainer').addClass('text-danger')

            $('#changeContainer').removeClass('text-success')
            $('#bottomTokenValueContainer').removeClass('text-success')
            $('#changeContainer').text("-"+$("#changeInput").val()+'%');
        }else{
            $('#bottomTokenValueContainer').addClass('text-success')
            $('#changeContainer').addClass('text-success')

            $('#changeContainer').removeClass('text-danger')
            $('#bottomTokenValueContainer').removeClass('text-danger')
            $('#changeContainer').text("+"+$("#changeInput").val()+'%');

        }

        // $('#mainTimeContainer').text($('#mainTime').val());
        // $("#realtimeTransactionContainer").find("tr:gt(0)").remove();

        for (var i = 1; i <= transactionCounter; i++) {
            var address = $('#walletAddress_'+i).val();
            var time = $('#time_'+i).val();
            var date = $('#date_'+i).val();
            var conversionInput = $('#conversionInput_'+i).val();
            var amount = parseFloat($('#amountInput_'+i).val());
            var amountTrue = Math.abs(parseFloat($('#amountInput_'+i).val()));
            var type = $('#typeSelect_'+i).val();
            var amountDecimalInput = parseInt($('#amountDecimalInput_'+i).val());

            var timestamp = date+' '+time;
            var isWithdraw;
            var color;
            var colorIcon;
            var isSend;
            var isNegative;
            var arrow;
            var type;

            var newAddress1 = address.substring(0, 4);
            var newAddress2 = address.substring(address.length-4,);
            var newAddress = newAddress1+'...'+newAddress2;

            // console.log(timestamp);

            if (type == "Receive") {
                arrow = 'assets/imgs/icons/turquoise arrow.png';
                color = 'text-success';
                colorIcon = 'text-success';
                isSend = 'Receive';
                type = 'receive';
                isNegative = "+ ";

            }else{
                arrow = 'assets/imgs/icons/blue arrow.png';
                isSend = 'Send';
                isNegative = "- ";
                color = 'text-dark';
                type = 'withdraw';
                colorIcon = 'text-dark';

            }

            $("#realtimeTransactionContainer").append(
                '<tr class="">'+
                    '<td style="width:5%" class="text-primary" style="position: relative;">'+
                        '<div class="'+type+'" aria-hidden="true">'+
                            '<img src="'+arrow+'" style="width:11px;margin-left: 3px;">'+
                        '</div>'+
                    '</td>'+

                    '<td style="width:45%">'+
                        '<div style="margin-left: 14px;margin-top:5px;">'+
                            '<b style="font-size:14px;">'+isSend+' &nbsp;'+newAddress+'</b>'+
                            '<br><div class="text-muted smalltext" style="margin-top:-1px!important">'+timestamp+'</div>'+
                        '</div>'+
                    '</td>'+

                    '<td class="text-right">'+
                        '<div class="font-weight-bold '+colorIcon+'" style="font-size:14px;">'+
                           isNegative+''+numberWithCommas(parseFloat(amountTrue).toFixed(amountDecimalInput))+
                        '</div>'+
                    
                        '<div class="text-muted smalltext" style="margin-top:-1px!important">'+
                            '≈ $'+numberWithCommas(parseFloat((conversionInput*amountTrue).toFixed(2)))+
                        '</div>'+
                    '</td>'+
                '</tr>'
            );
        }
    });

    function countDecimals(value) {
        if(Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0; 
    }

    function checkDecimalIfZero(string) {
        var stringArray = string.split("."); 
        var counter = 0;

        // console.log(stringArray);

        // for (var i = 0; i < stringArray.length; i++) {
        //     Things[i]
        // }
    }

    
    function numberWithCommas(numb) {
        var str = numb.toString().split(".");
        str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return str.join(".");
    }

    function doCapture() {
        // Move the scroll on top of page
        window.scrollTo(0, 0);
        
        // Convert the div to image (canvas)
        html2canvas(document.getElementById("phone")).then(function (canvas) {

            var ajax = new XMLHttpRequest();
            ajax.open("POST", "phoneToPng", true);
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9));

            ajax.onreadystatechange = function () {

               if (this.readyState == 4 && this.status == 200) {
                   // console.log(this.responseText);
                   $('#downloadPhone').get(0).click();
               }

           };
        });
    }

    var clicker = false;

    $('#downloadPhone').on('click',function(e){
        console.log("Downloading");
    });





    
</script>
</html>
