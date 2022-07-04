<script src="assets/js/rolldate.min.js"></script>
<style>
    /*@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');*/
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .mobileNumber input{
    position: absolute;
        height: 100%;
        width: 88%;
        padding: 0 25px;
        border: none;
        outline: none;
        font-size: 16px;
        border-bottom: 2px solid #ccc;
        border-top: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .mobileNumber input:is(:focus){
    border-bottom-color: #5426de;
    }

    /*.mobileNumber i{
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 20px;
    }

    .mobileNumber input:is(:focus) ~ i{
    color: #5426de;
    }

    .mobileNumber i.icon{
    left: 10;
    }*/

    .input-field i.showHidePw{
        right: 0;
        cursor: pointer;
        padding: 10px;
    }

    .input-field i.switchUserInput{
            right: 0;
            cursor: pointer;
            padding: 10px;
    }

    .form .text{
        color: #333;
        font-size: 14px;
    }

    .form a.text{
        color: #5426de;
        text-decoration: none;
    }

    .form a:hover{
    text-decoration: underline;
    }

    .login-signup-btn{
        width: 100%;
        height: 100%;
        border: none;
        color: #fff;
        font-size: 20px;
        font-weight: 1000;
        letter-spacing: 2px;
        background-color: #5426de;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .login-signup-btn:hover{
    background-color: #9e68e8;
    }

    button:disabled,
    button[disabled]{
    border: 1px solid #ac7eeb;
    background-color: #ac7eeb;
    }

    .form .login-signup{
        margin-top: 30px;
        text-align: center;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }

    /*kyc*/
    #title_kyc{
        /* font-size: 3rem; */
        /* font-weight: bold; */
        /* text-align:center; */
        position: relative;
        font-size: 35px;
        font-weight: 600;
        color: #5426de;
    }
    
    #title_kyc:before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        background-color: #5426de;
    }

    #subtitle_kyc {
        font-size:1rem;
        position: relative;
        /* line-height:2; */
    }

    #subtitle_kyc:before {
        display: inline-block;
        content: "";
        height: 1px;
        background: #939ba2!important;
        position: absolute;
        width: 170%;
        top: 50%;
        margin-left: 120px;
    }

    .icon_kyc{
        font-size:1rem!important;
        color:#5426de!important;
    }

    #instruction_kyc{
        font-size:1rem;
        text-align: justify;
        font-weight: 150;
        color: #939ba2!important;
        /* color:#5426de!important; */
    }

    .font2rem{
        font-size:2rem;
    }

    .font1rem{
        font-size:1rem!important;
    }

    .upload_button{
        width: 100%;
        height: 50px;
        border: none;
        color: #fff;
        font-size: 1rem;
        font-weight: 900;
        letter-spacing: 3px;
        background-color: #5426de;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top:10px;
        border-radius: 0.25rem;
    }

    .upload_button:hover{
        background-color: #9e68e8;
    }

    .check_upload{
        color:rgba(0, 0, 0, 0.5);
    }
    .checked_upload{
        color:green!important;
    }
    /*kyc*/

    /*otp*/
    #otp_container input{
        display:inline-block;
        width:2.5rem;
        height:2.5rem;
        text-align:center;
    }
    /*otp*/

    .is-invalid[for="mobileNumber"] {
    margin-left: 15px;
    }
    .bootstrap-select > select.mobile-device:focus + .dropdown-toggle, .bootstrap-select .dropdown-toggle:focus{
    box-shadow: none;
    outline: none !important;
    }
    .rolldate-panel {
        z-index: 1031!important;
    }

    .bootstrap-select > .dropdown-toggle{
        width: 70%!important;
    }

    .borderstatuscontainer{
        border:solid 2px #939ba2!important;
        border-radius: 10px;
    }
