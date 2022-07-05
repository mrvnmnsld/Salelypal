
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
    <center>
        <h1>GeeksforGeeks</h1>
        <h4>swipe Event using jQuery Mobile</h4>
    </center>
    <a data-role="button" id="gfg">click</a>
</body>
  
</html>    