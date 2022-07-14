<script defer src="assets/lib/faceapi/face-api.min.js"></script>
<!-- <script defer src="assets/lib/faceapi/script.js"></script> -->

<style type="text/css">
	.modal-footer{
		display: none;
	}

	.modal-content{
		background: transparent;
		border: 0;
	}

	#pagetitle_background{
		background: #293038;
		color: white;
		padding: 15px;
		border-radius: 20px 20px 0px 0px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		text-align: center;
	}

	#initial_modal{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}

	#kyc_modal{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}

	
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">User Details</label>
</div>

<div id="initial_modal">

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Email:</b></div>	
		<div class="col-md" id="emailContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Name:</b></div>	
		<div class="col-md" id="fullnameContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Date Joined:</b></div>	
		<div class="col-md" id="dateContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Birthday:</b></div>	
		<div class="col-md" id="birthdayContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Mobile:</b></div>	
		<div class="col-md" id="mobileNumberContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Country:</b></div>	
		<div class="col-md" id="countryContainer"></div>	
	</div>


	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Referred By:</b></div>	
		<div class="col-md" id="referredByContainer"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-2 pl-3"><b>Last login:</b></div>	
		<div class="col-md" id="lastLoginContainer"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-2 pl-3"><b>Pro User:</b></div>	
		<div class="col-md" id="">
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="isProContainer" id="isProContainerYes" value="true">
			  <label class="form-check-label" for="isProContainerYes">Yes</label>
			</div>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="isProContainer" id="isProContainerNo" value="false">
			  <label class="form-check-label" for="isProContainerNo">No</label>
			</div>
		</div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-2 pl-3"><b>Block:</b></div>	
		<div class="col-md" id="">
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="blockContainer" id="blockContainerYes" value="true">
			  <label class="form-check-label" for="blockContainerYes">Yes</label>
			</div>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="blockContainer" id="blockContainerNo" value="false">
			  <label class="form-check-label" for="blockContainerNo">No</label>
			</div>
		</div>	
	</div>

	<hr>

	<div>
		<button class="btn-block btn btn-sm btn-primary mt-1" id="verifyBtn">Verify KYC</button>
		<!-- <button class="btn-block btn btn-sm btn-primary mt-1" id="blockBtn">Block User</button> -->
		<!-- <button class="btn-block btn btn-sm btn-primary mt-1" id="unblockBtn">Unblock User</button> -->
		<button class="btn-block btn btn-sm btn-success mt-1" id="resetBtn">Reset Password</button>
		<button class="btn-block btn btn-sm btn-warning mt-1" id="deleteBtn">Delete User</button>
		<button class="btn-block btn btn-sm btn-danger mt-1" id="closeBtn">Close</button>
	</div>
</div>

<div id="kyc_modal" style="display:none">

	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Fullname:</b></div>	
		<div class="col-md" id="fullnameContainer_kyc"></div>	
	</div>
	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Birthday:</b></div>	
		<div class="col-md" id="birthdayContainer_kyc"></div>	
	</div>
	<div class="row mt-1">
		<div class="col-md-2 pl-3"><b>Country:</b></div>	
		<div class="col-md" id="countryContainer_kyc"></div>	
	</div>


	<div class="d-flex">
		<div class="p-2">
			<div>ID Image:</div>
			<img style="height: 250px;" class="img-fluid rounded" id="id_img_container" src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg">
			<a href="" download rel="noopener noreferrer" id="id_img_codownload" target="_blank" class="mt-2 btn btn-success btn-sm w-100">
			   Download Original Image
			</a>
		</div>

		<div class="p-2">
			<div>Face Image:</div>
			<img style="height: 250px;" class="img-fluid rounded" id="face_img_container" src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg">
			<a href="" download rel="noopener noreferrer" id="face_img_download" target="_blank" class="mt-2 btn btn-success btn-sm w-100">
			   Download Original Image
			</a>
		</div>
	</div>

	<div class="">NOTE: Please hard refresh the page to see the new uploaded if the image still contains the old one</div>

	<div id="errorReporter" class="text-center">
		
	</div>

	<hr>

	<div>
		<button class="btn-block btn btn-sm btn-primary mt-1" id="verify_user_btn">Verify KYC</button>
		<button class="btn-block btn btn-sm btn-warning mt-1" id="reject_user_btn">Reject KYC</button>
		<button class="btn-block btn-danger" id="kyc_back_btn">Go back</button>
	</div>
