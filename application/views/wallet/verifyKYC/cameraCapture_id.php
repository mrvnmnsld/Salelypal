<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>
<script type="text/javascript" src="assets/lib/webcamjs/webcam.min.js"></script>

<div id="noteslist_kyc" class="text-center mb-2"> 
    <div class="font1rem"><b>Important Notes</b></div>
    <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Don't use photo filter</span><br>
    <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing make up</span><br>
    <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing glasses</span><br>
    <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing hats</span>
</div>

<div id="webcamView" style="display:none">
	<div class="d-flex justify-content-center">
		<div id="my_camera"></div>
		<div id="results" style="width: 500px;height: 370px;display: none;"></div>
	</div>

	<div class="d-flex justify-content-center">
		<input type=button class="btn btn-primary m-1" value="Capture" onClick="take_snapshot()">
		<input type=button class="btn btn-danger m-1" disabled value="Retake" onClick="retakeDesktop()">
		<input type=button class="btn btn-success m-1" disabled value="Upload" onClick="uploadPhotoCapturedDesktop()">
		<input type=button class="btn btn-danger m-1" value="Cancel" onClick="Webcam.reset( '#my_camera' );bootbox.hideAll();">
	</div>

	<div class="text-center pt-3 text-muted">
	    <span>Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors</span>
	</div>
</div>

<div id="androidView" style="display: none;">
	<div class="py-4">
		<img src="" id="myImage" class="text-center" style="height: 370px;width:100%;display: none;">
	</div>

	<div class="d-flex justify-content-center">
		<input type=button class="btn btn-danger m-1" value="Retake" onClick="retakeAndroid()">
		<input type=button class="btn btn-success m-1" disabled value="Upload" onClick="uploadPhotoCapturedAndroid()">
		<input type=button class="btn btn-danger m-1" value="Cancel" onClick="bootbox.hideAll();">
	</div>

	<div class="text-center pt-3 text-muted">
	    <span>Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors</span>
	</div>
</div>

<div class="text-center text-success h4" style="display: none;" id="capturedText">Successfully Captured!</div>

