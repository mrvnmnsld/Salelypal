<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/index';
$route['index'] = 'main/index';

$route['quickLoadPage'] = 'main/quickLoadPage';
$route['checkLoginCredentials'] = 'main/checkLoginCredentials';
$route['checkEmailAvailability'] = 'main/checkEmailAvailability';
$route['checkPasswordMatch'] = 'main/checkPasswordMatch';

$route['saveSignUpForm'] = 'main/saveSignUpForm';
$route['sendOtp'] = 'main/sendOtp';

$route['homeView'] = 'main/homeView2';
$route['homeViewPro'] = 'main/homeViewPro';
$route['homeViewNotVerified'] = 'main/homeViewNotVerified';


$route['loadAnnouncement'] = 'main/loadAnnouncement';
$route['editProfile'] = 'main/editProfile';
$route['main/editProfileV2'] = 'main/editProfileV2';
$route['saveNewProfilePic'] = 'main/saveNewProfilePic';
$route['confirmPassword'] = 'main/confirmPassword';

$route['main/getCurrentPrice'] = 'main/getCurrentPrice';
$route['main/getTokenInfoViaID'] = 'main/getTokenInfoViaID';

$route['saveFaceImageKyc'] = 'main/saveFaceImageKyc';
$route['saveIDImageKyc'] = 'main/saveIDImageKyc';

$route['main/loadCryptoNews'] = 'main/loadCryptoNews';
$route['main/sendOTPViaEmail'] = 'main/sendOTPViaEmail';
$route['referalLink'] = 'main/referalLink';
$route['checkMobileAvailability'] = 'main/checkMobileNumberAvailability';
$route['checkIfReferalLinkIsValid'] = 'main/checkIfReferalLinkIsValid';

$route['main/sendSMS'] = 'main/sendSMS';
$route['main/getUserInvites'] = 'main/getUserInvites';

$route['saveBirthday'] = 'main/saveBirthday';

// Admin
	$route['admin-login'] = 'admin/adminLogin';
	$route['admin/checkLoginCredentials'] = 'admin/checkLoginCredentials';
	$route['admin-dashboard'] = 'admin/dashboard';
	$route['adminLogout'] = 'admin/adminLogout';


	$route['admin/getTopUpChartData'] = 'admin/getTopUpChartData';
	
	//USERS
		$route['admin/getAllUsers'] = 'admin/getAllUsers';
		$route['admin/userlist/blockuser'] = 'admin/blockuser';
		$route['admin/userlist/unblockuser'] = 'admin/unblockuser';
		$route['admin/userlist/resetPassword'] = 'admin/resetPassword';
		$route['admin/userlist/verify'] = 'admin/verifyUser';
		$route['admin/getKYCImages'] = 'admin/getKYCImages';
	//USERS

	//ADMIN Users
		$route['admin/getAllAdmin'] = 'admin/getAllAdmin';
		$route['admin/adminList/unblockAdmin'] = 'admin/unblockAdmin';
		$route['admin/adminList/blockAdmin'] = 'admin/blockAdmin';
		$route['admin/adminList/resetAdminPassword'] = 'admin/resetAdminPassword';
		$route['admin/adminList/saveNewAdminUser'] = 'admin/saveNewAdminUser';
	//ADMIN Users

	$route['admin/getAllUserTypes'] = 'admin/getAllUserTypes';
	$route['admin/getAllPermission'] = 'admin/getAllPermission';
	$route['admin/getGrantedAllPermission'] = 'admin/getGrantedAllPermission';
	$route['admin/saveEditPermissions'] = 'admin/saveEditPermissions';
	$route['admin/addNewAdminType'] = 'admin/addNewAdminType';
	$route['admin/checkAdminUserNameValidity'] = 'admin/checkAdminUserNameValidity';
	$route['getUserTypePriv'] = 'main/getUserTypePriv';

	$route['getNewNotifs'] = 'main/getNewNotifs';
	$route['getNewNotifsToViewed'] = 'main/getNewNotifsToViewed';
	$route['pushNewNotif'] = 'main/pushNewNotif';

	$route['makeMeMd5'] = 'main/makeMeMd5';

	$route['saveCredentialEdit'] = 'main/saveCredentialEdit';

	$route['admin/getBettingSettings'] = 'admin/getBettingSettings';
	$route['admin/saveBettingSettings'] = 'admin/saveBettingSettings';

	$route['admin/getFutureRisefallTimings'] = 'admin/getFutureRisefallTimings';
	$route['admin/addFutureRisefallOption'] = 'admin/addFutureRisefallOption';
	$route['admin/updateFutureRisefallOption'] = 'admin/updateFutureRisefallOption';
	$route['admin/deleteFutureRisefallOption'] = 'admin/deleteFutureRisefallOption';

	$route['volumeControl'] = 'admin/volumeControl';

