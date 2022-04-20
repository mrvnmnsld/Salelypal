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

    <script src="assets/vendor/html2canvas.min.js"></script>
</head>

<style type="text/css">
    html,body{margin: 0; height: 100%; overflow: hidden}

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
        z-index: 0;
    }

    #realtimeTransactionContainer{
        position: absolute;
        top: 306px;
        left: 15px;
        /*font-size: 16px;*/
        border-collapse: separate;
        border-spacing: 0 1em;
        /* background: white; */
        width: 89%;

    }

    .smalltext{
        font-size: 13px;
        /*text-align: center;*/
    }


    #tokenContainer{
        /*position: absolute;*/
        /*top: 46px;*/
        /*left: 37%;*/
        margin-top: 5px;
        font-size: 17px;
        width: 100%;
        /*border: 1px solid;*/
        background: white;
    }

    
    #bottomTokenValue{
        position: absolute;
        bottom: 85px;
        left: 0px;
        font-size: 12px;
        width: 100%;
        /*border: 1px solid;*/
        background: white;
    }

    .fa.withdraw, .fa.receive{
        transform: rotate(45deg);
        font-size: 20px;
    }

    #tokensContainer{
        overflow-y: auto;
        min-height: 100%;
        min-width: 102.2%;
        max-height: 570px;
    }

    .text-muted{
        color: #9e9e9e!important;
    }

    .text-success{
        color: #25beb9!important;
    }

    .tokenIcon{
        width: 38px;
        height: 38px;
    }

    .bordertest{
        border: 1px solid;
    } 

    #totalValueContainer{
        position: absolute;
        top: 130px;
        left: 47px;
            /* letter-spacing: -1px;*/
    }

    #bigValueContainer{
        font-size: 32px;
    }

    #mainTimeContainer{
        color: black;
        position: absolute;
        top: 10px;
    }
</style>

