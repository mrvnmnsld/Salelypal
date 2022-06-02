<style>
    #porfile_image {
        border-radius: 50%;
        width:10em;
        border:5px solid white;
        box-shadow: rgba(14, 30, 37, 0.5) 0px 2px 4px 0px, rgba(14, 30, 37, 0.9) 0px 2px 16px 0px;
    }
    #editIcon{
        font-size:1em;
        color:rgb(14, 30, 37);
    }
    #profile_details_container{
        /* background-color:rgba(0,0,0,.01); */
        height:25em;
    }
    #goBackLink{
        color:#004999;
    }
</style>

<link href="https://fonts.googleapis.com/css?family=Oswald" rel=“stylesheet”>
<link src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"rel=“stylesheet”>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<div id="body_container">
    <div id="profile_image_container" class="text-center m-5">

        <div>
            <img id="porfile_image" src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="">
        </div>

        <span id="edit_profile_btn" class="text-muted">Edit profile <i id="editIcon" class="fa fa-edit mt-3"></i></span>

    </div>

    <div id="profile_details_container" class="text-center my-3">
        <div id="name_email_div">
            <h1 id="fullname" class="display-4">Wallet Holder</h1>
        </div>
        <div class="p-4">
            <h6>Information</h6>
            
            <hr class="mt-0 mb-4">
            <div class="row pt-1">
                <div class="col-6 mb-3">
                    <h6> Email </h6>
                    <p id="email" class="text-muted">info@email.com</p>
                </div>
            <div class="col-6 mb-3">
                <h6> Phone </i></h6>
                <p id="mobileNumber" class="text-muted">123 456 789</p>
            </div>
        </div>
        <div class="p-0">
            <hr class="mt-0 mb-4">
            <div class="row pt-1">
                <div class="col-6 mb-3">
                    <h6 id="userIDh6"> User number </h6>
                    <p id="userID" class="text-muted">#</p>
                </div>
            <div class="col-6 mb-3">
                <h6> Birthday </h6>
                <p id="birthday" class="text-muted">dd/mm/yyyy</p>
            </div>
        </div>
        <div id="goBackLink" class="mt-3">
            <a id="goBack" onclick="backButton()"><i class="fa fa-undo" aria-hidden="true"></i> Go back</a>
        </div>
    </div>
</div>

<div id="edit_profile_container" class="p-3">
    <style>
        #edit_profile_container{
        border:black 2px solid;
        display: none;
        right: 0;
        top: 20%;
        height:70vh;
        width:100vw;
        position: fixed;
        margin: -5px auto 0 auto;
        background-color: white;
        z-index: 1;
        padding: 3px 0;
        border: 1px solid #151515;
        opacity: 0.1;
        }
        #edit_porfile_image {
        border-radius: 50%;
        width:5em;
        border:5px solid white;
        box-shadow: rgba(14, 30, 37, 0.5) 0px 2px 4px 0px, rgba(14, 30, 37, 0.9) 0px 2px 16px 0px;
        }
        #editImageIcon{
            font-size:1em;
            color:rgb(14, 30, 37);
        }
        #saveEdit_btn,#cancelEdit_btn{
            color:#004999;
        }
    </style>

    <div id="edit_profile_image_container" class="text-center my-3">
        <div>
            <img id="edit_porfile_image" src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="">
        </div>

        <span id="edit_image_btn" class="text-muted">change image <i id="editImageIcon" class="fa fa-edit my-2"></i></span>
    </div>


    
    <form class="row mx-3 text-left">
        <div class="form-group col-12">
            <small class="form-text text-muted">Hi! What would you like to modify?</small>
        </div>
        <div class="form-group col-12">
            <input type="text" class="form-control" id="fullnameEdit" placeholder="Enter desired name">
        </div>
        <div class="form-group col-12">
            <input type="email" class="form-control" id="emailEdit" placeholder="Enter new email">
        </div>
        <div class="form-group col-12">
            <input type="text" class="form-control" id="mobileNumberEdit" placeholder="Enter new number">
        </div>
        <div class="col-6 text-center">
            <a id="saveEdit_btn" onclick="saveEdit_btn()" class=""><i class="fa fa-floppy-o" aria-hidden="true"></i> save</a>
        </div>
        <div class="col-6 text-center">
            <a id="cancelEdit_btn" onclick="#" class=""><i class="fa fa-times" aria-hidden="true"></i> cancel</a>
        </div>
    </form>
    
</div>



<script>
	var profiledetails = ajaxShortLink('userWallet/getProfileDetails',{'userID':15});

    var userID = profiledetails[0].userID;
    var fullName = profiledetails[0].fullname;
    var email = profiledetails[0].email;
    var mobileNumber = profiledetails[0].mobileNumber;
    var birthday = profiledetails[0].birthday;

    var isEdit = 0;

    $('#fullname').text(fullName);
    $('#userID').text(userID);
    $('#email').text(email);
    $('#mobileNumber').text(mobileNumber);
    $('#birthday').text(birthday);


    $('#edit_profile_btn').on('click',function(){

        $('#fullnameEdit').val(fullName);
        $('#emailEdit').val(email);
        $('#mobileNumberEdit').val(mobileNumber);
            

        $('#edit_profile_container').fadeIn( "fast", function(){
            $(this).css('opacity', '1');
        });

        $('#edit_profile_container').css('box-shadow','0 0 0 max(100vh, 100vw) rgba(0, 0, 0, .5)');
        $('#edit_profile_container').css('z-index','999');
            
	});

    function saveEdit_btn(){

        $('#edit_profile_container').fadeOut( "slow", function(){
            $(this).css('opacity', '.1');
        });

    }
</script>


  
            

                

            