// Admin

// MainWallet
	$route['generateNewMainWallet'] = 'mainWallet/generateNewMainWallet';		
	$route['getBalance'] = 'mainWallet/getBalance';	
	$route['sendTrx'] = 'mainWallet/sendTrx';	
	$route['viewAccountDetails'] = 'mainWallet/viewAccountDetails';	
	$route['mainWallet/buyCrypto'] = 'mainWallet/buyCrypto';	

	$route['mainWallet/getTokensByNetwork'] = 'mainWallet/getTokensByNetwork';
	$route['mainWallet/confirmPasswordAdmin'] = 'mainWallet/confirmPasswordAdmin';
	$route['mainWallet/sendWithdrawal'] = 'mainWallet/sendWithdrawal';


	$route['mainWallet/getTronBalance'] = 'mainWallet/getTronBalance';
	$route['mainWallet/getTRC20Balance'] = 'mainWallet/getTRC20Balance';
	$route['mainWallet/getBinancecoinBalance'] = 'mainWallet/getBinancecoinBalance';
	$route['mainWallet/getBscTokenBalance'] = 'mainWallet/getBscTokenBalance';

	$route['mainWallet/createErc20Wallet'] = 'mainWallet/createErc20Wallet';
	$route['mainWallet/getEthereumBalance'] = 'mainWallet/getEthereumBalance';
	$route['mainWallet/getErc20TokenBalance'] = 'mainWallet/getErc20TokenBalance';

	$route['mainWallet/getAllTokensV2'] = 'mainWallet/getAllTokensV2';

// MainWallet

