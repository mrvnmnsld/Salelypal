<style>
	.card{
		border-radius: 5px;
	}
	.assets-btn{
		border: none;
		color: #f3f6f8;
		border-radius: 5px;
	  background-color: #5426de;
	  box-shadow: 0 4px #220e5d;
	}
	.assets-btn:hover{
	  box-shadow: 0 2px #220e5d;
	  top: 2px;
	}
	.assets-btn:active{
	  box-shadow: 0 0 #220e5d;
	  top: 6px;
	}
	.profilePic{
		width: 154px;
		height: 148px;
	}
	:root {
		--m3-border: #e1e1e1;
		--m3-tabs-bg: #fff;
		--m3-tab-text: #5426de;
		--m3-tab-bg: transparent;
		--m3-tab-hover-text: #888;
		--m3-tab-hover-bg: transparent;
		--m3-tab-active-text: #5426de;
		--m3-tab-active-bg: transparent;
	}
	section {
		padding-top: 20px;
		padding-bottom: 20px;
	}
	.tab-content .tab-pane {
		text-align: center;
	}
	#model_3 .nav-tabs {
		border: 0;
		text-align: center;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: flex;
		-ms-box-orient: horizontal;
		-ms-box-pack: center;
		-webkit-flex-flow: row wrap;
		-moz-flex-flow: row wrap;
		-ms-flex-flow: row wrap;
		flex-flow: row wrap;
		-webkit-justify-content: center;
		-moz-justify-content: center;
		-ms-justify-content: center;
		justify-content: center;
	}
	#model_3 .nav .nav-item {
		position: relative;
		z-index: 1;
		display: block;
		margin: 0;
		text-align: center;
		-webkit-flex: 1;
		-moz-flex: 1;
		-ms-flex: 1;
		flex: 1;
	}
	#model_3 .nav .nav-link {
		border: 0;
		border-radius: 0;
		padding: 0.5em 0;
		border-left: 1px solid var(--m3-border);
		-webkit-transition: color 0.2s;
		transition: color 0.2s;
		position: relative;
		display: block;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		line-height: 2.5;
		background-color: var(--m3-tab-bg);
		color: var(--m3-tab-text);
		outline: none;
	}
	#model_3 .nav .nav-link::before {
		content: '';
		display: block;
		position: absolute;
		z-index: 10;
  	bottom: 6px;
		height: 6px;
    left: 0;
    width: 100%;    
    background: var(--m3-tabs-bg);    
    -webkit-transition: -webkit-transform 0.3s;
    transition: transform 0.3s;
    -webkit-transform: translate3d(0,150%,0);
    transform: translate3d(0,150%,0);
	}
	#model_3 .nav .nav-item:last-child a {
    border-right: 1px solid var(--m3-border);
	}
	#model_3 .nav .nav-link:hover {
		background-color: var(--m3-tab-hover-bg);
		color: var(--m3-tab-hover-text);
	}
	#model_3 .nav .nav-link.active, 
	#model_3 .nav .nav-link.active:hover {
		background: var(--m3-tab-active-bg);
		color: var(--m3-tab-active-text);
	}
	#model_3 .nav .nav-link.active::before {
    background: var(--m3-tab-active-text);
	}
	#model_3 .nav i {
		display: inline-block;
		margin: 0 0.4em 0 0;
		vertical-align: middle;
		text-transform: none;
		font-weight: normal;
		font-variant: normal;
		font-size: 1.3em;
		line-height: 1;
		-webkit-backface-visibility: hidden;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}
	.main-color-text{
		color: #5426de!important;
	}