</div>


<script type="text/javascript">
	var globalFullnameContainer;
	var globalBirthdayContainer;

	$("#emailContainer").append(selectedData["email"]);
	$("#dateContainer").append(selectedData["timestamp"]);
	$("#mobileNumberContainer").append(selectedData["mobileNumber"]);
	// $("#ipContainer").append(selectedData["ip_lastLogin"]);
	$("#referredByContainer").append(selectedData["referedConcat"]);

	$("#countryContainer").append(selectedData["country"]);
	$("#fullnameContainer").append(selectedData["fullname"]);
	$("#birthdayContainer").append(selectedData["birthday"]);

	if (selectedData["fullname"] == null) {
		$("#fullnameContainer_kyc").html("<span class='text-danger'>No data</span>");
		$("#fullnameContainer").html("<span class='text-danger'>No data</span>");

	}else{
		$("#fullnameContainer_kyc").html("<span>"+selectedData["fullname"]+"</span>");
	}

	if (selectedData["birthday"] == null) {
		$("#birthdayContainer_kyc").html("<span class='text-danger'>No data</span>");
		$("#birthdayContainer").html("<span class='text-danger'>No data</span>");

	}else{
		$("#birthdayContainer_kyc").html("<span>"+selectedData["birthday"]+"</span>");
	}

	if (selectedData["country"] == null) {
		$("#countryContainer_kyc").html("<span class='text-danger'>No data</span>");
		$("#countryContainer").html("<span class='text-danger'>No data</span>");

	}else{
		$("#countryContainer_kyc").html("<span>"+selectedData["country"]+"</span>");
	}

	if (selectedData["lastLoginDate"] == null) {
		$('#lastLoginContainer').html("<span class='text-danger'>No data</span>");
	}else{
		$("#lastLoginContainer").append(selectedData["lastLoginDate"]+" IP: "+selectedData["ip_lastLogin"]);
	}

	if (selectedData["isBlocked"] == 1) {
		$("#blockContainerYes").attr('checked', 'checked');
	}else{
		$("#blockContainerNo").attr('checked', 'checked');
	}

	if (selectedData["isPro"] == 1) {
		$("#isProContainerYes").attr('checked', 'checked');
	}else{
		$("#isProContainerNo").attr('checked', 'checked');
	}

	if (selectedData["verified"] == 1) {
		$("#verifyBtn").text("View Verification")
		$("#verify_user_btn").attr("disabled",true)
		$("#verify_user_btn").text("Already Verified")
	}

	// initial Modal
		$("#closeBtn").on('click', function(){
			bootbox.hideAll();
        	loadDatatable('admin/getAllUsers');
		});

		$("#topUpBtn").on('click', function(){
			bootbox.hideAll();
			
			bootbox.alert({
			    message: ajaxLoadPage('quickLoadPage',{'pagename':'topUp/addTopUp'}),
			    size: 'large',
			    centerVertical: true,
			    closeButton: false
			});
		});

		$("#resetBtn").on('click', function(){
			$.confirm({
				icon: 'fa fa-window-restore',
			    title: 'Resetting?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: "Are you sure you want to <b>Reset</b> this user's password? (Default: tronpassword123)",
			    buttons: {
			        confirm: function () {
			        	ajaxShortLink('admin/userlist/resetPassword',{'userID':selectedData['userID']});
			        	loadDatatable('admin/getAllUsers');
			        	bootbox.hideAll();

			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successful reset of password of the user!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
			        },
			        cancel: function () {

			        },
			    }
			});
		});

		$("#verifyBtn").on('click', function(){

			$("#loading_text").text("Loading FaceMatcher");
			$("#loading").toggle();
			$("#initial_modal").toggle();
			$("#kyc_modal").toggle();

			if (selectedData.verified == 0) {
				Promise.all([
				  faceapi.nets.faceRecognitionNet.loadFromUri('assets/lib/faceapi/models'),
				  faceapi.nets.faceLandmark68Net.loadFromUri('assets/lib/faceapi/models'),
				  faceapi.nets.ssdMobilenetv1.loadFromUri('assets/lib/faceapi/models')
				]).then(start)

				async function start() {
					$("#loading_text").text("Comparing face descriptions");

					let image
					let canvas

			  		idImage = await faceapi.fetchImage("assets/imgs/kyc-imgs/id-imgs/"+selectedData.IDImagePath);
			  		image2Detections = await faceapi.detectAllFaces(idImage).withFaceLandmarks().withFaceDescriptors()

			  		console.log(idImage,image2Detections,image2Detections.length);

			  		if (image2Detections.length != 0) {

				  		var faceMatcher = new faceapi.FaceMatcher(image2Detections, 0.6)
				  		console.log(faceMatcher);

						$("#loading_text").text("Loading...");
				  		$("#loading").toggle();

				  		faceImg = await faceapi.fetchImage("assets/imgs/kyc-imgs/face-imgs/"+selectedData.FaceImagePath)
				  		canvas = faceapi.createCanvasFromMedia(faceImg)

				  		var displaySize = { width: faceImg.width, height: faceImg.height }
				  		faceapi.matchDimensions(canvas, displaySize)
				  		var detections = await faceapi.detectAllFaces(faceImg).withFaceLandmarks().withFaceDescriptors()

				  		if (image2Detections.length != 0) {
				  			var resizedDetections = faceapi.resizeResults(detections, displaySize)
				  			var results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))

				  			console.log(results);
				  			$("#errorReporter").removeClass("text-danger");
				  			$("#errorReporter").removeClass("text-success");

				  			if (results[0].distance >= 0.6) {
				  				$("#errorReporter").addClass("text-danger");
				  				$("#errorReporter").removeClass("text-success");

				  				$("#errorReporter").append("Face in images doesn't match");
				  				// $("#verify_user_btn").attr("disabled",true);
				  			}else{
				  				$("#errorReporter").removeClass("text-danger");
				  				$("#errorReporter").addClass("text-success");
				  				$("#errorReporter").append("Face image is matching with the ID Image");
				  			}
				  		}else{
							$("#errorReporter").addClass("text-danger");
							$("#errorReporter").removeClass("text-success");
							$("#errorReporter").text("No Face Found in Face Image");
			  				$("#verify_user_btn").attr("disabled",true);

				  		}
			  		}else{
			  			$("#errorReporter").addClass("text-danger");
			  			$("#errorReporter").removeClass("text-success");
						$("#errorReporter").text("No Face Found in ID Image");
		  				$("#verify_user_btn").attr("disabled",true);
						
						$("#loading_text").text("Loading...");
				  		$("#loading").toggle();
			  		}

			  		// results.forEach((result, i) => {
			  		//   var box = resizedDetections[i].detection.box
			  		//   var drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
			  		//   drawBox.draw(canvas)
			  		// })

				}
			}else{
				$("#loading").toggle();
				$("#loading_text").text("Loading...");
		
			}

			var idImg = document.getElementById('id_img_container')
			var faceImg = document.getElementById('face_img_container')

			
		});

		$("#deleteBtn").on('click', function(){
			$.confirm({
				icon: 'fa fa-trash',
			    title: 'Deleting?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: "Are you sure you want to <b>Delete</b> this user",
			    buttons: {
			        confirm: function () {
			        	ajaxShortLink('admin/userlist/deleteUser',{'userID':selectedData['userID']});
			        	loadDatatable('admin/getAllUsers');
			        	bootbox.hideAll();

			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successful deleted the user!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
			        },
			        cancel: function () {

			        },
			    }
			});
		});

		$('input[type=radio][name=isProContainer]').change(function() {
		    console.log(this.value);
		    var status;

			if (this.value=='false') {
				status=0
			}else{
				status=1
			}

			var res = ajaxShortLink("admin/updateProStatus",{
				'isPro':status,
				'userID':selectedData.userID,
			});

			if (res==false) {
	        	$.toast({
			        heading: '<h6>ERROR!</h6>',
			        text: 'Please contact system admin!',
			        showHideTransition: 'slide',
			        position: 'bottom-left'
			        // position: 'bottom-center'
			    })
			}
		});

		$('input[type=radio][name=blockContainer]').change(function() {
			if (this.value=='false') {
				ajaxShortLink('admin/userlist/unblockuser',{'userID':selectedData['userID']});
			}else{
				ajaxShortLink('admin/userlist/blockuser',{'userID':selectedData['userID']});
			}
		});
	// initial Modal

	// kyc Modal
		// var kycImages = ajaxShortLink("admin/getKYCImages",{
		// 	"userID":selectedData.userID
		// })


		if (selectedData.IDImagePath!=null && selectedData.FaceImagePath!=null && selectedData.fullname!=null && selectedData.birthday!=null &&selectedData.country!=null) {
			$("#id_img_container").attr("src","assets/imgs/kyc-imgs/id-imgs/"+selectedData.IDImagePath);
			$("#id_img_codownload").attr("href","assets/imgs/kyc-imgs/id-imgs/"+selectedData.IDImagePath);
			$("#face_img_container").attr("src","assets/imgs/kyc-imgs/face-imgs/"+selectedData.FaceImagePath);
			$("#face_img_download").attr("href","assets/imgs/kyc-imgs/face-imgs/"+selectedData.FaceImagePath);

			// $("#id_img_container").change();
		}else{
			$("#verifyBtn").text("Incomplete/No Image Uploaded")
			$("#verifyBtn").attr("disabled",true)
		}

		
		// console.log(kycImages);

		$("#kyc_back_btn").on('click', function(){
			$("#initial_modal").toggle();
			$("#kyc_modal").toggle();
		});

		$("#verify_user_btn").on('click', function(){
			$.confirm({
				icon: 'bi bi-check',
			    title: 'Verifiying?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>verify</b> this user?',
			    buttons: {
			        confirm: function () {
			        	ajaxShortLink('admin/userlist/verify',{
			        		'userID':selectedData['userID'],
			        		'email':selectedData['email'],
			        	});
			        	
			        	pushNewNotif("Verified!","Account Successfully verified. Enjoy Trading & Buying crypto with lower rates!",selectedData['userID'])

			        	loadDatatable('admin/getAllUsers');
			        	bootbox.hideAll();

			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successfully verified the user!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
			        },
			        cancel: function () {

			        },
			    }
			});
		});

		$("#reject_user_btn").on('click', function(){
			$.confirm({
				icon: 'bi bi-check',
			    title: 'Rejecting?',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to <b>Reject</b> this users KYC this will delete their current uploaded photos?',
			    buttons: {
			        confirm: function () {
			        	ajaxShortLink('admin/userlist/rejectedKyc',{
			        		'userID':selectedData['userID'],
			        		'faceFileName':selectedData['FaceImagePath'],
			        		'IdFileName':selectedData['IDImagePath'],
			        	});
			        	pushNewNotif("Rejected KYC!","Account KYC Rejected. Please Upload a new photo that follows the instructions!",selectedData['userID'])

			        	loadDatatable('admin/getAllUsers');
			        	bootbox.hideAll();

			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successfully rejected the user!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
			        },
			        cancel: function () {

			        },
			    }
			});
		});


		


		
		
	// kyc Modal

	


	
</script>