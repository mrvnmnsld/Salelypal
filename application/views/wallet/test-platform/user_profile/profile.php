<style>
    #profilePic {
        border-radius: 10%;
        width:16em;
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

<div id="body_container">
    <div id="profile_image_container" class="text-center m-5">

        <div>
            <img id="profilePic" src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="">
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

<script>
    var profiledetails = ajaxShortLink('userWallet/getProfileDetails',{'userID':15});
    var userID = profiledetails[0].userID;
    var fullName = profiledetails[0].fullname;
    var email = profiledetails[0].email;
    var mobileNumber = profiledetails[0].mobileNumber;
    var birthday = profiledetails[0].birthday;
    var profilePic = profiledetails[0].profile_pic;

    if (profilePic != null) {
		$('#profilePic').attr('src','assets/imgs/profile_pic/'+profilePic);
	}

    $('#fullname').text(fullName);
    $('#userID').text(userID);
    $('#email').text(email);
    $('#mobileNumber').text(mobileNumber);
    $('#birthday').text(birthday);

    $("#edit_profile_btn").on('click',function(){

        bootbox.alert({
            message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/user_profile/edit-profile'}),
            size: 'large',
            centerVertical: true,
            closeButton: false
        });
    });
</script>


  
            

                

            