</style>

	<div class="row">
			
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Assets</h5>
						<div class="align-items-center">
						  <div class="ps-3">
						  	<div class="row">
						  		<div class="col-8">
								    <span class="text-muted fw-bold">Total Balance</span>
								    <i class="fa fa-eye fa-lg text-muted"></i>
						  		</div>
						  		<div class="col-4">
								    <div class="dropdown">
										  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    USD
										  </button>
										  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
										    <button class="dropdown-item" type="button">EUR</button>
										    <button class="dropdown-item" type="button">PHP</button>
										    <button class="dropdown-item" type="button">GBP(Pounds)</button>
										  </div>
										</div>
						  		</div>
						  	</div>
								  <div class="d-flex">
						    		<h2 id="" class="mr-2">0</h2>
								    <h4>USD</h4>
								  </div>
						  </div>
						</div>

						<br>
						<hr>

						<div class="row justify-content-center">
							<button class="assets-btn col-3 text-center mr-2">
								<div class="row">
									<i class="fa fa-arrow-circle-down fa-lg mt-2"></i>
				          <span>Deposit</span>
								</div>
			        </button>
			        <button class="assets-btn col-3 text-center mr-2">
			        	<div class="row">
				          <i class="fa fa-arrow-circle-up fa-lg mt-2"></i>
				          <span>Withdraw</span>
			        	</div>
			        </button>
			        <button class="assets-btn col-3 text-center">
			        	<div class="row">
				          <i class="fa fa-credit-card-alt fa-lg mt-2"></i>
				          <span>Buy</span>
			        	</div>
			        </button>
						</div>

					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Profile <span>| Information</span></h5>

						<div class="row">
							<div class="col-4">
								<div class="row">
									<div class="mt-1">
										<img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="img-thumbnail profilePic">
									</div>
										<span id="edit_profile_btn" class="text-muted ml-3">Edit profile <i id="editIcon" class="fa fa-edit mt-3 text-muted"></i></span>
								</div>
							</div>

							<div class="col-8">

								<div class="row">
									<div class="col-5">
										<h6 id="userIDh6">User ID</h6>
										<p id="userID" class="text-muted">#</p>
									</div>
									<div class="col-7">
										<h6>Email</h6>
										<p id="email" class="text-truncate text-muted">info@email.com</p>
										<span id="tooltipemail"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-5">
										<h6 id="">Number</h6>
										<p id="mobileNumber" class="text-muted">123 456 789</p>
									</div>
									<div class="col-7">
										<h6>Birthday</h6>
										<p id="birthday" class="text-muted">dd/mm/yyyy</p>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Settings</h5>

							<div class="main-color-text font-weight-bold h6">Follow Us</div>

								<div class="row">
									<div class="col-4">
										<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
											<i class="fa fa-facebook-square" aria-hidden="true"></i>
											<span class="">&nbsp;Facebook</span>
										</button>
									</div>
									<div class="col-4">
										<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
											<i class="fa fa-telegram" aria-hidden="true"></i>
											<span class="">&nbsp;Telegram</span>
										</button>
									</div>
									<div class="col-4">
										<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
											<i class="fa fa-twitter-square" aria-hidden="true"></i>
											<span class="">&nbsp;Twitter</span>
										</button>
									</div>
								</div>

								<div class="row">
									<div class="col-4">
										<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
											<i class="fa fa-youtube-play" aria-hidden="true"></i>
											<span class="">&nbsp;Youtube</span>
										</button>
									</div>
									<div class="col-4">
										<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
											<i class="fa fa-reddit" aria-hidden="true"></i>
											<span class="">&nbsp;Reddit</span>
										</button>
									</div>
								</div>

							<div class="main-color-text font-weight-bold h6 mt-"2>Support</div>

								<div class="row">
									<div class="col-6">
										<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 20px;margin-left:3px">
											<i class="fa fa-question" aria-hidden="true"></i>
											<span class="" style="font-size: 18px;margin-left:2px">&nbsp;FAQ/Help Center</span>
										</button>
									</div>
									<div class="col-6">
										<button id="chat_support_btn" class="btn custom-2nd-text  btn-block text-left" style="font-size: 20px;margin-left:3px">
											<i class="fa fa-comments" aria-hidden="true"></i>
											<span class="" style="font-size: 18px;margin-left:2px">&nbsp;Chat Support</span>
										</button>
									</div>
								</div>

					</div>
				</div>
			</div>

	</div>

	<div class="card">
		<div class="card-body">
			<div id="inner-container">
				<section id="model_3">
					<div class="tabs-container">
						<ul class="nav nav-tabs container" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="balance-tab" data-toggle="tab" href="#balance" role="tab" aria-controls="home" aria-selected="true"></i>Balance</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab" aria-controls="profile" aria-selected="false"></i>Portfolio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="rise-tab" data-toggle="tab" href="#rise" role="tab" aria-controls="contact" aria-selected="false"></i>Rise Fall</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="long-tab" data-toggle="tab" href="#long" role="tab" aria-controls="contact" aria-selected="false"></i>Long Short</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="contact" aria-selected="false"></i>Daily Mining</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="regular-tab" data-toggle="tab" href="#regular" role="tab" aria-controls="contact" aria-selected="false"></i>Regular Mining</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="discover-tab" data-toggle="tab" href="#discover" role="tab" aria-controls="contact" aria-selected="false"></i>Discover</a>
							</li>
						</ul>
					</div>

					<div class="tab-content container" id="myTabContent">
						<!-- balance -->
							<div class="tab-pane fade show active" id="balance" role="tabpanel" aria-labelledby="balance-tab"><br>
									<div id="tokenContainer"></div>

									
									<div class="row">
										<div class="col-6 text-center">
											<button class="btn main-color-text mt-2 text-muted"  id="addToken_btn">
												<i class="fa fa-sliders" aria-hidden="true"></i>
												Add more
											</button>
										</div>

										<div class="col-6 text-center">
											<button class="btn main-color-text mt-2 text-muted"  id="refresh_btn">
												<i class="fa fa-refresh" aria-hidden="true"></i>
												Refresh
											</button>
										</div>
									</div>
							</div>
						<!-- balance -->

						<!-- portfolio -->
							<div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab"><br>
								<div class="row mt-3">
									<div class="col-3">
										<b class="main-color-text">Today's Earnings(Trading):</b>
											<span id="todaysEarning">
												<b>0 USD</b>
											</span>
									</div>
									<div class="col-3">
										<b class="main-color-text">Yesterdays PNL:</b>
											<span id="yesterdayPnl">
												<b>0% Change</b>
											</span>
									</div>
									<div class="col-3">
										<b class="main-color-text">7 Days PNL:</b>
											<span id="allDaysPnl">
												<b>0% Change</b>
											</span>
									</div>
									<div class="col-3">
										<b class="main-color-text">14 Days PNL:</b>
											<span id="14DaysPnl">
												<b>0% Change</b>
											</span>
									</div>
								</div>

								<div class="row mt-5">
									<div class="col-4" style="border:1px solid red">
										7 Days PNL Chart
									</div>
									<div class="col-4" style="border:1px solid red">
										14 Days PNL Chart
									</div>
									<div class="col-4" style="border:1px solid red">
										Assets Distribution
									</div>
								</div>
							</div>
						<!-- portfolio -->

						<!-- risefall -->
							<div class="tab-pane fade" id="rise" role="tabpanel" aria-labelledby="rise-tab">
								<div id="innerContainer">

								    <div class="main-color-text p-1">

								        <div class="p-2 mt-5">
								    			<label class="fw-bold">Select Token Pair: </label>
								            <select id="token_pair_select" class="p-2 form-control main-card-ui main-color-text">
								                <option>BTC/USDT</option>
								                <option>ETH/USDT</option>
								                <option>XRP/USDT</option>
								                <option>BNB/USDT</option>
								                <option>DOGE/USDT</option>
								                <option>TRX/USDT</option>
								            </select>

								            <div id="changeContainer">
								                <span class="h5" id="token_pair_value_container"></span>

								                <small id="token_pair_value_percentage_container"></small>
								                <small>24 Hour change</small>
								            </div>
								        </div>

								        <div class="tradingview-widget-container">
								          <div id="tradingview" style="height: 400px;"></div>
								        </div>

								        <div class="d-flex justify-content-center pt-1 mb-2 mt-2">
								            <button class="btn btn-success col-md" id="buy_rise_btn">
								                <img style="width:25px;" src="assets/imgs/icons/growth-graph.png">
								                Buy Rise
								            </button>

								            <button class="btn btn-danger col-md ml-1" id="buy_fall_btn">
								                <img style="width:25px;" src="assets/imgs/icons/graph.png">
								                Buy Fall
								            </button>
								        </div>
								    </div>
								</div>

								<div id="risefall_history_container" class="my-2"> 
								    <ul class="nav nav-tabs nav-fill">
								      <li class="nav-item">
								        <a id="history_tab_link" class="nav-link active main-color-link" aria-current="page" data-toggle="tab" href="#history_tab_btn">History</a>
								      </li>
								      <li class="nav-item">
								        <a id="instructions_tab_link" class="nav-link main-color-link" data-toggle="tab" href="#instructions_tab_btn">Instructions</a>
								      </li>
								    </ul>

								    <div class="tab-content">
								        <div id="history_tab_btn" class=" tab-pane active text-muted my-3">
								            <div class="card main-card-ui p-2 rounded shadow-lg">

								                <div class="d-flex">
								                    <div class="text-center p-2 mt-2">
								                        <div class="flex-fill p-2">
								                            <h5>Today's Earnings:</h5>
								                            <span id="todaysEarningRiseFall">
								                                0 USD
								                            </span>
								                        </div>
								                    </div>

								                    <div class="text-center p-2 mt-2">
								                        <div class="flex-fill p-2">
								                            <h5>All Time Earnings:</h5>
								                            <span id="allTimeEarningsRiseFall">
								                                0 USD
								                            </span>
								                        </div>
								                    </div>
								                </div>
								                

								                <table id="tableContainer" class="" style="font-size: 11px;width: 100%;" cellpadding="0"> 
								                    <thead>
								                        <tr>
								                            <th scope="col">Resolve Time</th>
								                            <th scope="col">Type</th>
								                            <th scope="col">Amount</th>
								                            <th scope="col">Price/Resolved</th>
								                        </tr>
								                    </thead>
								                </table>
								            </div>
								        </div>

								        <div id="instructions_tab_btn" class="tab-pane fade p-2 main-color-text">
								          <span>
								              1. Select token value prediction.<br>
								              2. Select Time limit of prediction.<br>
								              3. Input amount to be staked.<br>
								              4. Wait for time to be resolved.<br>
								              <br>

								              <!-- *Additional<br>
								              If the prediction is right but the token staked was not sent please report it as an appeal and wait for our admins to review what happened to your trade transaction -->
								          </span>

								          <!-- <br> -->
								          <!-- <br> -->

								          <div class="h6">FAQ:</div>
								          <span>
								              <b>1. How are the token predicted value being computed?</b><br>
								              Your value predicted will check the timestamp of that minute's CLOSED value(based on binance OHLC data)

								              <br>

								              <b>2. Are my staked tokens will be liquidated if i lost, how about if i won?</b><br>
								              The staked amount will be doubled if you have predicted the right amount but if you lose all your staked USDT will be liquidated. It's a high risk high reward kind of predictions
								          </span>
								        </div>
								    </div>
								</div>
							</div>
						<!-- risefall -->

						<!-- longshort -->
							<div class="tab-pane fade" id="long" role="tabpanel" aria-labelledby="long-tab">
								<div id="innerContainer">
								    <div class="main-color-text p-1" style="">

								        <div class="p-2 main-color-text mt-5">
								            <label class="fw-bold">Select Token Pair: </label>
								            <select id="token_pair_select" style=";" class="p-2 form-control main-card-ui main-color-text">
								                <option>BTC/USDT</option>
								                <option>ETH/USDT</option>
								                <option>XRP/USDT</option>
								                <option>BNB/USDT</option>
								                <option>DOGE/USDT</option>
								                <option>TRX/USDT</option>
								            </select>

								            <div id="changeContainer">
								                <span class="h5" id="token_pair_value_container"></span>

								                <small id="token_pair_value_percentage_container"></small>
								                <small>24 Hour change</small>
								            </div>
								        </div>

								        <div class="tradingview-widget-container">
								          <div id="tradingview" style="height: 400px;"></div>
								        </div>

								        <div class="d-flex justify-content-center pt-1 mb-2 mt-2">
								            <button class="btn btn-success col-md" id="buy_long_btn">
								                <img style="width:25px;" src="assets/imgs/icons/growth-graph.png">
								                Buy Long
								            </button>

								            <button class="btn btn-danger col-md ml-1" id="buy_short_btn">
								                <img style="width:25px;" src="assets/imgs/icons/graph.png">
								                Buy Short
								            </button>
								        </div>
								    </div>
								</div>

								<div id="future_history_container">
								    <ul class="nav nav-tabs nav-fill">
								      <li class="nav-item">
								        <a id="future_history_tab_link" class="nav-link active main-color-link" aria-current="page" data-toggle="tab" href="#future_history_tab_btn">History</a>
								      </li>
								      <li class="nav-item">
								        <a id="future_instructions_tab_link" class="nav-link main-color-link" data-toggle="tab" href="#future_instructions_tab_btn">Instructions</a>
								      </li>
								    </ul>

								    <div class="tab-content mt-3">
								        <div id="future_history_tab_btn" class="tab-pane active text-muted">
								            <div class="card main-card-ui p-2 rounded shadow-lg">
								                <div class="d-flex">
								                    <div class="text-center p-2 mt-2">
								                        <div class="flex-fill p-2">
								                            <h5>Today's Earnings:</h5>
								                            <span id="todaysEarningLongShort">
								                                0 USD
								                            </span>
								                        </div>
								                    </div>

								                    <div class="text-center p-2 mt-2">
								                        <div class="flex-fill p-2">
								                            <h5>All Time Earnings:</h5>
								                            <span id="allTimeEarningsLongShort">
								                                0 USD
								                            </span>
								                        </div>
								                    </div>
								                </div>
								                
								                <table id="tableContainer" class="" style="font-size: 11px;width: 100%;" cellpadding="0"> 
								                    <thead>
								                        <tr>
								                            <th scope="col">Risk Taken</th>
								                            <th scope="col">Amount</th>
								                            <th scope="col">Risk Price</th>
								                            <th scope="col">Resolved Price</th>
								                        </tr>
								                    </thead>
								                </table>
								            </div>

								        </div>

								        <div id="future_instructions_tab_btn" class="tab-pane fade p-2 main-color-text">
								          <span>
								              1. Select token value prediction.<br>
								              2. Select Time limit of prediction.<br>
								              3. Input amount to be staked.<br>
								              4. Wait for time to be resolved.<br>
								              <br>

								              <!-- *Additional<br>
								              If the prediction is right but the token staked was not sent please report it as an appeal and wait for our admins to review what happened to your trade transaction -->
								          </span>

								          <!-- <br> -->
								          <!-- <br> -->

								          <div class="h6">FAQ:</div>
								          <span>
								              <b>1. How are the token predicted value being computed?</b><br>
								              Your value predicted will check the timestamp of that minute's CLOSED value(based on binance OHLC data)

								              <br>

								              <b>2. Are my staked tokens will be liquidated if i lost, how about if i won?</b><br>
								              The staked amount will be doubled if you have predicted the right amount but if you lose all your staked USDT will be liquidated. It's a high risk high reward kind of predictions
								          </span>
								        </div>
								      </div>
								</div>
							</div>
						<!-- longshort -->

						<!-- daily -->
							<div class="tab-pane fade" id="daily" role="tabpanel" aria-labelledby="daily-tab">
								<div id="title_container" class="text-center" style="display:block">
									<div class="mt-5">
										<h5>Obtain rewards or earn interest!</h5>
									</div>
									<div class="text-muted mt-2 " style="font-size:.7em">
										<i onclick="instruction_btn()" class="fa fa-question-circle"aria-hidden="true"></i>
										Click here for detailed instructions
									</div>
								</div>



								<div id="dailymining_tab_container" class="mt-3">
									<ul id="dailymining_tabs" class="nav nav-tabs nav-justified" role="tablist">
										<li class="nav-item">
											<a id="mine_tab_id" class="nav-link active main-color-link " data-toggle="tab" href="#mine_tab">MINE</a>
										</li>

										<li class="nav-item">
											<a id="claim_tab_id" class="nav-link main-color-link " data-toggle="tab" href="#claim_tab">CLAIM</a>
										</li>
									</ul>	

									<div class="dailymining-tab-content tab-content">
										<div id="mine_tab" class="container tab-pane active"><br>

											<div id="daysBtn_container" class="container text-center mb-5" style="display:block;"></div>

											<div id="daily_mining_token_containers" style="display:none;">

												<div id="days_token_container"></div>
											</div>
										</div>

										<div id="claim_tab" class="tab-pane fade"><br>
											<div id="claim_tokens_container" class="p-4"></div>
										</div>
									</div>
								</div>

								<div class="px-4">
									<div class="card main-card-ui p-2 rounded shadow-lg">
									    <div class="text-center">
									        <h4>Mining History</h4>
									    </div>

									    <table id="tableContainer" class="" style="width: 98%!important;font-size: .85em;">  
									        <thead>
									            <tr>
									                <th>ID</th>
									                <th>Token</th>
									                <th>Balance</th>
									                <th>Period</th>
									                <th>Status</th>
									            </tr>
									        </thead>
									    </table>
									</div>
								</div>
							</div>
						<!-- daily -->

						<!-- regular -->
							<div class="tab-pane fade" id="regular" role="tabpanel" aria-labelledby="regular-tab">
								<div id="title_container" class="text-center" style="display:block">
									<div class="mt-5">
										<h5>Mine and Claim now!</h5>
									</div>
									<div class="text-muted mt-2 " style="font-size:.7em">
										<i onclick="how_compute_btn()" class="fa fa-question-circle"aria-hidden="true"></i>
										How do we compute this?
									</div>
								</div>

								<div id="token_mining_container" class="p-4"></div>
							</div>
						<!-- regular -->

						<!-- discover -->
							<div class="tab-pane fade" id="discover" role="tabpanel" aria-labelledby="discover-tab"><br>

								<div class="row">
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<div class="mt-3">
													<span class="main-color-text fw-bold">Invite friends and earn USDT</span><br>
													<span class="text-muted">Copy the link and send it to your friends & wait for the rewards to be sent</span> 

													<div class="input-group mb-1">
													  <input type="text" class="form-control" id="referal_link_container" readonly>

													  <div class="input-group-append">
													    <button class="btn btn-secondary" style="color:white;" type="button" id="copyLink_btn">Copy</button>
													  </div>
													</div>

													<div id="total_invites" class="main-color-text text-start">
														<span class="main-color-text fw-bold">TOTAL INVITES: </span> 
														<span class="text-muted fw-bold" id="total_invites_container">0</span>
														
														<button class="btn btn-link" id="view_invites_btn">
															<spam class="main-color-text" style="text-decoration: underline;">
																view
															</spam>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<div id="instruction_invites" class="mt-3">
													<span class="main-color-text fw-bold">
														Share the link to earn rewards!
													</span>

												 <div id="noteslist_invite" class="m-2"> 
										        <div class="text-start px-3">
										          <i class="fa fa-caret-right icon_kyc main-color-text" aria-hidden="true"></i><span class="text-start text-muted"> Invite 1 to get 5% reward!</span>
										        </div>
										        <div class="text-start px-3">
										          <i class="fa fa-caret-right icon_kyc main-color-text" aria-hidden="true"></i><span class="text-start text-muted"> Invite 2 to get 6% reward!</span>
										        </div>
										        <div class="text-start px-3 mb-4">
										          <i class="fa fa-caret-right icon_kyc main-color-text" aria-hidden="true"></i><span class="text-start text-muted"> Invite 5 to get 10% reward!</span>
										        </div>
											    </div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card px-2 pb-4 mt-2 rounded shadow-lg">
									<h4 class="main-color-text text-center fw-bold p-4">Top Crypto News</h4>

									<div id="news_container"></div>

									<div id="newsLoading">
										<h3>
											<div class="spinner-grow main-color-text" role="status">
											  <span class="sr-only">Loading Latest News...</span>
											</div>

											Loading Latest News...
										</h3>
									</div>

									<script type="text/javascript">
										baseUrl = "https://widgets.cryptocompare.com/";
										var scripts = document.getElementsByTagName("script");
										var embedder = $("#news_container")[0];

										(function (){
											var appName = encodeURIComponent(window.location.hostname);
											if(appName==""){appName="local";}
											var s = document.createElement("script");
											s.type = "text/javascript";
											s.async = true;
											var theUrl = baseUrl+'serve/v1/coin/feed?fsym=TRX&tsym=USD&feedType=cryptoglobe';
											s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
											
											embedder.append(s)
											$("#newsLoading").toggle();
										})();

										setTimeout(function(){
											var containerATag = $("#news_container a")[1];
											$(containerATag).remove();

											$("#news_container a").attr("href",'#');
											$("#news_container a").attr("target",'');
										},1000)
									</script>
								</div>
							</div>
						<!-- discover -->
					</div>
				</section>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
	});
</script>