// userWallet
	$route['getAddressDetails'] = 'userWallet/getAddressDetails';	
	$route['getAllTokens'] = 'userWallet/getAllTokens';	
	$route['sendWithdrawal'] = 'userWallet/sendWithdrawal';	
	$route['getPrivateKey'] = 'userWallet/getPrivateKey';	

	$route['getAddressBSC'] = 'userWallet/getAddressBSC';
	$route['getBscBalance'] = 'userWallet/getBscBalance';	
	$route['getBscWalletTransactions'] = 'userWallet/getBscWalletTransactions';
	$route['viewAllTransactionsBsc'] = 'userWallet/viewAllTransactionsBsc';
	$route['getBscWalletTransactionDetails'] = 'userWallet/getBscWalletTransactionDetails';
	$route['getGasPriceBsc'] = 'userWallet/getGasPriceBsc';	

	$route['wallet/getUserPurchase'] = 'userWallet/getUserPurchase';
	$route['userWallet/loadUserWallets'] = 'userWallet/loadUserWallets';
	$route['userWallet/loadAllWithdrawal'] = 'userWallet/loadAllWithdrawal';

	$route['userWallet/getAllSelectedTokens'] = 'userWallet/getAllSelectedTokens';
	$route['userWallet/getAllSelectedTokensVer2'] = 'userWallet/getAllSelectedTokensVer2';
	$route['userWallet/getAllTokensV2'] = 'userWallet/getAllTokensV2';
	
	$route['userWallet/updateTokenManagement'] = 'userWallet/updateTokenManagement';
	$route['userWallet/updateTokenManagementV2'] = 'userWallet/updateTokenManagementV2';

	$route['userWallet/getAllPurchase'] = 'userWallet/getAllPurchase';
	$route['userWallet/getAllAppeals'] = 'userWallet/getAllAppeals';
	$route['userWallet/getMyAppeals'] = 'userWallet/getMyAppeals';
	$route['userWallet/checkReferenceIDIfExist'] = 'userWallet/checkReferenceIDIfExist';
	
	$route['userWallet/purchaseCoins/flagAppeal'] = 'userWallet/flagAppeal';
	$route['userWallet/saveNewAppeal'] = 'userWallet/saveNewAppeal';


	$route['userWallet/getTronBalance'] = 'userWallet/getTronBalance';
	$route['userWallet/getTRC20Balance'] = 'userWallet/getTRC20Balance';

	$route['userWallet/getBinancecoinBalance'] = 'userWallet/getBinancecoinBalance';
	$route['userWallet/getBscTokenBalance'] = 'userWallet/getBscTokenBalance';

	$route['userWallet/getEthereumBalance'] = 'userWallet/getEthereumBalance';
	$route['userWallet/getErc20TokenBalance'] = 'userWallet/getErc20TokenBalance';

	$route['userWallet/getEthGasPrice'] = 'userWallet/getEthGasPrice';
	$route['userWallet/getBscGasPrice'] = 'userWallet/getBscGasPrice';

	$route['userWallet/getTokenDifference'] = 'userWallet/getTokenDifference';
	$route['userWallet/getTokenValue'] = 'userWallet/getTokenValue';

	$route['userWallet/tokenListing/saveEdit'] = 'userWallet/tokenSaveEdit';
	$route['userWallet/tokenListing/saveNewToken'] = 'userWallet/tokenSaveNew';
	
	$route['userWallet/backupBSCJson'] = 'userWallet/backupBSCJson';

	$route['userWallet/getErc20Transactions'] = 'userWallet/getErc20Transactions';

	$route['userWallet/checkTokenByContractAddress'] = 'userWallet/checkTokenByContractAddress';

	// PNL
		$route['userWallet/getToken24HourChange'] = 'userWallet/getToken24HourChange';
	// PNL
		
	// strict
		$route['userWallet/strictModeToggle'] = 'userWallet/strictModeToggle';
		$route['userWallet/getCurrentUserStrictStatus'] = 'userWallet/getCurrentUserStrictStatus';
		$route['userWallet/saveWithdrawalStrict'] = 'userWallet/saveWithdrawalStrict';
		$route['userWallet/strictMode/ApproveWithdrawal'] = 'userWallet/ApproveWithdrawal';
		$route['userWallet/strictMode/declineWithdrawal'] = 'userWallet/declineWithdrawal';
	// strict

	//contract
		$route['userWallet/future/savePosition'] = 'userWallet/futureSavePosition';
		$route['userWallet/future/getPendingPositions'] = 'userWallet/futureGetPendingPositions';
		$route['userWallet/future/resolvePosition'] = 'userWallet/futureResolvePosition';
		$route['userWallet/future/getClosedPositions'] = 'userWallet/futureGetClosedPositions';
		$route['userWallet/future/cancelPosition'] = 'userWallet/futureCancelPosition';
		$route['userWallet/future/admin/getAllContractPositions'] = 'userWallet/getAllContractPositions';
		$route['userWallet/future/getFuturePositionDetailsByID'] = 'userWallet/getFuturePositionDetailsByID';
	//contract

	//riseFall
		$route['userWallet/future/saveRiseFallPosition'] = 'userWallet/futureSaveRiseFallPosition';
		$route['userWallet/future/getPendingRiseFallPositions'] = 'userWallet/futureGetPendingRiseFallPositions';
		$route['userWallet/future/cancelRiseFallPosition'] = 'userWallet/futureCancelRiseFallPosition';
		$route['userWallet/future/resolveRiseFallPosition'] = 'userWallet/futureResolveRiseFallPosition';
		$route['userWallet/riseFall/admin/getAllRiseFall'] = 'userWallet/getAllRiseFall';
		$route['userWallet/future/getClosedRiseFallPositions'] = 'userWallet/futureGetClosedRiseFallPositions';
		$route['userWallet/risefall/getRiseFallDetailsByID'] = 'userWallet/getRiseFallDetailsByID';

		$route['userWallet/risefall/getPositionSet'] = 'userWallet/getRiseFallPositionSet';
		$route['userWallet/future/setRiseFallPosition'] = 'userWallet/setRiseFallPosition';
		
		$route['userWallet/future/setContractPosition'] = 'userWallet/setContractPosition';
		$route['userWallet/future/getFuturePositionSet'] = 'userWallet/getFuturePositionSet';

		$route['userWallet/riseFall/checkIfSet'] = 'userWallet/checkIfRisefallSet';
		$route['userWallet/riseFall/getPositionDetails'] = 'userWallet/risefallGetPositionDetails';

		$route['userWallet/future/checkIfSet'] = 'userWallet/futureCheckIfSet';
		$route['userWallet/future/getPositionDetails'] = 'userWallet/futureGetPositionDetails';
	//riseFall

		$route['userWallet/getAllContractPositionsViaUserID'] = 'userWallet/getAllContractPositionsViaUserID';


		

	//mining
		//Regular
			$route['getRegularMiningSettings'] = 'mining/getRegularMiningSettings';
			$route['mining/saveNewToken'] = 'mining/saveNewToken';
			$route['mining/saveEditToken'] = 'mining/saveEditToken';
			$route['mining/regular/deleteToken'] = 'mining/deleteRegularToken';

			$route['mining/getMyMiningEntries'] = 'mining/getMyMiningEntries';
			$route['mining/saveMiningEntry'] = 'mining/saveMiningEntry';
			$route['mining/claimLockTokensAndIncome'] = 'mining/claimLockTokensAndIncome';

			$route['mining/getAllRegularMiningEntries'] = 'mining/getAllRegularMiningEntries';		
			$route['mining/editMiningEntry'] = 'mining/editMiningEntry';		
		//Regular

		// daily
			$route['mining/daily/getDailySettings'] = 'mining/getDailySettings';	
			$route['mining/daily/saveNewDailyToken'] = 'mining/saveNewDailyToken';
			$route['mining/daily/saveEditDailyToken'] = 'mining/saveEditDailyToken';
			$route['mining/daily/deleteToken'] = 'mining/deleteDailyToken';

			$route['mining/daily/getDailyEntries'] = 'mining/getDailyEntries';
			$route['mining/daily/saveMiningEntry'] = 'mining/saveDailyMiningEntry';
			$route['mining/daily/getClaimEntriesByEntryID'] = 'mining/getClaimEntriesByEntryID';
			$route['mining/daily/claimIncome'] = 'mining/claimDailyIncome';
			$route['mining/daily/compoundIncome'] = 'mining/compoundDailyIncome';

			$route['mining/daily/getAllDailyEntries'] = 'mining/getAllDailyEntries';
			$route['mining/daily/editMiningEntry'] = 'mining/editDailyMiningEntry';

			$route['mining/daily/getAddDays'] = 'mining/getAddDays';
			$route['mining/daily/saveDays'] = 'mining/saveDays';
			$route['mining/daily/updateDays'] = 'mining/updateDays';
			$route['mining/daily/getDayTokens'] = 'mining/getDayTokens';
			$route['mining/daily/getDailyMiningDaysSettings'] = 'mining/getDailyMiningDaysSettings';

			$route['mining/daily/getPurchasableLimit'] = 'mining/getPurchasableLimit';
			$route['mining/daily/getTokenBalanceLimit'] = 'mining/getTokenBalanceLimit';
			$route['mining/daily/getTokensToClaim'] = 'mining/getTokensToClaim';
			

			

		// daily
	//mining


	$route['userWallet/loadUserWithdrawal'] = 'userWallet/loadUserWithdrawal';
	$route['userWallet/getAllSelectedTokensInfo'] = 'userWallet/getAllSelectedTokensInfo';
	$route['userWallet/getPriceAlert'] = 'userWallet/getPriceAlert';
	$route['userWallet/updatePriceAlert'] = 'userWallet/updatePriceAlert';
	$route['userWallet/triggerPriceAlerts'] = 'userWallet/triggerPriceAlerts';
	$route['userWallet/setTokenPriceAlerted'] = 'userWallet/setTokenPriceAlerted';
	$route['userWallet/sendWithdrawalV2'] = 'userWallet/sendWithdrawalV2';


