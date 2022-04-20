<style>

.modal-footer{
  display: none;
}

.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #04AA6D;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #04AA6D;
  cursor: pointer;
}



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

</style>

<h4 class="text-center text-dark">Custom Risk</h4>
<!-- <p>Drag the slider to set the risk options.</p> -->

<div class="font-weight-bold text-center">Please select if percentage or by value</div>
<div class="material-switch" style="margin: auto;width: 50%;">
  <span class="mr-1">Percentage</span>
  <input id="percentage_toggle" name="someSwitchOption001" type="checkbox">
  <label for="percentage_toggle" class="label-default bg-success"></label>
  <span class="ml-1">Value</span>
</div>

<div class="slidecontainer">
  <label for="exampleInputEmail1">Minutes:</label>
  <input type="range" min="1" max="10" value="1" class="slider" id="minutes_range">
  <div class="form-group">
      <input id="minutes_input" type="number" min="1" max="10" value="1" class="form-control" id="exampleInputEmail1" placeholder="1-20 Minutes">
  </div>
</div>

<div id="predict_percetage_container">
  <div class="slidecontainer">
    <label for="exampleInputEmail1">Predict Percetage:</label>

    <input type="range" min="0.05" max="100" value="0.05" class="slider" step=".05" id="percentage_range">
    <div class="form-group">
        <input id="percentage_input" type="number" min="0.05" max="100" value="0.05" class="form-control" id="exampleInputEmail1" placeholder="0.05-100">
    </div>
  </div>
</div>

<div id="predict_value_container" style="display:none">
  <div class="input-group">
      <div class="input-group-prepend">
        <button class="btn btn-outline-danger" type="button" id="value_predicted_input_minus">-</button>
      </div>

      <input id="value_predicted_input" type="number"class="form-control" placeholder="Enter Predicted Value">

      <div class="input-group-append">
        <button class="btn btn-outline-success" type="button" id="value_predicted_input_add">+</button>
      </div>
  </div>
</div>

<div id="predicted_container">
  <div>
    <span class="font-weight-bold">Value Predicted if LONG:</span>
    <span id="predicted_value_long_text">0.00:</span>
  </div>

  <div>
    <span class="font-weight-bold">Value Predicted if SHORT:</span>
    <span id="predicted_value_short_text">0.00:</span>
  </div>
</div>




<hr>

<div class="d-flex flex-row float-right">
  <button type="button" class="btn btn-success" id="accept_risk_btn">Accept Risk Options</button>
  <button type="button" class="btn btn-danger ml-1" id="cancel_btn">Cancel</button>
</div>

