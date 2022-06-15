function saveProfileDetails(dataSignUp,password){
    jQuery.ajax({
        url: 'editProfileSave',
        data: {
          'data' : dataSignUp,
          'password' : password,
        },
        type: "POST",
        success: function(response) {
            response = JSON.parse(response)
            console.log(response);

            if (response[1] == '1') {
                console.log("successfully saved");
                $('#saveResultsText').text("Profile successfully saved: will redirect to login page in 3 seconds for security purposes");
                $('btn').css('disabled',true);
                $('#saveResultsText').removeClass();
                $('#saveResultsText').addClass('alert alert-success');
            }

            setTimeout(function(){
                jQuery.ajax({
                    url: "logOut",
                    type: "POST",
                    success: function(response) {
                      location.href = 'login';
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }, 3000);
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}   

function editProfileSaveEmployeeList(dataSignUp){
    console.log(dataSignUp);

    jQuery.ajax({
        url: 'editProfileSaveEmployeeList',
        data: {
          'data' : dataSignUp,
        },
        type: "POST",
        success: function(response) {
            response = JSON.parse(response)
            console.log(response);

            if (response[1] == '1') {
                console.log("successfully saved");
                $('#saveResultsText').text("Successfully saved");
                $('btn').css('disabled',true);
                $('#saveResultsText').removeClass();
                $('#saveResultsText').addClass('alert alert-success');
            }
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}   

function callDataViaURL(url,data){
    console.log("Calling data via URL: running");

    var retVals;

    jQuery.ajax({
        url: url,
        data: data,
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

function getAllDataOnTable(tableName){
    console.log("Getting all data on table:"+tableName);

    var retVals;

    jQuery.ajax({
        url: 'common/getAllDataOnTable',
        data: {
            'tableName' : tableName
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

function callPageViaURL(url,data){
    console.log("Calling page via URL: running",data);

    var retVals;

    jQuery.ajax({
        url: url,
        data: data,
        type: "GET",
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

function callPageViaURLGeneric(pageURL){
    console.log("Calling page via URL: running- ",pageURL);

    var retVals;

    jQuery.ajax({
        url: 'common/loadPageGeneric',
        data: {
            'pageURL':pageURL
        },
        type: "GET",
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

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;

  //     var o = Math.round, r = Math.random, s = 255;
  //     return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}

function setChartJsTable(labelArray,dataArray,chartId,width,height,title){
    console.log("Loading dataTable: setChartJsTable");

    var colorArray = [];
    resetCanvas(chartId);

    for (var i = 0; i < dataArray.length; i++) {
      colorArray.push(getRandomColor());
    }

    var ctx = document.getElementById(chartId).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Total',
                data: dataArray,
                backgroundColor: colorArray,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                }]
            },
            responsive: true,
            title: {
                display: true,
                text: title
            } 
        },
        
    });
}

function setChartJsTablePie(labelArray,dataArray,chartId,width,height,title){
    console.log("Loading dataTable: setChartJsTable");

    var colorArray = [];
    resetCanvas(chartId);

    for (var i = 0; i < dataArray.length; i++) {
      colorArray.push(getRandomColor());
    }

    var ctx = document.getElementById(chartId).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Total',
                data: dataArray,
                backgroundColor: colorArray,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                }]
            },
            responsive: true,
            title: {
                display: true,
                text: title
            } 
        },
        
    });
}

function resetCanvas(chartId,width,height){
    console.log("RESETING CANVAS: running");

    $(chartId).remove(); // this is my <canvas> element
    $('#graph-container').append('<canvas id="'+chartId+'"><canvas>');
    canvas = document.querySelector('#'+chartId);
    ctx = canvas.getContext('2d');
    ctx.canvas.width = width;
    ctx.canvas.height = height;
}

function setDataTable(tableKeys,tableLabels,inventoryArray){    
    resetTable();
    console.log("Loading dataTable: running");
    // console.log(tableKeys,tableLabels,inventoryArray);

    for (var i = 0; i < tableLabels.length; i++) {
        $('#dataTable thead tr').append('<th>'+tableLabels[i]+'</th>');
    }
    
    $('#dataTable').DataTable().destroy();
    $('#dataTable').DataTable({
        data: inventoryArray,
        columns: tableKeys,
        "autoWidth": false,
        responsive: true,
    });
}

function resetTable(){
    console.log("RESETING TABLE: running");
    $('#dataTableContainer').empty();
    $('#dataTableContainer').append('<table id="dataTable" class="table"><thead><tr></tr></thead></table>');
}

function deleteItemInObject(array, attr, value) {
    for(var i = 0; i < array.length; i += 1) {
        if(array[i][attr] === value) {
            // return i;
            if (i > -1) {
              array.splice(i, 1);
            }
        }
    }
    console.log('index is -1');
}

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function getWeek(current) {
    var week= new Array(); 
    // Starting Monday not Sunday
    current.setDate((current.getDate() - current.getDay() +1));
    for (var i = 0; i < 7; i++) {
        week.push(
            new Date(current)
        ); 
        current.setDate(current.getDate() +1);
    }
    return week; 
}