// userWallet

// bitKeep
	$route['bitkeep-page1'] = 'bitkeep/bitkeepMain1';	
	$route['bitkeep-page2'] = 'bitkeep/bitkeepMain';	
	$route['bitkeep-page2-test'] = 'bitkeep/bitkeepMainTest';	
	$route['phoneToPng'] = 'bitkeep/phoneToPng';
// bitKeep

//agent management
	$route['agent-login'] = 'agent/agentLogin';
	$route['agent/getAgent'] = 'agent/getAgent';
	$route['agent/saveNewAgent'] = 'agent/saveNewAgent';
	$route['agent/updateAgentInfo'] = 'agent/updateAgentInfo';
	$route['agent/deleteAgent'] = 'agent/deleteAgent';
	$route['agent/getAgentInvites'] = 'agent/getAgentInvites';

	$route['agent/checkUserNameAvailability'] = 'agent/checkUserNameAvailability';
	$route['agent/checkAgentEmailAvailability'] = 'agent/checkAgentEmailAvailability';

	$route['agent/getMonthlyInvites'] = 'agent/getMonthlyInvites';
	$route['agent/getYearlyInvites'] = 'agent/getYearlyInvites';

	$route['agent/getIndirectReferal1stDegree'] = 'agent/getIndirectReferal1stDegree';


	
