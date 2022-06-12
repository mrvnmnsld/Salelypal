<div class="p-2 m-1">
	<label>Display Currency Selector: </label>
	<div class="form-group notranslate w-100 align-middle">
	    <select id="display_currency_selector" class="form-control form-control-sm">
	        <option value="usd">USD</option>
	        <option value="eur">EUR</option>
	        <option value="gbp">GBP(Pounds)</option>
	        <option value="aed">AED</option>
	        <option value="sar">SAR</option>
	        <option value="sgd">SGD</option>
	        <option value="php">PHP</option>
	        <!-- <option value="RMB">RMB</option> -->
	        <option value="inr">INR</option>
	        <!-- <option value="IDR">IDR</option> -->
	    </select>
	</div>

	<div class="text-center">Note: Saving will reload your assets</div>

	<div class="mt-3">
		<button class="btn btn-success btn-block" id="save_btn">Save Language</button>
		<button class="btn btn-danger red-btn btn-block" id="close_btn">Back</button>
	</div>
</div>

<script type="text/javascript">
	$("#display_currency_selector").val(displayCurrency);

	$("#save_btn").on("click", function(){
		$.confirm({
			icon: 'fa fa-money',
			title: 'Changing Currency?',
			columnClass: 'col-md-6 col-md-offset-6',
			content: 'Are you sure you want to <b>Change the currency</b> to '+$("#display_currency_selector option:selected").text()+'?',
			theme: 'dark',
			buttons: {
				confirm: function () {
					displayCurrency = $("#display_currency_selector").val()
					setLocalStorageByKey("displayCurrency",displayCurrency);
					$('#refresh_btn').click();
					$("#assets_btn").click();
				},
				cancel: function () {

				},
			}
		});
	})

	$("#close_btn").on('click',function(){
		$("#top_back_btn").click();
	})
</script>