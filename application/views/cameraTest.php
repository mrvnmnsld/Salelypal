<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Camera</title>
</head>
<body>
	<style>
	 #my_camera{
	     width: 320px;
	     height: 240px;
	     border: 1px solid black;
	}
	</style>

	<div id="my_camera"></div>
	<input type=button value="Take Snapshot" onClick="take_snapshot()">
	 
	<div id="results" ></div>
	<hr>
	<img  id="myImage"></img>


	 
	<!-- Webcam.min.js -->
	<script type="text/javascript" src="assets/lib/webcamjs/webcam.min.js"></script>

	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		function take_snapshot() {
		 
		   // take snapshot and get image data
		   Webcam.snap( function(data_uri) {
		       // display results in page
		       document.getElementById('results').innerHTML = 
		        '<img src="'+data_uri+'"/>';
		    } );
		}

		function onSuccess(imageData) {
		    var image = document.getElementById('myImage');
		    image.src = "data:image/jpeg;base64," + imageData;
		}

		function onFail(message) {
		    console.log('Failed because: ' + message);
		}


		setTimeout(function(){
			if((typeof isCordova != 'undefined' || typeof isCordova != undefined) == true){
				navigator.camera.getPicture(onSuccess, onFail, { quality: 50,
				    destinationType: Camera.DestinationType.DATA_URL
			 	}); 

				
			}else{
				console.log("HELLO");

			 	Webcam.set({
					width: 320,
					height: 240,
					image_format: 'jpeg',
					jpeg_quality: 90
			 	});
			 	Webcam.attach('#my_camera');
			}
		},100)


		

 	
	</script>
</body>
</html>