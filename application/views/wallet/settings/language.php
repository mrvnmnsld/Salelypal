<div class="p-2 m-1">
	<label>Language Selector: </label>
	<div class="form-group w-100 align-middle">
	    <select id="language_selector" class="form-control form-control-sm">
	        <option value="">Select language...</option>
	        <option class="notranslate" value="en">English</option>
	        <option value="zh-CN">Simplified Chinese</option>
	        <option value="zh-TW">Traditional Chinese</option>
	        <option value="ja">Japanese</option>
	        <option value="de">German</option>
	        <option value="es">Spanish(Spain)</option>
	        <option value="it">Italian</option>
	        <option value="fr">French</option>
	        <option value="ar">Arabic</option>
	        <option value="ru">Russian</option>
	        <option value="id, in">Jawa(Indonesia)</option>
	    </select>
	</div>

	<div class="text-center">Note: Report inaccurate translation to our system admins</div>

	<div class="mt-3">
		<button class="btn btn-success btn-block" id="save_btn">Save Language</button>
		<button class="btn btn-danger red-btn btn-block" id="close_btn">Back</button>
	</div>

	
</div>

<!-- google translate -->
  <script type="text/javascript">

  	var languange = getCookie("googtrans");
  	$("#language_selector").val(languange.split("/")[2])

		$("#save_btn").on('click',function(){

			if ($("#language_selector").val()!="") {
				$.confirm({
					icon: 'fa fa-language',
					title: 'Changing language?',
					columnClass: 'col-md-6 col-md-offset-6',
					content: 'Are you sure you want to <b>Change the language</b> to '+$("#language_selector option:selected").text()+'?',
					buttons: {
						confirm: function () {
							var lang = "/en/"+$("#language_selector").val()
							deleteAllCookies();
							setCookie('googtrans',lang ,1);
							location.reload();
						},
						cancel: function () {

						},
					}
				});
			}else{
				$.alert("Please select language");
			}
		})

		$("#close_btn").on('click',function(){
			$("#tittle_container").text('Settings');
			$.when(closeNav()).then(function() {
				$('#topNavBar').toggle();
		  		$("#container").fadeOut(animtionSpeed, function() {
				  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
			  			$("#container").empty();
			  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings'}));

				  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  			$('#topNavBar').toggle();
				  			$("#container").fadeIn(animtionSpeed);
				  		});
			    	});
			  	});
			});
		})

		function getCookie(cname) {
		  let name = cname + "=";
		  let decodedCookie = decodeURIComponent(document.cookie);
		  let ca = decodedCookie.split(';');
		  for(let i = 0; i <ca.length; i++) {
		    let c = ca[i];
		    while (c.charAt(0) == ' ') {
		      c = c.substring(1);
		    }
		    if (c.indexOf(name) == 0) {
		      return c.substring(name.length, c.length);
		    }
		  }
		  return "";
		}


		function setCookie(key, value, expiry) {
			var expires = new Date();
			expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
			document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
		}

		function deleteAllCookies() {
		    var cookies = document.cookie.split(";");

		    for (var i = 0; i < cookies.length; i++) {
		        var cookie = cookies[i];
		        var eqPos = cookie.indexOf("=");
		        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
		        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
		    }
		}


  </script>
<!-- google translate -->
