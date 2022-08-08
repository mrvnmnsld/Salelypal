<!DOCTYPE html public "Gerard Braad"> 
<html>
	<head>
    	<title>GAuth Authenticator</title>
        <meta charset="utf-8">
        <meta name="description" content="GAuth Authenticator">
		<meta name="HandheldFriendly" content="True">
		<meta http-equiv="cleartype" content="on">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- purposely at the top -->
        <script src="jquery-1.7.2.min.js"></script>
		<script src="init.js"></script>
		<script src="jquery.mobile-1.1.0.min.js"></script>
		<script src="sha.js"></script>
		<script src="code.js"></script>
		<link rel="stylesheet" href="jquery.mobile-1.1.0.min.css" />
		<link rel="stylesheet" href="styling.css" />
		<link rel="shortcut icon" href="./favicon.ico" />
		<link rel="apple-touch-icon" href="./images/icon-48.png" />
	</head>
	<body>
		<div data-role="page" id="main" data-theme="a">

			<div data-role="header">
				<h1>GAuth Authenticator</h1>
                <a href="#settings" data-role="button" data-rel="dialog" data-icon="plus" data-iconpos="notext">Settings</a>
                <a href="#about" data-role="button" data-rel="dialog" data-icon="info" data-iconpos="notext">About</a>
            </div>

			<div data-role="content">	
				<ul data-role="listview" data-inset="true" data-theme="a"  data-split-theme="b" data-split-icon="delete" id="accounts">
					<li id="accountsHeader" data-role="list-divider">One-time passwords<span class="ui-li-count" id='updatingIn'>..</span></li>
				</ul>				
			</div>

			<div data-role="footer">
				<h1>@gbraad</h1>
			</div>

		</div>

		<div data-role="dialog" id="settings" data-theme="a">
			<div data-role="header">
				<h1>Settings</h1>
			</div>
			<div data-role="content">
				<p>
					<form>
						Account name:
						<input type="text" name="keyAccount" id="keyAccount" value="" />
						Secret key:
						<input type="text" name="keySecret" id="keySecret" value="" />
					</form>
				</p>
			        <p>
					<a href="#main" data-role="button" data-rel="back" data-theme="a" id="add">Add</a>
					<a href="#main" data-role="button" data-rel="back" data-theme="a">Cancel</a>
				</p>
			</div>
		</div>

    	<div data-role="dialog" id="about" data-theme="a">
			<div data-role="header">
				<h1>About</h1>
			</div>
			<div data-role="content">
                <p>A simple application for use with Google Authenticator written in HTML using jQuery Mobile (and PhoneGap), jsSHA and LocalStorage.</p>
                <p><ul>
                    <li>Online<br/><a href="http://gauth.apps.gbraad.nl/">http://gauth.apps.gbraad.nl/</a></li>
                    <li>Application<br/><a href="https://build.phonegap.com/apps/135419/">for Android</a></li>
                    <li>Extension<br/><a href="https://chrome.google.com/webstore/detail/ilgcnhelpchnceeipipijaljkblbcobl?utm_source=chrome-ntp-icon">for Chrome</a></li>
                    <li>Webapp<br/><a href="https://marketplace.mozilla.org/app/gauth-authenticator/">Mozilla Marketplace</a></li>
                    <li>Source code<br/><a href="http://github.com/gbraad/html5-google-authenticator">http://github.com/gbraad/html5-google-authenticator</a></li>
                    <li>Thanks to Russell Sayers<br/><a href="http://blog.tinisles.com/2011/10/google-authenticator-one-time-password-algorithm-in-javascript/">TOTP Algorithm</a></li>
                </ul></p>
                <p>For more details or if you have suggestions, please do not hesitate to contact me at <a href="mailto:me@gbraad.nl?subject=gauth+authenticator">me@gbraad.nl</a>.<br/><br/>
                    <a href="https://flattr.com/thing/717982/GAuth-Authenticator" target="_blank"><img src="images/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a>
                </p>
			</div>
		</div>
</body>
</html>