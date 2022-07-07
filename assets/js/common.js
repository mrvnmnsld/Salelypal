function ajaxShortLink(url,data){
	var retVals;

	jQuery.ajax({
	    url: url,
	    data: data,
	    type: "GET",
	    async: false,
	    success: function(response) {  
	    	// console.log(response);
	    	retVals = JSON.parse(response);
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function ajaxPostLink(url,data){
	var retVals;

	jQuery.ajax({
	    url: url,
	    data: data,
	    type: "POST",
	    async: false,
	    success: function(response) {  
	    	// console.log(response);
	    	retVals = JSON.parse(response);
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function ajaxShortLinkNoParse(url,data){
	var retVals;

	jQuery.ajax({
	    url: url,
	    data: data,
	    type: "GET",
	    async: false,
	    success: function(response) {  
	    	// console.log(response);
	    	retVals = response;
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function ajaxLoadPage(url,data){
	var retVals;

	jQuery.ajax({
	    url: url,
	    data: data,
	    type: "GET",
	    async: false,
	    success: function(response) {  
	    	// console.log(response);
	    	retVals = response;
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function loadJsonViaURL(url){
	var json = null;

	$.ajax({
		'async': false,
		'global': false,
		'url': url,
		'dataType': "json",
		'success': function (data) {
		    json = data;
		}
	});

	return json;
}

function deleteGeneric(table,fieldNameArray,whereArray){
    console.log(table,fieldNameArray,whereArray)

    jQuery.ajax({
        url: 'common/adminRights/deleteGeneric',
        data: {
            'table':table,
            'fieldNameArray':fieldNameArray,
            'whereArray':whereArray,
        },
        type: "GET",
        async: false,
        success: function(response) {  
            retVals = JSON.parse(response);
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });

    return retVals;
}

function detectMob() {
  var isMobile = false; //initiate as false
  // device detection
  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
      isMobile = true;
  }

  return isMobile;
}

function generateOTP() {
    var digits = '0123456789';
    let OTP = '';
    for (let i = 0; i < 6; i++ ) {
        OTP += digits[Math.floor(Math.random() * 10)];
    }
    return OTP;
}

function setLocalStorage(currentUser){
	localStorage.setItem("currentUser",JSON.stringify(currentUser));
}

function showLocalStorage(){
	console.log(JSON.parse(localStorage.getItem("currentUser")));
}

function getCurrentUser(){
	if (localStorage.getItem("currentUser") === null) {
		return null;
	}else{
		return localStorage.getItem("currentUser");
	}
}

function logOutClearStorage(){
	localStorage.clear();
	window.location.replace("index");
}

function getAllLocalStorageByKey(){
	var values = [];

   	for (var i = 0; i < localStorage.length; i++) {
   		const key = localStorage.key(i);
        values.push({'key':key,'data':JSON.parse(localStorage.getItem(key))});
   	}

    return values;
}

// local storage

function getLocalStorageByKey(key){
	return localStorage.getItem(key);
}

function setLocalStorageByKey(key,value){
	localStorage.setItem(key,value);//value expects strings use stringify if needed
}

function deleteLocalStorageByKey(key){
	localStorage.removeItem(key);
	console.log("DELETED LOCALSTORAGE: "+key);
}

// local storage


function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function lowerCase(string){
  return string.toLowerCase();
}

function cleanOutPutString(string){
	return capitalizeFirstLetter(lowerCase(string))
}

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
}

function generatePassword() {
    var length = 10,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_+",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

function getIpAddress(){
    var retVals;

    jQuery.ajax({
        url: 'https://api.ipify.org?format=json',
        type: "GET",
        async: false,
        success: function(response) {  
        	// console.log(response);
        	retVals = response;
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });

    return retVals;
}

function backendHandleFormData(url,formData){

	var retVals = '';

    $.ajax({  
		url: url,   
		method:"POST",  
		data:formData,  
		contentType: false,  
		cache: false,  
		processData:false,  
		async: false,
		success:function(data){  
			console.log(data);
			// retVals = JSON.parse(data);
			retVals = data;
			// var res = JSON.parse(data);
      }  
    });

    return retVals;
}

function postShortLink(url,data){
	var retVals;

	jQuery.ajax({
	    url: url,
	    data: data,
	    type: "POST",
	    async: false,
	    success: function(response) {  
	    	// console.log(response);
	    	retVals = JSON.parse(response);
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function searchObjectByValue(object,toSearch){
	var found = object.find(e => e.tokenName === toSearch);
	return found;
}

function roundTron(n){
	retVals = (parseInt(n)/1000000).toFixed(2);
	return(parseFloat(retVals));
}

function getTimeDate(){
	var date = new Date();

	return date.getDate()+"/"+
	(date.getMonth()+1)+
	"/"+date.getFullYear()+
	" "+date.getHours()+
	":"+date.getMinutes()+
	":"+date.getSeconds();
}

getTimeDateV2 = function(){
	var date = new Date();

	return 	date.getFullYear()+"/"+
	(date.getMonth()+1)+
	"/"+date.getDate()+
	" "+date.getHours()+
	":"+date.getMinutes()+
	":"+date.getSeconds();
}

function getTimeDateNonFormated(){
	var date = new Date();

	return date;
}

function unixTimeToDate(timestamp){
	const milliseconds = timestamp * 1000;
	var date = new Date(milliseconds);

	return date.getDate()+
	"/"+(date.getMonth()+1)+"/"+
	date.getFullYear();
}

function unixTimeToDateNonFormated(timestamp){
	const milliseconds = timestamp * 1000;
	var date = new Date(milliseconds);

	return date;
}

function unixTimeToDateNonFormatedVer2(timestamp){
	var timestamp = timestamp*1000
	var myDate = new Date(timestamp); // Your timezone!
	// var myEpoch = myDate.getTime()/1000.0;

	return myDate;
}

function unixTimeToDate13Char(timestamp){
	// const milliseconds = timestamp / 1000;
	var date = new Date(timestamp);

	return date.getDate()+
	"/"+(date.getMonth()+1)+"/"+
	date.getFullYear();
}

function unixTimeToDate13CharNonFormated(timestamp){
	// const milliseconds = timestamp / 1000;
	var date = new Date(timestamp);

	return date;
}

function unixTimeToDatetime(timestamp){
	const milliseconds = timestamp * 1000;
	var date = new Date(milliseconds);

	return (date.getMonth()+1)+"/"+
	date.getDate()+
	"/"+date.getFullYear()+
	" "+date.getHours()+
	":"+date.getMinutes()+
	":"+date.getSeconds();
}

function isTrc20(address){
   return(address.substr(0, 1)=="T" && address.length==34);
}

function isAddressValidBscErc(address){
   return(address.substr(0, 1)=="0" && address.length==42);
}

function trc20AmountToRealAmount(trc20Amount){
	var res = trc20Amount/1000000;
	return	res;
}

function weiToBnb(wei){
	var res = parseFloat(wei)/1000000000000000000;
	return	res;
}

function mweiToBnb(wei){
	var res = parseFloat(wei)/1000000000000;
	return	res;
}

function gweiToEth(gwei){
	var res = parseFloat(gwei)/1000000000;
	return	res;
}

function getDateFormated(){
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	var hours = today.getHours();
	var minutes = today.getMinutes();
	var sec = today.getSeconds();

	return mm+dd+yyyy+"-"+hours+minutes+sec;
}

function estimateGasBsc(gasLimit,gasPrice){
	console.log(gasLimit,gasPrice);
	
	gasLimit = parseFloat(gasLimit);
	gasPrice = parseFloat(gasPrice);

	return (gasLimit*gasPrice)/1000000000;
}

function estimateGasEth(gasLimit,gasPrice){
	gasLimit = parseFloat(gasLimit);
	gasPrice = parseFloat(gasPrice);

	return (gasLimit*gasPrice)/1000000000;
}

function getPercentageIncrease(inputPercentage, currentValue){
	inputPercentage = parseFloat(inputPercentage);
	currentValue = parseFloat(currentValue);

    var percentageValue = (inputPercentage / 100)*currentValue;
    var increaseValued = currentValue+percentageValue;

    return increaseValued.toFixed(2);
}

function getPercentageDecrease(inputPercentage, currentValue){
	inputPercentage = parseFloat(inputPercentage);
	currentValue = parseFloat(currentValue);

    var percentageValue = (inputPercentage / 100)*currentValue;
    var decreaseValue = currentValue-percentageValue;

    return decreaseValue.toFixed(2);
}

function getEpochCurrentTime(){
	return Math.round((new Date()).getTime() / 1000);
}

Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

function addMinutes(date, minutes) {
    return new Date(date.getTime() + minutes*60000);
}

function formatDateObject(date){
	var options = { 
		year: 'numeric', 
		month: 'numeric', 
		day: 'numeric',
		hour:'numeric',
		minute:'numeric',
		second:'2-digit',
		// hour12: false
	};

	return date.toLocaleDateString("en-US", options);
}

function formatDateObject24Hours(date){
	var options = { 
		year: 'numeric', 
		month: 'numeric', 
		day: 'numeric',
		hour:'numeric',
		minute:'numeric',
		second:'2-digit',
		hour12: false
	};

	return date.toLocaleDateString("en-US", options);
}

function formatDateObjectMonthAndDayOnly(date){
	var options = { 
		year:false,
		month: 'numeric', 
		day: 'numeric',
		hour:false,
		minute:false,
		second:false,
		hour12: false
	};

	return date.toLocaleDateString("en-US", options);
}

function float2DecimalPoints(value){
	return parseFloat(parseFloat(value).toFixed(2))
}

function getEpochCurrentTime13Digit(){
	var date = new Date();
	return Date.parse(date);
}

function pushNewNotif(tittle,content,userID){
	ajaxShortLink("pushNewNotif",{
		'userID':userID,
		'tittle':tittle,
		'content':content
	});
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

getChanges = function(oldArray, newArray) {
  var changes, i, item, j, len;
  if (JSON.stringify(oldArray) === JSON.stringify(newArray)) {
    return false;
  }
  changes = [];
  for (i = j = 0, len = newArray.length; j < len; i = ++j) {
    item = newArray[i];
    if (JSON.stringify(item) !== JSON.stringify(oldArray[i])) {
      changes.push(item);
    }
  }
  return changes;
};

getBalance = function(networkName,tokenName,smartAddress){
	var balanceInnerFunction;

	if (networkName == 'trx'||networkName == 'trc20') {
		if (tokenName.toUpperCase() === 'trx'.toUpperCase()) {
			balanceInnerFunction = ajaxShortLink('test-platform/getTronBalance',{
				// 'trc20Address':currentUser['trc20_wallet']
			})['balance'];			
		}else{
			balanceInnerFunction = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
				// 'trc20Address':currentUser['trc20_wallet'],
				'contractaddress':smartAddress,
			})['balance'];
		}

		$("#warningReported").html("<b>Important Note:</b><br>TRC20 token transfer may consume energy, if energy is insufficient, TRX will be burned. Please ensure you have more than enough TRX to avoid transfer failure.<br><br> You may check TRC20 TRX Fee at <a href='https://tronstation.io/calculator' target='_blank'>Tronstation.io</a>");

	}else if(networkName =='bsc'){

		if(tokenName.toUpperCase() === 'bnb'.toUpperCase()){

			balanceInnerFunction = ajaxShortLink('test-platform/getBinancecoinBalance',{
				// 'bsc_wallet':currentUser['bsc_wallet']
			})['balance'];

		}else{
			balanceInnerFunction = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
				// 'bsc_wallet':currentUser['bsc_wallet'],
				'contractaddress':smartAddress
			})['balance'];
		}

		$("#warningReported").html("<b>Important Note:</b><br>BSC token transfer will consume transaction fee, if BNB is insufficient the transaction will fail Please ensure you have more than enough BNB to avoid transfer failure.<br><br> <b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6)+" BNB</span>");
	}else if(networkName =='erc20'){

		if(tokenName.toUpperCase() === 'eth'.toUpperCase()){

			balanceInnerFunction = ajaxShortLink('test-platform/getEthereumBalance',{
				// 'erc20_address':currentUser['erc20_wallet']
			})['balance'];

		}else{
			balanceInnerFunction = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
				// 'erc20_address':currentUser['erc20_wallet'],
				'contractaddress':smartAddress
			})['balance'];
		}

		$("#warningReported").html("<b>Important Note:</b><br>ERC20 token transfer will consume transaction fee, if ETH is insufficient the transaction will fail Please ensure you have more than enough ETH to avoid transfer failure.<br><br> <b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasEth(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6)+" ETH</span>");
	}

	return balanceInnerFunction;
}

getGasSupplyTestPlatform = function(network){
	var balanceInnerFunction;
	var gasTokenName;

	if (network == 'trx' || network == 'trc20') {
		balanceInnerFunction = ajaxShortLink('test-platform/getTronBalance',{
			// 'trc20Address':currentUser['trc20_wallet']
		})['balance'];	
		gasTokenName = 'TRX';
	}else if (network == 'bsc') {
		balanceInnerFunction = ajaxShortLink('test-platform/getBinancecoinBalance',{
			// 'bsc_wallet':currentUser['bsc_wallet']
		})['balance'];
		gasTokenName = 'BNB';
	}if (network == 'erc20') {
		balanceInnerFunction = ajaxShortLink('test-platform/getEthereumBalance',{
			// 'erc20_address':currentUser['erc20_wallet']
		})['balance'];
		gasTokenName = 'ETH';
	}

	return {
		'amount':balanceInnerFunction,
		'gasTokenName':gasTokenName,
	};
}

getTimeOnDateObject = function(date){
	//date accepts strings

	var d = new Date(date);
	d.getHours(); // => 9
	d.getMinutes(); // =>  30
	d.getSeconds(); // => 51

	return d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()
}

getNumberOfDays = function(start, end) {
    const date1 = new Date(start);
    const date2 = new Date(end);

    // One day in milliseconds
    const oneDay = 1000 * 60 * 60 * 24;

    // Calculating the time difference between two dates
    const diffInTime = date2.getTime() - date1.getTime();

    // Calculating the no. of days between two dates
    const diffInDays = Math.floor(diffInTime / oneDay);

    return {
    	'diffInTime':diffInTime,
    	'diffInDays':diffInDays
    };
}

isTimeAfter = function(start, end){
	var res;
	const date1 = new Date(start);
	const date2 = new Date(end);

	console.log(date1,date2);

	if(date1.getHours() <= date2.getHours() ){
		res = true;
	}else{
		res = false;
	}

	return res;
}

getCurrentDateV3 = function(){
	// this is for input type=date
	const date = new Date();

	const year = date.getFullYear();
	const month = String(date.getMonth() + 1).padStart(2, '0');
	const day = String(date.getDate()).padStart(2, '0');
	const joined = [year,month,day,].join('-');

	return joined;
}

animateCSS = function(element, animation, prefix = 'animate__'){
	new Promise((resolve, reject) => {
	  const animationName = `${prefix}${animation}`;
	  const node = document.querySelector(element);

	  node.classList.add(`${prefix}animated`, animationName);

	  function handleAnimationEnd(event) {
	    event.stopPropagation();
	    node.classList.remove(`${prefix}animated`, animationName);
	    resolve('Animation ended');
	  }

	  node.addEventListener('animationend', handleAnimationEnd, {once: true});
	});
}

getDaysDate = function(numDays){
	var dateContainer = [];

	for (var i = numDays; i >= 0; i--) {
		var innerDate = new Date().getTime()+(-Math.abs(i)*24*60*60*1000)

		innerDate = unixTimeToDate13CharNonFormated(innerDate)
		// dateContainer.push(formatDateObjectMonthAndDayOnly(new Date(new Date().getTime()+(-Math.abs(i)*24*60*60*1000))))
		dateContainer.push(
			(innerDate.getMonth()+1)+"-"+innerDate.getDate()
		)
	}

	return dateContainer;
}

getRandomColorIteration = function(iteration) {
	var colorContainer = [];

	for (var x = 0; x < iteration; x++) {
		var letters = '0123456789ABCDEF';
		var color = '#';
		for (var i = 0; i < 6; i++) {
		  color += letters[Math.floor(Math.random() * 16)];
		}

		colorContainer.push(color)
	}
  
	return colorContainer;
}

window.mobileAndTabletCheck = function() {
  let check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};