<script type="text/javascript">
	//webcam
		function take_snapshot() {
		   	Webcam.snap( function(data_uri) {
		   		console.log(data_uri);
	   			document.getElementById('results').innerHTML = 
		        '<img src="'+data_uri+'" style="width: 500px;height: 370px;"/>';
		    } );

		    
		    $("#capturedText").toggle();
		    $("#my_camera").toggle();
		    $("#results").toggle();
		    $("input[value='Capture']").attr("disabled",true);
		    $("input[value='Retake']").removeAttr("disabled");
		    $("input[value='Upload']").removeAttr("disabled");
		}

		function retakeDesktop(){
		    $("#capturedText").toggle();
		 	$("#my_camera").toggle();
		 	$("#results").toggle();
		 	$("input[value='Capture']").removeAttr("disabled");
		 	$("input[value='Retake']").attr("disabled",true);
		 	$("input[value='Upload']").attr("disabled",true);
		}

		function uploadPhotoCapturedDesktop(){
			console.log($("#results img").attr('src'));

			var blob = dataURItoBlob($("#results img").attr('src'));
			var fd = new FormData(document.forms[0]);
			fd.append("canvasImage", blob);

			$.confirm({
			    title: 'KYC - ID upload',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to upload image?',
			    buttons: {
			        confirm: function () {
			        	bootbox.hideAll();

			            var imageUploadFormData = new FormData();

			            imageUploadFormData.append(
			            	currentUserID+"_IDImage",
			            	blob,
			            	currentUserID+"_IDImage"
		            	);
	                    imageUploadFormData.append('userID', currentUserID);

	                    $("#IDUpload_btn").empty().append(
	                        '<div style="font-size:12px;font-weigt:100">'+
	                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
	                        ' Uploading'+
	                        '</div>'
	                    ).attr('disabled',true);

	                    var res;

	                    setTimeout(function(){
	                    var res = JSON.parse(backendHandleFormData('saveIDImageKyc',imageUploadFormData));
	                            console.log(res);

	                        $("#IDUpload_btn").empty().append(
	                            '<span><i id="IDCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>'+
	                            '<span  class="">ID</span>'
	                        ).removeAttr('disabled');

	                        if (res.error==0) {
	                            id_upload = 1;
	                            checkupload();
	                            Webcam.reset( '#my_camera' );

	                            $.toast({
	                                heading: '<h6>ID Image Uploaded</h6>',
	                                text: 'Successfull!',
	                                showHideTransition: 'slide',
	                                position: 'bottom-center'
	                            })
	                        }else{
	                            $.toast({
	                                heading: '<h6>Error In uploading. Please check if network is strong and contact system admin</h6>',
	                                text: 'Error!',
	                                showHideTransition: 'slide',
	                                position: 'bottom-center'
	                            })
	                        }
	                    },2000)

			                
			        },cancel: function () {
			            
			        },
			    }
			});
		}
	//webcam

	// android
		function retakeAndroid(){
			navigator.camera.getPicture(onSuccess, onFail, { quality: 50,
			    destinationType: Camera.DestinationType.DATA_URL
		 	}); 
		}

		function onSuccess(imageData) {
			$("#myImage").css("display",'block');
			$("#capturedText").css("display",'block');
			
		    var image = document.getElementById('myImage');
		    image.src = "data:image/jpeg;base64," + imageData;

		    $("input[value='Retake']").removeAttr("disabled");
		    $("input[value='Upload']").removeAttr("disabled");
		}

		function uploadPhotoCapturedAndroid(imageData) {
			console.log($("#myImage").attr('src'));

			var blob = dataURItoBlob($("#myImage").attr('src'));

			$.confirm({
			    title: 'KYC - ID upload',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to upload image?',
			    buttons: {
			        confirm: function () {
			        	bootbox.hideAll();

			            var imageUploadFormData = new FormData();

			            imageUploadFormData.append(
			            	currentUserID+"_IDImage",
			            	blob,
			            	currentUserID+"_IDImage"
		            	);
	                    imageUploadFormData.append('userID', currentUserID);

	                    $("#IDUpload_btn").empty().append(
	                        '<div style="font-size:12px;font-weigt:100">'+
	                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
	                        ' Uploading'+
	                        '</div>'
	                    ).attr('disabled',true);

	                    var res;

	                    setTimeout(function(){
	                    var res = JSON.parse(backendHandleFormData('saveIDImageKyc',imageUploadFormData));
	                            console.log(res);

	                        $("#IDUpload_btn").empty().append(
	                            '<span><i id="IDCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>'+
	                            '<span  class="">ID</span>'
	                        ).removeAttr('disabled');

	                        if (res.error==0) {
	                            id_upload = 1;
	                            checkupload();
	                            Webcam.reset( '#my_camera' );

	                            $.toast({
	                                heading: '<h6>ID Image Uploaded</h6>',
	                                text: 'Successfull!',
	                                showHideTransition: 'slide',
	                                position: 'bottom-center'
	                            })
	                        }else{
	                            $.toast({
	                                heading: '<h6>Error In uploading. Please check if network is strong and contact system admin</h6>',
	                                text: 'Error!',
	                                showHideTransition: 'slide',
	                                position: 'bottom-center'
	                            })
	                        }
	                    },2000)

			                
			        },cancel: function () {
			            
			        },
			    }
			});
		}

		function onFail(message) {
		    console.log('Failed because: ' + message);
		}
	// android

	function dataURItoBlob(dataURI) {
	    // convert base64/URLEncoded data component to raw binary data held in a string
	    var byteString;
	    if (dataURI.split(',')[0].indexOf('base64') >= 0)
	        byteString = atob(dataURI.split(',')[1]);
	    else
	        byteString = unescape(dataURI.split(',')[1]);

	    // separate out the mime component
	    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

	    // write the bytes of the string to a typed array
	    var ia = new Uint8Array(byteString.length);
	    for (var i = 0; i < byteString.length; i++) {
	        ia[i] = byteString.charCodeAt(i);
	    }

	    return new Blob([ia], {type:mimeString});
	}

	if(typeof isCordovaAndroid != 'undefined'){
		console.log("hi");
		$("#androidView").toggle();


		navigator.camera.getPicture(onSuccess, onFail, { quality: 50,
		    destinationType: Camera.DestinationType.DATA_URL
	 	}); 

	}else{
		console.log("HELLO");
		$("#webcamView").toggle();

	 	Webcam.set({
			width: 500,
			height: 370,
			image_format: 'jpeg',
			jpeg_quality: 90
	 	});
	 	Webcam.attach('#my_camera');
	 	
	}
</script>