</style>
    <div class="px-3 py-5" style="display:block;" id="verify_kyc_container">
    <div id="title_kyc" class="mb-4 main-color-text"><span class="">Verification</span></div>
    <div class="pb-1"><span class="text-muted text-left" id="subtitle_kyc">Upload photo</span></div>

    <div id="instruction_kyc" class="text-start pt-3">
        <span>
            Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors
        </span>
    </div>

    <div class="row pt-2">
        <div class="col-6">
            <button id="faceUpload_btn" class="upload_button face_upload_btn" type="button">
                <span><i id="faceCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>
                <span  class="">Face</span>
            </button>

            <input class="form-control d-none" type="file" name="faceUpload" id="faceUpload" accept="image/png, image/gif, image/jpeg" >
        </div>
        <div class="col-6">
            <button id="IDUpload_btn" class="upload_button id_upload_btn" type="button">
                <span><i id="IDCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>
                <span  class="">ID</span>
            </button>
            <input class="form-control d-none" type="file" name="IDUpload" id="IDUpload" accept="image/png, image/gif, image/jpeg" >
        </div>
    </div>

    <div class="py-3">
        <div class="row">
            <div class="col-6" >
                <span class="main-color-text">Country</span><br>
                <select id="country_select" name="country_select"></select>
            </div>
            <div class="col-6">
                <span class="main-color-text">Birthday</span>
                <input readonly class="form-control" type="text" id="birthday" placeholder="Click to select date">
            </div>
        </div>

    </div>
    <div class="pb-3">
        <span class="main-color-text">Full Name</span>
        <input class="form-control" type="text" id="fullName_kyc" placeholder="Enter Full Name">
    </div>
    <hr>
    <div id="verify_status_container" class="py-3 px-5 my-3 check_upload text-start borderstatuscontainer">
        <div class="row">
            <div class="col-6 p-0">
                <i id="id_checkedi" class='fa fa-check check_upload ' aria-hidden='true'></i><span id="id_checkedt" class='check_upload'> ID uploaded</span><br>
                <i id="face_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="face_checkedt" class='check_upload'> Face uploaded</span>
                <i id="bday_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="bday_checkedt" class='check_upload'> Birthday</span>
            </div>
            <div class="col-6 text-start">
                <i id="name_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="name_checkedt" class='check_upload'> Full name</span><br>
                <i id="country_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="country_checkedt" class='check_upload'> Country</span>
            </div>
        </div>
    </div>
    <div id="noteslist_kyc" class="m-2"> 
        <div class="text-left main-color-text py-2" style="font-size: 1.5rem;"><b>Important Notes</b></div>
        <div class="row justify-content-around px-3">
            <div class="col p-0">
                <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Don't use photo filter</span><br>
                <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing make up</span>
            </div>
            <div class="col text-start">
                <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing glasses</span><br>
                 <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing hats</span>
            </div>
        </div>
    </div>
</div>

