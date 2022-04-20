function callDataViaURL(url,data){
	console.log("Calling data via URL: running",data);

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

function callPageViaURL(url,data){
	console.log("Calling page via URL: running");

	var retVals;

	jQuery.ajax({
	    url: url,
	    data: data,
	    type: "POST",
	    async: false,
	    success: function(response) {  
	    	retVals = response;
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function deleteGeneric(table,fieldNameArray,whereArray){
    console.log(table,fieldNameArray,whereArray);
	var retVals;

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

function printPDF(urlPath,dataToSend){
	console.log("Calling data via URL: running",dataToSend);

	var retVals;

	jQuery.ajax({
	    url: urlPath,
	    data: {
	    	'dataToSend': dataToSend,
	    },
	    type: "POST",
	    async: false,
	    success: function(response) {  
	    	retVals = response;
	    },
	    error: function(error) {
	        console.log('Error:', error);
	    }
	});

	return retVals;
}

function getCurrentDate(dateArray){
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	dateArray = [{dd: dd, mm: mm, yyyy: yyyy, today: today}];
	return dateArray;
}