//agent management

//users management
	$route['getUsers'] = 'testPlatform/getUsers';
	$route['saveNewUser'] = 'testPlatform/saveNewUser';
	$route['deleteUser'] = 'testPlatform/deleteUser';
	$route['updateUserInfo'] = 'testPlatform/updateUserInfo';
	$route['compareEmailUpdate'] = 'testPlatform/compareEmailUpdate';
//users management

//create wallet
	$route['walletTesting/walletView'] = 'walletTesting/walletView';
	$route['walletTesting/createWallet'] = 'walletTesting/createWallet';
	$route['walletTesting/getTronBalance'] = 'walletTesting/getTronBalance';
	$route['walletTesting/sendTron'] = 'walletTesting/sendTron';

	// $route['walletTesting/createWallet'] = 'walletTesting/createWallet';
	// $route['walletTesting/getTronBalance'] = 'walletTesting/getTronBalance';
//create wallet


$route['getCountries'] = 'main/getCountries';
$route['testing'] = 'main/testing';

	// testing platform
		// $route['test-platform'] = 'testPlatform/indexNormal';
		// $route['test-platform-pro'] = 'testPlatform/indexPro';

		$route['test-platform/getTronBalance'] = 'testPlatform/getTronBalance';
		$route['test-platform/getBinancecoinBalance'] = 'testPlatform/getBinancecoinBalance';
		$route['test-platform/getEthereumBalance'] = 'testPlatform/getEthereumBalance';
		$route['test-platform/getTokenBalanceBySmartAddress'] = 'testPlatform/getTokenBalanceBySmartAddress';

		$route['test-platform/risefall/openPosition'] = 'testPlatform/riseFallOpenPosition';
		$route['test-platform/risefall/winPosition'] = 'testPlatform/riseFallWinPosition';

		$route['test-platform/future/openPosition'] = 'testPlatform/riseFallOpenPosition';
		$route['test-platform/future/winPosition'] = 'testPlatform/futureWinPosition';


		$route['test-platform/getUserPurchase'] = 'testPlatform/getUserPurchase';
		$route['test-platform/buyCrypto'] = 'testPlatform/buyCrypto';

		$route['test-platform/newBalance'] = 'testPlatform/newBalance';
		$route['test-platform/getUserBuyHistory'] = 'testPlatform/getUserBuyHistory';
	// testing platform

	// tests
		$route["faceRecog"] = 'admin/faceRecog';

	// tests


		$route["privacyPolicy"] = 'main/privacyPolicy';
		$route["termsAndConditions"] = 'main/termsAndConditions';





	





$route[(':any')] = 'main/error';
