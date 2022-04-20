<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Store</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Ae1RO9QQfdAmJZrIxgXzcETFNsdWxQj7LBAx8XCbA8JJ4mnwgyWvq9q7A5fVn_5m9NP9kQ3c2XwACrhr&disable-funding=credit"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../assets/js/common.js"></script>

    <script src="../assets/vendor/jquery/jquery.validate.min.js"></script>

    <script src="../assets/vendor/jquery-toast-plugin-master/src/jquery.toast.js"></script>
    <link href="../assets/vendor/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">
</head>
<body>

    <style type="text/css">
        .disabledDiv{
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 10000;
        }

        .disabledDiv h1{
            font-weight: bold;
            text-align: center;
            margin-top: 8%;
            color: white;
        }

        #paypal-button-container{
            position: relative;
            width: 50%;
            padding: 2px;
        }
    </style>

    <form id="mainForm">
        <label>Please select token</label>
        <select id="token_select" name="token_select">
            <option>BNB</option>
            <option>USDT</option>
            <option>TRX</option>
        </select>

        <label>Amount</label>
        <input type="number" name="amount" id="amount">

        <button type="submit">Confirm Pricing</button>
    </form>

    <br>

    <div>
        <div>
            <b>Current Token Price:</b>
            <span id="tokenPrice_container"></span>
        </div>

        <div>
            <b>Total Amount:</b>
            <span id="totalAmount_container"></span>
        </div>
    </div>

    <br>

    <div class="danger">Note: Confirm price every 5 seconds to proceed to payment</div>

    <div id="paypal-button-container">
        <!-- <div class="disabledDiv"><h2>Confirm price again</h2></div> -->
    </div>

    <script>
        var trxValueNow;
        var usdtValueNow;
        var bnbValueNow;

        $("#mainForm").validate({
            errorClass: 'is-invalid text-danger',
            rules:{
                token_select: "required",
                amount: "required"
            },
            submitHandler: function(form){
                // var data = $('#mainForm').serializeArray();
                // console.log(data);   

                var token_select = $("#token_select").val();
                var amountTotal = parseFloat($("#amount").val());

                if (token_select == 'TRX') {
                    token_select = ajaxShortLinkNoParse('https://min-api.cryptocompare.com/data/price?fsym=TRX&tsyms=USD')["USD"];
                }else if (token_select == 'BNB') {
                    token_select = ajaxShortLinkNoParse('https://min-api.cryptocompare.com/data/price?fsym=BNB&tsyms=USD')["USD"];
                }else if (token_select == 'USDT'){
                    token_select = ajaxShortLinkNoParse('https://min-api.cryptocompare.com/data/price?fsym=USDT&tsyms=USD')["USD"];
                }

                var amountTotal = parseFloat((token_select*amountTotal).toFixed(2));
                console.log(amountTotal);

                $("#tokenPrice_container").text(token_select);
                $("#totalAmount_container").text(amountTotal);

                $("#paypal-button-container").empty();

                paypal.Buttons({
                    env: 'sandbox', // sandbox | production
                    // Specify the style of the button
                    style: {
                        label: 'pay',
                        size:  'small',    // small | medium | large | responsive
                        shape: 'pill',     // pill | rect
                        color: 'blue'      // gold | blue | silver | black
                    },
                    createOrder: function(data, actions){
                        
                        clearInterval(confirmPriceTimer);
                        
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: amountTotal
                                }
                            }],
                            "application_context" : { 
                                 "shipping_preference":"NO_SHIPPING"
                            }
                        })
                    },
                    onApprove: function(data, actions){
                        console.log('Data :' + data);
                        console.log('Action : '+actions);
                        return actions.order.capture().then(function(details){
                            console.log(details);
                        })
                    },
                    onCancel: function(data, actions) {
                        clearInterval(confirmPriceTimer);

                        console.log(data, actions)
                        var confirmPriceTimer = setTimeout(function() {
                            $("#paypal-button-container").append('<div class="disabledDiv"><h1>Confirm price again</h2></div>');
                        }, 5000);
                    }
                }).render('#paypal-button-container');

                var confirmPriceTimer = setTimeout(function() {
                    $("#paypal-button-container").append('<div class="disabledDiv"><h1>Confirm price again</h2></div>');
                }, 5000);
            }
        });

    </script>
    
</body>
</html>