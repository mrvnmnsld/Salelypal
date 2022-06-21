<div id="edit_profile_container" class="p-3">
    <style>
        .modal-footer{
            display:none;
        }
        #profilePicEdit {
        border-radius: 10%;
        width:16em;
        border:5px solid white;
        box-shadow: rgba(14, 30, 37, 0.5) 0px 2px 4px 0px, rgba(14, 30, 37, 0.9) 0px 2px 16px 0px;
        }
        #editImageIcon{
            font-size:1em;
            color:rgb(14, 30, 37);
        }
        #saveEdit_btn,#cancelEdit_btn{
            margin-top:3em;
        }
    </style>
    <div id="edit_profile_image_container" class="text-center my-3">
        <div class="">
            <img id="profilePicEdit" src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="">
        </div>
        <span id="edit_image_btn" class="text-muted"><small>change image <i id="editImageIcon" class="fa fa-edit my-2 text-muted"></i></small></span>
        <input class="form-control d-none" type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/gif, image/jpeg" >
    </div>
    <form id="editprofile_form" class="row mx-1 text-left">
        <div class="form-group col-12">
            <span style="color:#004999;" class="form-text main-color-text">Edit personal information :</span>
        </div>
        <div class="form-group col-12">
            <input type="text" class="form-control" id="fullNameEdit" name="fullNameEdit" placeholder="Enter desired name">
        </div>
        <div class="form-group col-12">
            <input type="date" class="form-control" id="birthdayEdit" name="birthdayEdit" placeholder="Enter new email">
        </div>
        <div class="form-group col-12">
            <input type="text" class="form-control" id="mobileNumberEdit" name="mobileNumberEdit" placeholder="Enter new number">
        </div>
        <div class="col-6 text-center">
            <a id="saveEdit_btn" class=""><i class="fa fa-floppy-o text-muted" aria-hidden="true"></i> save</a>
        </div>
        <div class="col-6 text-center">
            <a id="cancelEdit_btn" class=""><i class="fa fa-times text-muted" aria-hidden="true"></i> cancel</a>
        </div>
    </form>
</div>  

<script>
    console.log(profiledetails);
    $('#fullNameEdit').val(fullName);
    $('#mobileNumberEdit').val(mobileNumber);
    $('#birthdayEdit').val(birthday);

    if (profilePic != null) {
		$('#profilePicEdit').attr('src','assets/imgs/profile_pic/'+profiledetails[0].profile_pic);
	}

    $("#cancelEdit_btn").on("click", function(){
		bootbox.hideAll();
	});

    $("#saveEdit_btn").on("click", function(){
        $("#editprofile_form").submit();
	});

    $("#editprofile_form").validate({ 
        errorClass: 'is-invalid',
	  	rules: {
            fullNameEdit: "required",
            birthdayEdit: "required",
            mobileNumberEdit: "required",
	  	},
	  	submitHandler: function(form){
		    var data = $('#editprofile_form').serializeArray();
		    data.push({
		    		"name":"userID",
		    		"value":userID
		    });
		    var res = ajaxShortLink('main/editProfileV2',data);

		    console.log(data,res);

		    if(res == true){
		    	$.toast({
		    	    text: 'Profile Successfully Updated',
		    	    showHideTransition: 'slide',
					allowToastClose: false,
					hideAfter: 5000,
					stack: 5,
					position: 'bottom-center',
	    		    textAlign: 'center',
	    		    loader: true,
	    		    loaderBg: '#9EC600'
		    	})

		    	bootbox.hideAll();
		    }else{
		    	$.toast({
		    	    text: 'System Error, Please Contact System Admin',
		    	    showHideTransition: 'fade',
					allowToastClose: false,
					hideAfter: 5000,
					stack: 5,
					position: 'bottom-center',
	    		    textAlign: 'center',
	    		    loader: true,
	    		    loaderBg: '#9EC600'
		    	})
		    }
	  	}
    });

    $("#edit_image_btn").on("click", function(){
        $('#fileToUpload').click();
    });

    $('#fileToUpload').change(function(){
  		readURL(this);

		$.confirm({
			icon: 'fa fa-plus-circle',
		    title: 'New Profile Pic?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to upload your new profile pic?',
		    buttons: {
		        confirm: function () {
		        	var imageUploadFormData = new FormData();
		        	var generatedString = generateOTP();

		        	imageUploadFormData.append(generatedString+"_profile_pic", $('#fileToUpload')[0].files[0],generatedString+"_profile_pic");
		        	imageUploadFormData.append('oldPic', profiledetails[0].profile_pic);
		        	imageUploadFormData.append('userID', currentUser['userID']);

			     	var newPhoto = backendHandleFormData('saveNewProfilePic',imageUploadFormData);
                    profiledetails = ajaxShortLink('userWallet/getProfileDetails',{'userID':15});
                    console.log(profiledetails);

    			    $.toast({
    			        text: 'Successfully saved all changes! You will be logged out for security purposes!',
    			        showHideTransition: 'slide',
						allowToastClose: false,
						hideAfter: 5000,
						stack: 5,
						position: 'bottom-center',
		    		    textAlign: 'center',
		    		    loader: true,
		    		    loaderBg: '#9EC600'
    			    })

    			    // setTimeout(function() {
    			    //   logOutClearStorage();
    			    // }, 3000);

		        },
		        cancel: function () {
		        	$('#profilePicEdit').attr('src','assets/imgs/profile_pic/'+currentUser["profile_pic"]);
		        },
		    }
		});
	});

    function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        
	        reader.onload = function (e) {
	            $('#profilePicEdit').attr('src', e.target.result);
                $('#profilePic').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	    }
	}

</script>