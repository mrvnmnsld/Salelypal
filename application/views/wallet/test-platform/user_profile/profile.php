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
    /*tooltips*/
        #tooltipemail {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        #emailDiv #tooltipemail {
            visibility: hidden;
            width: auto;
            background-color: rgb(50, 50, 50);
            color: #94abef;
            text-align: center;
            border-radius: 6px;
            padding: 5px 5px;

        /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        #emailDiv:hover #tooltipemail {
            visibility: visible;
        }
        .not-verified{
            color:orange!important;
        }
        .rejected{
            color:red!important;
        }
        .verified{
            color:#23923d!important;
        }
</style>

<link href="https://fonts.googleapis.com/css?family=Oswald" rel=“stylesheet”>

<div id="body_container">
    <div id="profile_image_container" class="text-center m-5">

        <div>
            <img id="profilePic" src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="">
        </div>

        <span id="edit_profile_btn" class="text-muted">Edit profile <i id="editIcon" class="fa fa-edit mt-3 text-muted"></i></span>

    </div>

    <div id="profile_details_container" class="text-center my-3">
        <div id="name_email_div">
            <h1 id="fullname" class="display-4">Wallet Holder</h1>
            <h6 id="isVerified" class="text-muted isVerified">test</h6>
        </div>
        <div class="p-4">
            <h6>Information</h6>
            
            <hr class="mt-0 mb-4">
            <div class="row pt-1">
                <div id="emailDiv" class="col-6 mb-3">
                    <h6> Email </h6>
                    <p id="email" class="text-truncate text-muted">info@email.com</p>
                     <span id="tooltipemail"></span>
                </div>
            <div class="col-6 mb-3">
                <h6> Phone Number</i></h6>
                <p id="mobileNumber" class="text-muted">123 456 789</p>
            </div>
        </div>
        <div class="p-0">
            <hr class="mt-0 mb-4">
            <div class="row pt-1">
                <div class="col-6 mb-3">
                    <h6 id="userIDh6"> User ID# </h6>
                    <p id="userID" class="text-muted">#</p>
                </div>
            <div class="col-6 mb-3">
                <h6> Birthday </h6>
                <p id="birthday" class="text-muted">dd/mm/yyyy</p>
            </div>
        </div>
       <!--  <div id="goBackLink" class="mt-3">
            <a id="goBack" onclick="backButton()"><i class="fa fa-undo" aria-hidden="true"></i> Go back</a>
        </div> -->
    </div>
</div>

<script>
    var profiledetails = ajaxShortLink('userWallet/getProfileDetails',{'userID':currentUser.userID});
    var userID = profiledetails[0].userID;
    var fullName = profiledetails[0].fullname;
    var email = profiledetails[0].email;
    var mobileNumber = profiledetails[0].mobileNumber;
    var birthday = profiledetails[0].birthday;
    var profilePic = profiledetails[0].profile_pic;
    var verifiedBoolean = profiledetails[0].verified;
    var verified;

    if (profilePic != null) {
		$('#profilePic').attr('src','assets/imgs/profile_pic/'+profilePic);
	}

    if(verifiedBoolean==2){
        verified = 'Rejected, please re-submit KYC'
        $('#isVerified').removeClass('not-verified')
        $('#isVerified').removeClass('verified')
        $('#isVerified').addClass('rejected')
    }else if(verifiedBoolean==0){
        verified = 'Unverified User'
        $('#isVerified').addClass('not-verified')
        $('#isVerified').removeClass('verified')
        $('#isVerified').removeClass('rejected')
    }else{
        verified = 'Verified User'
        $('#isVerified').removeClass('not-verified')
        $('#isVerified').removeClass('rejected')
        $('#isVerified').addClass('verified')
    }

    $('#fullname').text(fullName);
    $('#userID').text(userID);
    $('#email').text(email);
    $('#mobileNumber').text(mobileNumber);
    $('#birthday').text(birthday);
    $('#tooltipemail').text(email);
    $('#isVerified').text(verified);
    

    $("#edit_profile_btn").on('click',function(){

        bootbox.alert({
            message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/user_profile/edit-profile'}),
            size: 'large',
            centerVertical: true,
            closeButton: false
        });
    });

    console

</script>


  
            

                

            