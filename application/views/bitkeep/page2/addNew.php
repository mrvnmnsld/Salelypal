<style type="text/css">
	.modal-footer{
		display: none;
	}

	.modal-body{
	    height: 200px;

	}
</style>

<form id="addForm">
	<div class="row pl-2 pr-2">
	    <div class="form-group form-control-sm col-sm">
	        <label for="exampleInputEmail1">Time/时间</label>
	        <input type="text" value="18:55" class="form-control form-control-sm" id="time_1" name="time_1" placeholder="Pick hour and minute">
	    </div>

	    <div class="form-group form-control-sm col-sm">
	        <label for="exampleInputEmail1">Date/日期</label>
	        <input type="date" value="2022-01-20" class="form-control form-control-sm" id="date_1" name="date_1" placeholder="Pick hour and minute">
	    </div>

	    <div class="form-group form-control-sm col-sm">
	        <label for="exampleInputPassword1">Wallet address/钱包地址</label>
	        <input type="text" value="TCPEpnfpEjX1k6y7190a8fa719632" class="form-control form-control-sm" id="walletAddress_1" name="walletAddress_1" aria-describedby="emailHelp" placeholder="Enter address">
	    </div>

	    <div class="form-group form-control-sm col-sm">
	        <label for="exampleInputPassword1">Type/转账类型</label>
	        <select class="form-control form-control-sm" id="typeSelect_1"> 
	            <option>Withdraw</option>
	            <option>Receive</option>
	        </select>
	    </div>
	</div>

	<div class="row pl-2 pr-2" style="margin-top:15px;">
	    <div class="form-group form-control-sm col-sm-2">
	        <label for="exampleInputPassword1">Amount/金额</label>
	        <input type="number" value="5" pattern="[0-9]+" class="form-control form-control-sm" id="amountInput_1" name="amountInput_1" placeholder="Enter amount">
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
</form>

<div class="row float-right mr-2 mt-4">
	<button class="ml-1 btn btn-primary float-right" id="addButtonBtn">+ Add</button>
	<button class="ml-1 btn btn-danger float-right" id="closeBtn">x Close</button>
</div>

<script type="text/javascript">
	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#addButtonBtn").on('click', function(){
		var serializedArray = $('#addForm').serializeArray();

		for (var i = 0; i < .length; i++) {
			
		}		
	});
</script>