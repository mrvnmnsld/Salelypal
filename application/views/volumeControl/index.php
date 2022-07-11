<style>
	#rangeValue {
	  display: block;
	  text-align: center;
	  font-size: 6em;
	  color: #999;
	  font-weight: 400;
	}
	.range {
	  width: 400px;
	  height: 15px;
	  -webkit-appearance: none;
	  background: #111;
	  outline: none;
	  border-radius: 15px;
	  overflow: hidden;
	  box-shadow: inset 0 0 5px rgba(0, 0, 0, 1);
	}
	.range::-webkit-slider-thumb {
	  -webkit-appearance: none;
	  width: 15px;
	  height: 15px;
	  border-radius: 50%;
	  background: #5426de;
	  cursor: pointer;
	  border: 4px solid #333;
	  box-shadow: -407px 0 0 400px #5426de;
	}
	#switch[type=checkbox]{
	  height: 0;
	  width: 0;
	  visibility: hidden;
	}

	label {
	  cursor: pointer;
	  text-indent: -9999px;
	  width: 100px;
	  height: 50px;
	  background: grey;
	  display: block;
	  border-radius: 100px;
	  position: relative;
	}

	label:after {
	  content: '';
	  position: absolute;
	  top: 5px;
	  left: 5px;
	  width: 40px;
	  height: 40px;
	  background: #fff;
	  border-radius: 90px;
	  transition: 0.3s;
	}

	#switch:checked + label {
	  background: #5426de;
	}

	#switch:checked + label:after {
	  left: calc(100% - 5px);
	  transform: translateX(-100%);
	}

	label:active:after {
	  width: 130px;
	}
</style>

<div id="innerContainer" style="display:none" class="card">
	<div class="p-4">
		<div class="pagetitle">
	      	<h1>Volume Control</h1>
			<sub class="fw-bold">Set User withdrawal limit by their top up total</sub>
	    </div>

	    <input type="checkbox" id="switch" onclick="toggle_btn()" /><label for="switch">Toggle</label>

	    <br>

		<section class="section-dashboard">
			<div class="">
				<div class="">
					<div class="card-body">
						<h5>Select Percentage <span>| Percent</span></h5>
						<div class="d-flex align-items-center">
						  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
						    
						  </div>
							<div>
								<span id="rangeValue">0</span>
								<input class="range" type="range" value="0" min="0" max="100" onChange="rangeSlide(this.value)">
							</div>
							<i class="fa fa-percent"></i>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div>
</div>

<script>
	var getVolumeControl = ajaxShortLink("getVolumeControl");

	if (getVolumeControl[0].isOn == "1") {
		console.log("here");
		$("#switch").prop( "checked", true );

		document.getElementById('rangeValue').innerHTML = getVolumeControl[0].percentage;
		$(".range").val(getVolumeControl[0].percentage);

		setTimeout(function(){
			$(".section-dashboard").css("display","block");
		},10)
	}

	function toggle_btn(){
		console.log("there");
		if ($('#switch').is(":checked")==true) {
			$(".section-dashboard").css("display","block");

			var updateVolumeControl = ajaxShortLink('admin/updateVolumeControl',{
				"isOn":1
			});
		}else{
			$(".section-dashboard").css("display","none");

			var updateVolumeControl = ajaxShortLink('admin/updateVolumeControl',{
				"isOn":0
			});
		}
	}

	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
		$(".section-dashboard").toggle();
	});

	function rangeSlide(value) {
        document.getElementById('rangeValue').innerHTML = value;

        var updateVolumeControl = ajaxShortLink('admin/updateVolumeControl',{
        	"percentage":value
        });
    }



</script>