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
	  background: #5426de;
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
	  background: grey;
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
	      	<h1>On / Off Toggle</h1>
			<sub class="fw-bold">Click the toggle button if you want to enable the percentage selector</sub>
	    </div>

	    <input type="checkbox" id="switch" /><label for="switch">Toggle</label>

	    <br>

		<section class="section-dashboard">

			<div class="col-md-4">
					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title">Select Percentage <span>| Percent</span></h5>
							<div class="d-flex align-items-center">
							  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							    
							  </div>
								<div>
									<span id="rangeValue">0</span>
									<input class="range" type="range" value="0" min="0" max="100" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)">
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

	$(document).ready(function(){
	  $("#switch").click(function(){
	    $(".section-dashboard").toggle("swing");
	  });
	});

	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
	});

	function rangeSlide(value) {
        document.getElementById('rangeValue').innerHTML = value;
    }



</script>