<script>
    var face_upload=0;
    var id_upload=0;
    var countryCodes = loadJsonViaURL("assets/json/countryCodes.json");

    for (var i = 0; i < countryCodes.length; i++) {
        $('#country_select').append(
            '<option value="'+countryCodes[i].name+'">'+countryCodes[i].name+'</option>'
        );
    }


    $('#country_select').selectpicker({
        style: '',
        size: 8,
        // showSubtext :true,
        liveSearch: true
     });

    var checkIfKYCPhotoExists = ajaxShortLink('main/checkIfKYCPhotoExists',{
        "userID":currentUser.userID
    });

    if (checkIfKYCPhotoExists!=false) {
        if (checkIfKYCPhotoExists.IDImagePath!=null) {
            id_upload=1;
            checkupload();
            $('#id_checkedi').addClass('checked_upload');
            $('#id_checkedt').addClass('checked_upload');
        }

        if (checkIfKYCPhotoExists.FaceImagePath!=null){
            face_upload=1;
            $('#face_checkedi').addClass('checked_upload');
            $('#face_checkedt').addClass('checked_upload');
            checkupload();
        }
    }

    $('#birthday').val(currentUser.birthday)
    $('#fullName_kyc').val(currentUser.fullname)

    if($('#birthday').val()!=null){
        $('#bday_checkedi').addClass('checked_upload');
        $('#bday_checkedt').addClass('checked_upload');
    }

    if($('#fullName_kyc').val()!=null){
        $('#name_checkedi').addClass('checked_upload');
        $('#name_checkedt').addClass('checked_upload');
    }

    if($('#country_select').val()!=null){
        $('#country_checkedi').addClass('checked_upload');
        $('#country_checkedt').addClass('checked_upload');
    }

    var currentUserID = currentUser.userID

    $("#faceUpload_btn").on("click",function(){
        $.confirm({
        theme:'dark',
        columnClass: 'col-md-6',
        title: "Face Upload",
        content: 'You want to Upload photo or Take photo?',
        buttons: {
            uploadPhoto:{
                text: 'Upload Photo',
                btnClass: 'btn-blue', 
                isHidden: false,
                isDisabled: false,
                action: function(uploadPhoto){
                    $('#faceUpload').click();
                }
            },
            takePhoto: {
                text: 'Take Photo', // text for button
                btnClass: 'btn-blue', // class for the button
                isHidden: false, // initially not hidden
                isDisabled: false, // initially not disabled
                action: function(takePhoto){
                    if(typeof isCordovaAndroid != 'undefined'){
                        console.log("hi");

                        bootbox.alert({
                            message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture'}),
                            size: 'large',
                            centerVertical: true,
                            closeButton: false
                        });
                    }else{
                        if (mobileAndTabletCheck()) {
                            $.confirm({
                                theme: 'dark',
                                title: 'Not Available!',
                                content: 'This Feature Is only available in Android & Desktop View, Please Download APK or Access your account in your desktop browser',
                                typeAnimated: true,
                                buttons: {
                                    close: function () {
                                    }
                                }
                            });
                        }else{
                            bootbox.alert({
                                message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture'}),
                                size: 'large',
                                centerVertical: true,
                                closeButton: false
                            });
                        }
                    }
                }
            },
            cancel:{
                text: 'Cancel', // text for button
                btnClass: 'btn-danger', // class for the button
                isHidden: false, // initially not hidden
                isDisabled: false, // initially not disabled
                action: function(cancel){

                }
            },
        }
        });
    });

    $("#IDUpload_btn").on("click", function(){
        // $('#IDUpload').click();
        $.confirm({
            theme:'dark',
            columnClass: 'col-md-6',
            title: "ID Upload",
            content: 'You want to Upload photo or Take photo?',
            buttons: {
                uploadPhoto:{
                    text: 'Upload Photo', // text for button
                    btnClass: 'btn-blue', // class for the button
                    isHidden: false, // initially not hidden
                    isDisabled: false, // initially not disabled
                    action: function(uploadPhoto){
                        $('#IDUpload').click();
                    }
                },
                takePhoto: {
                text: 'Take Photo', // text for button
                btnClass: 'btn-blue', // class for the button
                isHidden: false, // initially not hidden
                isDisabled: false, // initially not disabled
                action: function(takePhoto){
                    if(typeof isCordovaAndroid != 'undefined'){
                        console.log("hi");

                        bootbox.alert({
                            message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture_id'}),
                            size: 'large',
                            centerVertical: true,
                            closeButton: false
                        });
                    }else{
                        if (mobileAndTabletCheck()) {
                            $.confirm({
                                theme: 'dark',
                                title: 'Not Available!',
                                content: 'This Feature Is only available in Android & Desktop View, Please Download APK or Access your account in your desktop browser',
                                typeAnimated: true,
                                buttons: {
                                    close: function () {
                                    }
                                }
                            });
                        }else{
                            bootbox.alert({
                                message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture_id'}),
                                size: 'large',
                                centerVertical: true,
                                closeButton: false
                            });
                        }
                    }

                    
                }
            },
                cancel:{
                        text: 'Cancel', // text for button
                btnClass: 'btn-danger', // class for the button
                isHidden: false, // initially not hidden
                isDisabled: false, // initially not disabled
                action: function(cancel){
                    // longhand method to define a button
                    // provides more features
                }
                },
            }
        });
    });

    $('#faceUpload').change(function(){
        if ($(this).val()!='') {
            $.confirm({
                title: 'KYC - Face upload',
                columnClass: 'col-md-6 col-md-offset-6',
                content: 'Are you sure you want to upload image?',
                buttons: {
                    confirm: function () {
                        var fileContainer = document.getElementById('faceUpload');
                                // Check if any file is selected.
                        if (fileContainer.files.length > 0) {
                            for (var x = 0; x <= fileContainer.files.length - 1; x++) {
                                var file = fileContainer.files.item(x).size;
                                var fileSize = Math.round((file / 1024));
                                // The size of the file.
                                console.log(fileSize);
                                if (fileSize >= 4096) {
                                    $.confirm({
                                        theme: 'dark',
                                        title: 'Error!',
                                        content: 'File too Big, please select a file less than 4mb',
                                        typeAnimated: true,
                                        buttons: {
                                            close: function () {
                                            }
                                        }
                                    });
                                }else{
                                    continueUpload();
                                }
                            }
                        }
                        function continueUpload(){
                            var imageUploadFormData = new FormData();

                            imageUploadFormData.append(currentUserID+"_faceImage", $('#faceUpload')[0].files[0],currentUserID+"_faceImage");
                            imageUploadFormData.append('userID', currentUserID);

                            $("#faceUpload_btn").empty().append(
                                '<div style="font-size:12px;font-weight:100">'+
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
                                ' Uploading'+
                            '</div>'
                            ).attr('disabled',true);

                            var res;

                            setTimeout(function(){
                                res = JSON.parse(backendHandleFormData('saveFaceImageKyc',imageUploadFormData));

                                $("#faceUpload_btn").empty().append(
                                    '<span><i id="faceCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>'+
                                    '<span class="">Face</span>'
                                ).removeAttr('disabled');

                                console.log(res);

                                if (res.error==0) {
                                    face_upload = 1;
                                    checkupload();

                                    $.toast({
                                        heading: '<h6>Face Image Uploaded</h6>',
                                        text: 'Successfull!',
                                        showHideTransition: 'slide',
                                        // icon: 'success',
                                        position: 'bottom-center'
                                    })
                                }else{
                                    $.toast({
                                        heading: '<h6>Error In uploading. Please check if network is strong and contact system admin</h6>',
                                        text: 'Error!',
                                        showHideTransition: 'slide',
                                        // icon: 'success',
                                        position: 'bottom-center'
                                    })
                                }
                            },2000)
                        }
                        
                    },cancel: function () {
                        
                    },
                }
            });
        }        
    });

    $('#IDUpload').change(function(){
        if ($(this).val()!='') {
            $.confirm({
                title: 'KYC - ID upload',
                columnClass: 'col-md-6 col-md-offset-6',
                content: 'Are you sure you want to upload image?',
                buttons: {
                    confirm: function () {

                        var fileContainer = document.getElementById('IDUpload');
                        
                        if (fileContainer.files.length > 0) {
                            for (var x = 0; x <= fileContainer.files.length - 1; x++) {
                                var file = fileContainer.files.item(x).size;
                                var fileSize = Math.round((file / 1024));
                                // The size of the file.
                                console.log(fileSize);
                                if (fileSize >= 4096) {
                                    $.confirm({
                                        theme: 'dark',
                                        title: 'Error!',
                                        content: 'File too Big, please select a file less than 4mb',
                                        typeAnimated: true,
                                        buttons: {
                                            close: function () {
                                            }
                                        }
                                    });
                                }else{
                                    continueUpload();
                                }
                            }
                        }

                        function continueUpload(){
                            var imageUploadFormData = new FormData();

                            imageUploadFormData.append(currentUserID+"_IDImage", $('#IDUpload')[0].files[0],currentUserID+"_IDImage");
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
                        }
                                
                    },cancel: function () {
                        
                    },
                }
            });
        }
    });

    $('#birthday').change(function(){
        var res = ajaxShortLink("saveBirthday",{
            "birthday":$(this).val(),
            "userID":currentUserID,
        });
        console.log(res,currentUserID,currentUserID);

        if(res==false){
            $.alert("Error in Uploading Birthdate, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
        }
    });

    $('input[name="birthday"]').change(function(){
        var res = ajaxShortLink("saveBirthday",{
            "birthday":$(this).val(),
            "userID":currentUserID,
        });

        if(res==false){
            $.alert("Error in Uploading Birthdate, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
        }
    });

    $('#fullName_kyc').change(function(){
        var res = ajaxShortLink("saveName",{
            "fullname":$(this).val(),
            "userID":currentUserID,
        });

        if(res==false){
            $.alert("Error in Uploading name, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
        }
    });

    $('#country_select').change(function(){
        console.log($(this).val());
        var res = ajaxShortLink("saveCountry",{
            "country":$(this).val(),
            "userID":currentUserID,
        });

        if(res==false){
            $.alert("Error in Uploading name, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
        }
    });

    function checkupload(){
        if (id_upload == 1 && face_upload == 0){
            $('#instruction_kyc').html("\
            <span>Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors</span>\
            <br><span><b>ID photo uploaded</b></span>\
            ")
        }else if(face_upload == 1 && id_upload == 0){
            $('#instruction_kyc').html("\
            <span>Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors</span>\
            <br><span><b>Face photo uploaded</b></span>\
            ")
        }else{
            $('#instruction_kyc').html("\
            <span style='color:black;' class='main-color-text'> Face and ID uploaded successfull! you can also retake photo.</span>\
            ")
        }
    }

    new Rolldate({
        el: '#birthday',
        format: 'YYYY-MM-DD',
        beginYear: 1940,
        endYear: 2100,
        lang:{
            title:'Select date',
            cancel: 'Cancel',
            confirm: 'Confirm',
            year: '',
            month: '',
            day:  ''
        },
        confirm: function(date) {
            setTimeout(function(){
               console.log($("#birthday").val(),curntUserID);

               var res = ajaxShortLink("saveBirthday",{
                   "birthday":$("#birthday").val(),
                   "userID":currentUserID,
               });

               
               if(res==false){
                   $.alert("Error in Uploading Birthdate, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
               } 
           },300)
            
        },
        // init: function(){
        //     body.style.overflow = "hidden";
        // },confirm: function(date) {
        //     body.style.overflow = "auto";
        // },cancel: function(date) {
        //     body.style.overflow = "auto";
        // }
    })
</script>