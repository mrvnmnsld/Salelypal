<!-- <script src="assets/vendor/jquery-ui-1.13.0.custom/jquery-ui.js"></script>
<link href="assets/vendor/jquery-ui-slider-captcha-master/css/slider-captcha.css" rel="stylesheet" />
<script src="assets/vendor/jquery-ui-slider-captcha-master/js/slider-captcha.js"></script> -->
<script src="assets/vendor/text-captcha-master/jquery.textCaptcha.js"></script> -->
<link href="assets/vendor/text-captcha-master/textCaptcha.css" rel="stylesheet" />

<div id="slider">

</div>

<script type="text/javascript">
	$(document).ready(function() {
		$( '#slider' ).sliderCaptcha({
			face: {
				icon: 'plus',
				iconAfterUnlock: 'stop'
			}
		});
	})
</script>