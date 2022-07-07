<?php
    // Start a session.
    session_start();

    // Include the IconCaptcha classes.
    require('assets/src/captcha-session.class.php');
    require('assets/src/captcha.class.php');

    use IconCaptcha\IconCaptcha;

    // Set the IconCaptcha options.
    IconCaptcha::options([
        'iconPath' => '../../assets/icons/', // required, change path according to your installation.
        'token' => false
    ]);
    
    // If the form has been submitted, validate the captcha.
    if(!empty($_POST)) {
        if(IconCaptcha::validateSubmission($_POST)) {
            echo "test";
        } else {
            echo "test";
        }
    }

    echo dirname(__FILE__) . '../../assets/icons/';

?>
<html>

<head>
    <link rel="stylesheet" href=
"http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
  
    <script src=
        "http://code.jquery.com/jquery-1.11.1.min.js">
    </script>
  
    <script src=
		"http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js">
    </script>
  
    <script type="text/javascript">
        $(document).on('swipe', function(event) {
            console.log(event)
        })
    </script>
</head>
  
<body>
    <!-- <form method="post"> -->

        <!-- Additional security token to prevent CSRF. Optional but highly recommended - disable via IconCaptcha options. -->

        <!-- The IconCaptcha will be rendered in this element -->
    <div class="iconcaptcha-holder" data-theme="light"></div>
    hellp
        
    <!-- </form> -->

    <!-- Include IconCaptcha script & stylesheet | Change paths according to your installation -->
    <link href="assets/css/icon-captcha.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/icon-captcha.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            IconCaptcha.init('.iconcaptcha-holder', {
               general: {
                   validationPath: 'assets/src/captcha-request.php', // required, change path according to your installation.
                   fontFamily: 'Poppins',
                   credits: 'show',
               },
               security: {
                   clickDelay: 500,
                   hoverDetection: true,
                   enableInitialMessage: true,
                   initializeDelay: 500,
                   selectionResetDelay: 3000,
                   loadingAnimationDelay: 1000,
                   invalidateTime: 1000 * 60 * 2, // 2 minutes, in milliseconds
               },
               messages: {
                   initialization: {
                       verify: 'Verify that you are human.',
                       loading: 'Loading challenge...'
                   },
                   header: 'Select the image displayed the <u>least</u> amount of times',
                   correct: 'Verification complete.',
                   incorrect: {
                       title: 'Uh oh.',
                       subtitle: "You've selected the wrong image."
                   },
                   timeout: {
                       title: 'Please wait 60 sec.',
                       subtitle: 'You made too many incorrect selections.'
                   }
               }
           });
        });
    </script>
</body>
  
</html>    