<body>
    <div class="row" style="height: 100%!important;">
        <div class="bg-danger col-md">
            <div>
                <div class="h1 p-2 text-center"> 
                    Edit Wallets
                </div>

                <a class="d-none" href="assets/bitkeep/Screencapture.jpeg" id="downloadPhone" download>Downlad</a>

                <div class="p-5">
                    <form autocomplete="off">
                        <button class="btn btn-success m-1" type="button" id="addToken_btn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add Coin Type/添加币种
                        </button>

                        <button class="btn btn-warning m-1" type="button" id="removeToken_btn">
                            <i class="fa fa-times" aria-hidden="true"></i> Remove Last Coin Type/删除最后添加币种
                        </button>

                        <button class="btn btn-primary m-1" type="button" onClick="window.location.reload();">
                            <i class="fa fa-times" aria-hidden="true"></i> Reset/重设
                        </button>

                        <!-- <button class="btn btn-success" type="button" id="saveConfig_btn">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Config
                        </button>

                        <button class="btn btn-primary" type="button" id="loadConfig_btn">
                            <i class="fa fa-file-o" aria-hidden="true"></i> Load Config
                        </button> -->

                        <button class="btn btn-success m-1" type="button" onclick="doCapture();">
                            <i class="fa fa-camera-retro" aria-hidden="true"></i> Save image/保存图片
                        </button>

                        <input type="file" id="loadConfig_file" class="d-none" accept="application/JSON">

                        <div class="row mt-2">
                            <div class="col-md">
                                <div class="form-group col-md text-light">
                                    <label for="exampleInputEmail1">Top bar time/手机时间:</label>
                                    <input type="text" value="00:00" class="form-control" id="mainTime" name="mainTime" placeholder="Pick hour and minute">
                                </div>
                            </div>
                        </div>                    
                        
                        <div id="tokensContainer" class="p-3 text-light">
                            <div id="token_1" class="p-2 border border-light m-2 rounded">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Token/货币类型</label>
                                    <select class="form-control" id="tokenSelect_1"> 
                                        <option>BNB</option>
                                        <option>USDT(TRX)</option>
                                        <option>USDT(BSC)</option>
                                        <option>TRX</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Amount/金额</label>
                                    <input type="text" value="1" onkeypress="return IsNumeric(event);" class="form-control" id="amountInput_1" name="amountInput_1" aria-describedby="emailHelp" placeholder="Enter Amount">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dollar Amount Rate/当前bitkeep钱包汇率</label>
                                    <input type="text" value="1" onkeypress="return IsNumeric(event);" class="form-control" id="valueInput_1" name="valueInput_1" placeholder="Enter amount">
                                </div>   

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Amount Decimal Point/金额小数点</label>
                                    <input type="number" min="0" value="2"  class="form-control" id="decimalCounter_1" name="decimalCounter_1" placeholder="Enter How Many Decimal Points">
                                </div>    

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Rate Decimal Point/汇率小数点</label>
                                    <input type="number" min="0" value="2"  class="form-control" id="tokenAmountDecimalCounter_1" name="tokenAmountDecimalCounter_1" placeholder="Enter How Many Decimal Points">
                                </div>                    
                            </div>
                        </div>

                        <hr class="bg-light">

                        <button type="button" class="btn btn-primary btn-block" id="load_btn">Load</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-warning col-md">
            <div class="h1 p-2 text-center"> 
                Wallet View
            </div>

            <div class="phone pt-2 pl-2" style="position: relative;" id="phone">
                <div id="mainTimeContainer" class="font-weight-bold ml-4" 
                    style="
                        margin-top: -3px;
                        z-index: 1;
                    "
                >
                    00:00
                </div>

                <div id="backgroundContainer">
                    <img src="assets/imgs/Bitkeep page 1.jpg" / style="width: 100%;height: 90%;">
                </div>

                <div id="totalValueContainer" class="text-light">
                    <span" style="margin-left: -10px;">$</span>
                    <span id="bigValueContainer" style="margin-left: -2px;">1</span>
                    <span id="smallValueContainer" style="margin-left: -5px;">.00</span>
                </div>


                <div id="realtimeTransactionContainer">
                    <div id="tokenRealTime_1" class="mb-3">
                        <table width="105%%" border="0">
                            <tr>
                                <td width="1%">
                                    <img class="tokenIcon" src="assets/imgs/icons/bsc_logo.png" class="">
                                    <!-- <img class="tokenIcon" src="https://coin.top/production/logo/trx.png" class=""> -->
                                </td>

                                <td width="30%" class="font-weight-bold">
                                    <div style="font-size:15.5px;">BNB</div>
                                    <div class="text-muted smalltext">$1.00</div>
                                </td>

                                <td width="20%" class="font-weight-bold text-right">
                                    <div style="font-size:16px;" class="text-right">1.00</div>
                                    <div class="text-muted smalltext">$1.00</div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var tokenCounter = 1;
    $('label').addClass('text-light');

    $('#time_1').clockpicker({
        autoclose: true
    });

    $('#mainTime').clockpicker({
        autoclose: true
    });

    $("#amountInput_1").on('change',function(){
        var value = numberWithCommas($(this).val());
        $("#amountInput_1").val(value)

        console.log(value)
    })

    $("#valueInput_1").on('change',function(){
        var value = numberWithCommas($(this).val());
        $("#valueInput_1").val(value)

        console.log(value);
    })

    $("#addToken_btn").on('click',function(){
        tokenCounter = tokenCounter + 1;
        console.log(tokenCounter);

        if (tokenCounter<=10) {
            $("#tokensContainer").append(
                '<div id="token_'+tokenCounter+'" class="p-2 border border-light m-2 rounded">'+
                    '<div class="form-group">'+
                        '<label for="exampleInputPassword1">Token/货币类型</label>'+
                        '<select class="form-control" id="tokenSelect_'+tokenCounter+'"> '+
                            '<option>BNB</option>'+
                            '<option>USDT(TRX)</option>'+
                            '<option>USDT(BSC)</option>'+
                            '<option>TRX</option>'+
                        '</select>'+
                    '</div>'+

                    '<div class="form-group">'+
                        '<label for="exampleInputPassword1">Amount/金额</label>'+
                        '<input type="text" value="" class="form-control" id="amountInput_'+tokenCounter+'" name="amountInput_'+tokenCounter+'" aria-describedby="emailHelp" placeholder="Enter Amount">'+
                    '</div>'+  

                    '<div class="form-group">'+
                        '<label for="exampleInputPassword1">Dollar Amount Rate/当前bitkeep钱包汇率</label>'+
                        '<input type="text" value="1" onkeypress="return IsNumeric(event);" class="form-control" id="valueInput_'+tokenCounter+'" name="valueInput_'+tokenCounter+'" placeholder="Enter amount">'+
                    '</div>'+  

                    '<div class="form-group">'+
                        '<label for="exampleInputPassword1">Amount Decimal Point/金额小数点</label>'+
                        '<input type="number" min="2" value="2"  class="form-control" id="decimalCounter_'+tokenCounter+'" name="decimalCounter_'+tokenCounter+'" placeholder="Enter How Many Decimal Points">'+
                    '</div>'+    

                    '<div class="form-group">'+
                        '<label for="exampleInputPassword1">Rate Decimal Point/汇率小数点</label>'+
                        '<input type="number" min="0" value="0"  class="form-control" id="tokenAmountDecimalCounter_'+tokenCounter+'" name="tokenAmountDecimalCounter_'+tokenCounter+'" placeholder="Enter How Many Decimal Points">'+
                    '</div> '+  
                '</div>'
            );

            $("#amountInput_"+tokenCounter).on('change',function(){
                var value = numberWithCommas($(this).val());
                $("#amountInput_"+tokenCounter).val(value)

                console.log(value)
            })

            $("#valueInput_"+tokenCounter).on('change',function(){
                var value = numberWithCommas($(this).val());
                $("#valueInput_"+tokenCounter).val(value)

                console.log(value);
            })
        }else{
            tokenCounter = tokenCounter - 1;
            alert("10 is the limit for transactions");
        }
    });

    $("#removeToken_btn").on('click',function(){
        if (tokenCounter>=2) {
            $('#token_'+tokenCounter).remove();
            tokenCounter = tokenCounter - 1
        }else{
            alert("cant go lower than 1")
        }
    });

    $("#load_btn").on('click',function(){
        $('#mainTimeContainer').text($('#mainTime').val());
        $('#realtimeTransactionContainer').empty();
        var totalAmount = 0;

        for (var i = 1; i <= tokenCounter; i++) {
            var tokenSelect = $('#tokenSelect_'+i).val();
            var decimalCounter = $('#decimalCounter_'+i).val();
            var tokenAmountDecimalCounter = $('#tokenAmountDecimalCounter_'+i).val();
            var valueInput = parseFloat($('#valueInput_'+i).val().replace(/,/g, '')).toFixed(tokenAmountDecimalCounter);    
            var amountInput = parseFloat($('#amountInput_'+i).val().replace(/,/g, '')).toFixed(decimalCounter);
            var amountValue =  (amountInput * valueInput).toFixed(decimalCounter);   

            console.log(tokenAmountDecimalCounter);

            var imageSrc;

            if (tokenSelect == "USDT(TRX)") {
                imageSrc = 'assets/imgs/icons/USDT_TRX.png';
            }else if (tokenSelect == "USDT(BSC)") {
                imageSrc = 'assets/imgs/icons/USDT_BSC.png';
            }else if (tokenSelect == "BNB") {
                imageSrc = 'assets/imgs/icons/bsc_logo.png';
            }else if (tokenSelect == "TRX"){
                imageSrc = 'assets/imgs/icons/trx_logo1.png';
                
            }
            
            $('#realtimeTransactionContainer').append(
                '<div id="tokenRealTime_1'+i+'" class="mb-3">'+
                    '<table width="105%">'+
                        '<tr>'+
                            '<td width="1%">'+
                                '<img class="tokenIcon" src="'+imageSrc+'" class="">'+
                            '</td>'+

                            '<td width="30%" class="font-weight-bold">'+
                                '<div style="font-size:15.5px;">'+tokenSelect+'</div>'+
                                '<div class="text-muted smalltext">$'+numberWithCommas(valueInput)+'</div>'+
                            '</td>'+

                            '<td width="20%" class="font-weight-bold text-right">'+
                                '<div style="font-size:16px;" class="text-right">'+numberWithCommas(amountInput)+'</div>'+
                                '<div class="text-muted smalltext">$'+numberWithCommas(amountValue)+'</div>'+
                            '</td>'+
                        '</tr>'+
                    '</table>'+

                '</div>'
            );

            totalAmount = parseFloat(totalAmount)+parseFloat(amountValue); 
        }
        totalAmount = parseFloat(totalAmount).toFixed(2).toString().split(".")

        $('#bigValueContainer').text(numberWithCommas(totalAmount[0]))
        $('#smallValueContainer').text('.'+totalAmount[1])        
    });

    $("#saveConfig_btn").on('click',function(){
        var saveJsonContainer = new Object();
        var outerContainer = new Object();

        saveJsonContainer['isConfig'] = true;

        for (var i = 1; i <= tokenCounter; i++) {
            var innerContainer = new Object;

            var tokenSelect = $('#tokenSelect_'+i).val();
            var decimalCounter = $('#decimalCounter_'+i).val();
            var tokenAmountDecimalCounter = $('#tokenAmountDecimalCounter_'+i).val();
            var valueInput = parseFloat($('#valueInput_'+i).val().replace(/,/g, ''));    
            var amountInput = parseFloat($('#amountInput_'+i).val().replace(/,/g, ''));

            innerContainer['tokenSelect'] = tokenSelect;
            innerContainer['decimalCounter'] = decimalCounter;
            innerContainer['tokenAmountDecimalCounter'] = tokenAmountDecimalCounter;
            innerContainer['valueInput'] = valueInput;
            innerContainer['amountInput'] = amountInput;

            outerContainer[i] = innerContainer;

        }

        saveJsonContainer['result'] = outerContainer;

        let dataStr = JSON.stringify(saveJsonContainer);

        let dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);

        let exportFileDefaultName = getDateFormated()+'_config.json';

        let linkElement = document.createElement('a');
        linkElement.setAttribute('href', dataUri);
        linkElement.setAttribute('download', exportFileDefaultName);
        linkElement.click();
    });

    $("#loadConfig_btn").on('click',function(){
        $('#loadConfig_file').click();
    });

    document.getElementById('loadConfig_file').addEventListener('change', onChange);

    function onChange(event) {
        var reader = new FileReader();
        reader.onload = onReaderLoad;
        reader.readAsText(event.target.files[0]);
    }

    function onReaderLoad(event){
        var jsonReader = JSON.parse(event.target.result)
        // console.log(jsonReader.isConfig);

        if (!jsonReader.isConfig) {
            alert("JSON Format is not valid. Please make sure that you exported a JSON from save config function");
        }else{
            var resultJson = jsonReader['result'];
            var resultKeys = Object.keys(resultJson);
            
            for (var i = 0; i < resultKeys.length; i++) {
                console.log(i+1);

                if(i!=0){
                    $("#addToken_btn").click();
                }

                $('#tokenSelect_'+(i+1)).val(resultJson[resultKeys[i]].tokenSelect)
                $('#amountInput_'+(i+1)).val(resultJson[resultKeys[i]].amountInput)
                $('#valueInput_'+(i+1)).val(resultJson[resultKeys[i]].valueInput)
                $('#decimalCounter_'+(i+1)).val(resultJson[resultKeys[i]].decimalCounter)
                $('#tokenAmountDecimalCounter_'+(i+1)).val(resultJson[resultKeys[i]].tokenAmountDecimalCounter)
                

            }

            $("#load_btn").click();
            
        }
    }
    
    function numberWithCommas(numb) {
        var str = numb.toString().split(".");
        str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return str.join(".");
    }

    function IsNumeric(evt){
        // var charCode = (evt.which) ? evt.which : event.keyCode
        // if (charCode > 31 && (charCode < 48 || charCode > 57))
        // return false;

        return true;
    }

    function countDecimals(value) {
        if(Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0; 
    }

    function onChange(event) {
        var reader = new FileReader();
        reader.onload = onReaderLoad;
        reader.readAsText(event.target.files[0]);
    }

    function doCapture() {
        // Move the scroll on top of page
        window.scrollTo(0, 0);
        
           // Convert the div to image (canvas)
           html2canvas(document.getElementById("phone")).then(function (canvas) {
        
               // Get the image data as JPEG and 0.9 quality (0.0 - 1.0)
               // console.log(canvas.toDataURL("image/jpeg", 0.9)); 
                var ajax = new XMLHttpRequest();
                ajax.open("POST", "phoneToPng", true);
                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9));
        
               // Receiving response from server
               // This function will be called multiple times
               ajax.onreadystatechange = function () {
        
                   // Check when the requested is completed
                   if (this.readyState == 4 && this.status == 200) {
        
                       // Displaying response from server
                       console.log(this.responseText);

                       $('#downloadPhone').get(0).click();
                       // $('#downloadPhone').click();
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
