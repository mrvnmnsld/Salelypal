<link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
  .modal-footer{
    display: none;
  }
  label.is-invalid{
    text-align: center;
    color: red;
  }
  .icon-size{
    font-size: 1.4em;
    max-width: 2em;
    padding-top: 10px;
  }
  .form-control { /* seems working on other ui bugs, no changes on current ui screens */
    height: 2.7em; 
  }
  .modal-content{
    background: transparent;
    border: 0;
  }
  #pagetitle_background{
    background: #293038;
    color: white;
    padding: 20px;
    border-radius: 20px 20px 0px 0px;
    box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
  }
  #main_modal_container{
    background-color: #F2F4F4;
    border-radius:0px 0px 20px 20px;
    box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
    padding: 20px;
  }
  #second_page_modal_container{
    background-color: #F2F4F4;
    border-radius:0px 0px 20px 20px;
    box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
    padding: 20px;
  }
</style>

<div id="pagetitle_background" class="text-center">
  <span class="h2 mt-2 fw-bold">Edit User Credentials</span>
</div>

<div id="main_modal_container">

  <div class="row mt-1">
    <div class="col-md-3 pl-3"><b>ID:</b></div> 
    <div class="col-md" id="idContainer"></div>  
  </div>

  <div class="row mt-1">
    <div class="col-md-3 pl-3"><b>Username:</b></div> 
    <div class="col-md" id="usernameContainer"></div>  
  </div>

  <div class="row mt-1">
    <div class="col-md-3 pl-3"><b>User Type:</b></div> 
    <div class="col-md" id="usertypeContainer"></div>  
  </div>

  <div class="row mt-1">
    <div class="col-md-3 pl-3"><b>Date Created:</b></div> 
    <div class="col-md" id="datecreatedContainer"></div>  
  </div>

   <hr>

  <div class="d-flex flex-row-reverse">
    <button type="button" class="btn btn-danger" id="close_btn">Close</button>
    <button type="button" class="btn btn-success mr-1" id="edit_credentials_btn">Edit Credentials</button>
  </div>
 
</div>

<div id="second_page_modal_container" style="display: none;">
  <div  class="form-group">

    <form id="update_login_form">

      <label class="fw-bold">Username</label> 
      <div class="input-group row m-1 mb-3">
        <i class="input-group-text fa fa-user-circle icon-size" aria-hidden="true"></i>
          <input type="text" class="form-control" id="username_input" name="username" placeholder="Username">
      </div>

      <label class="fw-bold">Old Password</label>
      <div class="input-group row m-1 mb-3">
        <i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
          <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
      </div>

      <label class="fw-bold">New Password</label>
      <div class="input-group row m-1 mb-3">
        <i class="input-group-text fa fa-key icon-size" aria-hidden="true"></i>
          <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
      </div>

      <hr>

      <div class="d-flex flex-row-reverse">
        <button type="button" class="btn btn-danger" id="closeBtn">Close</button>
        <button type="button" class="btn btn-success mr-1" id="save_btn">Save Changes</button>
      </div>

    </form>

  </div>
</div>

<script type="text/javascript">

  $("#idContainer").text(currentUser.id);
  $("#usernameContainer").text(currentUser.username);
  $("#usertypeContainer").text(currentUser.userType);
  $("#datecreatedContainer").text(currentUser.dateCreated);

  $("#close_btn").on("click", function(){
    bootbox.hideAll();
  });

  $("#edit_credentials_btn").on('click',function(){
    $("#main_modal_container").toggle();
    $("#second_page_modal_container").toggle();
  });

  $("#username_input").val(currentUser.username);

  $("#save_btn").on("click",function(){
    $("#update_login_form").submit();
  });

  $("#closeBtn").on("click", function(){
    bootbox.hideAll();
  });

  jQuery.validator.addMethod("checkAdminUserNameAvailability", function(value, element) {
    if (currentUser.username == value) {
      return true
    }else{
        return (ajaxShortLinkNoParse("admin/checkAdminUserNameAvailability",{'username':value}))
    }
  }, "Username already taken");


  jQuery.validator.addMethod("checkPasswordMatch", function(value, element) {
      return (ajaxShortLinkNoParse("checkPasswordMatch",{
        'oldPassword':currentUser.password,
        'matchingPassword':value
      }))
  }, "Old Password Doesn't match");

  $("#update_login_form").validate({
      errorClass: 'is-invalid',
      rules: {
      username: {
        required:true,
        minlength:3,
        checkAdminUserNameAvailability:true,
      },
      newPassword: {
        minlength:6,
      },
      oldPassword: {
        checkPasswordMatch: true,
        minlength:6,
        required:true
      }
      },
      submitHandler: function(form){
        var data = $('#update_login_form').serializeArray();

        data.push({
          "name":"id",
          "value":currentUser.id
        });


        var res = ajaxShortLink('admin/updateLoginInfo',data);

        // console.log(data,res);

        if(res == true){
          $.toast({
              heading: 'Success!!!',
              text: 'Agent Successfully Updated',
              icon: 'success',
          })

          bootbox.hideAll();
        }else{
          $.toast({
              heading: 'Error: System Error. Please contact admin if issue persist',
              text: 'Please try again',
              icon: 'error',
          })
        }

      }
  });

    
</script>