<script>

  var ethPriceBinance = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/price?symbol=ETHUSDT").price).toFixed(2);

  $("#value_predicted_input").val(ethPriceBinance);
  $("#predicted_value_long_text").text(ethPriceBinance);
  $("#predicted_value_short_text").text(ethPriceBinance);

  $("#value_predicted_input").val(getPercentageIncrease(0.05,ethPriceBinance));
  $("#predicted_value_long_text").text(getPercentageIncrease(0.05,ethPriceBinance));
  $("#predicted_value_short_text").text(getPercentageDecrease(0.05,ethPriceBinance));


  if (customRiskArray.length >= 1) {
    $("#minutes_input").val(customRiskArray[customRiskArray.length-1].minutes_input);
    $("#minutes_range").val(customRiskArray[customRiskArray.length-1].minutes_input);

    if(customRiskArray[customRiskArray.length-1].percentage_input==undefined){
      $('#percentage_toggle').click()
      $("#predicted_container").toggle();
      $('#predict_percetage_container').css('display','none');
      $('#predict_value_container').css('display','block');

      $("#value_predicted_input").val(customRiskArray[customRiskArray.length-1].value_predicted_input);
    }else{
      $("#percentage_input").val(customRiskArray[customRiskArray.length-1].percentage_input);
      $("#percentage_range").val(customRiskArray[customRiskArray.length-1].percentage_input);
    }
  }

  $("#minutes_range").on('input',function(){
    $("#minutes_input").val($(this).val());
  });

  $("#minutes_input").on('input',function(){
    $("#minutes_range").val($(this).val());
  });

  $("#percentage_range").on('input',function(){
    $("#percentage_input").val($(this).val());

    $("#predicted_value_long_text").text(getPercentageIncrease($(this).val(),ethPriceBinance));
    $("#predicted_value_short_text").text(getPercentageDecrease($(this).val(),ethPriceBinance));
  });

  $("#percentage_input").on('input',function(){

    var currentValue = $(this).val();
    if(currentValue==""){
      $("#predicted_value_long_text").text("Enter a valid number");
      $("#predicted_value_short_text").text("Enter a valid number");
      $("#percentage_range").val($(this).attr('min'));
    }else{
      $("#predicted_value_long_text").text(getPercentageIncrease(currentValue,ethPriceBinance));
      $("#predicted_value_short_text").text(getPercentageDecrease(currentValue,ethPriceBinance));
      $("#percentage_range").val(currentValue);
    }

    console.log(getPercentageDecrease($(this).val(),ethPriceBinance));
  });

  $('#percentage_toggle').change(function() {
    var percentage_toggle = this.checked;

    console.log(percentage_toggle);

    if(percentage_toggle){
      $("#predicted_container").toggle();
      $('#predict_percetage_container').css('display','none');
      $('#predict_value_container').css('display','block');
    }else{
      $("#predicted_container").toggle();
      $('#predict_percetage_container').css('display','block');
      $('#predict_value_container').css('display','none');
    }
  });

  $('#accept_risk_btn').on('click',function(){
    var minutes_input = $("#minutes_input").val();
    var isValue = $('#percentage_toggle').is(":checked");

    // console.log("isValue:",isValue);

    if(isValue==true){
      var value_predicted_input = $("#value_predicted_input").val();

      if(minutes_input!=""||value_predicted_input!=""){
        // console.log(minutes_input,value_predicted_input);

        customRiskArray.push({
          'minutes_input':minutes_input,
          'value_predicted_input':value_predicted_input
        });

        var timestampPredicted = unixTimeToDatetime(getEpochCurrentTime()+parseInt(minutes_input)*60);
        console.log(timestampPredicted);

        $("#risk_value_predicted_long").text(value_predicted_input);
        $("#risk_value_predicted_short").text(value_predicted_input);
        $("#risk_timestamp_predicted").text(timestampPredicted);

        bootbox.hideAll();
      }else{
        $.alert({
            title: 'Encountered an error!',
            content: 'Please Input minute(s) and percentage',
            type: 'red',
        });
      }
    }else{
      var percentage_input = $("#percentage_input").val();

      if(minutes_input!=""||percentage_input!=""){
        customRiskArray.push({
          'minutes_input':minutes_input,
          'percentage_input':percentage_input,
          'value_predicted_input':percentage_input
        });

        var timestampPredicted = unixTimeToDatetime(getEpochCurrentTime()+parseInt(minutes_input)*60);
        console.log(timestampPredicted);

        $("#risk_value_predicted_long").text($("#predicted_value_long_text").text());
        $("#risk_value_predicted_short").text($("#predicted_value_short_text").text());
        $("#risk_timestamp_predicted").text(timestampPredicted);


        bootbox.hideAll();
      }else{
        $.alert({
            title: 'Encountered an error!',
            content: 'Please Input minute(s) and percentage',
            type: 'red',
        });
      }
    }
  });

  $('#value_predicted_input_minus').on('click',function(){
    var newValue = parseFloat($("#value_predicted_input").val())-.5;
    $("#value_predicted_input").val(newValue);
  });

  $('#value_predicted_input_add').on('click',function(){
    var newValue = parseFloat($("#value_predicted_input").val())+.5;
    $("#value_predicted_input").val(newValue);
  });

  $('#cancel_btn').on('click',function(){
    $("#1Min").attr('checked', 'checked');
    $("#1Min").parent('label').addClass('active');
    $('#customRisk_btn').removeClass('active');

    // customRiskArray = [];
    bootbox.hideAll();
  });




  



  
</script>